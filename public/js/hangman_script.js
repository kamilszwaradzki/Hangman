/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var countRecords = 0;
var myId;
var difficulty;
var selectedDifficulty;

var count = 0;

const PATH = document.currentScript.getAttribute('path');

function loadHangmanFromFile(){
    let CONST_HANGMAN_SVG = [];
    $.getJSON(PATH, function (data) {
        $.each(data, function (i, f) {
            CONST_HANGMAN_SVG.push(document.createElementNS("http://www.w3.org/2000/svg", f[0]));
            for (var j = 1; j <= f[1].length; j += 2)
            {
                CONST_HANGMAN_SVG[i].setAttribute(f[1][j - 1], f[1][j]);
            }
        });
    });
    return CONST_HANGMAN_SVG;
}
let hangmanSVG =  loadHangmanFromFile();

$("#easy,#medium,#hard").click(function (e) {
    difficulty = $(this).attr('value');
    selectedDifficulty = $(this).attr('id');
    $("fieldset:has(#chooseDifficulty)").hide();
    $('.ui.red.header,.ui.green.header,#easy,#medium,#hard').hide();
    $('#strokedLetters').empty();
    $("#ShowMe,#mainFrame").show();
    $('#myHangman').empty();
    var letterButton = '<tr>';
    for (var i = 0; i < 26; ++i) {
        if (i === 13) {
            letterButton += '</tr><tr>';
        }
        letterButton += '<td class="letter ' + $(this).attr('id') + '"><div class="letter-button ' + $(this).attr('id') + '">' + String.fromCharCode(65 + i) + '</div></td>';
    }
    letterButton += '</tr>';
    $("#letters").html(letterButton);
    $('.letter').removeClass('disabled');
    clickedLetter();
    $('#letters').show();
    $.ajax({
        url: "/count/" + difficulty
    })
            .done(function (msg) {
                countRecords = msg;
                myId = Math.floor(Math.random() * Math.floor(countRecords));
                $.ajax({
                    url: "/modified/" + difficulty + "/" + myId
                })
                        .done(function (msg) {
                            $("#ShowMe").text(msg[0].join(" "));
                            if(msg[1] !== null) {
                                $("#category").show();
                                $("#categoryContent").text(msg[1]);   
                            }
                            else{
                                $("#category").hide();
                            }
                        });
            });
});

function clickedLetter(){
    $('.letter').click(function () {
    $(this).toggleClass('disabled');
    $('#strokedLetters').append("<del>" + $(this).text() + "</del>&nbsp;");
    const searchStr = $(this).text();
    var indexes = [];
    $.ajax({
        url: '/contain/' + difficulty + '/' + myId,
        data: {
            letter: searchStr
        }
    })
            .done(function (data) {
                indexes = data; // type array
                let a = $("#ShowMe").text().split(" ");
                if (indexes.length === 0) {
                    // draw next line
                    // load all vectors to array and one-by-one display

                    $("#myHangman").append(hangmanSVG.shift());

                    if (hangmanSVG.length === 0) {
                        hangmanSVG =  loadHangmanFromFile();
                        $('#letters').hide();
                        $("#buttons").append('<h1 class="ui red header">Game Over!</h1>');
                        $.ajax({
                            url: '/wholeword/' + difficulty + '/' + myId
                        })
                                .done(function (data) {
                                    $("#ShowMe").text("The word I mean is: " + data);
                                });
                        $("fieldset:has(#chooseDifficulty),fieldset:has(#chooseDifficulty)>button").show();
                    }
                } else {
                    for (var i = 0; i < indexes.length; i++) {
                        a[indexes[i]] = searchStr;
                    }
                    var joinedA = a.join("");
                    if (joinedA.indexOf('_') === -1) {
                        hangmanSVG = loadHangmanFromFile();
                        $('#letters').hide();
                        $("#buttons").append('<h1 class="ui green header">You Win!</h1>');
                        $("fieldset:has(#chooseDifficulty),fieldset:has(#chooseDifficulty)>button").show();
                    }
                    
                }
                $("#ShowMe").text(a.join(" "));

            });
});
}