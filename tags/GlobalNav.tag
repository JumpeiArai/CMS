<GlobalNav>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo text-capitalize">Hello.js</a>
        <a href="#" data-activates="mobile" class="button-collapse" id="buttonCollapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down" onclick="{onclick}">
            <li><a><i class="small material-icons">library_books</i></a></li>
            <li><a><i class="small material-icons">web</i></a></li>
            <li><a><i class="small material-icons">perm_identity</i></a></li>
            <li><a><i class="small material-icons">contacts</i></a></li>
            <li><a href="./admin/login.php"><i class="material-icons">settings</i></a></li>
        </ul>
        <ul class="side-nav" id="mobile" onclick="{onclick}">
            <li><a><i class="small material-icons">library_books</i><span>blog</span></a></li>
            <li><a><i class="small material-icons">web</i><span>portfolio</span></a></li>
            <li><a><i class="small material-icons">perm_identity</i><span>profile</span></a></li>
            <li><a><i class="small material-icons">contacts</i><span>contact</span></a></li>
            <li><a><i class="material-icons">settings</i><span>setting</span></a></li>
        </ul>
    </div>
</nav>


    <script>
        var self = this;
        this.selected = "Profile";
        this.mountedTag = riot.mount('Profile');
        this.on('mount',function(){
            $(".button-collapse").sideNav();
        });
        this.onclick = function(e){
            switch (e.target.innerText) {
                case "library_books" :
                    if(self.selected !== "Blog"){
                        if(self.mountedTag) {
                            self.mountedTag[0].unmount(true);
                        }
                        self.mountedTag = riot.mount('Blog');
                        self.selected = "Blog";
                        }
                    break;
                case "perm_identity" :
                    if(self.selected !=="Profile") {
                        if(self.mountedTag) {
                            self.mountedTag[0].unmount(true);
                        }
                        self.mountedTag = riot.mount('Profile');
                        self.selected = "Profile";
                    }
                    break;
                case "web" :
                    if(self.selected !=="Web") {
                        if(self.mountedTag) {
                            self.mountedTag[0].unmount(true);
                        }
                        self.mountedTag = riot.mount('Portfolio');
                        self.selected = "Portfolio";
                    }
                    break;
                case "settings" :
                    route("./admin/login.php");
                    break;
            }
        };
    </script>

</GlobalNav>