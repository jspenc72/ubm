/** Verify.js - v0.0.1 - 2013/06/12
 * https://github.com/jpillora/verify
 * Copyright (c) 2013 Jaime Pillora - MIT
 */
(function (e, t, i) {
    function n(e, t) {
        function n() {
            f("ajax error"), t.callback("There has been an error")
        }

        function r() {
            d.prompt(u, !1);
            for (var e = s.loading[p]; e.length;) e.pop().success.apply(t, arguments);
            s.loaded[p] = arguments
        }
        var o = {
                method: "GET",
                timeout: 15e3
            },
            l = t._exec,
            u = "GroupRuleExecution" === l.type ? l.element.domElem : t.field,
            h = e.success,
            c = e.error,
            d = l.element.options,
            p = JSON ? JSON.stringify(e) : a(),
            m = {
                success: h,
                error: c || n
            };
        if (s.loaded[p]) {
            var g = s.loaded[p],
                v = m.success;
            return v.apply(t, g), i
        }
        if (s.loading[p] || (s.loading[p] = []), s.loading[p].push(m), 1 === s.loading[p].length) {
            d.prompt(u, "Checking...", "load");
            var y = {
                success: r,
                error: r
            };
            l.ajax = $.ajax($.extend(o, e, y))
        }
    }

    function r(e) {
        $.extend(!0, this, e)
    }(function (e, t, i) {
        "use strict";
        var n, r, s, a, o, l, u, h, c, d, f, p, m, g, v, y, b, A, x, w, E, F, R, k = [].indexOf || function (e) {
            for (var t = 0, i = this.length; i > t; t++)
                if (t in this && this[t] === e) return t;
            return -1
        };
        b = "notify", y = b + "js", x = {
            t: "top",
            m: "middle",
            b: "bottom",
            l: "left",
            c: "center",
            r: "right"
        }, c = ["l", "c", "r"], R = ["t", "m", "b"], m = ["t", "b", "l", "r"], g = {
            t: "b",
            m: null,
            b: "t",
            l: "r",
            c: null,
            r: "l"
        }, v = function (e) {
            var t;
            return t = [], $.each(e.split(/\W+/), function (e, n) {
                var r;
                return r = n.toLowerCase().charAt(0), x[r] ? t.push(r) : i
            }), t
        }, F = {}, s = {
            name: "core",
            html: '<div class="' + y + '-wrapper">\n  <div class="' + y + '-arrow"></div>\n  <div class="' + y + '-container"></div>\n</div>',
            css: "." + y + "-corner {\n  position: fixed;\n  margin: 5px;\n  z-index: 1050;\n}\n\n." + y + "-corner ." + y + "-wrapper,\n." + y + "-corner ." + y + "-container {\n  position: relative;\n  display: block;\n  height: inherit;\n  width: inherit;\n  margin: 3px;\n}\n\n." + y + "-wrapper {\n  z-index: 1;\n  position: absolute;\n  display: inline-block;\n  height: 0;\n  width: 0;\n}\n\n." + y + "-container {\n  display: none;\n  z-index: 1;\n  position: absolute;\n  cursor: pointer;\n}\n\n." + y + "-text {\n  position: relative;\n}\n\n." + y + "-arrow {\n  position: absolute;\n  z-index: 2;\n  width: 0;\n  height: 0;\n}"
        }, E = {
            "border-radius": ["-webkit-", "-moz-"]
        }, u = function (e) {
            return F[e]
        }, r = function (t, n) {
            var r, s;
            if (!t) throw "Missing Style name";
            if (!n) throw "Missing Style definition";
            return (null != (s = F[t]) ? s.cssElem : void 0) && (e.console && console.warn("" + b + ": overwriting style '" + t + "'"), F[t].cssElem.remove()), n.name = t, F[t] = n, r = "", n.classes && $.each(n.classes, function (e, t) {
                return r += "." + y + "-" + n.name + "-" + e + " {\n", $.each(t, function (e, t) {
                    return E[e] && $.each(E[e], function (i, n) {
                        return r += "  " + n + e + ": " + t + ";\n"
                    }), r += "  " + e + ": " + t + ";\n"
                }), r += "}\n"
            }), n.css && (r += "/* styles for " + n.name + " */\n" + n.css), r ? (n.cssElem = p(r), n.cssElem.attr("id", "notify-" + n.name)) : i
        }, p = function (e) {
            var t;
            t = a("style"), t.attr("type", "text/css"), $("head").append(t);
            try {
                t.html(e)
            } catch (i) {
                t[0].styleSheet.cssText = e
            }
            return t
        }, A = {
            clickToHide: !0,
            autoHide: !0,
            autoHideDelay: 5e3,
            arrowShow: !0,
            arrowSize: 5,
            elementPosition: "bottom",
            globalPosition: "top right",
            style: "bootstrap",
            className: "error",
            showAnimation: "slideDown",
            showDuration: 400,
            hideAnimation: "slideUp",
            hideDuration: 200,
            gap: 5
        }, f = function (e, t) {
            var i;
            return i = function () {}, i.prototype = e, $.extend(!0, new i, t)
        }, o = function (e) {
            return $.extend(A, e)
        }, a = function (e) {
            return $("<" + e + "></" + e + ">")
        }, h = {}, l = function (e) {
            var t;
            return e.is("[type=radio]") && (t = e.parents("form:first").find("[type=radio]").filter(function (t, i) {
                return $(i).attr("name") === e.attr("name")
            }), e = t.first()), e
        }, d = function (e, t, n) {
            var r, s;
            if ("string" == typeof n) n = parseInt(n, 10);
            else if ("number" != typeof n) return;
            if (!isNaN(n)) return r = x[g[t.charAt(0)]], s = t, e[r] !== i && (t = x[r.charAt(0)], n = -n), e[t] === i ? e[t] = n : e[t] += n, null
        }, w = function (e, t, i) {
            if ("l" === e || "t" === e) return 0;
            if ("c" === e || "m" === e) return i / 2 - t / 2;
            if ("r" === e || "b" === e) return i - t;
            throw "Invalid alignment"
        }, n = function () {
            function e(e, t, i) {
                "string" == typeof i && (i = {
                    className: i
                }), this.options = f(A, $.isPlainObject(i) ? i : {}), this.loadHTML(), this.wrapper = $(s.html), this.wrapper.data(y, this), this.arrow = this.wrapper.find("." + y + "-arrow"), this.container = this.wrapper.find("." + y + "-container"), this.container.append(this.userContainer), e && e.length && (this.elementType = e.attr("type"), this.originalElement = e, this.elem = l(e), this.elem.data(y, this), this.elem.before(this.wrapper)), this.container.hide(), this.run(t)
            }
            return e.prototype.loadHTML = function () {
                var e;
                if (e = this.getStyle(), this.userContainer = $(e.html), this.text = this.userContainer.find("[data-notify-text]"), 0 === this.text.length && (this.text = this.userContainer.find("[data-notify-html]"), this.rawHTML = !0), 0 === this.text.length) throw "style: '" + name + "' HTML is missing a: 'data-notify-text' or 'data-notify-html' attribute";
                return this.text.addClass("" + y + "-text")
            }, e.prototype.show = function (e, t) {
                var n, r, s, a, o, l = this;
                if (r = function () {
                    return e || l.elem || l.destroy(), t ? t() : i
                }, o = this.container.parent().parents(":hidden").length > 0, s = this.container.add(this.arrow), n = [], o && e) a = "show";
                else if (o && !e) a = "hide";
                else if (!o && e) a = this.options.showAnimation, n.push(this.options.showDuration);
                else {
                    if (o || e) return r();
                    a = this.options.hideAnimation, n.push(this.options.hideDuration)
                }
                return n.push(r), s[a].apply(s, n)
            }, e.prototype.setGlobalPosition = function () {
                var e, t, i, n, r, s, o, l;
                return l = this.getPosition(), o = l[0], s = l[1], r = x[o], e = x[s], n = o + "|" + s, t = h[n], t || (t = h[n] = a("div"), i = {}, i[r] = 0, "middle" === e ? i.top = "45%" : "center" === e ? i.left = "45%" : i[e] = 0, t.css(i).addClass("" + y + "-corner"), $("body").append(t)), t.prepend(this.wrapper)
            }, e.prototype.setElementPosition = function () {
                var e, t, n, r, s, a, o, l, u, h, f, p, v, y, b, A, E, F, j, T, I, C, O, S, D, M, z, N, P;
                for (O = this.getPosition(), T = O[0], F = O[1], j = O[2], f = this.elem.position(), l = this.elem.outerHeight(), p = this.elem.outerWidth(), u = this.elem.innerHeight(), h = this.elem.innerWidth(), S = this.wrapper.position(), s = this.container.height(), a = this.container.width(), y = x[T], A = g[T], E = x[A], o = {}, o[E] = "b" === T ? l : "r" === T ? p : 0, d(o, "top", f.top - S.top), d(o, "left", f.left - S.left), P = ["top", "left"], D = 0, z = P.length; z > D; D++) I = P[D], b = parseInt(this.elem.css("margin-" + I), 10), b && d(o, I, b);
                if (v = Math.max(0, this.options.gap - (this.options.arrowShow ? n : 0)), d(o, E, v), this.options.arrowShow) {
                    for (n = this.options.arrowSize, t = $.extend({}, o), e = this.userContainer.css("border-color") || this.userContainer.css("background-color") || "white", M = 0, N = m.length; N > M; M++) I = m[M], C = x[I], I !== A && (r = C === y ? e : "transparent", t["border-" + C] = "" + n + "px solid " + r);
                    d(o, x[A], n), k.call(m, F) >= 0 && d(t, x[F], 2 * n)
                } else this.arrow.hide();
                return k.call(R, T) >= 0 ? (d(o, "left", w(F, a, p)), t && d(t, "left", w(F, n, h))) : k.call(c, T) >= 0 && (d(o, "top", w(F, s, l)), t && d(t, "top", w(F, n, u))), this.container.is(":visible") && (o.display = "block"), this.container.removeAttr("style").css(o), t ? this.arrow.removeAttr("style").css(t) : i
            }, e.prototype.getPosition = function () {
                var e, t, i, n, r, s, a, o;
                if (t = this.options.position || (this.elem ? this.options.elementPosition : this.options.globalPosition), e = v(t), 0 === e.length && (e[0] = "b"), i = e[0], 0 > k.call(m, i)) throw "Must be one of [" + m + "]";
                return (1 === e.length || (n = e[0], k.call(R, n) >= 0 && (r = e[1], 0 > k.call(c, r))) || (s = e[0], k.call(c, s) >= 0 && (a = e[1], 0 > k.call(R, a)))) && (e[1] = (o = e[0], k.call(c, o) >= 0 ? "m" : "l")), 2 === e.length && (e[2] = e[1]), e
            }, e.prototype.getStyle = function (e) {
                var t;
                if (e || (e = this.options.style), e || (e = "default"), t = F[e], !t) throw "Missing style: " + e;
                return t
            }, e.prototype.updateClasses = function () {
                var e, t;
                return e = ["base"], $.isArray(this.options.className) ? e = e.concat(this.options.className) : this.options.className && e.push(this.options.className), t = this.getStyle(), e = $.map(e, function (e) {
                    return "" + y + "-" + t.name + "-" + e
                }).join(" "), this.userContainer.attr("class", e)
            }, e.prototype.run = function (e, t) {
                var n = this;
                return $.isPlainObject(t) ? $.extend(this.options, t) : "string" === $.type(t) && (this.options.color = t), this.container && !e ? (this.show(!1), i) : this.container || e ? (this.text[this.rawHTML ? "html" : "text"](e), this.updateClasses(), this.elem ? this.setElementPosition() : this.setGlobalPosition(), this.show(!0), this.options.autoHide ? (clearTimeout(this.autohideTimer), this.autohideTimer = setTimeout(function () {
                    return n.show(!1)
                }, this.options.autoHideDelay)) : i) : i
            }, e.prototype.destroy = function () {
                return this.wrapper.remove()
            }, e
        }(), $[b] = function (e, t, i) {
            return e && e.nodeName || e.jquery ? $(e)[b](t, i) : (i = t, t = e, new n(null, t, i)), e
        }, $.fn[b] = function (e, t) {
            return $(this).each(function () {
                var i;
                return i = l($(this)).data(y), i ? i.run(e, t) : new n($(this), e, t)
            }), this
        }, $.extend($[b], {
            defaults: o,
            addStyle: r,
            pluginOptions: A,
            getStyle: u,
            insertCSS: p
        }), $(function () {
            return p(s.css).attr("id", "core-notify"), $(t).on("click notify-hide", "." + y + "-wrapper", function (e) {
                var t;
                return t = $(this).data(y), t && (t.options.clickToHide || "notify-hide" === e.type) ? t.show(!1) : i
            })
        })
    })(e, t), $.notify.addStyle("bootstrap", {
        html: "<div>\n<span data-notify-text></span>\n</div>",
        classes: {
            base: {
                "font-weight": "bold",
                padding: "8px 15px 8px 14px",
                "text-shadow": "0 1px 0 rgba(255, 255, 255, 0.5)",
                "background-color": "#fcf8e3",
                border: "1px solid #fbeed5",
                "border-radius": "4px",
                "white-space": "nowrap",
                "padding-left": "25px",
                "background-repeat": "no-repeat",
                "background-position": "3px 7px"
            },
            error: {
                color: "#B94A48",
                "background-color": "#F2DEDE",
                "border-color": "#EED3D7",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAtRJREFUeNqkVc1u00AQHq+dOD+0poIQfkIjalW0SEGqRMuRnHos3DjwAH0ArlyQeANOOSMeAA5VjyBxKBQhgSpVUKKQNGloFdw4cWw2jtfMOna6JOUArDTazXi/b3dm55socPqQhFka++aHBsI8GsopRJERNFlY88FCEk9Yiwf8RhgRyaHFQpPHCDmZG5oX2ui2yilkcTT1AcDsbYC1NMAyOi7zTX2Agx7A9luAl88BauiiQ/cJaZQfIpAlngDcvZZMrl8vFPK5+XktrWlx3/ehZ5r9+t6e+WVnp1pxnNIjgBe4/6dAysQc8dsmHwPcW9C0h3fW1hans1ltwJhy0GxK7XZbUlMp5Ww2eyan6+ft/f2FAqXGK4CvQk5HueFz7D6GOZtIrK+srupdx1GRBBqNBtzc2AiMr7nPplRdKhb1q6q6zjFhrklEFOUutoQ50xcX86ZlqaZpQrfbBdu2R6/G19zX6XSgh6RX5ubyHCM8nqSID6ICrGiZjGYYxojEsiw4PDwMSL5VKsC8Yf4VRYFzMzMaxwjlJSlCyAQ9l0CW44PBADzXhe7xMdi9HtTrdYjFYkDQL0cn4Xdq2/EAE+InCnvADTf2eah4Sx9vExQjkqXT6aAERICMewd/UAp/IeYANM2joxt+q5VI+ieq2i0Wg3l6DNzHwTERPgo1ko7XBXj3vdlsT2F+UuhIhYkp7u7CarkcrFOCtR3H5JiwbAIeImjT/YQKKBtGjRFCU5IUgFRe7fF4cCNVIPMYo3VKqxwjyNAXNepuopyqnld602qVsfRpEkkz+GFL1wPj6ySXBpJtWVa5xlhpcyhBNwpZHmtX8AGgfIExo0ZpzkWVTBGiXCSEaHh62/PoR0p/vHaczxXGnj4bSo+G78lELU80h1uogBwWLf5YlsPmgDEd4M236xjm+8nm4IuE/9u+/PH2JXZfbwz4zw1WbO+SQPpXfwG/BBgAhCNZiSb/pOQAAAAASUVORK5CYII=)"
            },
            success: {
                color: "#468847",
                "background-color": "#DFF0D8",
                "border-color": "#D6E9C6",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAutJREFUeNq0lctPE0Ecx38zu/RFS1EryqtgJFA08YCiMZIAQQ4eRG8eDGdPJiYeTIwHTfwPiAcvXIwXLwoXPaDxkWgQ6islKlJLSQWLUraPLTv7Gme32zoF9KSTfLO7v53vZ3d/M7/fIth+IO6INt2jjoA7bjHCJoAlzCRw59YwHYjBnfMPqAKWQYKjGkfCJqAF0xwZjipQtA3MxeSG87VhOOYegVrUCy7UZM9S6TLIdAamySTclZdYhFhRHloGYg7mgZv1Zzztvgud7V1tbQ2twYA34LJmF4p5dXF1KTufnE+SxeJtuCZNsLDCQU0+RyKTF27Unw101l8e6hns3u0PBalORVVVkcaEKBJDgV3+cGM4tKKmI+ohlIGnygKX00rSBfszz/n2uXv81wd6+rt1orsZCHRdr1Imk2F2Kob3hutSxW8thsd8AXNaln9D7CTfA6O+0UgkMuwVvEFFUbbAcrkcTA8+AtOk8E6KiQiDmMFSDqZItAzEVQviRkdDdaFgPp8HSZKAEAL5Qh7Sq2lIJBJwv2scUqkUnKoZgNhcDKhKg5aH+1IkcouCAdFGAQsuWZYhOjwFHQ96oagWgRoUov1T9kRBEODAwxM2QtEUl+Wp+Ln9VRo6BcMw4ErHRYjH4/B26AlQoQQTRdHWwcd9AH57+UAXddvDD37DmrBBV34WfqiXPl61g+vr6xA9zsGeM9gOdsNXkgpEtTwVvwOklXLKm6+/p5ezwk4B+j6droBs2CsGa/gNs6RIxazl4Tc25mpTgw/apPR1LYlNRFAzgsOxkyXYLIM1V8NMwyAkJSctD1eGVKiq5wWjSPdjmeTkiKvVW4f2YPHWl3GAVq6ymcyCTgovM3FzyRiDe2TaKcEKsLpJvNHjZgPNqEtyi6mZIm4SRFyLMUsONSSdkPeFtY1n0mczoY3BHTLhwPRy9/lzcziCw9ACI+yql0VLzcGAZbYSM5CCSZg1/9oc/nn7+i8N9p/8An4JMADxhH+xHfuiKwAAAABJRU5ErkJggg==)"
            },
            info: {
                color: "#3A87AD",
                "background-color": "#D9EDF7",
                "border-color": "#BCE8F1",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QYFAhkSsdes/QAAA8dJREFUOMvVlGtMW2UYx//POaWHXg6lLaW0ypAtw1UCgbniNOLcVOLmAjHZolOYlxmTGXVZdAnRfXQm+7SoU4mXaOaiZsEpC9FkiQs6Z6bdCnNYruM6KNBw6YWewzl9z+sHImEWv+vz7XmT95f/+3/+7wP814v+efDOV3/SoX3lHAA+6ODeUFfMfjOWMADgdk+eEKz0pF7aQdMAcOKLLjrcVMVX3xdWN29/GhYP7SvnP0cWfS8caSkfHZsPE9Fgnt02JNutQ0QYHB2dDz9/pKX8QjjuO9xUxd/66HdxTeCHZ3rojQObGQBcuNjfplkD3b19Y/6MrimSaKgSMmpGU5WevmE/swa6Oy73tQHA0Rdr2Mmv/6A1n9w9suQ7097Z9lM4FlTgTDrzZTu4StXVfpiI48rVcUDM5cmEksrFnHxfpTtU/3BFQzCQF/2bYVoNbH7zmItbSoMj40JSzmMyX5qDvriA7QdrIIpA+3cdsMpu0nXI8cV0MtKXCPZev+gCEM1S2NHPvWfP/hL+7FSr3+0p5RBEyhEN5JCKYr8XnASMT0xBNyzQGQeI8fjsGD39RMPk7se2bd5ZtTyoFYXftF6y37gx7NeUtJJOTFlAHDZLDuILU3j3+H5oOrD3yWbIztugaAzgnBKJuBLpGfQrS8wO4FZgV+c1IxaLgWVU0tMLEETCos4xMzEIv9cJXQcyagIwigDGwJgOAtHAwAhisQUjy0ORGERiELgG4iakkzo4MYAxcM5hAMi1WWG1yYCJIcMUaBkVRLdGeSU2995TLWzcUAzONJ7J6FBVBYIggMzmFbvdBV44Corg8vjhzC+EJEl8U1kJtgYrhCzgc/vvTwXKSib1paRFVRVORDAJAsw5FuTaJEhWM2SHB3mOAlhkNxwuLzeJsGwqWzf5TFNdKgtY5qHp6ZFf67Y/sAVadCaVY5YACDDb3Oi4NIjLnWMw2QthCBIsVhsUTU9tvXsjeq9+X1d75/KEs4LNOfcdf/+HthMnvwxOD0wmHaXr7ZItn2wuH2SnBzbZAbPJwpPx+VQuzcm7dgRCB57a1uBzUDRL4bfnI0RE0eaXd9W89mpjqHZnUI5Hh2l2dkZZUhOqpi2qSmpOmZ64Tuu9qlz/SEXo6MEHa3wOip46F1n7633eekV8ds8Wxjn37Wl63VVa+ej5oeEZ/82ZBETJjpJ1Rbij2D3Z/1trXUvLsblCK0XfOx0SX2kMsn9dX+d+7Kf6h8o4AIykuffjT8L20LU+w4AZd5VvEPY+XpWqLV327HR7DzXuDnD8r+ovkBehJ8i+y8YAAAAASUVORK5CYII=)"
            },
            warn: {
                color: "#C09853",
                "background-color": "#FCF8E3",
                "border-color": "#FBEED5",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAABJlBMVEXr6eb/2oD/wi7/xjr/0mP/ykf/tQD/vBj/3o7/uQ//vyL/twebhgD/4pzX1K3z8e349vK6tHCilCWbiQymn0jGworr6dXQza3HxcKkn1vWvV/5uRfk4dXZ1bD18+/52YebiAmyr5S9mhCzrWq5t6ufjRH54aLs0oS+qD751XqPhAybhwXsujG3sm+Zk0PTwG6Shg+PhhObhwOPgQL4zV2nlyrf27uLfgCPhRHu7OmLgAafkyiWkD3l49ibiAfTs0C+lgCniwD4sgDJxqOilzDWowWFfAH08uebig6qpFHBvH/aw26FfQTQzsvy8OyEfz20r3jAvaKbhgG9q0nc2LbZxXanoUu/u5WSggCtp1anpJKdmFz/zlX/1nGJiYmuq5Dx7+sAAADoPUZSAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfdBgUBGhh4aah5AAAAlklEQVQY02NgoBIIE8EUcwn1FkIXM1Tj5dDUQhPU502Mi7XXQxGz5uVIjGOJUUUW81HnYEyMi2HVcUOICQZzMMYmxrEyMylJwgUt5BljWRLjmJm4pI1hYp5SQLGYxDgmLnZOVxuooClIDKgXKMbN5ggV1ACLJcaBxNgcoiGCBiZwdWxOETBDrTyEFey0jYJ4eHjMGWgEAIpRFRCUt08qAAAAAElFTkSuQmCC)"
            }
        }
    }),
    function (t) {
        function n() {
            this.suppressLog || a("log", this, arguments)
        }

        function r() {
            a("warn", this, arguments)
        }

        function s() {
            a("info", this, arguments)
        }

        function a(n, r, s) {
            if (e.console !== i && e.console.isFake !== !0) {
                var a = t.map(s, h);
                a[0] = [r.prefix, a[0], r.postfix].join("");
                var o = "boolean" === t.type(a[a.length - 1]) ? a.pop() : null;
                o === !0 && e.console.group(a[0]), a[0] && null === o && (e.navigator.userAgent.indexOf("MSIE") >= 0 ? e.console.log(a.join(",")) : e.console[n].apply(e.console, a)), o === !1 && e.console.groupEnd()
            }
        }

        function o(e) {
            return {
                log: function () {
                    n.apply(e, arguments)
                },
                warn: function () {
                    r.apply(e, arguments)
                },
                info: function () {
                    s.apply(e, arguments)
                }
            }
        }
        e.console === i && (e.console = {
            isFake: !0
        });
        for (var l = ["log", "warn", "info", "group", "groupCollapsed", "groupEnd"], u = l.length - 1; u >= 0; u--) e.console[l[u]] === i && (e.console[l[u]] = t.noop);
        if (t) {
            var h = function (e) {
                    return e
                },
                c = function (e) {
                    return e = t.extend({}, c.defaults, e), o(e)
                };
            c.defaults = {
                suppressLog: !1,
                prefix: "",
                postfix: ""
            }, t.extend(c, o(c.defaults)), t.console === i && (t.console = c), t.consoleNoConflict = c
        }
    }(jQuery);
    var s = {
            loading: {},
            loaded: {}
        },
        a = function () {
            return a.curr++
        };
    a.curr = 1, $.fn.verifyScrollView = function (e) {
        var t = $(this).first();
        return 1 !== t.length ? $(this) : $(this).verifyScrollTo(t, e)
    }, $.fn.verifyScrollTo = function (e, t, i) {
        "function" == typeof t && 2 == arguments.length && (i = t, t = e);
        var n = $.extend({
            scrollTarget: e,
            offsetTop: 50,
            duration: 500,
            easing: "swing"
        }, t);
        return this.each(function () {
            var e = $(this),
                t = "number" == typeof n.scrollTarget ? n.scrollTarget : $(n.scrollTarget),
                r = "number" == typeof t ? t : t.offset().top + e.scrollTop() - parseInt(n.offsetTop, 10);
            e.animate({
                scrollTop: r
            }, parseInt(n.duration, 10), n.easing, function () {
                "function" == typeof i && i.call(this)
            })
        })
    }, $.fn.equals = function (e) {
        if ($(this).length !== e.length) return !1;
        for (var t = 0, i = $(this).length; i > t; ++t)
            if ($(this)[t] !== e[t]) return !1;
        return !0
    };
    var o = null;
    (function () {
        var e = !1,
            t = /xyz/.test(function () {}) ? /\b_super\b/ : /.*/;
        o = function () {}, o.extend = function (i) {
            function n() {
                !e && this.init && this.init.apply(this, arguments)
            }
            var r = this.prototype;
            e = !0;
            var s = new this;
            e = !1;
            for (var a in i) s[a] = "function" == typeof i[a] && "function" == typeof r[a] && t.test(i[a]) ? function (e, t) {
                return function () {
                    var i = this._super;
                    this._super = r[e];
                    var n = t.apply(this, arguments);
                    return this._super = i, n
                }
            }(a, i[a]) : i[a];
            return n.prototype = s, n.prototype.constructor = n, n.extend = arguments.callee, n
        }
    })();
    var l = o.extend({
            init: function (e, t) {
                this.name = t ? t : "Set_" + a(), this.array = [], this.addAll(e)
            },
            indexOf: function (e) {
                for (var t = 0, i = this.array.length; i > t; ++t)
                    if ($.isFunction(e) ? e(this.get(t)) : this.equals(this.get(t), e)) return t;
                return -1
            },
            find: function (e) {
                return this.get(this.indexOf(e)) || null
            },
            get: function (e) {
                return this.array[e]
            },
            has: function (e) {
                return !!this.find(e)
            },
            add: function (e) {
                return this.has(e) ? !1 : (this.array.push(e), !0)
            },
            addAll: function (e) {
                if (!e) return 0;
                $.isArray(e) || (e = [e]);
                for (var t = 0, i = 0, n = e.length; n > i; ++i) this.add(e[i]) && t++;
                return t
            },
            remove: function (e) {
                for (var t = [], i = 0, n = this.array.length; n > i; ++i) this.equals(this.get(i), e) || t.push(this.get(i));
                return this.array = t, e
            },
            removeAll: function () {
                this.array = []
            },
            equals: function (e, t) {
                return e && t && e.equals !== i && t.equals !== i ? e.equals(t) : e === t
            },
            each: function (e) {
                for (var t = 0, i = this.array.length; i > t; ++t)
                    if (e(this.get(t)) === !1) return
            },
            map: function (e) {
                return $.map(this.array, e)
            },
            filter: function (e) {
                return $.grep(this.array, e)
            },
            size: function () {
                return this.array.length
            },
            getArray: function () {
                return this.array
            }
        }),
        u = l.extend({
            init: function (e, t, i) {
                this.type = e, this._super(t, i)
            },
            add: function (e) {
                e instanceof this.type ? this._super(e) : this.log("add failed - invalid type")
            }
        }),
        h = {
            create: function (e) {
                function t() {}
                return t.prototype = e, new t
            },
            bind: $.proxy,
            checkOptions: function (e) {
                if (e)
                    for (var t in e) g[t] === i && p("Invalid option: '" + t + "'")
            },
            appendArg: function (e, t, i) {
                i || (i = 0);
                var n = [].slice.call(e, i);
                return n[i] = t + n[i], n
            },
            memoize: function (e) {
                return function () {
                    for (var t = Array.prototype.slice.call(arguments), i = "", n = t.length, r = null; n--;) r = t[n], i += r === Object(r) ? JSON.stringify(r) : r, e.memoize || (e.memoize = {});
                    return i in e.memoize ? e.memoize[i] : e.memoize[i] = e.apply(this, t)
                }
            },
            dateToString: function (e) {
                return e.getFullYear() + "-" + (e.getMonth() + 1) + "-" + e.getDate()
            },
            parseDate: function (e) {
                var t = e.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
                if (!t) return null;
                var n;
                if ($.datepicker !== i) try {
                    var r = $.datepicker.parseDate("dd/mm/yy", e);
                    n = new Date(r)
                } catch (s) {
                    return null
                } else n = new Date(parseInt(t[3], 10), parseInt(t[2], 10) - 1, parseInt(t[1], 10));
                return n
            },
            isRTL: function (e) {
                var i = $(t),
                    n = $("body"),
                    r = e && e.hasClass("rtl") || e && "rtl" === (e.attr("dir") || "").toLowerCase() || i.hasClass("rtl") || "rtl" === (i.attr("dir") || "").toLowerCase() || n.hasClass("rtl") || "rtl" === (n.attr("dir") || "").toLowerCase();
                return Boolean(r)
            }
        },
        c = "0.0.1",
        d = $.consoleNoConflict({
            prefix: "verify.js: "
        }),
        f = d.log,
        p = d.warn,
        m = d.info,
        g = {
            debug: !1,
            autoInit: !0,
            validateAttribute: "data-validate",
            validationEventTrigger: "blur",
            scroll: !0,
            focusFirstField: !0,
            hideErrorOnChange: !1,
            skipHiddenFields: !0,
            skipDisabledFields: !0,
            errorClass: "error",
            errorContainer: function (e) {
                return e
            },
            reskinContainer: function (e) {
                return e
            },
            beforeSubmit: function (e, t) {
                return t
            },
            track: $.noop,
            showPrompt: !0,
            prompt: function (e, t, i) {
                "function" === $.type($.notify) && (i || (i = {
                    color: "red"
                }), $.notify(e, t, i))
            }
        };
    r.prototype = g;
    var v = o.extend({
            name: "Class",
            toString: function () {
                return (this.type ? this.type + ": " : "") + (this.name ? this.name + ": " : "")
            },
            log: function () {
                g.debug && f.apply(this, h.appendArg(arguments, "" + this))
            },
            warn: function () {
                p.apply(this, h.appendArg(arguments, "" + this))
            },
            info: function () {
                m.apply(this, h.appendArg(arguments, "" + this))
            },
            bind: function (e) {
                var t = this[e];
                t && $.isFunction(t) && (this[e] = h.bind(t, this))
            },
            bindAll: function () {
                for (var e in this) this.bind(e)
            },
            nextTick: function (t, i, n) {
                var r = this;
                return e.setTimeout(function () {
                    t.apply(r, i)
                }, n || 0)
            }
        }),
        y = v.extend({
            init: function (e, t) {
                return this.name = e, $.isPlainObject(t) ? (this.type = t.__ruleType, this.extendInterface(t.extend), this.userObj || (this.userObj = {}), $.extend(this.userObj, t), this.buildFn(), this.ready = this.fn !== i, i) : this.warn("rule definition must be a function or an object")
            },
            extendInterface: function (e) {
                if (e && "string" == typeof e) {
                    for (var t, i = e; i;) {
                        if (i === this.name) return this.error("Rule already extends '%s'", i);
                        t = b.getRawRule(i), i = t ? t.extend : null
                    }
                    var n = b.getRule(e);
                    if (!n) return this.warn("Rule missing '%s'", i);
                    if (this.parent = n, !(n instanceof y)) return this.error("Cannot extend: '" + otherName + "' invalid type");
                    this.userObj = h.create(n.userObj), this.userObj.parent = n.userObj
                }
            },
            buildFn: function () {
                if ($.isFunction(this.userObj.fn)) this.fn = this.userObj.fn;
                else {
                    if ("regexp" !== $.type(this.userObj.regex)) return this.error("Rule has no function");
                    this.fn = function (e) {
                        return function (t) {
                            var i = RegExp(e);
                            return t.val().match(i) ? !0 : t.message || "Invalid Format"
                        }
                    }(this.userObj.regex)
                }
            },
            defaultInterface: {
                log: f,
                warn: p,
                ajax: function (e) {
                    n(e, this)
                }
            },
            defaultFieldInterface: {
                val: function () {
                    return this.field.val.apply(this.field, arguments)
                }
            },
            defaultGroupInterface: {
                val: function (e, t) {
                    var n = this.field(e);
                    return n ? t === i ? n.val() : n.val(t) : i
                },
                field: function (e) {
                    var t = $.grep(this._exec.members, function (t) {
                            return t.id === e
                        }),
                        i = t.length ? t[0].element.domElem : null;
                    return i || this.warn("Cannot find group element with id: '" + e + "'"), i
                },
                fields: function () {
                    return $().add($.map(this._exec.members, function (e) {
                        return e.element.domElem
                    }))
                }
            },
            buildInterface: function (e) {
                var t = [];
                return t.push({}), t.push(this.userObj), t.push(this.defaultInterface), "field" === this.type && (t.push(this.defaultFieldInterface), t.push({
                    field: e.element.domElem
                })), "group" === this.type && t.push(this.defaultGroupInterface), t.push({
                    prompt: e.element.options.prompt,
                    form: e.element.form.domElem,
                    callback: e.callback,
                    args: e.args,
                    _exec: e
                }), $.extend.apply(this, t)
            }
        }),
        b = null;
    (function () {
        var e = function (e) {
                for (var t, n, r = e.split(""), s = [], a = 0, o = 0, l = r.length; l > o; ++o) {
                    if (t = r[o], "(" === t && a++, ")" === t && a--, a > 1) return null;
                    "," === t && 1 === a && (r[o] = ";")
                }
                return 0 !== a ? null : ($.each(r.join("").split(","), function (t, r) {
                    return (n = r.match(/^(\w+)(\.(\w+))?(\#(\w+))?(\(([^;\)]+(\;[^;\)]+)*)\))?$/)) ? (r = {}, r.name = n[1], n[3] && (r.scope = n[3]), n[5] && (r.id = n[5]), r.args = n[7] ? n[7].split(";") : [], s.push(r), i) : p("Invalid validate attribute: " + e)
                }), s)
            },
            t = h.memoize(e),
            n = {},
            r = {},
            s = function (e, t) {
                for (var i in t) n[i] && p("validator '%s' already exists", i), $.isFunction(t[i]) && (t[i] = {
                    fn: t[i]
                }), t[i].__ruleType = e;
                $.extend(!0, n, t)
            },
            a = function (e) {
                s("field", e)
            },
            o = function (e) {
                s("group", e)
            },
            l = function (e) {
                return n[e]
            },
            u = function (e) {
                var t = r[e],
                    i = n[e];
                return i ? t || (t = r[e] = new y(e, i)) : p("Missing rule: " + e), t
            },
            c = function (e) {
                var i = e.form.options.validateAttribute,
                    n = e.domElem.attr(i);
                return n ? t(n) : null
            },
            d = function (e) {
                var t = !1,
                    i = null,
                    n = [];
                return "ValidationField" !== e.type ? p("Cannot get rules from invalid type") : e.domElem ? (i = this.parseAttribute(e), i && i.length ? ($.each(i, function (e, i) {
                    /required/.test(i.name) && (t = !0), i.rule = u(i.name), i.rule && n.push(i)
                }), n.required = t, n) : n) : n
            };
        b = {
            addFieldRules: a,
            addGroupRules: o,
            getRule: u,
            getRawRule: l,
            parseString: e,
            parseAttribute: c,
            parseElement: d
        }
    })();
    var A = null;
    (function () {
        var e = v.extend({
                type: "ValidationElement",
                init: function (e) {
                    if (!e || !e.length) throw "Missing Element";
                    return this.domElem = e, this.bindAll(), this.name = this.domElem.attr("name") || this.domElem.attr("id") || a(), this.execution = null, e.data("verify") ? !1 : (e.data("verify", this), !0)
                },
                equals: function (t) {
                    var i, n;
                    return this.domElem ? (i = this.domElem, t.jquery ? n = t : t instanceof e && t.domElem && (n = t.domElem), i && n ? i.equals(n) : !1) : !1
                }
            }),
            n = e.extend({
                type: "ValidationField",
                init: function (e, t) {
                    this._super(e), this.form = t, this.options = t.options, this.groups = t.groups, this.ruleNames = null, this.touched = !1
                },
                validate: function (e) {
                    e || (e = $.noop);
                    var t = new w(this);
                    t.execute().done(function () {
                        e(!0)
                    }).fail(function () {
                        e(!1)
                    })
                },
                update: function () {
                    this.rules = b.parseElement(this);
                    for (var e = 0; this.rules.length > e; ++e) {
                        var t = this.rules[e];
                        if (t.rule && "group" === t.rule.type) {
                            this.groups[t.name] || (this.groups[t.name] = {});
                            var i = t.scope || "default";
                            this.groups[t.name][i] || (this.groups[t.name][i] = new u(n)), this.groups[t.name][i].add(this)
                        }
                    }
                },
                handleResult: function (e) {
                    var t = this.options,
                        i = t.reskinContainer(this.domElem);
                    if (!i || !i.length) return this.warn("No reskin element found. Check 'reskinContainer' option.");
                    t.showPrompt && t.prompt(i, e.response);
                    var n = t.errorContainer(i);
                    n && n.length && n.toggleClass(t.errorClass, !e.success), this.options.track("Validate", [this.form.name, this.name].join(" "), e.success ? "Valid" : e.response ? '"' + e.response + '"' : "Silent Fail")
                },
                scrollFocus: function (e) {
                    var t = $.noop;
                    this.options.focusFirstField && (t = function () {
                        e.focus()
                    }), this.options.scroll ? e.verifyScrollView(t) : this.options.focusFirstField && field.focus()
                }
            });
        A = e.extend({
            type: "ValidationForm",
            init: function (e, s) {
                if (this._super(e), !e.is("form")) throw "Must be a form";
                this.options = new r(s), this.fields = new u(n), this.groups = {}, this.fieldByName = {}, this.invalidFields = {}, this.fieldHistory = {}, this.submitResult = i, this.submitPending = !1, this.cache = {
                    ruleNames: {},
                    ajax: {
                        loading: {},
                        loaded: {}
                    }
                }, $(t).ready(this.domReady)
            },
            extendOptions: function (e) {
                $.extend(!0, this.options, e)
            },
            domReady: function () {
                this.bindEvents(), this.updateFields(), this.log("bound to " + this.fields.size() + " elems")
            },
            bindEvents: function () {
                this.domElem.on("keyup.jqv", "input", this.onKeyup).on("blur.jqv", "input[type=text]:not(.hasDatepicker),input:not([type].hasDatepicker)", this.onValidate).on("change.jqv", "input[type=text].hasDatepicker,select,[type=checkbox],[type=radio]", this.onValidate).on("submit.jqv", this.onSubmit).trigger("initialised.jqv")
            },
            unbindEvents: function () {
                this.domElem.off(".jqv")
            },
            updateFields: function () {
                var e = "[" + this.options.validateAttribute + "]";
                this.domElem.find(e).each(this.updateField)
            },
            updateField: function (e, t) {
                e.jquery !== i && (t = e), t.jquery === i && (t = $(t));
                var r, s, a = "input:not([type=hidden]),select,textarea";
                return t.is(a) ? (s = t, r = this.fields.find(s), r || (r = new n(s, this), this.fields.add(r)), r.update(), r) : this.warn("Validators will not work on container elements (" + t.prop("tagName") + "). Please use INPUT, SELECT or TEXTAREA.")
            },
            onSubmit: function (e) {
                var t = !1;
                return this.submitPending && this.warn("pending..."), this.submitPending || this.submitResult !== i ? this.submitResult !== i && (t = this.options.beforeSubmit.call(this.domElem, e, this.submitResult)) : (this.submitPending = !0, this.validate(this.doSubmit)), t || e.preventDefault(), t
            },
            doSubmit: function (e) {
                this.log("doSubmit", e), this.submitPending = !1, this.submitResult = e, this.domElem.submit(), this.submitResult = i
            },
            onKeyup: function (e) {
                this.options.hideErrorOnChange && this.options.prompt($(e.currentTarget), null)
            },
            onValidate: function (e) {
                var t = $(e.currentTarget),
                    i = t.data("verify") || this.updateField(t);
                i.log("validate"), i.validate($.noop)
            },
            validate: function (e) {
                e || (e = $.noop), this.updateFields();
                var t = new x(this);
                t.execute().done(function () {
                    e(!0)
                }).fail(function () {
                    e(!1)
                })
            }
        })
    })();
    var x = null,
        w = null;
    (function () {
        var e = {
                NOT_STARTED: 0,
                RUNNING: 1,
                COMPLETE: 2
            },
            t = v.extend({
                type: "Execution",
                init: function (t, i) {
                    this.element = t, t && (this.prevExec = t.execution, t.execution = this, this.options = this.element.options, this.domElem = t.domElem), this.parent = i, this.name = "#" + a(), this.status = e.NOT_STARTED, this.bindAll(), this.d = this.restrictDeferred(), this.d.done(this.executePassed), this.d.fail(this.executeFailed)
                },
                isPending: function () {
                    return this.prevExec && this.prevExec.status !== e.COMPLETE
                },
                toString: function () {
                    return this._super() + "[" + this.element.name + (this.rule ? ":" + this.rule.name : "") + "] "
                },
                serialize: function (e) {
                    var t = this.mapExecutables(e);
                    if (!$.isArray(t) || 0 === t.length) return this.resolve();
                    var i = t[0](),
                        n = 1,
                        r = t.length;
                    if (this.log("SERIALIZE", r), !i || !i.pipe) throw "Invalid Deferred Object";
                    for (; r > n; n++) i = i.pipe(t[n]);
                    return i.done(this.resolve).fail(this.reject), this.d.promise()
                },
                parallelize: function (e) {
                    function t(e) {
                        s++, s === o && r.resolve(e)
                    }

                    function i(e) {
                        l || (l = !0, r.reject(e))
                    }
                    var n = this.mapExecutables(e),
                        r = this,
                        s = 0,
                        a = 0,
                        o = n.length,
                        l = !1;
                    if (this.log("PARALLELIZE", o), !$.isArray(n) || 0 === o) return this.resolve();
                    for (; o > a; ++a) {
                        var u = n[a]();
                        if (!u || !u.done || !u.fail) throw "Invalid Deferred Object";
                        u.done(t).fail(i)
                    }
                    return this.d.promise()
                },
                mapExecutables: function (e) {
                    return $.map(e, function (e) {
                        if ($.isFunction(e)) return e;
                        if ($.isFunction(e.execute)) return e.execute;
                        throw "Invalid executable"
                    })
                },
                linkPass: function (e) {
                    e.d.done(this.resolve)
                },
                linkFail: function (e) {
                    e.d.fail(this.reject)
                },
                link: function (e) {
                    this.linkPass(e), this.linkFail(e)
                },
                execute: function () {
                    for (var t = this.parent, i = []; t;) i.unshift(t.name), t = t.parent;
                    var n = "(" + i.join(" < ") + ")";
                    return this.log(this.parent ? n : "", "executing..."), this.status = e.RUNNING, this.domElem && this.domElem.triggerHandler("validating"), !0
                },
                executePassed: function (e) {
                    this.success = !0, this.response = this.filterResponse(e), this.executed()
                },
                executeFailed: function (e) {
                    this.success = !1, this.response = this.filterResponse(e), this.executed()
                },
                executed: function () {
                    this.status = e.COMPLETE, this.log((this.success ? "Passed" : "Failed") + ": " + this.response), this.domElem && this.domElem.triggerHandler("validated", this.success)
                },
                resolve: function (e) {
                    return this.resolveOrReject(!0, e)
                },
                reject: function (e) {
                    return this.resolveOrReject(!1, e)
                },
                resolveOrReject: function (e, t) {
                    var i = e ? "__resolve" : "__reject";
                    if (!this.d || !this.d[i]) throw "Invalid Deferred Object";
                    return this.nextTick(this.d[i], [t], 0), this.d.promise()
                },
                filterResponse: function (e) {
                    return "string" == typeof e ? e : null
                },
                restrictDeferred: function (e) {
                    return e || (e = $.Deferred()), e.__reject = e.reject, e.__resolve = e.resolve, e.reject = e.resolve = function () {
                        console.error("Use execution.resolve|reject()")
                    }, e
                }
            });
        x = t.extend({
            type: "FormExecution",
            init: function (e) {
                this._super(e), this.ajaxs = [], this.children = this.element.fields.map($.proxy(function (e) {
                    return new w(e, this)
                }, this))
            },
            execute: function () {
                return this._super(), this.isPending() ? (this.warn("pending... (waiting for %s)", this.prevExec.name), this.reject()) : (this.log("exec fields #" + this.children.length), this.parallelize(this.children))
            }
        }), w = t.extend({
            type: "FieldExecution",
            init: function (e, t) {
                this._super(e, t), t instanceof x && (this.formExecution = t), e.touched = !0, this.children = []
            },
            execute: function () {
                if (this._super(), this.isPending()) return this.warn("pending... (waiting for %s)", this.prevExec.name), this.reject();
                var e = b.parseElement(this.element);
                return this.skip = this.skipValidations(e), this.skip ? this.resolve() : (this.children = $.map(e, $.proxy(function (e) {
                    return "group" === e.rule.type ? new r(e, this) : new n(e, this)
                }, this)), this.serialize(this.children))
            },
            skipValidations: function (e) {
                return 0 === e.length ? (this.log("skip (no validators)"), !0) : e.required || $.trim(this.domElem.val()) ? this.options.skipHiddenFields && this.options.reskinContainer(this.domElem).is(":hidden") ? (this.log("skip (hidden)"), !0) : this.options.skipDisabledFields && this.domElem.is("[disabled]") ? (this.log("skip (disabled)"), !0) : !1 : (this.warn("skip (not required)"), !0)
            },
            executed: function () {
                this._super();
                var e, t = this,
                    i = this.children;
                for (e = 0; i.length > e; ++e)
                    if (i[e].success === !1) {
                        t = i[e];
                        break
                    }
                this.element.handleResult(t)
            }
        });
        var n = t.extend({
                type: "RuleExecution",
                init: function (e, t) {
                    this._super(null, t), this.rule = e.rule, this.args = e.args, this.element = this.parent.element, this.options = this.element.options, this.rObj = {}
                },
                callback: function (e) {
                    clearTimeout(this.t), this.callbackCount++, this.log(this.rule.name + " (cb:" + this.callbackCount + "): " + e), this.callbackCount > 1 || (e === i && this.warn("Undefined result"), e === !0 ? this.resolve(e) : this.reject(e))
                },
                timeout: function () {
                    this.warn("timeout!"), this.callback("Timeout")
                },
                execute: function () {
                    if (this._super(), this.callbackCount = 0, !this.element || !this.rule.ready) return this.warn(this.element ? "not  ready." : "invalid parent."), this.resolve();
                    this.t = setTimeout(this.timeout, 1e4), this.r = this.rule.buildInterface(this);
                    var e;
                    try {
                        e = this.rule.fn(this.r)
                    } catch (t) {
                        e = !0, console.error("Error caught in validation rule: '" + this.rule.name + "', skipping.\nERROR: " + ("" + t) + "\nSTACK:" + t.stack)
                    }
                    return e !== i && this.nextTick(this.callback, [e]), this.d.promise()
                }
            }),
            r = n.extend({
                type: "GroupRuleExecution",
                init: function (e, t) {
                    if (this._super(e, t), this.groupName = e.name, this.id = e.id, this.scope = e.scope || "default", this.group = this.element.groups[this.groupName][this.scope], !this.group) throw "Missing Group Set";
                    1 === this.group.size() && this.warn("Group only has 1 field. Consider a field rule.")
                },
                execute: function () {
                    var t, n, r, s = this.group.exec,
                        a = this.parent,
                        o = a && a.parent,
                        l = !o,
                        u = o instanceof x,
                        h = !1;
                    if (s && s.status !== e.COMPLETE) {
                        for (this.members = s.members, t = 0; this.members.length > t; ++t) this.element === this.members[t].element && (h = !0);
                        if (h) return this.log("ALREADY A MEMBER OF %s", s.name), this.reject(), i;
                        this.log("SLAVE TO %s", s.name), this.members.push(this), this.link(s), this.parent && s.linkFail(this.parent)
                    } else this.log("MASTER"), this.members = [this], this.executeGroup = this._super, s = this.group.exec = this, u && s.linkFail(o); if (l)
                        for (t = 0; this.group.size() > t; ++t)
                            if (n = this.group.get(t), this.element !== n) {
                                if (this.log("CHECK:", n.name), !n.touched) return this.log("FIELD NOT READY: ", n.name), this.reject();
                                r = n.execution, r && r.status !== e.COMPLETE && r.reject(), this.log("STARTING ", n.name), r = new w(n, this), r.execute()
                            }
                    var c = this.group.size(),
                        d = s.members.length;
                    return c === d && s.status === e.NOT_STARTED ? (s.log("RUN"), s.executeGroup()) : this.log("WAIT (" + d + "/" + c + ")"), this.d.promise()
                },
                filterResponse: function (e) {
                    if (!e || !this.members.length) return this._super(e);
                    var t = $.isPlainObject(e),
                        i = "string" == typeof e;
                    return i && this === this.group.exec ? e : t && e[this.id] ? e[this.id] : null
                }
            })
    })(), $.fn.validate = function (e) {
        var t = $(this).data("verify");
        t ? t.validate(e) : p("element does not have verifyjs attached")
    }, $.fn.validate.version = c, $.fn.verify = function (e) {
        return this.each(function () {
            var t = $.verify.forms.find($(this));
            return e === !1 || "destroy" === e ? (t && (t.unbindEvents(), $.verify.forms.remove(t)), i) : (h.checkOptions(e), t ? (t.extendOptions(e), t.updateFields()) : (t = new A($(this), e), $.verify.forms.add(t)), i)
        })
    }, $.verify = function (e) {
        h.checkOptions(e), $.extend(g, e)
    }, $.extend($.verify, {
        version: c,
        updateRules: b.updateRules,
        addRules: b.addFieldRules,
        addFieldRules: b.addFieldRules,
        addGroupRules: b.addGroupRules,
        log: m,
        warn: p,
        defaults: g,
        globals: g,
        utils: h,
        forms: new u(A, [], "FormSet"),
        _hidden: {
            ruleManager: b
        }
    }), $(function () {
        g.autoInit && $("form").filter(function () {
            return $(this).find("[" + g.validateAttribute + "]").length > 0
        }).verify()
    }), f("plugin added."),
    function (t) {
        return t.verify === i ? (e.alert("Please include verify.js before each rule file"), i) : (t.verify.addFieldRules({
            currency: {
                regex: /^\-?\$?\d{1,2}(,?\d{3})*(\.\d+)?$/,
                message: "Invalid monetary value"
            },
            email: {
                regex: /^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                message: "Invalid email address"
            },
            url: {
                regex: /^https?:\/\/[\-A-Za-z0-9+&@#\/%?=~_|!:,.;]*[\-A-Za-z0-9+&@#\/%=~_|]/,
                message: "Invalid URL"
            },
            alphanumeric: {
                regex: /^[0-9A-Za-z]+$/,
                message: "Use digits and letters only"
            },
            street_number: {
                regex: /^\d+[A-Za-z]?(-\d+)?[A-Za-z]?$/,
                message: "Street Number only"
            },
            number: {
                regex: /^\d+$/,
                message: "Use digits only"
            },
            numberSpace: {
                regex: /^[\d\ ]+$/,
                message: "Use digits and spaces only"
            },
            postcode: {
                regex: /^\d{4}$/,
                message: "Invalid postcode"
            },
            date: {
                fn: function (e) {
                    return t.verify.utils.parseDate(e.val()) ? !0 : e.message
                },
                message: "Invalid date"
            },
            required: {
                fn: function (e) {
                    return e.requiredField(e, e.field)
                },
                requiredField: function (e, i) {
                    var n = i.val();
                    switch (i.prop("type")) {
                    case "radio":
                    case "checkbox":
                        var r = i.attr("name"),
                            s = i.data("fieldGroup");
                        if (s || (s = e.form.find("input[name='" + r + "']"), i.data("fieldGroup", s)), s.is(":checked")) break;
                        return 1 === s.size() ? e.messages.single : e.messages.multiple;
                    default:
                        if (!t.trim(n)) return e.messages.all
                    }
                    return !0
                },
                messages: {
                    all: "This field is required",
                    multiple: "Please select an option",
                    single: "This checkbox is required"
                }
            },
            regex: {
                fn: function (e) {
                    var t;
                    try {
                        var i = e.args[0];
                        t = RegExp(i)
                    } catch (n) {
                        return e.warn("Invalid regex: " + i), !0
                    }
                    return e.val().match(t) ? !0 : e.args[1] || e.message
                },
                message: "Invalid format"
            },
            pattern: {
                extend: "regex"
            },
            asyncTest: function (e) {
                e.prompt(e.field, "Please wait..."), setTimeout(function () {
                    e.callback()
                }, 2e3)
            },
            phone: function (e) {
                e.val(e.val().replace(/\D/g, ""));
                var t = e.val();
                return t.match(/^\+?[\d\s]+$/) ? t.match(/^\+/) ? !0 : t.match(/^0/) ? 10 !== t.replace(/\s/g, "").length ? "Must be 10 digits long" : !0 : "Number must start with 0" : "Use digits and spaces only"
            },
            size: function (e) {
                var t = e.val(),
                    n = e.args[0],
                    r = e.args[1];
                if (n !== i && r === i) {
                    var s = parseInt(n, 10);
                    if (e.val().length !== s) return "Must be " + s + " characters"
                } else if (n !== i && r !== i) {
                    var a = parseInt(n, 10);
                    if (r = parseInt(r, 10), a > t.length || t.length > r) return "Must be between " + a + " and " + r + " characters"
                } else e.warn("size validator parameter error on field: " + e.field.attr("name"));
                return !0
            },
            min: function (e) {
                var t = e.val(),
                    i = parseInt(e.args[0], 10);
                return i > t.length ? "Must be at least " + i + " characters" : !0
            },
            max: function (e) {
                var t = e.val(),
                    i = parseInt(e.args[0], 10);
                return t.length > i ? "Must be at most " + i + " characters" : !0
            },
            decimal: function (e) {
                var t = e.val(),
                    i = e.args[0] ? parseInt(e.args[0], 10) : 2;
                if (!t.match(/^\d+(,\d{3})*(\.\d+)?$/)) return "Invalid decimal value";
                var n = parseFloat(t.replace(/[^\d\.]/g, "")),
                    r = Math.pow(10, i);
                return n = Math.round(n * r) / r, e.field.val(n), !0
            },
            minVal: function (e) {
                var t = parseFloat(e.val().replace(/[^\d\.]/g, "")),
                    i = e.args[1] || "",
                    n = parseFloat(e.args[0]);
                return n > t ? "Must be greater than " + n + i : !0
            },
            maxVal: function (e) {
                var t = parseFloat(e.val().replace(/[^\d\.]/g, "")),
                    i = e.args[1] || "",
                    n = parseFloat(e.args[0]);
                return t > n ? "Must be less than " + n + i : !0
            },
            rangeVal: function (e) {
                var t = parseFloat(e.val().replace(/[^\d\.]/g, "")),
                    i = e.args[2] || "",
                    n = e.args[3] || "",
                    r = parseFloat(e.args[0]),
                    s = parseFloat(e.args[1]);
                return t > s || r > t ? "Must be between " + i + r + n + "\nand " + i + s + n : !0
            },
            agreement: function (e) {
                return e.field.is(":checked") ? !0 : "You must agree to continue"
            },
            minAge: function (e) {
                var i = parseInt(e.args[0], 10);
                if (!i || isNaN(i)) return console.log("WARNING: Invalid Age Param: " + i), !0;
                new Date;
                var n = new Date;
                n.setFullYear(n.getFullYear() - i);
                var r = t.verify.utils.parseDate(e.val());
                return "Invalid Date" === r ? "Invalid Date" : r > n ? "You must be at least " + i : !0
            }
        }), t.verify.addGroupRules({
            dateRange: function (e) {
                var i = e.field("start"),
                    n = e.field("end");
                if (0 === i.length || 0 === n.length) return e.warn("Missing dateRange fields, skipping..."), !0;
                var r = t.verify.utils.parseDate(i.val());
                if (!r) return "Invalid Start Date";
                var s = t.verify.utils.parseDate(n.val());
                return s ? r >= s ? "Start Date must come before End Date" : !0 : "Invalid End Date"
            },
            requiredAll: {
                extend: "required",
                fn: function (e) {
                    var i, n = (e.fields().length, []),
                        r = [];
                    return e.fields().each(function (t, s) {
                        i = e.requiredField(e, s), i === !0 ? n.push(s) : r.push({
                            field: s,
                            message: i
                        })
                    }), n.length > 0 && r.length > 0 ? (t.each(r, function (t, i) {
                        e.prompt(i.field, i.message)
                    }), !1) : !0
                }
            }
        }), i)
    }(jQuery)
})(window, document);