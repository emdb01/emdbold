/*
 * 	portBox 1.0 - jQuery plugin
 *	written by Joey Navarro	http://www.joeynavarro.com
 *	Copyright (c) 2013 Joey Navarro (http://www.joeynavarro.com)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 */
(function (e) {
    e(document).on("click", "[data-display]", function (t) {
        //selected mails written by murali

//selected mails written by murali
        t.preventDefault();
        var n = e(this).attr("data-display");
        e("#" + n).display(e(this).data())
    });
    e.fn.display = function (t) {
        var n = {animation: "fade", animationspeed: 200, closeBGclick: true};
        t = e.extend({}, n, t);
        return this.each(function () {
            function u() {
                r = false
            }
            function a() {
                r = true
            }
            var n = e(this), r = false, i = e(".portBox-overlay"), s;
            var o = false;
            if (navigator.userAgent.match(/Windows Phone/i)) {
                o = true
            }
            if (i.length == 0) {
                i = e('<div class="portBox-overlay" />').insertAfter(n)
            }
            if (typeof e.fn.slimScroll == "function") {
                s = true
            } else {
                s = false
            }
            if (n.has(".scrollBar").length == 0 && s == true) {
                n.wrapInner('<div class="scrollBar" style="padding-right:20px;" />'), n.css({"padding-right": 10});
                e(function () {
                    e(".scrollBar").slimScroll({height: "100%"})
                });
                n.append('<a class="close-portBox">&#215;</a>')
            }
            if (n.has(".close-portBox").length == 0 && s == false) {
                n.append('<a class="close-portBox">&#215;</a>')
            }
            n.center = function () {
                var t, r;
                if (n.outerHeight() + 25 > e(window).height() && s === true && o === false) {
                    var i = e(window).height() - 80;
                    n.css({height: i + "px"})
                }
                n.css({top: 0, left: 0});
                t = Math.max(e(window).height() - n.outerHeight(), 0) / 2;
                r = Math.max(e(window).width() - n.outerWidth(), 0) / 2;
                n.css({top: t + e(window).scrollTop(), left: r + e(window).scrollLeft()});
                if (n.innerWidth() + 10 >= e(window).width()) {
                    n.css({"margin-right": 5 + "px"}), e(".close-portBox").css({top: 3, right: 3})
                } else {
                    n.css({"margin-right": 0 + "px"}), e(".close-portBox").css({top: -6, right: -7})
                }
                if (n.outerHeight() >= e(window).height() && s == false) {
                    n.css({top: 20 + e(window).scrollTop()})
                }
            };
            n.center();
            e(window).on("resize.portBox", n.center);
            n.on("portBox:open", function () {
                if (!r) {
                    a();
                    if (t.animation == "") {
                        n.css({display: "block"}), i.css({display: "block"});
                        u()
                    } else {
                        i.fadeIn(t.animationspeed);
                        n.show(t.animation, t.animationspeed);
                        u()
                    }
                }
            });
            n.on("portBox:close", function () {
                if (!r) {
                    a();
                    if (t.animation == "") {
                        n.css({display: "none"}), i.css({display: "none"});
                        u()
                    } else {
                        i.fadeOut(t.animationspeed), n.fadeOut(t.animationspeed);
                        u()
                    }
                    e(window).off("resize.portBox")
                }
            });
            n.trigger("portBox:open");
            var f = e(".close-portBox").one("click.portBoxEvent", function () {
                n.trigger("portBox:close")
            });
            if (t.closeBGclick) {
                i.css({cursor: "pointer"});
                i.one("click.portBoxEvent", function () {
                    n.trigger("portBox:close")
                })
            }
            e("body").keyup(function (e) {
                if (e.which === 27) {
                    n.trigger("portBox:close")
                }
            })
        })
    }
})(jQuery);
/*
 *! Copyright (c) 2011 Piotr Rochala (http://rocha.la)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.1.0
 *
 */
