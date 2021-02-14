<html>

<head>
    <title>Hangman</title>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <link href="{{ asset('Semantic-UI-CSS-master/semantic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stock-theme.css') }}" rel="stylesheet" id="custom-theme">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <br>
    <div class="main ui container">
        <div class="ui segment">
            <div class="ui fluid form">
                <h1 class="ui header"> Hangman </h1>
                <h2 id="category" class="ui header"> Category: &nbsp;<span id="categoryContent"> </span></h2>
                <div class="ui field" id="controlButtons">
                    <fieldset>
                        <legend class="ui header" id="chooseDifficulty" align="center"> Choose Difficulty </legend>
                        <button class="ui green button" id="easy" value="1">Easy</button>
                        <button class="ui yellow button" id="medium" value="2">Medium</button>
                        <button class="ui red button" id="hard" value="3">Hard</button>
                     </fieldset>
                </div>
                <h2 id="ShowMe">_ _ _ _ _ _ _ _ _</h2>
                <div class="ui form">

                    <div id="mainFrame">
                        <div class="ui field">
                            <svg width="33.14703724mm" height="41.5387783mm" viewBox="0 0 33.14703724 41.5387783">
                                <g id="myHangman" fill="none" stroke="black" stroke-width="1"></g>
                            </svg>
                            <div id="strokedLetters"></div>
                        </div>
                        <div id="buttons" class="ui field">
                            <table id="letters"></table>
                        </div>
                    </div>
                    <footer>
                    
                        <div class="custom_styles">
                            <label for="custom-styles">Choose a style:</label>

                            <select name="custom-styles" id="custom-styles">
                              <option value="stock-theme" selected="true">stock theme</option>
                              <option value="arch">arch</option>
                              <option value="carbon">carbon</option>
                              <option value="sweden">sweden</option>
                              <option value="aether">aether</option>
                              <option value="rudy">rudy</option>
                              <option value="dark_magic_girl">dark-magic-girl</option>
                            </select>
                        </div>                        
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/hangman_script.js') }}" path="{{ asset('js/hangman.json') }}"></script>
    <script src="{{ asset('js/theme_changer.js')}}" charset="utf8"></script>
</body>

</html>