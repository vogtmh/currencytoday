﻿const url = 'https://api.frankfurter.dev/v1/'

var selectedBase;
var selectedCurrency;

var appVersion;
var appString;

var stockdata;
var metadata;
var timeseries;
var timeitems;
var rateitems;
var latest;
var latest_close;

var currencies = [];
var bases = [];
var labels = [];
var datapoints = [];

const daysAgo = n => {
    let d = new Date();
    d.setDate(d.getDate() - Math.abs(n));
    return d;
};

function loadSettings() {
    if (localStorage.getItem("base") === null) {
        console.log("Base does not exist in localstorage. Creating ..");
        localStorage.base = "EUR";
        selectedBase = localStorage.base;
    } else {
        selectedBase = localStorage.base;
        console.log("Base from localstorage: " + selectedBase);
    }

    if (localStorage.getItem("currency") === null) {
        console.log("Currency does not exist in localstorage. Creating ..");
        localStorage.currency = "THB";
        selectedCurrency = localStorage.currency;
    } else {
        selectedCurrency = localStorage.currency;
        console.log("Currency from localstorage: " + selectedCurrency);
    }
}

function timeConverter(UNIX_timestamp) {
    var a = new Date(UNIX_timestamp);
    var year = a.getFullYear();
    var month = a.getMonth() + 1;
    if (month < 10) { month = '0' + month }
    var day = a.getDate();
    if (day < 10) { day = '0' + day }
    var hour = a.getHours();
    if (hour < 10) { hour = '0' + hour }
    var min = a.getMinutes();
    if (min < 10) { min = '0' + min }
    var time = year + '-' + month + '-' + day;
    return time;
}

function drawChart2() {
    try {
        let resetCanvas = `<canvas id="stockChart" height="300" width="400"></canvas>`;
        $("#canvasContainer").html(resetCanvas);
    }
    catch (e) {
        let message = e.message;
        $("#infobox").html("Error while resetting canvas: " + message);
    }

    try {
        var ctx = document.getElementById('stockChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'close price in Euro',
                    data: datapoints,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1.0)',
                    borderWidth: 2,
                    pointRadius: 2,
                    pointHitRadius: 5,
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                }
            }
        });
    }
    catch (e) {
        let message = e.message;
        $("#infobox").html("Error while drawing chart: " + message);
    }
}

function getStockdata() {
    var start_date = timeConverter(daysAgo(60));
    var end_date = timeConverter(Date.now());
    let query = url + start_date + ".." + end_date + "?base=" + selectedBase;
    labels = [];
    datapoints = [];

    $.ajax({
        url: query,
        type: 'GET',
        dataType: 'json',
        success(response) {
            stockdata = response;
            var metadate, seriesZero, rate;
            if (stockdata.hasOwnProperty("base")) {
                try {
                    metadate = stockdata.end_date;
                    timeseries = stockdata.rates;
                    timeitems = Object.keys(timeseries).length
                    seriesZero = timeseries[Object.keys(timeseries)[0]]
                    rateitems = Object.keys(seriesZero).length
                    console.log(stockdata);
                    currencies = [];
                    bases = [];

                    // get available currencies
                    for (let i = 0; i < rateitems; i++) {
                        let currency = Object.keys(seriesZero)[i]
                        currencies.push(currency);
                    }
                    bases = currencies.slice();
                    let base = stockdata.base;
                    bases.push(base)
                    bases.sort()

                    // get series for selected currency
                    for (let i = 0; i < timeitems; i++) {
                        let label = Object.keys(timeseries)[i]
                        let alldata = timeseries[Object.keys(timeseries)[i]]
                        let datapoint = alldata[selectedCurrency]
                        rate = datapoint;
                        labels.push(label);
                        datapoints.push(datapoint);
                    }
                }
                catch (e) {
                    let message = e.message;
                    $("#infobox").html("Error while refreshing stats: " + message);
                }
                drawChart2();

                try {
                    $("#heading").html("1 " + selectedBase)
                    $("#rate").html(rate + " " + selectedCurrency)

                    if (appString != "") {
                        $("#infobox").html(appString + " - rate: " + metadate)
                    }
                    else {
                        $("#infobox").html("rate: " + metadate)
                    }
                }
                catch (e) {
                    let message = e.message;
                    $("#infobox").html("Error while refreshing stats: " + message);
                }
            }
            else {
                console.log('No valid data found')
            }
            if (stockdata.hasOwnProperty("Information")) {
                information = stockdata["Information"]
                $("#infobox").html(information)
            }
        },
        error(jqXHR, status, errorThrown) {
            console.log('failed to fetch ' + query)
        },
    });
}

function showCurrencyselection(mode) {
    var html = '';

    if (mode == "base") {
        for (let i = 0; i < (rateitems + 1); i++) {
            let currency = bases[i]
            if (currency == selectedBase) {
                html += `<div class="currencybutton" style="background-color: Highlight" onclick="setBase('` + currency + `')">` + currency + '</div>';
            }
            else {
                html += `<div class="currencybutton" onclick="setBase('` + currency + `')">` + currency + '</div>';
            }
        }
    }
    if (mode == "target") {
        for (let i = 0; i < rateitems; i++) {
            let currency = currencies[i]
            if (currency == selectedCurrency) {
                html += `<div class="currencybutton" style="background-color: Highlight" onclick="setCurrency('` + currency + `')">` + currency + '</div>';
            }
            else {
                html += `<div class="currencybutton" onclick="setCurrency('` + currency + `')">` + currency + '</div>';
            }
        }
    }
    
    $("#currencyselection").html(html);
    $("#currencyselection").show();
}

function setBase(currency) {
    $("#currencyselection").hide();
    localStorage.base = currency;
    selectedBase = localStorage.base;
    getStockdata();
}

function setCurrency(currency) {
    $("#currencyselection").hide();
    localStorage.currency = currency;
    selectedCurrency = localStorage.currency;
    getStockdata();
}

$(document).ready(function () {
    try {
        appVersion = Windows.ApplicationModel.Package.current.id.version;
        appString = `v${appVersion.major}.${appVersion.minor}.${appVersion.build}`;
        var currentView = Windows.UI.Core.SystemNavigationManager.getForCurrentView();
        currentView.appViewBackButtonVisibility = Windows.UI.Core.AppViewBackButtonVisibility.visible;
    }
    catch (e) {
        console.log('Windows namespace not available, backbutton listener and versioninfo skipped.')
        appString = '';
    }

    document.onselectstart = new Function("return false")

    loadSettings()
    getStockdata();
});

setInterval(getStockdata, 3600000); // check once per hour