(function (e) {
    jQuery.fn.extend({slimScroll: function (t) {
            var n = {width: "auto", height: "250px", size: "7px", color: "#000", position: "right", distance: "1px", start: "top", opacity: .4, alwaysVisible: false, disableFadeOut: false, railVisible: false, railColor: "#333", railOpacity: .2, railDraggable: true, railClass: "slimScrollRail", barClass: "slimScrollBar", wrapperClass: "slimScrollDiv", allowPageScroll: false, wheelStep: 20, touchScrollStep: 200};
            var r = e.extend(n, t);
            this.each(function () {
                function E(t) {
                    if (!n) {
                        return
                    }
                    var t = t || window.event;
                    var i = 0;
                    if (t.wheelDelta) {
                        i = -t.wheelDelta / 120
                    }
                    if (t.detail) {
                        i = t.detail / 3
                    }
                    var s = t.target || t.srcTarget;
                    if (e(s).closest("." + r.wrapperClass).is(v.parent())) {
                        S(i, true)
                    }
                    if (t.preventDefault && !d) {
                        t.preventDefault()
                    }
                    if (!d) {
                        t.returnValue = false
                    }
                }
                function S(e, t, n) {
                    var i = e;
                    var s = v.outerHeight() - b.outerHeight();
                    if (t) {
                        i = parseInt(b.css("top")) + e * parseInt(r.wheelStep) / 100 * b.outerHeight();
                        i = Math.min(Math.max(i, 0), s);
                        i = e > 0 ? Math.ceil(i) : Math.floor(i);
                        b.css({top: i + "px"})
                    }
                    l = parseInt(b.css("top")) / (v.outerHeight() - b.outerHeight());
                    i = l * (v[0].scrollHeight - v.outerHeight());
                    if (n) {
                        i = e;
                        var u = i / v[0].scrollHeight * v.outerHeight();
                        u = Math.min(Math.max(u, 0), s);
                        b.css({top: u + "px"})
                    }
                    v.scrollTop(i);
                    v.trigger("slimscrolling", ~~i);
                    N();
                    C()
                }
                function x() {
                    if (window.addEventListener) {
                        this.addEventListener("DOMMouseScroll", E, false);
                        this.addEventListener("mousewheel", E, false)
                    } else {
                        document.attachEvent("onmousewheel", E)
                    }
                }
                function T() {
                    f = Math.max(v.outerHeight() / v[0].scrollHeight * v.outerHeight(), p);
                    b.css({height: f + "px"});
                    var e = f == v.outerHeight() ? "none" : "block";
                    b.css({display: e})
                }
                function N() {
                    T();
                    clearTimeout(u);
                    if (l == ~~l) {
                        d = r.allowPageScroll;
                        if (c != l) {
                            var e = ~~l == 0 ? "top" : "bottom";
                            v.trigger("slimscroll", e)
                        }
                    }
                    c = l;
                    if (f >= v.outerHeight()) {
                        d = true;
                        return
                    }
                    b.stop(true, true).fadeIn("fast");
                    if (r.railVisible) {
                        y.stop(true, true).fadeIn("fast")
                    }
                }
                function C() {
                    if (!r.alwaysVisible) {
                        u = setTimeout(function () {
                            if (!(r.disableFadeOut && n) && !i && !s) {
                                b.fadeOut("slow");
                                y.fadeOut("slow")
                            }
                        }, 1e3)
                    }
                }
                var n, i, s, u, a, f, l, c, h = "<div></div>", p = 30, d = false;
                var v = e(this);
                if (v.parent().hasClass(r.wrapperClass)) {
                    var m = v.scrollTop();
                    b = v.parent().find("." + r.barClass);
                    y = v.parent().find("." + r.railClass);
                    T();
                    if (e.isPlainObject(t)) {
                        if ("scrollTo"in t) {
                            m = parseInt(r.scrollTo)
                        } else if ("scrollBy"in t) {
                            m += parseInt(r.scrollBy)
                        } else if ("destroy"in t) {
                            b.remove();
                            y.remove();
                            v.unwrap();
                            return
                        }
                        S(m, false, true)
                    }
                    return
                }
                r.height = r.height == "auto" ? v.parent().innerHeight() : r.height;
                var g = e(h).addClass(r.wrapperClass).css({position: "relative", overflow: "hidden", width: r.width, height: r.height});
                v.css({overflow: "hidden", width: r.width, height: r.height});
                var y = e(h).addClass(r.railClass).css({width: r.size, height: "100%", position: "absolute", top: 0, display: r.alwaysVisible && r.railVisible ? "block" : "none", "border-radius": r.size, background: r.railColor, opacity: r.railOpacity, zIndex: 90});
                var b = e(h).addClass(r.barClass).css({background: r.color, width: r.size, position: "absolute", top: 0, opacity: r.opacity, display: r.alwaysVisible ? "block" : "none", "border-radius": r.size, BorderRadius: r.size, MozBorderRadius: r.size, WebkitBorderRadius: r.size, zIndex: 99});
                var w = r.position == "right" ? {right: r.distance} : {left: r.distance};
                y.css(w);
                b.css(w);
                v.wrap(g);
                v.parent().append(b);
                v.parent().append(y);
                if (r.railDraggable) {
                    b.draggable({axis: "y", containment: "parent", start: function () {
                            s = true
                        }, stop: function () {
                            s = false;
                            C()
                        }, drag: function (t) {
                            S(0, e(this).position().top, false)
                        }})
                }
                y.hover(function () {
                    N()
                }, function () {
                    C()
                });
                b.hover(function () {
                    i = true
                }, function () {
                    i = false
                });
                v.hover(function () {
                    n = true;
                    N();
                    C()
                }, function () {
                    n = false;
                    C()
                });
                v.bind("touchstart", function (e, t) {
                    if (e.originalEvent.touches.length) {
                        a = e.originalEvent.touches[0].pageY
                    }
                });
                v.bind("touchmove", function (e) {
                    e.originalEvent.preventDefault();
                    if (e.originalEvent.touches.length) {
                        var t = (a - e.originalEvent.touches[0].pageY) / r.touchScrollStep;
                        S(t, true)
                    }
                });
                if (r.start === "bottom") {
                    b.css({top: v.outerHeight() - b.outerHeight()});
                    S(0, true)
                } else if (r.start !== "top") {
                    S(e(r.start).position().top, null, true);
                    if (!r.alwaysVisible) {
                        b.hide()
                    }
                }
                x();
                T()
            });
            return this
        }});
    jQuery.fn.extend({slimscroll: jQuery.fn.slimScroll})
})(jQuery);