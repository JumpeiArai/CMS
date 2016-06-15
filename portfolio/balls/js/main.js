    //2D circle collidion engine
    //canvas -> move -> action(hitted) -> canvas ...loop
    //Vectorを生成するクラスを定義
    var Vector = function (x, y) {
        this.x = x;
        this.y = y;
    }
    Vector.prototype.addVec = function (Vec) {
        return new Vector(this.x + Vec.x, this.y + Vec.y);
    }
    Vector.prototype.mulVec = function (x, y) {
            var y = y || x;
            return new Vector(this.x * x, this.y * y);
        }
        //内積
    Vector.prototype.dotVec = function (Vec) {
            return this.x * Vec.x + this.y * Vec.y;
        }
        //外積
    Vector.prototype.crossVec = function (Vec) {
            return new this.x * Vec.y - this.y * Vec.y;
        }
        //移動
    Vector.prototype.move = function (dx, dy) {
        this.x += dx;
        this.y += dy;
    }

    //円を生成するクラスを定義
    //(x,y) :position   (v.x,v.y) :vector  (a.x,a.y) : accelaration 
    //b : restitution
    var Circle = function (x, y, r) {
        this.x = x;
        this.y = y;
        this.r = r;
        //     this.b=1;
        this.color = colorGen();
        this.v = new Vector(0, 0);
        this.a = new Vector(0, 0);
        this.move = function (dx, dy) {
            this.x += dx;
            this.y += dy;
        }
    }
    Circle.prototype.hitCircle = function (oppCcl) {
        var d = Math.pow(oppCcl.x - this.x, 2) + Math.pow(oppCcl.y - this.y, 2)
        if (d >= Math.pow(oppCcl.r + this.r, 2)) {
            return;
        } //相手が接触してない時処理を抜ける

        //衝突処理に必要な計算を行う
        var dist = Math.sqrt(d);
        var over_dist = this.r - oppCcl.r + dist;
        var centerVec = new Vector(this.x - oppCcl.x, this.y - oppCcl.y) //相手と自分の中心を結ぶベクトル
        var anormUnit = centerVec.mulVec(1 / dist); //centarVecを正規化=単位法線ベクトル
        var bnormUnit = anormUnit.mulVec(-1); //anormUnitの逆ベクトル
        ///////////////////

        //衝突処理を行う

        //まず重なっている場合に外にだす
        this.move(anormUnit.x * over_dist / 4, anormUnit.x * over_dist / 4);
        oppCcl.move(bnormUnit.x * over_dist / 4, bnormUnit.y * over_dist / 4);
        /////////////////

        var aTangUnit = new Vector(anormUnit.y * -1, anormUnit.x); // 接線ベクトルa
        var bTangUnit = new Vector(bnormUnit.y * -1, bnormUnit.x); // 接線ベクトルb

        var aNorm = anormUnit.mulVec(anormUnit.dotVec(this.v)); // aベクトル法線成分
        var aTang = aTangUnit.mulVec(aTangUnit.dotVec(this.v)); // aベクトル接線成分
        var bNorm = bnormUnit.mulVec(bnormUnit.dotVec(oppCcl.v)); // bベクトル法線成分
        var bTang = bTangUnit.mulVec(bTangUnit.dotVec(oppCcl.v)); // bベクトル接線成分

        this.v = new Vector(bNorm.x + aTang.x, bNorm.y + aTang.y);
        oppCcl.v = new Vector(aNorm.x + bTang.x, aNorm.y + bTang.y);

    }

    function World(gX, gY) {
        this.gravity = new Vector(gX, gY);
        this.objects = [];
        this.setGravity = function (x, y) {
            this.gravity.x = x;
            this.gravity.y = y;
        }
    }
    World.prototype.step = function () {
        var objects = this.objects;
        var gravity = this.gravity;

        objects.forEach(function (e) {
            var a = e.a;
            e.v = e.v.addVec(gravity);
            e.v = e.v.addVec(a);
            e.move(e.v.x, e.v.y);
            /////wallBlock///////
            if (e.x < e.r) {
                var overdist = e.r - e.x;
                e.x += overdist;
                e.v.x *= -0.9;
            } else if (e.x > 500 - e.r) {
                var overdist = e.x + e.r - 500;
                e.x -= overdist;
                e.v.x *= -0.9;
            } else if (e.y < e.r) {
                var overdist = e.r - e.y;
                e.y += overdist;
                e.v.y *= -0.9;
            } else if (e.y > 500 - e.r) {
                var overdist = e.y + e.r - 500;
                e.y -= overdist;
                e.v.y *= -0.9;
            }
            ////////////
        });
        for (var i = 0; i < objects.length - 1; i++) {
            for (var j = i + 1; j < objects.length; j++) {
                var o0 = objects[i];
                var o1 = objects[j];
                o0.hitCircle(o1);
            }
        }
    }
    World.prototype.clickEvent = function (e) {
        var x = e.clientX;
        var y = e.clientY;
        var r = Math.floor(Math.random() * 19) + 5;
        var vx = Math.random() - 0.5;
        var vy = Math.random() - 0.5;
        var tmpC = new Circle(x, y, r);
        tmpC.v.x = vx;
        tmpC.v.y = vy;
        world.objects.push(tmpC);
    }

    var world;
    var ctx;

    function init() {
        world = new World(0, 0.1);
        ctx = document.querySelector("canvas").getContext("2d");
        setInterval(mainMet, 1000 / 60);
    }

    function mainMet() {
        world.step();
        redraw();
    }

    function colorGen() {
        return '#' + Math.floor(Math.random() * 16777215).toString(16);
    }

    function redraw() {
        ctx.fillStyle = "gray";
        ctx.fillRect(0, 0, 500, 500);
        for (var i = 0; i < world.objects.length; i++) {
            var e = world.objects[i];
            ctx.fillStyle = e.color;
            ctx.strokeStyle = "white";
            ctx.beginPath();
            ctx.arc(e.x, e.y, e.r, 0, Math.PI * 2);
            ctx.closePath();
            ctx.fill();
        }
    }
    $(document).ready(function () {
        window.addEventListener('click', function (e) {
            world.clickEvent(e);
        }, false);
        init();
    });