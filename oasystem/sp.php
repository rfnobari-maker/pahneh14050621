<div id="divBottomLeft" style="position: absolute; z-index: 9898; left: 20px; top: 450px;">
<div style="position:relative;width:139px;height:25px;text-align:center;background-image:url(images/chat-bg.png);background-position:center top;background-repeat:no-repeat;padding-top:71px">
                <script type="text/javascript" src="http://online.1abzar.com/1abzar.php?admin=5138&amp;hide=1&amp;on=http://pahneh.eaj.ir/login/reza.gif&amp;off=http://1abzar.com/off.jpg"></script>
                <div style="display:none">
                  <h3><a tit="tit" href="http://www.1abzar.com">&#1662;&#1588;&#1578;&#1740;&#1576;&#1575;&#1606;&#1740;</a></h3>
</div>
</div>
<script type="text/javascript">
    var ns = (navigator.appName.indexOf("Netscape") != -1);
    var d = document;
    function JSFX_FloatDiv(id, sx, sy) {
        var el = d.getElementById ? d.getElementById(id) : d.all ? d.all[id] : d.layers[id];
        var px = document.layers ? "" : "px";
        window[id + "_obj"] = el;
        if (d.layers) el.style = el;
        el.cx = el.sx = sx; el.cy = el.sy = sy;
        el.sP = function (x, y) { this.style.left = x + px; this.style.top = y + px; };

        el.floatIt = function () {
            var pX, pY;
            pX = (this.sx >= 0) ? 0 : ns ? innerWidth :
		document.documentElement && document.documentElement.clientWidth ?
		document.documentElement.clientWidth : document.body.clientWidth;
            pY = ns ? pageYOffset : document.documentElement && document.documentElement.scrollTop ?
		document.documentElement.scrollTop : document.body.scrollTop;
            if (this.sy < 0)
                pY += ns ? innerHeight : document.documentElement && document.documentElement.clientHeight ?
		document.documentElement.clientHeight : document.body.clientHeight;
            this.cx += (pX + this.sx - this.cx) / 8; this.cy += (pY + this.sy - this.cy) / 8;
            this.sP(this.cx, this.cy);
            setTimeout(this.id + "_obj.floatIt()", 40);
        }
        return el;
    }
    JSFX_FloatDiv("divBottomLeft", 20, -205).floatIt();
</script>
