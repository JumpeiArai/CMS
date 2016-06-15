<Profile>
    <div class="container" id="pro-wrapper">
        <div id="cont-wrapper">
            <h1>Whats this?</h1>

            <p>ja_rascalのブログ兼ポートフォリオサイトです</p>

            <div class="card center">
                <div class="row">
                    <div class="col s12 m6">
                        <div class="card cyan">
                            <div class="card-content center">
                                <img src="./img/self.jpg" alt="" class="circle responsive-img">
                            </div>
                            <div class="card-content white-text">
                                <span class="card-title">Name : Arai Jumpei</span>
                                <p>G's Academ　1期生</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var self = this;
        this.on('updated',function(){
            $('#pro-wrapper #cont-wrapper').hide();
            $('#pro-wrapper').show().fadeIn();
            $('#pro-wrapper #cont-wrapper').fadeIn();
        });
    </script>

</Profile>