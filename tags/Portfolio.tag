<Portfolio>
        <div class="row" id="pf-wrapper">
            <div class="card medium col s6 m4 hoverable portfolio" each={data} onclick="{onclick}">
                <div class="card-image">
                    <img src="./portfolio/{appname}/img.jpg" alt="">
                </div>
                <div class="card-title center">
                    <p>{title}</p>
                </div>
                <div class="card-content">
                    <span>{detail}</span>
                </div>
            </div>
        </div>
    <script>
        var self = this;
        this.on("mount",function(){
            $.get('./api/portfolio.php',function(data){
                self.data = data;
                self.update();
            });
        });
        this.onclick = function(e){
            window.open('./portfolio/'+e.item.appname+'/index.html');
        };
        this.on('updated',function(){
            $('#pf-wrapper .portfolio').hide();
            $('#pf-wrapper').show().fadeIn();
            $('#pf-wrapper .portfolio').fadeIn();
        });
    </script>

    <style scoped>
        :scope .card .card-image img {
            top:0.75em;
        }
        :scope .card .card-title p{
            margin-bottom: 10px;
            text-decoration-line: underline;
        }
        :scope .card-content {
            border-top: solid 1px dimgray;
        }
        :scope .card:hover {
            opacity: .8;
            filter: alpha(opacity=80);
        }
        :scope div.row div.card.medium {
            height : 500px;
        }
        :scope .card {
            margin:0.75em;
        }
    </style>
</Portfolio>


