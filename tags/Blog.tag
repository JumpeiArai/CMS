<Blog>
    <div class="row">

    <div class="col s12 m9 articles">
        <div class="col s12">
            <div class="card gray lighten-5">
                <div class="card-content gray-text">
                    <News news = {opts.news} />
                </div>
            </div>
            <div class="card gray lighten-5" id="article" each={data}>
                <div class="card-content gray-text">
                    <p class="card-title">{title}</p>
                    <span>{tag}</span><p class="card-date">{indate}</p>
                    <raw html={detail}></raw>
                </div>
            </div>
            <div class="pn-wrapper center">
            <ul class="pagination">
                <li class="disabled"><a href="#"><i class="material-icons">chevron_left</i></a></li>
                <li class="waves-effect"><a href="#"><i class="material-icons">chevron_right</i></a></li>
            </ul>
            </div>
        </div>
    </div>
        <div class="col s3 sidebar hide-on-small-and-down">
            <!--Sidebar Guides-->
            <div class="card gray lighten-5">
                <div class="card-content gray-text categ">
                    <p class="card-title">category</p>
                </div>
                <Tags></Tags>
            </div>
            <div class="card gray lighten-5">
                <div class="card-content gray-text">
                    <span class="card-title">backnumber</span>
                    <Backnumber></Backnumber>
                </div>
            </div>
        </div>
    </div>

    <script>
        var that = this;
        this.data = [{title:"dummy",detail:"naiyou",indate:"6.Apr"}];
        this.on('mount',function(){
            $.get('./api/article.php',function(data){
                data[0].detail = data[0].detail.replace(/\n/g,'<br>');
                that.data = data;
                that.update();
            });
            riot.tag('raw', '<span></span>', function(opts) {
                this.root.innerHTML = opts.html;
            });
        });
        this.on('updated',function(){
            $('#article .card-content').hide();
            $('#article').show().slideDown();
            $('#article .card-content').slideDown();
        });
    </script>

    <style scoped>
        div.row div.col.s12.m9.articles{
            padding:0;
            margin:0;
        }
        .news{
            border-bottom: 1px solid darkgray;
        }
        :scope .card-title{
            border-bottom: 1px solid darkgray;
        }
        :scope #article {
            position: relative;
        }
        :scope .card-date{
            text-align: right;
        }
        :scope .card-content.categ{
            padding-bottom:0;
        }
    </style>
</Blog>

<News>
    <p class="news">最新の投稿</p>
    <p each={news}><a onclick={onclick}>{title} <span class="indate">{indate}</span></a></p>

    <script>
        var that = this;
        this.news = [{title:"newdummy1",id:1},{title:"newdummy2",id:2},{title:"newdummy3",id:3}];
        this.on('mount',function(){
           $.get("./api/news.php",function(data){
               that.news = data;
               that.update();
           });
        });
        this.onclick = function(e){
            var id = e.item.id;
            $.post('./api/article.php',{id:id},function(data) {
                data[0].detail = data[0].detail.replace(/\n/g,'<br>');
                that.parent.data = data;
                that.parent.update();
            });
        };
    </script>

    <style scoped>
        :scope .indate{
            float:right;
            margin-right:20px;
        }
        :scope a:hover{
            cursor:pointer;
        }
    </style>
</News>

<Backnumber>
    <li each={data} ><a onclick={onclick}>{year}({cnt})</a></li>

    <script>
        var self = this;
        this.on('mount',function(){
            $.get('./api/backnumber.php',function(data){
                self.data = data;
                self.update();
            });
        });
    </script>
    
    <style scoped>
        :scope a:hover{
            corsor:pointer;
        }
    </style>
</Backnumber>

<Tags>
    <div class="card-content gray-text">
        <ul>
            <li each="{name, cnt in data}" onclick="{onclick}"><a>{name}({cnt})</a></li>
        </ul>
    </div>

    <script>
        var self = this;

        this.on('mount',function(){
            $.get('./api/tags.php',function(data){
                self.data= data;
                self.update();
            });
        });
        this.onclick = function(e){
            $.post("./api/category.php",{tag:e.item.name},function(data){
                var arr = Object.keys(data).map(key => data[key]);
                arr.forEach(function(rec){
                    rec.detail = rec.detail.replace(/\n/g,'<br>');
                });
                self.parent.data = arr;
                self.parent.update();
            });
        };
    </script>

    <style scoped>
        :scope div.card-content li:hover{
            cursor:pointer;
        }
        :scope div.card-content ul{
            margin-top:0;
        }
    </style>
</Tags>