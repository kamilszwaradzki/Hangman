<html>
    <head>
        <title>Hangman</title>
        <script type="text/javascript" charset="utf8" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
        <link href="{{asset('Semantic-UI-CSS-master/semantic.min.css')}}" rel="stylesheet">
    </head>
    <body>
    <br>
        <div class="main ui container" >
            <div class="ui segment">
                <div class="ui fluid form" >
                <h1 class="ui header" style="text-align: center;"> Hangman </h1>
                <div class="ui field" id="controlButtons" style="text-align: center;display: block;margin: auto;">
                            <button class="ui green button" id="randomWordButton">Random word</button>
                </div>
                <h2 style="text-align: center;display:none;" id="ShowMe">_ _ _ _ _ _ _ _ _</h2>
                    <div class="ui form" >

                        <div style="display:none;" id="mainFrame">
                            <div class="ui field">
                                <svg style="display: block;margin: auto;" width="33.14703724mm" height="41.5387783mm" viewBox="0 0 33.14703724 41.5387783">
                                    <g id="myHangman" lc:layername="0" lc:is_locked="false" lc:is_construction="false" fill="none" stroke="black" stroke-width="1">
                                    </g>
                                </svg>
                                <div id="strokedLetters"></div>
                            </div>
                            <div id="buttons" class="ui field" style="display: block;margin: auto;">
                            <table id="letters" style="width:500px; margin: 10px auto;">
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        var countRecords = 0;
        var myId;
        $("#randomWordButton").click(function(){
            $("#randomWordButton").hide();
            $('.ui.red.header,.ui.green.header').hide();
            $('#strokedLetters').empty();
            $("#ShowMe,#mainFrame").show();
            $('#myHangman').empty();
            $('td button').attr('disabled', false);
            $('#letters').show();
            $.ajax({
                url: "/count"
            })
             .done(function( msg ) {
                countRecords = msg;
                myId = Math.floor(Math.random() * Math.floor(countRecords));
                $.ajax({
                    url: "/modified",
                    data: {id:myId}
                })
                .done(function(msg) {
                    console.log(msg);
                    $("#ShowMe").text(msg.join(" "));
                });
            });
        });
        var tmp = '<tr>';
        for(var i = 0; i < 26;++i)
        {
            if(i == 13)
            {
                tmp+='</tr><tr><td style="text-align:center;"><button class="ui green button" style="text-align:center;padding:12px 25px 6px; box-sizing: border-box; width:25px;">'+String.fromCharCode(65+i)+'</button></td>';
            }
            else{
                tmp+='<td style="text-align:center;"><button class="ui green button" style="text-align:center;padding:12px 25px 6px; box-sizing: border-box; width:25px;">'+String.fromCharCode(65+i)+'</button></td>';
            }
        }
        tmp+='</tr>';
        $("#letters").append(tmp);
        var count = 0;
        var rightDesk = document.createElementNS("http://www.w3.org/2000/svg","line");
        rightDesk.setAttribute("x1","0");
        rightDesk.setAttribute("y1","41.5387783");
        rightDesk.setAttribute("x2","9.42794058");
        rightDesk.setAttribute("y2","25.20910621");
        var leftDesk = document.createElementNS("http://www.w3.org/2000/svg","line");
        leftDesk.setAttribute("x1","9.42794058");
        leftDesk.setAttribute("y1","25.20910621");
        leftDesk.setAttribute("x2","18.82727987");
        leftDesk.setAttribute("y2","41.48923942");
        var vertical = document.createElementNS("http://www.w3.org/2000/svg","line");
        vertical.setAttribute("x1","9.42794058");
        vertical.setAttribute("y1","25.20910621");
        vertical.setAttribute("x2","9.42794058");
        vertical.setAttribute("y2","0");
        var horizontal = document.createElementNS("http://www.w3.org/2000/svg","line");
        horizontal.setAttribute("x1","9.42794058");
        horizontal.setAttribute("y1","0");
        horizontal.setAttribute("x2","30.49998096");
        horizontal.setAttribute("y2","0");
        var line = document.createElementNS("http://www.w3.org/2000/svg","line");
        line.setAttribute("x1","30.49998096");
        line.setAttribute("y1","0");
        line.setAttribute("x2","30.49998096");
        line.setAttribute("y2","6.63934416");
        var head = document.createElementNS("http://www.w3.org/2000/svg","circle");
        head.setAttribute("cx","30.49998096");
        head.setAttribute("cy","8.53064243");
        head.setAttribute("r","1.89129827");
        var body = document.createElementNS("http://www.w3.org/2000/svg","line");
        body.setAttribute("x1","30.37572436");
        body.setAttribute("y1","10.41785452");
        body.setAttribute("x2","30.37572436");
        body.setAttribute("y2","19.7364358");
        var arms = document.createElementNS("http://www.w3.org/2000/svg","line");
        arms.setAttribute("x1","27.47426785");
        arms.setAttribute("y1","14.21288203");
        arms.setAttribute("x2","33.14703724");
        arms.setAttribute("y2","14.21288203");
        var rightLeg = document.createElementNS("http://www.w3.org/2000/svg","line");
        rightLeg.setAttribute("x1","30.37572436");
        rightLeg.setAttribute("y1","19.7364358");
        rightLeg.setAttribute("x2","28.03678708");
        rightLeg.setAttribute("y2","23.78759401");
        var leftLeg = document.createElementNS("http://www.w3.org/2000/svg","line");
        leftLeg.setAttribute("x1","30.49751248");
        leftLeg.setAttribute("y1","19.67375092");
        leftLeg.setAttribute("x2","32.77290586");
        leftLeg.setAttribute("y2","23.61484786");
        let hangmanSVG = [ // change to DOM Element
            rightDesk,
            leftDesk,
            vertical,
            horizontal,
            line,
            head,
            body,
            arms,
            rightLeg,
            leftLeg
        ];
        $('td button').click(function(e){
            $(this).attr('disabled', true);
            $('#strokedLetters').append("<del style='font-size:16px;'>"+$(this).text()+"</del>&nbsp;");
            const searchStr=$(this).text();
            $(this).addClass("hidden");
            var indexes = [];
            $.ajax({
                url: '/contain',
                data: {id:myId,letter:searchStr} 
            })
            .done(function (data){
                indexes = data; // type array
                let a = $("#ShowMe").text().split(" ");
                if(indexes.length == 0)
                {
                    // draw next line
                    // load all vectors to array and one-by-one display

                    $("#myHangman").append(hangmanSVG.shift());
                    
                    if(hangmanSVG.length == 0) {
                        hangmanSVG = [ // change to DOM Element
                            rightDesk,
                            leftDesk,
                            vertical,
                            horizontal,
                            line,
                            head,
                            body,
                            arms,
                            rightLeg,
                            leftLeg
                        ];
                        $('#letters').hide();
                        $("#buttons").append('<h1 class="ui red header" style="text-align: center;">Game Over!</h1>');
                        $.ajax({
                        url: '/wholeword',
                        data: {id:myId}
                        })
                        .done(function (data){
                            $("#ShowMe").text("The word I mean is: "+data);
                            });
                        $("#randomWordButton").show();
                    }
                }
                else{
                    for(var i = 0; i<indexes.length; i++)
                    {
                        a[indexes[i]] = searchStr;
                    }
                    var joinedA = a.join("");
                    if(joinedA.indexOf('_') == -1)
                    {
                        hangmanSVG = [ // change to DOM Element
                            rightDesk,
                            leftDesk,
                            vertical,
                            horizontal,
                            line,
                            head,
                            body,
                            arms,
                            rightLeg,
                            leftLeg
                        ];
                        $('#letters').hide();
                        $("#buttons").append('<h1 class="ui green header" style="text-align: center;">You Win!</h1>');
                        $("#randomWordButton").show();
                    }
                }
                $("#ShowMe").text(a.join(" "));
                    
            });         
        });
        </script>
    </body>
</html>