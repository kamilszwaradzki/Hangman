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
                <h2 style="text-align: center;" id="ShowMe">_ _ _ _ _ _ _ _ _</h2>
                    <div class="ui form" >
                        <div class="ui field">
                            <svg style="display: block;margin: auto;" width="33.14703724mm" height="41.5387783mm" viewBox="0 0 33.14703724 41.5387783">
                                <g lc:layername="0" lc:is_locked="false" lc:is_construction="false" fill="none" stroke="black" stroke-width="1">
                                    <line x1="0" y1="41.5387783" x2="9.42794058" y2="25.20910621"/>
                                    <line x1="9.42794058" y1="25.20910621" x2="18.82727987" y2="41.48923942"/>
                                    <line x1="18.82727987" y1="41.48923942" x2="9.42794058" y2="25.20910621"/>
                                    <line x1="9.42794058" y1="25.20910621" x2="9.42794058" y2="0"/>
                                    <line x1="9.42794058" y1="0" x2="30.49998096" y2="0"/>
                                    <line x1="30.49998096" y1="0" x2="30.49998096" y2="6.63934416"/>
                                    <circle cx="30.49998096" cy="8.53064243" r="1.89129827"/>
                                    <line x1="30.37572436" y1="10.41785452" x2="30.37572436" y2="19.7364358"/>
                                    <line x1="30.37572436" y1="19.7364358" x2="28.03678708" y2="23.78759401"/>
                                    <line x1="30.49751248" y1="19.67375092" x2="32.77290586" y2="23.61484786"/>
                                    <line x1="27.47426785" y1="14.21288203" x2="33.14703724" y2="14.21288203"/>
                                </g>
                            </svg>
                        </div>
                        <div class="ui field" style="display: block;margin: auto;">
                        <table id="letters" style="width:500px; margin: 10px auto;">
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
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
        $("#letters").append(tmp)
        $('button').click(function(e){
            const sourceStr='occurence';
            const searchStr=$(this).text();
            $(this).addClass("hidden");
            const indexes = [...sourceStr.matchAll(new RegExp(searchStr, 'gi'))].map(a => a.index);

            let a = $("#ShowMe").text().split(" ");
            if(indexes.length == 0)
            {
                // draw next line
            }
            else{
                for(var i = 0; i<indexes.length; i++)
                {
                    a[indexes[i]] = searchStr;
                }

            }
            $("#ShowMe").text(a.join(" "));
        });
        </script>
    </body>
</html>