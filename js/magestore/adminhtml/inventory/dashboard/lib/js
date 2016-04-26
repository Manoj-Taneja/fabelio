var qq;
(function(n,t){
    function gt(n){
        var t=n.length,r=i.type(n);
        return i.isWindow(n)?!1:n.nodeType===1&&t?!0:r==="array"||r!=="function"&&(t===0||typeof t=="number"&&t>0&&t-1 in n)
        }
        function te(n){
        var t=ni[n]={};
        
        return i.each(n.match(s)||[],function(n,i){
            t[i]=!0
            }),t
        }
        function ur(n,r,u,f){
        if(i.acceptData(n)){
            var h,o,c=i.expando,l=n.nodeType,s=l?i.cache:n,e=l?n[c]:n[c]&&c;
            if(e&&s[e]&&(f||s[e].data)||u!==t||typeof r!="string")return e||(e=l?n[c]=b.pop()||i.guid++:c),s[e]||(s[e]=l?{}:{
                toJSON:i.noop
                }),(typeof r=="object"||typeof r=="function")&&(f?s[e]=i.extend(s[e],r):s[e].data=i.extend(s[e].data,r)),o=s[e],f||(o.data||(o.data={}),o=o.data),u!==t&&(o[i.camelCase(r)]=u),typeof r=="string"?(h=o[r],h==null&&(h=o[i.camelCase(r)])):h=o,h
                }
            }
    function fr(n,t,r){
    if(i.acceptData(n)){
        var f,o,s=n.nodeType,u=s?i.cache:n,e=s?n[i.expando]:i.expando;
        if(u[e]){
            if(t&&(f=r?u[e]:u[e].data,f)){
                for(i.isArray(t)?t=t.concat(i.map(t,i.camelCase)):(t in f)?t=[t]:(t=i.camelCase(t),t=t in f?[t]:t.split(" ")),o=t.length;o--;)delete f[t[o]];
                if(r?!ti(f):!i.isEmptyObject(f))return
            }(r||(delete u[e].data,ti(u[e])))&&(s?i.cleanData([n],!0):i.support.deleteExpando||u!=u.window?delete u[e]:u[e]=null)
            }
        }
}
function er(n,r,u){
    if(u===t&&n.nodeType===1){
        var f="data-"+r.replace(rr,"-$1").toLowerCase();
        if(u=n.getAttribute(f),typeof u=="string"){
            try{
                u=u==="true"?!0:u==="false"?!1:u==="null"?null:+u+""===u?+u:ir.test(u)?i.parseJSON(u):u
                }catch(e){}
            i.data(n,r,u)
            }else u=t
            }
            return u
    }
    function ti(n){
    for(var t in n)if((t!=="data"||!i.isEmptyObject(n[t]))&&t!=="toJSON")return!1;return!0
    }
    function ct(){
    return!0
    }
    function g(){
    return!1
    }
    function cr(){
    try{
        return r.activeElement
        }catch(n){}
}
function ar(n,t){
    do n=n[t];while(n&&n.nodeType!==1);
    return n
    }
    function fi(n,t,r){
    if(i.isFunction(t))return i.grep(n,function(n,i){
        return!!t.call(n,i,n)!==r
        });
    if(t.nodeType)return i.grep(n,function(n){
        return n===t!==r
        });
    if(typeof t=="string"){
        if(oe.test(t))return i.filter(t,n,r);
        t=i.filter(t,n)
        }
        return i.grep(n,function(n){
        return i.inArray(n,t)>=0!==r
        })
    }
    function vr(n){
    var i=yr.split("|"),t=n.createDocumentFragment();
    if(t.createElement)while(i.length)t.createElement(i.pop());
    return t
    }
    function gr(n,t){
    return i.nodeName(n,"table")&&i.nodeName(t.nodeType===1?t:t.firstChild,"tr")?n.getElementsByTagName("tbody")[0]||n.appendChild(n.ownerDocument.createElement("tbody")):n
    }
    function nu(n){
    return n.type=(i.find.attr(n,"type")!==null)+"/"+n.type,n
    }
    function tu(n){
    var t=ye.exec(n.type);
    return t?n.type=t[1]:n.removeAttribute("type"),n
    }
    function hi(n,t){
    for(var u,r=0;(u=n[r])!=null;r++)i._data(u,"globalEval",!t||i._data(t[r],"globalEval"))
        }
        function iu(n,t){
    if(t.nodeType===1&&i.hasData(n)){
        var u,f,o,s=i._data(n),r=i._data(t,s),e=s.events;
        if(e){
            delete r.handle;
            r.events={};
            
            for(u in e)for(f=0,o=e[u].length;f<o;f++)i.event.add(t,u,e[u][f])
                }
                r.data&&(r.data=i.extend({},r.data))
        }
    }
function be(n,t){
    var r,f,u;
    if(t.nodeType===1){
        if(r=t.nodeName.toLowerCase(),!i.support.noCloneEvent&&t[i.expando]){
            u=i._data(t);
            for(f in u.events)i.removeEvent(t,f,u.handle);t.removeAttribute(i.expando)
            }
            r==="script"&&t.text!==n.text?(nu(t).text=n.text,tu(t)):r==="object"?(t.parentNode&&(t.outerHTML=n.outerHTML),i.support.html5Clone&&n.innerHTML&&!i.trim(t.innerHTML)&&(t.innerHTML=n.innerHTML)):r==="input"&&oi.test(n.type)?(t.defaultChecked=t.checked=n.checked,t.value!==n.value&&(t.value=n.value)):r==="option"?t.defaultSelected=t.selected=n.defaultSelected:(r==="input"||r==="textarea")&&(t.defaultValue=n.defaultValue)
        }
    }
function u(n,r){
    var s,e,h=0,f=typeof n.getElementsByTagName!==o?n.getElementsByTagName(r||"*"):typeof n.querySelectorAll!==o?n.querySelectorAll(r||"*"):t;
    if(!f)for(f=[],s=n.childNodes||n;(e=s[h])!=null;h++)!r||i.nodeName(e,r)?f.push(e):i.merge(f,u(e,r));
    return r===t||r&&i.nodeName(n,r)?i.merge([n],f):f
    }
    function ke(n){
    oi.test(n.type)&&(n.defaultChecked=n.checked)
    }
    function ou(n,t){
    if(t in n)return t;
    for(var r=t.charAt(0).toUpperCase()+t.slice(1),u=t,i=eu.length;i--;)if(t=eu[i]+r,t in n)return t;return u
    }
    function ut(n,t){
    return n=t||n,i.css(n,"display")==="none"||!i.contains(n.ownerDocument,n)
    }
    function su(n,t){
    for(var f,r,o,e=[],u=0,s=n.length;u<s;u++)(r=n[u],r.style)&&(e[u]=i._data(r,"olddisplay"),f=r.style.display,t?(e[u]||f!=="none"||(r.style.display=""),r.style.display===""&&ut(r)&&(e[u]=i._data(r,"olddisplay",au(r.nodeName)))):e[u]||(o=ut(r),(f&&f!=="none"||!o)&&i._data(r,"olddisplay",o?f:i.css(r,"display"))));
    for(u=0;u<s;u++)(r=n[u],r.style)&&(t&&r.style.display!=="none"&&r.style.display!==""||(r.style.display=t?e[u]||"":"none"));
    return n
    }
    function hu(n,t,i){
    var r=to.exec(t);
    return r?Math.max(0,r[1]-(i||0))+(r[2]||"px"):t
    }
    function cu(n,t,r,u,f){
    for(var e=r===(u?"border":"content")?4:t==="width"?1:0,o=0;e<4;e+=2)r==="margin"&&(o+=i.css(n,r+p[e],!0,f)),u?(r==="content"&&(o-=i.css(n,"padding"+p[e],!0,f)),r!=="margin"&&(o-=i.css(n,"border"+p[e]+"Width",!0,f))):(o+=i.css(n,"padding"+p[e],!0,f),r!=="padding"&&(o+=i.css(n,"border"+p[e]+"Width",!0,f)));
    return o
    }
    function lu(n,t,r){
    var e=!0,u=t==="width"?n.offsetWidth:n.offsetHeight,f=v(n),o=i.support.boxSizing&&i.css(n,"boxSizing",!1,f)==="border-box";
    if(u<=0||u==null){
        if(u=y(n,t,f),(u<0||u==null)&&(u=n.style[t]),lt.test(u))return u;
        e=o&&(i.support.boxSizingReliable||u===n.style[t]);
        u=parseFloat(u)||0
        }
        return u+cu(n,t,r||(o?"border":"content"),e,f)+"px"
    }
    function au(n){
    var u=r,t=uu[n];
    return t||(t=vu(n,u),t!=="none"&&t||(rt=(rt||i("<iframe frameborder='0' width='0' height='0'/>").css("cssText","display:block !important")).appendTo(u.documentElement),u=(rt[0].contentWindow||rt[0].contentDocument).document,u.write("<!doctype html><html><body>"),u.close(),t=vu(n,u),rt.detach()),uu[n]=t),t
    }
    function vu(n,t){
    var r=i(t.createElement(n)).appendTo(t.body),u=i.css(r[0],"display");
    return r.remove(),u
    }
    function li(n,t,r,u){
    var f;
    if(i.isArray(t))i.each(t,function(t,i){
        r||fo.test(n)?u(n,i):li(n+"["+(typeof i=="object"?t:"")+"]",i,r,u)
        });
    else if(r||i.type(t)!=="object")u(n,t);else for(f in t)li(n+"["+f+"]",t[f],r,u)
        }
        function gu(n){
    return function(t,r){
        typeof t!="string"&&(r=t,t="*");
        var u,f=0,e=t.toLowerCase().match(s)||[];
        if(i.isFunction(r))while(u=e[f++])u[0]==="+"?(u=u.slice(1)||"*",(n[u]=n[u]||[]).unshift(r)):(n[u]=n[u]||[]).push(r)
            }
        }
function nf(n,t,r,u){
    function e(s){
        var h;
        return f[s]=!0,i.each(n[s]||[],function(n,i){
            var s=i(t,r,u);
            if(typeof s!="string"||o||f[s]){
                if(o)return!(h=s)
                    }else return t.dataTypes.unshift(s),e(s),!1
                }),h
        }
        var f={},o=n===yi;
    return e(t.dataTypes[0])||!f["*"]&&e("*")
    }
    function pi(n,r){
    var f,u,e=i.ajaxSettings.flatOptions||{};
    
    for(u in r)r[u]!==t&&((e[u]?n:f||(f={}))[u]=r[u]);return f&&i.extend(!0,n,f),n
    }
    function ao(n,i,r){
    for(var s,o,f,e,h=n.contents,u=n.dataTypes;u[0]==="*";)u.shift(),o===t&&(o=n.mimeType||i.getResponseHeader("Content-Type"));
    if(o)for(e in h)if(h[e]&&h[e].test(o)){
        u.unshift(e);
        break
    }
    if(u[0]in r)f=u[0];
    else{
        for(e in r){
            if(!u[0]||n.converters[e+" "+u[0]]){
                f=e;
                break
            }
            s||(s=e)
            }
            f=f||s
        }
        if(f)return f!==u[0]&&u.unshift(f),r[f]
        }
        function vo(n,t,i,r){
    var h,u,f,s,e,o={},c=n.dataTypes.slice();
    if(c[1])for(f in n.converters)o[f.toLowerCase()]=n.converters[f];for(u=c.shift();u;)if(n.responseFields[u]&&(i[n.responseFields[u]]=t),!e&&r&&n.dataFilter&&(t=n.dataFilter(t,n.dataType)),e=u,u=c.shift(),u)if(u==="*")u=e;
        else if(e!=="*"&&e!==u){
        if(f=o[e+" "+u]||o["* "+u],!f)for(h in o)if(s=h.split(" "),s[1]===u&&(f=o[e+" "+s[0]]||o["* "+s[0]],f)){
            f===!0?f=o[h]:o[h]!==!0&&(u=s[0],c.unshift(s[1]));
            break
        }
        if(f!==!0)if(f&&n.throws)t=f(t);else try{
            t=f(t)
            }catch(l){
            return{
                state:"parsererror",
                error:f?l:"No conversion from "+e+" to "+u
                }
            }
        }
        return{
    state:"success",
    data:t
}
}
function rf(){
    try{
        return new n.XMLHttpRequest
        }catch(t){}
}
function yo(){
    try{
        return new n.ActiveXObject("Microsoft.XMLHTTP")
        }catch(t){}
}
function ff(){
    return setTimeout(function(){
        it=t
        }),it=i.now()
    }
    function ef(n,t,i){
    for(var u,f=(ft[t]||[]).concat(ft["*"]),r=0,e=f.length;r<e;r++)if(u=f[r].call(i,t,n))return u
        }
        function of(n,t,r){
    var e,o,s=0,l=pt.length,f=i.Deferred().always(function(){
        delete c.elem
        }),c=function(){
        if(o)return!1;
        for(var s=it||ff(),t=Math.max(0,u.startTime+u.duration-s),h=t/u.duration||0,i=1-h,r=0,e=u.tweens.length;r<e;r++)u.tweens[r].run(i);
        return f.notifyWith(n,[u,i,t]),i<1&&e?t:(f.resolveWith(n,[u]),!1)
        },u=f.promise({
        elem:n,
        props:i.extend({},t),
        opts:i.extend(!0,{
            specialEasing:{}
        },r),
    originalProperties:t,
    originalOptions:r,
    startTime:it||ff(),
        duration:r.duration,
        tweens:[],
        createTween:function(t,r){
        var f=i.Tween(n,u.opts,t,r,u.opts.specialEasing[t]||u.opts.easing);
        return u.tweens.push(f),f
        },
    stop:function(t){
        var i=0,r=t?u.tweens.length:0;
        if(o)return this;
        for(o=!0;i<r;i++)u.tweens[i].run(1);
        return t?f.resolveWith(n,[u,t]):f.rejectWith(n,[u,t]),this
        }
    }),h=u.props;
for(bo(h,u.opts.specialEasing);s<l;s++)if(e=pt[s].call(u,n,h,u.opts),e)return e;return i.map(h,ef,u),i.isFunction(u.opts.start)&&u.opts.start.call(n,u),i.fx.timer(i.extend(c,{
    elem:n,
    anim:u,
    queue:u.opts.queue
    })),u.progress(u.opts.progress).done(u.opts.done,u.opts.complete).fail(u.opts.fail).always(u.opts.always)
}
function bo(n,t){
    var r,f,e,u,o;
    for(r in n)if(f=i.camelCase(r),e=t[f],u=n[r],i.isArray(u)&&(e=u[1],u=n[r]=u[0]),r!==f&&(n[f]=u,delete n[r]),o=i.cssHooks[f],o&&"expand"in o){
        u=o.expand(u);
        delete n[f];
        for(r in u)r in n||(n[r]=u[r],t[r]=e)
            }else t[f]=e
        }
        function ko(n,t,r){
    var u,a,v,c,e,y,s=this,l={},o=n.style,h=n.nodeType&&ut(n),f=i._data(n,"fxshow");
    r.queue||(e=i._queueHooks(n,"fx"),e.unqueued==null&&(e.unqueued=0,y=e.empty.fire,e.empty.fire=function(){
        e.unqueued||y()
        }),e.unqueued++,s.always(function(){
        s.always(function(){
            e.unqueued--;
            i.queue(n,"fx").length||e.empty.fire()
            })
        }));
    n.nodeType===1&&("height"in t||"width"in t)&&(r.overflow=[o.overflow,o.overflowX,o.overflowY],i.css(n,"display")==="inline"&&i.css(n,"float")==="none"&&(i.support.inlineBlockNeedsLayout&&au(n.nodeName)!=="inline"?o.zoom=1:o.display="inline-block"));
    r.overflow&&(o.overflow="hidden",i.support.shrinkWrapBlocks||s.always(function(){
        o.overflow=r.overflow[0];
        o.overflowX=r.overflow[1];
        o.overflowY=r.overflow[2]
        }));
    for(u in t)if(a=t[u],po.exec(a)){
        if(delete t[u],v=v||a==="toggle",a===(h?"hide":"show"))continue;
        l[u]=f&&f[u]||i.style(n,u)
        }
        if(!i.isEmptyObject(l)){
        f?"hidden"in f&&(h=f.hidden):f=i._data(n,"fxshow",{});
        v&&(f.hidden=!h);
        h?i(n).show():s.done(function(){
            i(n).hide()
            });
        s.done(function(){
            var t;
            i._removeData(n,"fxshow");
            for(t in l)i.style(n,t,l[t])
                });
        for(u in l)c=ef(h?f[u]:0,u,s),u in f||(f[u]=c.start,h&&(c.end=c.start,c.start=u==="width"||u==="height"?1:0))
            }
        }
function f(n,t,i,r,u){
    return new f.prototype.init(n,t,i,r,u)
    }
    function wt(n,t){
    var r,i={
        height:n
    },u=0;
    for(t=t?1:0;u<4;u+=2-t)r=p[u],i["margin"+r]=i["padding"+r]=n;
    return t&&(i.opacity=i.width=n),i
    }
    function sf(n){
    return i.isWindow(n)?n:n.nodeType===9?n.defaultView||n.parentWindow:!1
    }
    var et,bi,o=typeof t,hf=n.location,r=n.document,ki=r.documentElement,cf=n.jQuery,lf=n.$,ot={},b=[],bt="1.10.2",di=b.concat,kt=b.push,l=b.slice,gi=b.indexOf,af=ot.toString,k=ot.hasOwnProperty,dt=bt.trim,i=function(n,t){
    return new i.fn.init(n,t,bi)
    },st=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,s=/\S+/g,vf=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,yf=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,nr=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,pf=/^[\],:{}\s]*$/,wf=/(?:^|:|,)(?:\s*\[)+/g,bf=/\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,kf=/"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,df=/^-ms-/,gf=/-([\da-z])/gi,ne=function(n,t){
    return t.toUpperCase()
    },h=function(n){
    (r.addEventListener||n.type==="load"||r.readyState==="complete")&&(tr(),i.ready())
    },tr=function(){
    r.addEventListener?(r.removeEventListener("DOMContentLoaded",h,!1),n.removeEventListener("load",h,!1)):(r.detachEvent("onreadystatechange",h),n.detachEvent("onload",h))
    },ni,ir,rr,wi,at,nt,tt,tf,vt;
i.fn=i.prototype={
    jquery:bt,
    constructor:i,
    init:function(n,u,f){
        var e,o;
        if(!n)return this;
        if(typeof n=="string"){
            if(e=n.charAt(0)==="<"&&n.charAt(n.length-1)===">"&&n.length>=3?[null,n,null]:yf.exec(n),e&&(e[1]||!u)){
                if(e[1]){
                    if(u=u instanceof i?u[0]:u,i.merge(this,i.parseHTML(e[1],u&&u.nodeType?u.ownerDocument||u:r,!0)),nr.test(e[1])&&i.isPlainObject(u))for(e in u)i.isFunction(this[e])?this[e](u[e]):this.attr(e,u[e]);return this
                    }
                    if(o=r.getElementById(e[2]),o&&o.parentNode){
                    if(o.id!==e[2])return f.find(n);
                    this.length=1;
                    this[0]=o
                    }
                    return this.context=r,this.selector=n,this
                }
                return!u||u.jquery?(u||f).find(n):this.constructor(u).find(n)
            }
            return n.nodeType?(this.context=this[0]=n,this.length=1,this):i.isFunction(n)?f.ready(n):(n.selector!==t&&(this.selector=n.selector,this.context=n.context),i.makeArray(n,this))
        },
    selector:"",
    length:0,
    toArray:function(){
        return l.call(this)
        },
    get:function(n){
        return n==null?this.toArray():n<0?this[this.length+n]:this[n]
        },
    pushStack:function(n){
        var t=i.merge(this.constructor(),n);
        return t.prevObject=this,t.context=this.context,t
        },
    each:function(n,t){
        return i.each(this,n,t)
        },
    ready:function(n){
        return i.ready.promise().done(n),this
        },
    slice:function(){
        return this.pushStack(l.apply(this,arguments))
        },
    first:function(){
        return this.eq(0)
        },
    last:function(){
        return this.eq(-1)
        },
    eq:function(n){
        var i=this.length,t=+n+(n<0?i:0);
        return this.pushStack(t>=0&&t<i?[this[t]]:[])
        },
    map:function(n){
        return this.pushStack(i.map(this,function(t,i){
            return n.call(t,i,t)
            }))
        },
    end:function(){
        return this.prevObject||this.constructor(null)
        },
    push:kt,
    sort:[].sort,
    splice:[].splice
    };
    
i.fn.init.prototype=i.fn;
i.extend=i.fn.extend=function(){
    var u,o,r,e,s,h,n=arguments[0]||{},f=1,l=arguments.length,c=!1;
    for(typeof n=="boolean"&&(c=n,n=arguments[1]||{},f=2),typeof n=="object"||i.isFunction(n)||(n={}),l===f&&(n=this,--f);f<l;f++)if((s=arguments[f])!=null)for(e in s)(u=n[e],r=s[e],n!==r)&&(c&&r&&(i.isPlainObject(r)||(o=i.isArray(r)))?(o?(o=!1,h=u&&i.isArray(u)?u:[]):h=u&&i.isPlainObject(u)?u:{},n[e]=i.extend(c,h,r)):r!==t&&(n[e]=r));return n
    };
    
i.extend({
    expando:"jQuery"+(bt+Math.random()).replace(/\D/g,""),
    noConflict:function(t){
        return n.$===i&&(n.$=lf),t&&n.jQuery===i&&(n.jQuery=cf),i
        },
    isReady:!1,
    readyWait:1,
    holdReady:function(n){
        n?i.readyWait++:i.ready(!0)
        },
    ready:function(n){
        if(n===!0?!--i.readyWait:!i.isReady){
            if(!r.body)return setTimeout(i.ready);
            (i.isReady=!0,n!==!0&&--i.readyWait>0)||(et.resolveWith(r,[i]),i.fn.trigger&&i(r).trigger("ready").off("ready"))
            }
        },
isFunction:function(n){
    return i.type(n)==="function"
    },
isArray:Array.isArray||function(n){
    return i.type(n)==="array"
    },
isWindow:function(n){
    return n!=null&&n==n.window
    },
isNumeric:function(n){
    return!isNaN(parseFloat(n))&&isFinite(n)
    },
type:function(n){
    return n==null?String(n):typeof n=="object"||typeof n=="function"?ot[af.call(n)]||"object":typeof n
    },
isPlainObject:function(n){
    var r;
    if(!n||i.type(n)!=="object"||n.nodeType||i.isWindow(n))return!1;
    try{
        if(n.constructor&&!k.call(n,"constructor")&&!k.call(n.constructor.prototype,"isPrototypeOf"))return!1
            }catch(u){
        return!1
        }
        if(i.support.ownLast)for(r in n)return k.call(n,r);for(r in n);return r===t||k.call(n,r)
    },
isEmptyObject:function(n){
    for(var t in n)return!1;return!0
    },
error:function(n){
    throw new Error(n);
},
parseHTML:function(n,t,u){
    if(!n||typeof n!="string")return null;
    typeof t=="boolean"&&(u=t,t=!1);
    t=t||r;
    var f=nr.exec(n),e=!u&&[];
    return f?[t.createElement(f[1])]:(f=i.buildFragment([n],t,e),e&&i(e).remove(),i.merge([],f.childNodes))
    },
parseJSON:function(t){
    if(n.JSON&&n.JSON.parse)return n.JSON.parse(t);
    if(t===null)return t;
    if(typeof t=="string"&&(t=i.trim(t),t&&pf.test(t.replace(bf,"@").replace(kf,"]").replace(wf,""))))return new Function("return "+t)();
    i.error("Invalid JSON: "+t)
    },
parseXML:function(r){
    var u,f;
    if(!r||typeof r!="string")return null;
    try{
        n.DOMParser?(f=new DOMParser,u=f.parseFromString(r,"text/xml")):(u=new ActiveXObject("Microsoft.XMLDOM"),u.async="false",u.loadXML(r))
        }catch(e){
        u=t
        }
        return u&&u.documentElement&&!u.getElementsByTagName("parsererror").length||i.error("Invalid XML: "+r),u
    },
noop:function(){},
    globalEval:function(t){
    t&&i.trim(t)&&(n.execScript||function(t){
        n.eval.call(n,t)
        })(t)
    },
camelCase:function(n){
    return n.replace(df,"ms-").replace(gf,ne)
    },
nodeName:function(n,t){
    return n.nodeName&&n.nodeName.toLowerCase()===t.toLowerCase()
    },
each:function(n,t,i){
    var u,r=0,f=n.length,e=gt(n);
    if(i){
        if(e){
            for(;r<f;r++)if(u=t.apply(n[r],i),u===!1)break
            }else for(r in n)if(u=t.apply(n[r],i),u===!1)break
            }else if(e){
        for(;r<f;r++)if(u=t.call(n[r],r,n[r]),u===!1)break
        }else for(r in n)if(u=t.call(n[r],r,n[r]),u===!1)break;return n
    },
trim:dt&&!dt.call("﻿ ")?function(n){
    return n==null?"":dt.call(n)
    }:function(n){
    return n==null?"":(n+"").replace(vf,"")
    },
makeArray:function(n,t){
    var r=t||[];
    return n!=null&&(gt(Object(n))?i.merge(r,typeof n=="string"?[n]:n):kt.call(r,n)),r
    },
inArray:function(n,t,i){
    var r;
    if(t){
        if(gi)return gi.call(t,n,i);
        for(r=t.length,i=i?i<0?Math.max(0,r+i):i:0;i<r;i++)if(i in t&&t[i]===n)return i
            }
            return-1
    },
merge:function(n,i){
    var f=i.length,u=n.length,r=0;
    if(typeof f=="number")for(;r<f;r++)n[u++]=i[r];else while(i[r]!==t)n[u++]=i[r++];
    return n.length=u,n
    },
grep:function(n,t,i){
    var u,f=[],r=0,e=n.length;
    for(i=!!i;r<e;r++)u=!!t(n[r],r),i!==u&&f.push(n[r]);
    return f
    },
map:function(n,t,i){
    var u,r=0,e=n.length,o=gt(n),f=[];
    if(o)for(;r<e;r++)u=t(n[r],r,i),u!=null&&(f[f.length]=u);else for(r in n)u=t(n[r],r,i),u!=null&&(f[f.length]=u);return di.apply([],f)
    },
guid:1,
proxy:function(n,r){
    var f,u,e;
    return(typeof r=="string"&&(e=n[r],r=n,n=e),!i.isFunction(n))?t:(f=l.call(arguments,2),u=function(){
        return n.apply(r||this,f.concat(l.call(arguments)))
        },u.guid=n.guid=n.guid||i.guid++,u)
    },
access:function(n,r,u,f,e,o,s){
    var h=0,l=n.length,c=u==null;
    if(i.type(u)==="object"){
        e=!0;
        for(h in u)i.access(n,r,h,u[h],!0,o,s)
            }else if(f!==t&&(e=!0,i.isFunction(f)||(s=!0),c&&(s?(r.call(n,f),r=null):(c=r,r=function(n,t,r){
        return c.call(i(n),r)
        })),r))for(;h<l;h++)r(n[h],u,s?f:f.call(n[h],h,r(n[h],u)));
    return e?n:c?r.call(n):l?r(n[0],u):o
    },
now:function(){
    return(new Date).getTime()
    },
swap:function(n,t,i,r){
    var f,u,e={};
    
    for(u in t)e[u]=n.style[u],n.style[u]=t[u];f=i.apply(n,r||[]);
    for(u in t)n.style[u]=e[u];return f
    }
});
i.ready.promise=function(t){
    if(!et)if(et=i.Deferred(),r.readyState==="complete")setTimeout(i.ready);
        else if(r.addEventListener)r.addEventListener("DOMContentLoaded",h,!1),n.addEventListener("load",h,!1);
        else{
        r.attachEvent("onreadystatechange",h);
        n.attachEvent("onload",h);
        var u=!1;
        try{
            u=n.frameElement==null&&r.documentElement
            }catch(e){}
        u&&u.doScroll&&function f(){
            if(!i.isReady){
                try{
                    u.doScroll("left")
                    }catch(n){
                    return setTimeout(f,50)
                    }
                    tr();
                i.ready()
                }
            }()
        }
        return et.promise(t)
};

i.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(n,t){
    ot["[object "+t+"]"]=t.toLowerCase()
    });
bi=i(r),function(n,t){
    function u(n,t,i,r){
        var p,u,f,l,w,a,k,c,g,d;
        if((t?t.ownerDocument||t:y)!==s&&nt(t),t=t||s,i=i||[],!n||typeof n!="string")return i;
        if((l=t.nodeType)!==1&&l!==9)return[];
        if(v&&!r){
            if(p=or.exec(n))if(f=p[1]){
                if(l===9)if(u=t.getElementById(f),u&&u.parentNode){
                    if(u.id===f)return i.push(u),i
                        }else return i;
                else if(t.ownerDocument&&(u=t.ownerDocument.getElementById(f))&&ot(t,u)&&u.id===f)return i.push(u),i
                    }else{
                if(p[2])return b.apply(i,t.getElementsByTagName(n)),i;
                if((f=p[3])&&e.getElementsByClassName&&t.getElementsByClassName)return b.apply(i,t.getElementsByClassName(f)),i
                    }
                    if(e.qsa&&(!h||!h.test(n))){
                if(c=k=o,g=t,d=l===9&&n,l===1&&t.nodeName.toLowerCase()!=="object"){
                    for(a=pt(n),(k=t.getAttribute("id"))?c=k.replace(cr,"\\$&"):t.setAttribute("id",c),c="[id='"+c+"'] ",w=a.length;w--;)a[w]=c+wt(a[w]);
                    g=ti.test(n)&&t.parentNode||t;
                    d=a.join(",")
                    }
                    if(d)try{
                    return b.apply(i,g.querySelectorAll(d)),i
                    }catch(tt){}finally{
                    k||t.removeAttribute("id")
                    }
                }
            }
    return pr(n.replace(vt,"$1"),t,i,r)
}
function ri(){
    function n(i,u){
        return t.push(i+=" ")>r.cacheLength&&delete n[t.shift()],n[i]=u
        }
        var t=[];
    return n
    }
    function c(n){
    return n[o]=!0,n
    }
    function l(n){
    var t=s.createElement("div");
    try{
        return!!n(t)
        }catch(i){
        return!1
        }finally{
        t.parentNode&&t.parentNode.removeChild(t);
        t=null
        }
    }
function ui(n,t){
    for(var u=n.split("|"),i=n.length;i--;)r.attrHandle[u[i]]=t
        }
        function bi(n,t){
    var i=t&&n,r=i&&n.nodeType===1&&t.nodeType===1&&(~t.sourceIndex||vi)-(~n.sourceIndex||vi);
    if(r)return r;
    if(i)while(i=i.nextSibling)if(i===t)return-1;
    return n?1:-1
    }
    function lr(n){
    return function(t){
        var i=t.nodeName.toLowerCase();
        return i==="input"&&t.type===n
        }
    }
function ar(n){
    return function(t){
        var i=t.nodeName.toLowerCase();
        return(i==="input"||i==="button")&&t.type===n
        }
    }
function rt(n){
    return c(function(t){
        return t=+t,c(function(i,r){
            for(var u,f=n([],i.length,t),e=f.length;e--;)i[u=f[e]]&&(i[u]=!(r[u]=i[u]))
                })
        })
    }
    function ki(){}
function pt(n,t){
    var e,f,s,o,i,h,c,l=li[n+" "];
    if(l)return t?0:l.slice(0);
    for(i=n,h=[],c=r.preFilter;i;){
        (!e||(f=ir.exec(i)))&&(f&&(i=i.slice(f[0].length)||i),h.push(s=[]));
        e=!1;
        (f=rr.exec(i))&&(e=f.shift(),s.push({
            value:e,
            type:f[0].replace(vt," ")
            }),i=i.slice(e.length));
        for(o in r.filter)(f=yt[o].exec(i))&&(!c[o]||(f=c[o](f)))&&(e=f.shift(),s.push({
            value:e,
            type:o,
            matches:f
        }),i=i.slice(e.length));if(!e)break
    }
    return t?i.length:i?u.error(n):li(n,h).slice(0)
    }
    function wt(n){
    for(var t=0,r=n.length,i="";t<r;t++)i+=n[t].value;
    return i
    }
    function fi(n,t,i){
    var r=t.dir,u=i&&r==="parentNode",f=di++;
    return t.first?function(t,i,f){
        while(t=t[r])if(t.nodeType===1||u)return n(t,i,f)
            }:function(t,i,e){
        var h,s,c,l=p+" "+f;
        if(e){
            while(t=t[r])if((t.nodeType===1||u)&&n(t,i,e))return!0
                }else while(t=t[r])if(t.nodeType===1||u)if(c=t[o]||(t[o]={}),(s=c[r])&&s[0]===l){
            if((h=s[1])===!0||h===ht)return h===!0
                }else if(s=c[r]=[l],s[1]=n(t,i,e)||ht,s[1]===!0)return!0
            }
        }
function ei(n){
    return n.length>1?function(t,i,r){
        for(var u=n.length;u--;)if(!n[u](t,i,r))return!1;return!0
        }:n[0]
    }
    function bt(n,t,i,r,u){
    for(var e,o=[],f=0,s=n.length,h=t!=null;f<s;f++)(e=n[f])&&(!i||i(e,r,u))&&(o.push(e),h&&t.push(f));
    return o
    }
    function oi(n,t,i,r,u,f){
    return r&&!r[o]&&(r=oi(r)),u&&!u[o]&&(u=oi(u,f)),c(function(f,e,o,s){
        var l,c,a,p=[],y=[],w=e.length,k=f||yr(t||"*",o.nodeType?[o]:o,[]),v=n&&(f||!t)?bt(k,p,n,o,s):k,h=i?u||(f?n:w||r)?[]:e:v;
        if(i&&i(v,h,o,s),r)for(l=bt(h,y),r(l,[],o,s),c=l.length;c--;)(a=l[c])&&(h[y[c]]=!(v[y[c]]=a));
        if(f){
            if(u||n){
                if(u){
                    for(l=[],c=h.length;c--;)(a=h[c])&&l.push(v[c]=a);
                    u(null,h=[],l,s)
                    }
                    for(c=h.length;c--;)(a=h[c])&&(l=u?it.call(f,a):p[c])>-1&&(f[l]=!(e[l]=a))
                    }
                }else h=bt(h===e?h.splice(w,h.length):h),u?u(null,e,h,s):b.apply(e,h)
        })
}
function si(n){
    for(var s,u,i,e=n.length,h=r.relative[n[0].type],c=h||r.relative[" "],t=h?1:0,l=fi(function(n){
        return n===s
        },c,!0),a=fi(function(n){
        return it.call(s,n)>-1
        },c,!0),f=[function(n,t,i){
        return!h&&(i||t!==lt)||((s=t).nodeType?l(n,t,i):a(n,t,i))
        }];t<e;t++)if(u=r.relative[n[t].type])f=[fi(ei(f),u)];
        else{
        if(u=r.filter[n[t].type].apply(null,n[t].matches),u[o]){
            for(i=++t;i<e;i++)if(r.relative[n[i].type])break;return oi(t>1&&ei(f),t>1&&wt(n.slice(0,t-1).concat({
                value:n[t-2].type===" "?"*":""
                })).replace(vt,"$1"),u,t<i&&si(n.slice(t,i)),i<e&&si(n=n.slice(i)),i<e&&wt(n))
            }
            f.push(u)
        }
        return ei(f)
    }
    function vr(n,t){
    var f=0,i=t.length>0,e=n.length>0,o=function(o,h,c,l,a){
        var y,g,k,w=[],d=0,v="0",nt=o&&[],tt=a!=null,it=lt,ut=o||e&&r.find.TAG("*",a&&h.parentNode||h),rt=p+=it==null?1:Math.random()||.1;
        for(tt&&(lt=h!==s&&h,ht=f);(y=ut[v])!=null;v++){
            if(e&&y){
                for(g=0;k=n[g++];)if(k(y,h,c)){
                    l.push(y);
                    break
                }
                tt&&(p=rt,ht=++f)
                }
                i&&((y=!k&&y)&&d--,o&&nt.push(y))
            }
            if(d+=v,i&&v!==d){
            for(g=0;k=t[g++];)k(nt,w,h,c);
            if(o){
                if(d>0)while(v--)nt[v]||w[v]||(w[v]=nr.call(l));
                w=bt(w)
                }
                b.apply(l,w);
            tt&&!o&&w.length>0&&d+t.length>1&&u.uniqueSort(l)
            }
            return tt&&(p=rt,lt=it),nt
        };
        
    return i?c(o):o
    }
    function yr(n,t,i){
    for(var r=0,f=t.length;r<f;r++)u(n,t[r],i);
    return i
    }
    function pr(n,t,i,u){
    var s,f,o,c,l,h=pt(n);
    if(!u&&h.length===1){
        if(f=h[0]=h[0].slice(0),f.length>2&&(o=f[0]).type==="ID"&&e.getById&&t.nodeType===9&&v&&r.relative[f[1].type]){
            if(t=(r.find.ID(o.matches[0].replace(k,d),t)||[])[0],!t)return i;
            n=n.slice(f.shift().value.length)
            }
            for(s=yt.needsContext.test(n)?0:f.length;s--;){
            if(o=f[s],r.relative[c=o.type])break;
            if((l=r.find[c])&&(u=l(o.matches[0].replace(k,d),ti.test(f[0].type)&&t.parentNode||t))){
                if(f.splice(s,1),n=u.length&&wt(f),!n)return b.apply(i,u),i;
                break
            }
        }
        }
    return kt(n,h)(u,t,!v,i,ti.test(n)),i
}
var ut,e,ht,r,ct,hi,kt,lt,g,nt,s,a,v,h,tt,at,ot,o="sizzle"+-new Date,y=n.document,p=0,di=0,ci=ri(),li=ri(),ai=ri(),ft=!1,dt=function(n,t){
    return n===t?(ft=!0,0):0
    },st=typeof t,vi=-2147483648,gi={}.hasOwnProperty,w=[],nr=w.pop,tr=w.push,b=w.push,yi=w.slice,it=w.indexOf||function(n){
    for(var t=0,i=this.length;t<i;t++)if(this[t]===n)return t;return-1
    },gt="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",f="[\\x20\\t\\r\\n\\f]",et="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",pi=et.replace("w","w#"),wi="\\["+f+"*("+et+")"+f+"*(?:([*^$|!~]?=)"+f+"*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|("+pi+")|)|)"+f+"*\\]",ni=":("+et+")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|"+wi.replace(3,8)+")*)|.*)\\)|)",vt=new RegExp("^"+f+"+|((?:^|[^\\\\])(?:\\\\.)*)"+f+"+$","g"),ir=new RegExp("^"+f+"*,"+f+"*"),rr=new RegExp("^"+f+"*([>+~]|"+f+")"+f+"*"),ti=new RegExp(f+"*[+~]"),ur=new RegExp("="+f+"*([^\\]'\"]*)"+f+"*\\]","g"),fr=new RegExp(ni),er=new RegExp("^"+pi+"$"),yt={
    ID:new RegExp("^#("+et+")"),
    CLASS:new RegExp("^\\.("+et+")"),
    TAG:new RegExp("^("+et.replace("w","w*")+")"),
    ATTR:new RegExp("^"+wi),
    PSEUDO:new RegExp("^"+ni),
    CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+f+"*(even|odd|(([+-]|)(\\d*)n|)"+f+"*(?:([+-]|)"+f+"*(\\d+)|))"+f+"*\\)|)","i"),
    bool:new RegExp("^(?:"+gt+")$","i"),
    needsContext:new RegExp("^"+f+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+f+"*((?:-\\d)?\\d*)"+f+"*\\)|)(?=[^-]|$)","i")
    },ii=/^[^{]+\{\s*\[native \w/,or=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,sr=/^(?:input|select|textarea|button)$/i,hr=/^h\d$/i,cr=/'|\\/g,k=new RegExp("\\\\([\\da-f]{1,6}"+f+"?|("+f+")|.)","ig"),d=function(n,t,i){
    var r="0x"+t-65536;
    return r!==r||i?t:r<0?String.fromCharCode(r+65536):String.fromCharCode(r>>10|55296,r&1023|56320)
    };
    
try{
    b.apply(w=yi.call(y.childNodes),y.childNodes);
    w[y.childNodes.length].nodeType
    }catch(wr){
    b={
        apply:w.length?function(n,t){
            tr.apply(n,yi.call(t))
            }:function(n,t){
            for(var i=n.length,r=0;n[i++]=t[r++];);
            n.length=i-1
            }
        }
}
hi=u.isXML=function(n){
    var t=n&&(n.ownerDocument||n).documentElement;
    return t?t.nodeName!=="HTML":!1
    };
    
e=u.support={};

nt=u.setDocument=function(n){
    var t=n?n.ownerDocument||n:y,i=t.defaultView;
    return t===s||t.nodeType!==9||!t.documentElement?s:(s=t,a=t.documentElement,v=!hi(t),i&&i.attachEvent&&i!==i.top&&i.attachEvent("onbeforeunload",function(){
        nt()
        }),e.attributes=l(function(n){
        return n.className="i",!n.getAttribute("className")
        }),e.getElementsByTagName=l(function(n){
        return n.appendChild(t.createComment("")),!n.getElementsByTagName("*").length
        }),e.getElementsByClassName=l(function(n){
        return n.innerHTML="<div class='a'><\/div><div class='a i'><\/div>",n.firstChild.className="i",n.getElementsByClassName("i").length===2
        }),e.getById=l(function(n){
        return a.appendChild(n).id=o,!t.getElementsByName||!t.getElementsByName(o).length
        }),e.getById?(r.find.ID=function(n,t){
        if(typeof t.getElementById!==st&&v){
            var i=t.getElementById(n);
            return i&&i.parentNode?[i]:[]
            }
        },r.filter.ID=function(n){
        var t=n.replace(k,d);
        return function(n){
            return n.getAttribute("id")===t
            }
        }):(delete r.find.ID,r.filter.ID=function(n){
    var t=n.replace(k,d);
    return function(n){
        var i=typeof n.getAttributeNode!==st&&n.getAttributeNode("id");
        return i&&i.value===t
        }
    }),r.find.TAG=e.getElementsByTagName?function(n,t){
    if(typeof t.getElementsByTagName!==st)return t.getElementsByTagName(n)
        }:function(n,t){
    var i,r=[],f=0,u=t.getElementsByTagName(n);
    if(n==="*"){
        while(i=u[f++])i.nodeType===1&&r.push(i);
        return r
        }
        return u
    },r.find.CLASS=e.getElementsByClassName&&function(n,t){
    if(typeof t.getElementsByClassName!==st&&v)return t.getElementsByClassName(n)
        },tt=[],h=[],(e.qsa=ii.test(t.querySelectorAll))&&(l(function(n){
    n.innerHTML="<select><option selected=''><\/option><\/select>";
    n.querySelectorAll("[selected]").length||h.push("\\["+f+"*(?:value|"+gt+")");
    n.querySelectorAll(":checked").length||h.push(":checked")
    }),l(function(n){
    var i=t.createElement("input");
    i.setAttribute("type","hidden");
    n.appendChild(i).setAttribute("t","");
    n.querySelectorAll("[t^='']").length&&h.push("[*^$]="+f+"*(?:''|\"\")");
    n.querySelectorAll(":enabled").length||h.push(":enabled",":disabled");
    n.querySelectorAll("*,:x");
    h.push(",.*:")
    })),(e.matchesSelector=ii.test(at=a.webkitMatchesSelector||a.mozMatchesSelector||a.oMatchesSelector||a.msMatchesSelector))&&l(function(n){
    e.disconnectedMatch=at.call(n,"div");
    at.call(n,"[s!='']:x");
    tt.push("!=",ni)
    }),h=h.length&&new RegExp(h.join("|")),tt=tt.length&&new RegExp(tt.join("|")),ot=ii.test(a.contains)||a.compareDocumentPosition?function(n,t){
    var r=n.nodeType===9?n.documentElement:n,i=t&&t.parentNode;
    return n===i||!!(i&&i.nodeType===1&&(r.contains?r.contains(i):n.compareDocumentPosition&&n.compareDocumentPosition(i)&16))
    }:function(n,t){
    if(t)while(t=t.parentNode)if(t===n)return!0;
    return!1
    },dt=a.compareDocumentPosition?function(n,i){
    if(n===i)return ft=!0,0;
    var r=i.compareDocumentPosition&&n.compareDocumentPosition&&n.compareDocumentPosition(i);
    return r?r&1||!e.sortDetached&&i.compareDocumentPosition(n)===r?n===t||ot(y,n)?-1:i===t||ot(y,i)?1:g?it.call(g,n)-it.call(g,i):0:r&4?-1:1:n.compareDocumentPosition?-1:1
    }:function(n,i){
    var r,u=0,o=n.parentNode,s=i.parentNode,f=[n],e=[i];
    if(n===i)return ft=!0,0;
    if(o&&s){
        if(o===s)return bi(n,i)
            }else return n===t?-1:i===t?1:o?-1:s?1:g?it.call(g,n)-it.call(g,i):0;
    for(r=n;r=r.parentNode;)f.unshift(r);
    for(r=i;r=r.parentNode;)e.unshift(r);
    while(f[u]===e[u])u++;
    return u?bi(f[u],e[u]):f[u]===y?-1:e[u]===y?1:0
    },t)
};

u.matches=function(n,t){
    return u(n,null,null,t)
    };
    
u.matchesSelector=function(n,t){
    if((n.ownerDocument||n)!==s&&nt(n),t=t.replace(ur,"='$1']"),e.matchesSelector&&v&&(!tt||!tt.test(t))&&(!h||!h.test(t)))try{
        var i=at.call(n,t);
        if(i||e.disconnectedMatch||n.document&&n.document.nodeType!==11)return i
            }catch(r){}
        return u(t,s,null,[n]).length>0
    };
    
u.contains=function(n,t){
    return(n.ownerDocument||n)!==s&&nt(n),ot(n,t)
    };
    
u.attr=function(n,i){
    (n.ownerDocument||n)!==s&&nt(n);
    var f=r.attrHandle[i.toLowerCase()],u=f&&gi.call(r.attrHandle,i.toLowerCase())?f(n,i,!v):t;
    return u===t?e.attributes||!v?n.getAttribute(i):(u=n.getAttributeNode(i))&&u.specified?u.value:null:u
    };
    
u.error=function(n){
    throw new Error("Syntax error, unrecognized expression: "+n);
};

u.uniqueSort=function(n){
    var r,u=[],t=0,i=0;
    if(ft=!e.detectDuplicates,g=!e.sortStable&&n.slice(0),n.sort(dt),ft){
        while(r=n[i++])r===n[i]&&(t=u.push(i));
        while(t--)n.splice(u[t],1)
            }
            return n
    };
    
ct=u.getText=function(n){
    var r,i="",u=0,t=n.nodeType;
    if(t){
        if(t===1||t===9||t===11){
            if(typeof n.textContent=="string")return n.textContent;
            for(n=n.firstChild;n;n=n.nextSibling)i+=ct(n)
                }else if(t===3||t===4)return n.nodeValue
            }else for(;r=n[u];u++)i+=ct(r);
    return i
    };
    
r=u.selectors={
    cacheLength:50,
    createPseudo:c,
    match:yt,
    attrHandle:{},
    find:{},
    relative:{
        ">":{
            dir:"parentNode",
            first:!0
            },
        " ":{
            dir:"parentNode"
        },
        "+":{
            dir:"previousSibling",
            first:!0
            },
        "~":{
            dir:"previousSibling"
        }
    },
preFilter:{
    ATTR:function(n){
        return n[1]=n[1].replace(k,d),n[3]=(n[4]||n[5]||"").replace(k,d),n[2]==="~="&&(n[3]=" "+n[3]+" "),n.slice(0,4)
        },
    CHILD:function(n){
        return n[1]=n[1].toLowerCase(),n[1].slice(0,3)==="nth"?(n[3]||u.error(n[0]),n[4]=+(n[4]?n[5]+(n[6]||1):2*(n[3]==="even"||n[3]==="odd")),n[5]=+(n[7]+n[8]||n[3]==="odd")):n[3]&&u.error(n[0]),n
        },
    PSEUDO:function(n){
        var r,i=!n[5]&&n[2];
        return yt.CHILD.test(n[0])?null:(n[3]&&n[4]!==t?n[2]=n[4]:i&&fr.test(i)&&(r=pt(i,!0))&&(r=i.indexOf(")",i.length-r)-i.length)&&(n[0]=n[0].slice(0,r),n[2]=i.slice(0,r)),n.slice(0,3))
        }
    },
filter:{
    TAG:function(n){
        var t=n.replace(k,d).toLowerCase();
        return n==="*"?function(){
            return!0
            }:function(n){
            return n.nodeName&&n.nodeName.toLowerCase()===t
            }
        },
CLASS:function(n){
    var t=ci[n+" "];
    return t||(t=new RegExp("(^|"+f+")"+n+"("+f+"|$)"))&&ci(n,function(n){
        return t.test(typeof n.className=="string"&&n.className||typeof n.getAttribute!==st&&n.getAttribute("class")||"")
        })
    },
ATTR:function(n,t,i){
    return function(r){
        var f=u.attr(r,n);
        return f==null?t==="!=":t?(f+="",t==="="?f===i:t==="!="?f!==i:t==="^="?i&&f.indexOf(i)===0:t==="*="?i&&f.indexOf(i)>-1:t==="$="?i&&f.slice(-i.length)===i:t==="~="?(" "+f+" ").indexOf(i)>-1:t==="|="?f===i||f.slice(0,i.length+1)===i+"-":!1):!0
        }
    },
CHILD:function(n,t,i,r,u){
    var s=n.slice(0,3)!=="nth",e=n.slice(-4)!=="last",f=t==="of-type";
    return r===1&&u===0?function(n){
        return!!n.parentNode
        }:function(t,i,h){
        var a,k,c,l,v,w,b=s!==e?"nextSibling":"previousSibling",y=t.parentNode,g=f&&t.nodeName.toLowerCase(),d=!h&&!f;
        if(y){
            if(s){
                while(b){
                    for(c=t;c=c[b];)if(f?c.nodeName.toLowerCase()===g:c.nodeType===1)return!1;w=b=n==="only"&&!w&&"nextSibling"
                    }
                    return!0
                }
                if(w=[e?y.firstChild:y.lastChild],e&&d){
                for(k=y[o]||(y[o]={}),a=k[n]||[],v=a[0]===p&&a[1],l=a[0]===p&&a[2],c=v&&y.childNodes[v];c=++v&&c&&c[b]||(l=v=0)||w.pop();)if(c.nodeType===1&&++l&&c===t){
                    k[n]=[p,v,l];
                    break
                }
                }else if(d&&(a=(t[o]||(t[o]={}))[n])&&a[0]===p)l=a[1];else while(c=++v&&c&&c[b]||(l=v=0)||w.pop())if((f?c.nodeName.toLowerCase()===g:c.nodeType===1)&&++l&&(d&&((c[o]||(c[o]={}))[n]=[p,l]),c===t))break;
        return l-=u,l===r||l%r==0&&l/r>=0
        }
    }
},
PSEUDO:function(n,t){
    var f,i=r.pseudos[n]||r.setFilters[n.toLowerCase()]||u.error("unsupported pseudo: "+n);
    return i[o]?i(t):i.length>1?(f=[n,n,"",t],r.setFilters.hasOwnProperty(n.toLowerCase())?c(function(n,r){
        for(var u,f=i(n,t),e=f.length;e--;)u=it.call(n,f[e]),n[u]=!(r[u]=f[e])
            }):function(n){
        return i(n,0,f)
        }):i
    }
},
pseudos:{
    not:c(function(n){
        var i=[],r=[],t=kt(n.replace(vt,"$1"));
        return t[o]?c(function(n,i,r,u){
            for(var e,o=t(n,null,u,[]),f=n.length;f--;)(e=o[f])&&(n[f]=!(i[f]=e))
                }):function(n,u,f){
            return i[0]=n,t(i,null,f,r),!r.pop()
            }
        }),
has:c(function(n){
    return function(t){
        return u(n,t).length>0
        }
    }),
contains:c(function(n){
    return function(t){
        return(t.textContent||t.innerText||ct(t)).indexOf(n)>-1
        }
    }),
lang:c(function(n){
    return er.test(n||"")||u.error("unsupported lang: "+n),n=n.replace(k,d).toLowerCase(),function(t){
        var i;
        do if(i=v?t.lang:t.getAttribute("xml:lang")||t.getAttribute("lang"))return i=i.toLowerCase(),i===n||i.indexOf(n+"-")===0;while((t=t.parentNode)&&t.nodeType===1);
        return!1
        }
    }),
target:function(t){
    var i=n.location&&n.location.hash;
    return i&&i.slice(1)===t.id
    },
root:function(n){
    return n===a
    },
focus:function(n){
    return n===s.activeElement&&(!s.hasFocus||s.hasFocus())&&!!(n.type||n.href||~n.tabIndex)
    },
enabled:function(n){
    return n.disabled===!1
    },
disabled:function(n){
    return n.disabled===!0
    },
checked:function(n){
    var t=n.nodeName.toLowerCase();
    return t==="input"&&!!n.checked||t==="option"&&!!n.selected
    },
selected:function(n){
    return n.parentNode&&n.parentNode.selectedIndex,n.selected===!0
    },
empty:function(n){
    for(n=n.firstChild;n;n=n.nextSibling)if(n.nodeName>"@"||n.nodeType===3||n.nodeType===4)return!1;return!0
    },
parent:function(n){
    return!r.pseudos.empty(n)
    },
header:function(n){
    return hr.test(n.nodeName)
    },
input:function(n){
    return sr.test(n.nodeName)
    },
button:function(n){
    var t=n.nodeName.toLowerCase();
    return t==="input"&&n.type==="button"||t==="button"
    },
text:function(n){
    var t;
    return n.nodeName.toLowerCase()==="input"&&n.type==="text"&&((t=n.getAttribute("type"))==null||t.toLowerCase()===n.type)
    },
first:rt(function(){
    return[0]
    }),
last:rt(function(n,t){
    return[t-1]
    }),
eq:rt(function(n,t,i){
    return[i<0?i+t:i]
    }),
even:rt(function(n,t){
    for(var i=0;i<t;i+=2)n.push(i);
    return n
    }),
odd:rt(function(n,t){
    for(var i=1;i<t;i+=2)n.push(i);
    return n
    }),
lt:rt(function(n,t,i){
    for(var r=i<0?i+t:i;--r>=0;)n.push(r);
    return n
    }),
gt:rt(function(n,t,i){
    for(var r=i<0?i+t:i;++r<t;)n.push(r);
    return n
    })
}
};

r.pseudos.nth=r.pseudos.eq;
for(ut in{
    radio:!0,
    checkbox:!0,
    file:!0,
    password:!0,
    image:!0
    })r.pseudos[ut]=lr(ut);for(ut in{
    submit:!0,
    reset:!0
    })r.pseudos[ut]=ar(ut);ki.prototype=r.filters=r.pseudos;
r.setFilters=new ki;
kt=u.compile=function(n,t){
    var r,u=[],f=[],i=ai[n+" "];
    if(!i){
        for(t||(t=pt(n)),r=t.length;r--;)i=si(t[r]),i[o]?u.push(i):f.push(i);
        i=ai(n,vr(f,u))
        }
        return i
    };
    
e.sortStable=o.split("").sort(dt).join("")===o;
e.detectDuplicates=ft;
nt();
e.sortDetached=l(function(n){
    return n.compareDocumentPosition(s.createElement("div"))&1
    });
l(function(n){
    return n.innerHTML="<a href='#'><\/a>",n.firstChild.getAttribute("href")==="#"
    })||ui("type|href|height|width",function(n,t,i){
    if(!i)return n.getAttribute(t,t.toLowerCase()==="type"?1:2)
        });
e.attributes&&l(function(n){
    return n.innerHTML="<input/>",n.firstChild.setAttribute("value",""),n.firstChild.getAttribute("value")===""
    })||ui("value",function(n,t,i){
    if(!i&&n.nodeName.toLowerCase()==="input")return n.defaultValue
        });
l(function(n){
    return n.getAttribute("disabled")==null
    })||ui(gt,function(n,t,i){
    var r;
    if(!i)return(r=n.getAttributeNode(t))&&r.specified?r.value:n[t]===!0?t.toLowerCase():null
        });
i.find=u;
i.expr=u.selectors;
i.expr[":"]=i.expr.pseudos;
i.unique=u.uniqueSort;
i.text=u.getText;
i.isXMLDoc=u.isXML;
i.contains=u.contains
}(n);
ni={};

i.Callbacks=function(n){
    n=typeof n=="string"?ni[n]||te(n):i.extend({},n);
    var s,f,c,e,o,l,r=[],u=!n.once&&[],a=function(t){
        for(f=n.memory&&t,c=!0,o=l||0,l=0,e=r.length,s=!0;r&&o<e;o++)if(r[o].apply(t[0],t[1])===!1&&n.stopOnFalse){
            f=!1;
            break
        }
        s=!1;
        r&&(u?u.length&&a(u.shift()):f?r=[]:h.disable())
        },h={
        add:function(){
            if(r){
                var t=r.length;
                (function u(t){
                    i.each(t,function(t,f){
                        var e=i.type(f);
                        e==="function"?n.unique&&h.has(f)||r.push(f):f&&f.length&&e!=="string"&&u(f)
                        })
                    })(arguments);
                s?e=r.length:f&&(l=t,a(f))
                }
                return this
            },
        remove:function(){
            return r&&i.each(arguments,function(n,t){
                for(var u;(u=i.inArray(t,r,u))>-1;)r.splice(u,1),s&&(u<=e&&e--,u<=o&&o--)
                    }),this
            },
        has:function(n){
            return n?i.inArray(n,r)>-1:!!(r&&r.length)
            },
        empty:function(){
            return r=[],e=0,this
            },
        disable:function(){
            return r=u=f=t,this
            },
        disabled:function(){
            return!r
            },
        lock:function(){
            return u=t,f||h.disable(),this
            },
        locked:function(){
            return!u
            },
        fireWith:function(n,t){
            return r&&(!c||u)&&(t=t||[],t=[n,t.slice?t.slice():t],s?u.push(t):a(t)),this
            },
        fire:function(){
            return h.fireWith(this,arguments),this
            },
        fired:function(){
            return!!c
            }
        };
    
return h
};

i.extend({
    Deferred:function(n){
        var u=[["resolve","done",i.Callbacks("once memory"),"resolved"],["reject","fail",i.Callbacks("once memory"),"rejected"],["notify","progress",i.Callbacks("memory")]],f="pending",r={
            state:function(){
                return f
                },
            always:function(){
                return t.done(arguments).fail(arguments),this
                },
            then:function(){
                var n=arguments;
                return i.Deferred(function(f){
                    i.each(u,function(u,e){
                        var s=e[0],o=i.isFunction(n[u])&&n[u];
                        t[e[1]](function(){
                            var n=o&&o.apply(this,arguments);
                            n&&i.isFunction(n.promise)?n.promise().done(f.resolve).fail(f.reject).progress(f.notify):f[s+"With"](this===r?f.promise():this,o?[n]:arguments)
                            })
                        });
                    n=null
                    }).promise()
                },
            promise:function(n){
                return n!=null?i.extend(n,r):r
                }
            },t={};
    
    return r.pipe=r.then,i.each(u,function(n,i){
        var e=i[2],o=i[3];
        r[i[1]]=e.add;
        o&&e.add(function(){
            f=o
            },u[n^1][2].disable,u[2][2].lock);
        t[i[0]]=function(){
            return t[i[0]+"With"](this===t?r:this,arguments),this
            };
            
        t[i[0]+"With"]=e.fireWith
        }),r.promise(t),n&&n.call(t,t),t
    },
when:function(n){
    var t=0,u=l.call(arguments),r=u.length,e=r!==1||n&&i.isFunction(n.promise)?r:0,f=e===1?n:i.Deferred(),h=function(n,t,i){
        return function(r){
            t[n]=this;
            i[n]=arguments.length>1?l.call(arguments):r;
            i===o?f.notifyWith(t,i):--e||f.resolveWith(t,i)
            }
        },o,c,s;
if(r>1)for(o=new Array(r),c=new Array(r),s=new Array(r);t<r;t++)u[t]&&i.isFunction(u[t].promise)?u[t].promise().done(h(t,s,u)).fail(f.reject).progress(h(t,c,o)):--e;
    return e||f.resolveWith(s,u),f.promise()
    }
});
i.support=function(t){
    var a,e,f,h,c,l,v,y,s,u=r.createElement("div");
    if(u.setAttribute("className","t"),u.innerHTML="  <link/><table><\/table><a href='/a'>a<\/a><input type='checkbox'/>",a=u.getElementsByTagName("*")||[],e=u.getElementsByTagName("a")[0],!e||!e.style||!a.length)return t;
    h=r.createElement("select");
    l=h.appendChild(r.createElement("option"));
    f=u.getElementsByTagName("input")[0];
    e.style.cssText="top:1px;float:left;opacity:.5";
    t.getSetAttribute=u.className!=="t";
    t.leadingWhitespace=u.firstChild.nodeType===3;
    t.tbody=!u.getElementsByTagName("tbody").length;
    t.htmlSerialize=!!u.getElementsByTagName("link").length;
    t.style=/top/.test(e.getAttribute("style"));
    t.hrefNormalized=e.getAttribute("href")==="/a";
    t.opacity=/^0.5/.test(e.style.opacity);
    t.cssFloat=!!e.style.cssFloat;
    t.checkOn=!!f.value;
    t.optSelected=l.selected;
    t.enctype=!!r.createElement("form").enctype;
    t.html5Clone=r.createElement("nav").cloneNode(!0).outerHTML!=="<:nav><\/:nav>";
    t.inlineBlockNeedsLayout=!1;
    t.shrinkWrapBlocks=!1;
    t.pixelPosition=!1;
    t.deleteExpando=!0;
    t.noCloneEvent=!0;
    t.reliableMarginRight=!0;
    t.boxSizingReliable=!0;
    f.checked=!0;
    t.noCloneChecked=f.cloneNode(!0).checked;
    h.disabled=!0;
    t.optDisabled=!l.disabled;
    try{
        delete u.test
        }catch(p){
        t.deleteExpando=!1
        }
        f=r.createElement("input");
    f.setAttribute("value","");
    t.input=f.getAttribute("value")==="";
    f.value="t";
    f.setAttribute("type","radio");
    t.radioValue=f.value==="t";
    f.setAttribute("checked","t");
    f.setAttribute("name","t");
    c=r.createDocumentFragment();
    c.appendChild(f);
    t.appendChecked=f.checked;
    t.checkClone=c.cloneNode(!0).cloneNode(!0).lastChild.checked;
    u.attachEvent&&(u.attachEvent("onclick",function(){
        t.noCloneEvent=!1
        }),u.cloneNode(!0).click());
    for(s in{
        submit:!0,
        change:!0,
        focusin:!0
        })u.setAttribute(v="on"+s,"t"),t[s+"Bubbles"]=v in n||u.attributes[v].expando===!1;u.style.backgroundClip="content-box";
    u.cloneNode(!0).style.backgroundClip="";
    t.clearCloneStyle=u.style.backgroundClip==="content-box";
    for(s in i(t))break;return t.ownLast=s!=="0",i(function(){
        var h,e,f,c="padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;",s=r.getElementsByTagName("body")[0];
        s&&(h=r.createElement("div"),h.style.cssText="border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px",s.appendChild(h).appendChild(u),u.innerHTML="<table><tr><td><\/td><td>t<\/td><\/tr><\/table>",f=u.getElementsByTagName("td"),f[0].style.cssText="padding:0;margin:0;border:0;display:none",y=f[0].offsetHeight===0,f[0].style.display="",f[1].style.display="none",t.reliableHiddenOffsets=y&&f[0].offsetHeight===0,u.innerHTML="",u.style.cssText="box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;",i.swap(s,s.style.zoom!=null?{
            zoom:1
        }:{},function(){
            t.boxSizing=u.offsetWidth===4
            }),n.getComputedStyle&&(t.pixelPosition=(n.getComputedStyle(u,null)||{}).top!=="1%",t.boxSizingReliable=(n.getComputedStyle(u,null)||{
            width:"4px"
        }).width==="4px",e=u.appendChild(r.createElement("div")),e.style.cssText=u.style.cssText=c,e.style.marginRight=e.style.width="0",u.style.width="1px",t.reliableMarginRight=!parseFloat((n.getComputedStyle(e,null)||{}).marginRight)),typeof u.style.zoom!==o&&(u.innerHTML="",u.style.cssText=c+"width:1px;padding:1px;display:inline;zoom:1",t.inlineBlockNeedsLayout=u.offsetWidth===3,u.style.display="block",u.innerHTML="<div><\/div>",u.firstChild.style.width="5px",t.shrinkWrapBlocks=u.offsetWidth!==3,t.inlineBlockNeedsLayout&&(s.style.zoom=1)),s.removeChild(h),h=u=f=e=null)
        }),a=h=c=l=e=f=null,t
    }({});
ir=/(?:\{[\s\S]*\}|\[[\s\S]*\])$/;
rr=/([A-Z])/g;
i.extend({
    cache:{},
    noData:{
        applet:!0,
        embed:!0,
        object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
    },
    hasData:function(n){
        return n=n.nodeType?i.cache[n[i.expando]]:n[i.expando],!!n&&!ti(n)
        },
    data:function(n,t,i){
        return ur(n,t,i)
        },
    removeData:function(n,t){
        return fr(n,t)
        },
    _data:function(n,t,i){
        return ur(n,t,i,!0)
        },
    _removeData:function(n,t){
        return fr(n,t,!0)
        },
    acceptData:function(n){
        if(n.nodeType&&n.nodeType!==1&&n.nodeType!==9)return!1;
        var t=n.nodeName&&i.noData[n.nodeName.toLowerCase()];
        return!t||t!==!0&&n.getAttribute("classid")===t
        }
    });
i.fn.extend({
    data:function(n,r){
        var e,f,o=null,s=0,u=this[0];
        if(n===t){
            if(this.length&&(o=i.data(u),u.nodeType===1&&!i._data(u,"parsedAttrs"))){
                for(e=u.attributes;s<e.length;s++)f=e[s].name,f.indexOf("data-")===0&&(f=i.camelCase(f.slice(5)),er(u,f,o[f]));
                i._data(u,"parsedAttrs",!0)
                }
                return o
            }
            return typeof n=="object"?this.each(function(){
            i.data(this,n)
            }):arguments.length>1?this.each(function(){
            i.data(this,n,r)
            }):u?er(u,n,i.data(u,n)):null
        },
    removeData:function(n){
        return this.each(function(){
            i.removeData(this,n)
            })
        }
    });
i.extend({
    queue:function(n,t,r){
        var u;
        if(n)return t=(t||"fx")+"queue",u=i._data(n,t),r&&(!u||i.isArray(r)?u=i._data(n,t,i.makeArray(r)):u.push(r)),u||[]
            },
    dequeue:function(n,t){
        t=t||"fx";
        var r=i.queue(n,t),e=r.length,u=r.shift(),f=i._queueHooks(n,t),o=function(){
            i.dequeue(n,t)
            };
            
        u==="inprogress"&&(u=r.shift(),e--);
        u&&(t==="fx"&&r.unshift("inprogress"),delete f.stop,u.call(n,o,f));
        !e&&f&&f.empty.fire()
        },
    _queueHooks:function(n,t){
        var r=t+"queueHooks";
        return i._data(n,r)||i._data(n,r,{
            empty:i.Callbacks("once memory").add(function(){
                i._removeData(n,t+"queue");
                i._removeData(n,r)
                })
            })
        }
    });
i.fn.extend({
    queue:function(n,r){
        var u=2;
        return(typeof n!="string"&&(r=n,n="fx",u--),arguments.length<u)?i.queue(this[0],n):r===t?this:this.each(function(){
            var t=i.queue(this,n,r);
            i._queueHooks(this,n);
            n==="fx"&&t[0]!=="inprogress"&&i.dequeue(this,n)
            })
        },
    dequeue:function(n){
        return this.each(function(){
            i.dequeue(this,n)
            })
        },
    delay:function(n,t){
        return n=i.fx?i.fx.speeds[n]||n:n,t=t||"fx",this.queue(t,function(t,i){
            var r=setTimeout(t,n);
            i.stop=function(){
                clearTimeout(r)
                }
            })
    },
clearQueue:function(n){
    return this.queue(n||"fx",[])
    },
promise:function(n,r){
    var u,e=1,o=i.Deferred(),f=this,s=this.length,h=function(){
        --e||o.resolveWith(f,[f])
        };
        
    for(typeof n!="string"&&(r=n,n=t),n=n||"fx";s--;)u=i._data(f[s],n+"queueHooks"),u&&u.empty&&(e++,u.empty.add(h));
    return h(),o.promise(r)
    }
});
var d,or,ii=/[\t\r\n\f]/g,ie=/\r/g,re=/^(?:input|select|textarea|button|object)$/i,ue=/^(?:a|area)$/i,ri=/^(?:checked|selected)$/i,a=i.support.getSetAttribute,ht=i.support.input;
i.fn.extend({
    attr:function(n,t){
        return i.access(this,i.attr,n,t,arguments.length>1)
        },
    removeAttr:function(n){
        return this.each(function(){
            i.removeAttr(this,n)
            })
        },
    prop:function(n,t){
        return i.access(this,i.prop,n,t,arguments.length>1)
        },
    removeProp:function(n){
        return n=i.propFix[n]||n,this.each(function(){
            try{
                this[n]=t;
                delete this[n]
            }catch(i){}
        })
    },
addClass:function(n){
    var e,t,r,u,o,f=0,h=this.length,c=typeof n=="string"&&n;
    if(i.isFunction(n))return this.each(function(t){
        i(this).addClass(n.call(this,t,this.className))
        });
    if(c)for(e=(n||"").match(s)||[];f<h;f++)if(t=this[f],r=t.nodeType===1&&(t.className?(" "+t.className+" ").replace(ii," "):" "),r){
        for(o=0;u=e[o++];)r.indexOf(" "+u+" ")<0&&(r+=u+" ");
        t.className=i.trim(r)
        }
        return this
    },
removeClass:function(n){
    var e,r,t,u,o,f=0,h=this.length,c=arguments.length===0||typeof n=="string"&&n;
    if(i.isFunction(n))return this.each(function(t){
        i(this).removeClass(n.call(this,t,this.className))
        });
    if(c)for(e=(n||"").match(s)||[];f<h;f++)if(r=this[f],t=r.nodeType===1&&(r.className?(" "+r.className+" ").replace(ii," "):""),t){
        for(o=0;u=e[o++];)while(t.indexOf(" "+u+" ")>=0)t=t.replace(" "+u+" "," ");
        r.className=n?i.trim(t):""
        }
        return this
    },
toggleClass:function(n,t){
    var r=typeof n;
    return typeof t=="boolean"&&r==="string"?t?this.addClass(n):this.removeClass(n):i.isFunction(n)?this.each(function(r){
        i(this).toggleClass(n.call(this,r,this.className,t),t)
        }):this.each(function(){
        if(r==="string")for(var t,f=0,u=i(this),e=n.match(s)||[];t=e[f++];)u.hasClass(t)?u.removeClass(t):u.addClass(t);else(r===o||r==="boolean")&&(this.className&&i._data(this,"__className__",this.className),this.className=this.className||n===!1?"":i._data(this,"__className__")||"")
            })
    },
hasClass:function(n){
    for(var i=" "+n+" ",t=0,r=this.length;t<r;t++)if(this[t].nodeType===1&&(" "+this[t].className+" ").replace(ii," ").indexOf(i)>=0)return!0;return!1
    },
val:function(n){
    var u,r,e,f=this[0];
    return arguments.length?(e=i.isFunction(n),this.each(function(u){
        var f;
        this.nodeType===1&&(f=e?n.call(this,u,i(this).val()):n,f==null?f="":typeof f=="number"?f+="":i.isArray(f)&&(f=i.map(f,function(n){
            return n==null?"":n+""
            })),r=i.valHooks[this.type]||i.valHooks[this.nodeName.toLowerCase()],r&&"set"in r&&r.set(this,f,"value")!==t||(this.value=f))
        })):f?(r=i.valHooks[f.type]||i.valHooks[f.nodeName.toLowerCase()],r&&"get"in r&&(u=r.get(f,"value"))!==t)?u:(u=f.value,typeof u=="string"?u.replace(ie,""):u==null?"":u):void 0
    }
});
i.extend({
    valHooks:{
        option:{
            get:function(n){
                var t=i.find.attr(n,"value");
                return t!=null?t:n.text
                }
            },
    select:{
        get:function(n){
            for(var e,t,o=n.options,r=n.selectedIndex,u=n.type==="select-one"||r<0,s=u?null:[],h=u?r+1:o.length,f=r<0?h:u?r:0;f<h;f++)if(t=o[f],(t.selected||f===r)&&(i.support.optDisabled?!t.disabled:t.getAttribute("disabled")===null)&&(!t.parentNode.disabled||!i.nodeName(t.parentNode,"optgroup"))){
                if(e=i(t).val(),u)return e;
                s.push(e)
                }
                return s
            },
        set:function(n,t){
            for(var u,r,f=n.options,e=i.makeArray(t),o=f.length;o--;)r=f[o],(r.selected=i.inArray(i(r).val(),e)>=0)&&(u=!0);
            return u||(n.selectedIndex=-1),e
            }
        }
},
attr:function(n,r,u){
    var f,e,s=n.nodeType;
    if(n&&s!==3&&s!==8&&s!==2){
        if(typeof n.getAttribute===o)return i.prop(n,r,u);
        if(s===1&&i.isXMLDoc(n)||(r=r.toLowerCase(),f=i.attrHooks[r]||(i.expr.match.bool.test(r)?or:d)),u!==t)if(u===null)i.removeAttr(n,r);else return f&&"set"in f&&(e=f.set(n,u,r))!==t?e:(n.setAttribute(r,u+""),u);else return f&&"get"in f&&(e=f.get(n,r))!==null?e:(e=i.find.attr(n,r),e==null?t:e)
            }
        },
removeAttr:function(n,t){
    var r,u,e=0,f=t&&t.match(s);
    if(f&&n.nodeType===1)while(r=f[e++])u=i.propFix[r]||r,i.expr.match.bool.test(r)?ht&&a||!ri.test(r)?n[u]=!1:n[i.camelCase("default-"+r)]=n[u]=!1:i.attr(n,r,""),n.removeAttribute(a?r:u)
        },
attrHooks:{
    type:{
        set:function(n,t){
            if(!i.support.radioValue&&t==="radio"&&i.nodeName(n,"input")){
                var r=n.value;
                return n.setAttribute("type",t),r&&(n.value=r),t
                }
            }
    }
},
propFix:{
    "for":"htmlFor",
    "class":"className"
},
prop:function(n,r,u){
    var e,f,s,o=n.nodeType;
    if(n&&o!==3&&o!==8&&o!==2)return s=o!==1||!i.isXMLDoc(n),s&&(r=i.propFix[r]||r,f=i.propHooks[r]),u!==t?f&&"set"in f&&(e=f.set(n,u,r))!==t?e:n[r]=u:f&&"get"in f&&(e=f.get(n,r))!==null?e:n[r]
        },
propHooks:{
    tabIndex:{
        get:function(n){
            var t=i.find.attr(n,"tabindex");
            return t?parseInt(t,10):re.test(n.nodeName)||ue.test(n.nodeName)&&n.href?0:-1
            }
        }
}
});
or={
    set:function(n,t,r){
        return t===!1?i.removeAttr(n,r):ht&&a||!ri.test(r)?n.setAttribute(!a&&i.propFix[r]||r,r):n[i.camelCase("default-"+r)]=n[r]=!0,r
        }
    };

i.each(i.expr.match.bool.source.match(/\w+/g),function(n,r){
    var u=i.expr.attrHandle[r]||i.find.attr;
    i.expr.attrHandle[r]=ht&&a||!ri.test(r)?function(n,r,f){
        var e=i.expr.attrHandle[r],o=f?t:(i.expr.attrHandle[r]=t)!=u(n,r,f)?r.toLowerCase():null;
        return i.expr.attrHandle[r]=e,o
        }:function(n,r,u){
        return u?t:n[i.camelCase("default-"+r)]?r.toLowerCase():null
        }
    });
ht&&a||(i.attrHooks.value={
    set:function(n,t,r){
        if(i.nodeName(n,"input"))n.defaultValue=t;else return d&&d.set(n,t,r)
            }
        });
a||(d={
    set:function(n,i,r){
        var u=n.getAttributeNode(r);
        return u||n.setAttributeNode(u=n.ownerDocument.createAttribute(r)),u.value=i+="",r==="value"||i===n.getAttribute(r)?i:t
        }
    },i.expr.attrHandle.id=i.expr.attrHandle.name=i.expr.attrHandle.coords=function(n,i,r){
    var u;
    return r?t:(u=n.getAttributeNode(i))&&u.value!==""?u.value:null
    },i.valHooks.button={
    get:function(n,i){
        var r=n.getAttributeNode(i);
        return r&&r.specified?r.value:t
        },
    set:d.set
    },i.attrHooks.contenteditable={
    set:function(n,t,i){
        d.set(n,t===""?!1:t,i)
        }
    },i.each(["width","height"],function(n,t){
    i.attrHooks[t]={
        set:function(n,i){
            if(i==="")return n.setAttribute(t,"auto"),i
                }
            }
}));
i.support.hrefNormalized||i.each(["href","src"],function(n,t){
    i.propHooks[t]={
        get:function(n){
            return n.getAttribute(t,4)
            }
        }
});
i.support.style||(i.attrHooks.style={
    get:function(n){
        return n.style.cssText||t
        },
    set:function(n,t){
        return n.style.cssText=t+""
        }
    });
i.support.optSelected||(i.propHooks.selected={
    get:function(n){
        var t=n.parentNode;
        return t&&(t.selectedIndex,t.parentNode&&t.parentNode.selectedIndex),null
        }
    });
i.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){
    i.propFix[this.toLowerCase()]=this
    });
i.support.enctype||(i.propFix.enctype="encoding");
i.each(["radio","checkbox"],function(){
    i.valHooks[this]={
        set:function(n,t){
            if(i.isArray(t))return n.checked=i.inArray(i(n).val(),t)>=0
                }
            };
    
i.support.checkOn||(i.valHooks[this].get=function(n){
    return n.getAttribute("value")===null?"on":n.value
    })
});
var ui=/^(?:input|select|textarea)$/i,fe=/^key/,ee=/^(?:mouse|contextmenu)|click/,sr=/^(?:focusinfocus|focusoutblur)$/,hr=/^([^.]*)(?:\.(.+)|)$/;
i.event={
    global:{},
    add:function(n,r,u,f,e){
        var b,p,k,w,c,l,a,v,h,d,g,y=i._data(n);
        if(y){
            for(u.handler&&(w=u,u=w.handler,e=w.selector),u.guid||(u.guid=i.guid++),(p=y.events)||(p=y.events={}),(l=y.handle)||(l=y.handle=function(n){
                return typeof i!==o&&(!n||i.event.triggered!==n.type)?i.event.dispatch.apply(l.elem,arguments):t
                },l.elem=n),r=(r||"").match(s)||[""],k=r.length;k--;)(b=hr.exec(r[k])||[],h=g=b[1],d=(b[2]||"").split(".").sort(),h)&&(c=i.event.special[h]||{},h=(e?c.delegateType:c.bindType)||h,c=i.event.special[h]||{},a=i.extend({
                type:h,
                origType:g,
                data:f,
                handler:u,
                guid:u.guid,
                selector:e,
                needsContext:e&&i.expr.match.needsContext.test(e),
                namespace:d.join(".")
                },w),(v=p[h])||(v=p[h]=[],v.delegateCount=0,c.setup&&c.setup.call(n,f,d,l)!==!1||(n.addEventListener?n.addEventListener(h,l,!1):n.attachEvent&&n.attachEvent("on"+h,l))),c.add&&(c.add.call(n,a),a.handler.guid||(a.handler.guid=u.guid)),e?v.splice(v.delegateCount++,0,a):v.push(a),i.event.global[h]=!0);
            n=null
            }
        },
remove:function(n,t,r,u,f){
    var y,o,h,b,p,a,c,l,e,w,k,v=i.hasData(n)&&i._data(n);
    if(v&&(a=v.events)){
        for(t=(t||"").match(s)||[""],p=t.length;p--;){
            if(h=hr.exec(t[p])||[],e=k=h[1],w=(h[2]||"").split(".").sort(),!e){
                for(e in a)i.event.remove(n,e+t[p],r,u,!0);continue
            }
            for(c=i.event.special[e]||{},e=(u?c.delegateType:c.bindType)||e,l=a[e]||[],h=h[2]&&new RegExp("(^|\\.)"+w.join("\\.(?:.*\\.|)")+"(\\.|$)"),b=y=l.length;y--;)o=l[y],(f||k===o.origType)&&(!r||r.guid===o.guid)&&(!h||h.test(o.namespace))&&(!u||u===o.selector||u==="**"&&o.selector)&&(l.splice(y,1),o.selector&&l.delegateCount--,c.remove&&c.remove.call(n,o));
            b&&!l.length&&(c.teardown&&c.teardown.call(n,w,v.handle)!==!1||i.removeEvent(n,e,v.handle),delete a[e])
            }
            i.isEmptyObject(a)&&(delete v.handle,i._removeData(n,"events"))
        }
    },
trigger:function(u,f,e,o){
    var a,v,s,w,l,c,b,p=[e||r],h=k.call(u,"type")?u.type:u,y=k.call(u,"namespace")?u.namespace.split("."):[];
    if((s=c=e=e||r,e.nodeType!==3&&e.nodeType!==8)&&!sr.test(h+i.event.triggered)&&(h.indexOf(".")>=0&&(y=h.split("."),h=y.shift(),y.sort()),v=h.indexOf(":")<0&&"on"+h,u=u[i.expando]?u:new i.Event(h,typeof u=="object"&&u),u.isTrigger=o?2:3,u.namespace=y.join("."),u.namespace_re=u.namespace?new RegExp("(^|\\.)"+y.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,u.result=t,u.target||(u.target=e),f=f==null?[u]:i.makeArray(f,[u]),l=i.event.special[h]||{},o||!l.trigger||l.trigger.apply(e,f)!==!1)){
        if(!o&&!l.noBubble&&!i.isWindow(e)){
            for(w=l.delegateType||h,sr.test(w+h)||(s=s.parentNode);s;s=s.parentNode)p.push(s),c=s;
            c===(e.ownerDocument||r)&&p.push(c.defaultView||c.parentWindow||n)
            }
            for(b=0;(s=p[b++])&&!u.isPropagationStopped();)u.type=b>1?w:l.bindType||h,a=(i._data(s,"events")||{})[u.type]&&i._data(s,"handle"),a&&a.apply(s,f),a=v&&s[v],a&&i.acceptData(s)&&a.apply&&a.apply(s,f)===!1&&u.preventDefault();
        if(u.type=h,!o&&!u.isDefaultPrevented()&&(!l._default||l._default.apply(p.pop(),f)===!1)&&i.acceptData(e)&&v&&e[h]&&!i.isWindow(e)){
            c=e[v];
            c&&(e[v]=null);
            i.event.triggered=h;
            try{
                e[h]()
                }catch(d){}
            i.event.triggered=t;
            c&&(e[v]=c)
            }
            return u.result
        }
    },
dispatch:function(n){
    n=i.event.fix(n);
    var o,e,r,u,s,h=[],c=l.call(arguments),a=(i._data(this,"events")||{})[n.type]||[],f=i.event.special[n.type]||{};
    
    if(c[0]=n,n.delegateTarget=this,!f.preDispatch||f.preDispatch.call(this,n)!==!1){
        for(h=i.event.handlers.call(this,n,a),o=0;(u=h[o++])&&!n.isPropagationStopped();)for(n.currentTarget=u.elem,s=0;(r=u.handlers[s++])&&!n.isImmediatePropagationStopped();)(!n.namespace_re||n.namespace_re.test(r.namespace))&&(n.handleObj=r,n.data=r.data,e=((i.event.special[r.origType]||{}).handle||r.handler).apply(u.elem,c),e!==t&&(n.result=e)===!1&&(n.preventDefault(),n.stopPropagation()));
        return f.postDispatch&&f.postDispatch.call(this,n),n.result
        }
    },
handlers:function(n,r){
    var e,o,f,s,c=[],h=r.delegateCount,u=n.target;
    if(h&&u.nodeType&&(!n.button||n.type!=="click"))for(;u!=this;u=u.parentNode||this)if(u.nodeType===1&&(u.disabled!==!0||n.type!=="click")){
        for(f=[],s=0;s<h;s++)o=r[s],e=o.selector+" ",f[e]===t&&(f[e]=o.needsContext?i(e,this).index(u)>=0:i.find(e,this,null,[u]).length),f[e]&&f.push(o);
        f.length&&c.push({
            elem:u,
            handlers:f
        })
        }
        return h<r.length&&c.push({
        elem:this,
        handlers:r.slice(h)
        }),c
    },
fix:function(n){
    if(n[i.expando])return n;
    var e,o,s,u=n.type,f=n,t=this.fixHooks[u];
    for(t||(this.fixHooks[u]=t=ee.test(u)?this.mouseHooks:fe.test(u)?this.keyHooks:{}),s=t.props?this.props.concat(t.props):this.props,n=new i.Event(f),e=s.length;e--;)o=s[e],n[o]=f[o];
    return n.target||(n.target=f.srcElement||r),n.target.nodeType===3&&(n.target=n.target.parentNode),n.metaKey=!!n.metaKey,t.filter?t.filter(n,f):n
    },
props:"altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
fixHooks:{},
keyHooks:{
    props:"char charCode key keyCode".split(" "),
    filter:function(n,t){
        return n.which==null&&(n.which=t.charCode!=null?t.charCode:t.keyCode),n
        }
    },
mouseHooks:{
    props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
    filter:function(n,i){
        var u,o,f,e=i.button,s=i.fromElement;
        return n.pageX==null&&i.clientX!=null&&(o=n.target.ownerDocument||r,f=o.documentElement,u=o.body,n.pageX=i.clientX+(f&&f.scrollLeft||u&&u.scrollLeft||0)-(f&&f.clientLeft||u&&u.clientLeft||0),n.pageY=i.clientY+(f&&f.scrollTop||u&&u.scrollTop||0)-(f&&f.clientTop||u&&u.clientTop||0)),!n.relatedTarget&&s&&(n.relatedTarget=s===n.target?i.toElement:s),n.which||e===t||(n.which=e&1?1:e&2?3:e&4?2:0),n
        }
    },
special:{
    load:{
        noBubble:!0
        },
    focus:{
        trigger:function(){
            if(this!==cr()&&this.focus)try{
                return this.focus(),!1
                }catch(n){}
            },
    delegateType:"focusin"
},
blur:{
    trigger:function(){
        if(this===cr()&&this.blur)return this.blur(),!1
            },
    delegateType:"focusout"
},
click:{
    trigger:function(){
        if(i.nodeName(this,"input")&&this.type==="checkbox"&&this.click)return this.click(),!1
            },
    _default:function(n){
        return i.nodeName(n.target,"a")
        }
    },
beforeunload:{
    postDispatch:function(n){
        n.result!==t&&(n.originalEvent.returnValue=n.result)
        }
    }
},
simulate:function(n,t,r,u){
    var f=i.extend(new i.Event,r,{
        type:n,
        isSimulated:!0,
        originalEvent:{}
    });
u?i.event.trigger(f,null,t):i.event.dispatch.call(t,f);
f.isDefaultPrevented()&&r.preventDefault()
}
};

i.removeEvent=r.removeEventListener?function(n,t,i){
    n.removeEventListener&&n.removeEventListener(t,i,!1)
    }:function(n,t,i){
    var r="on"+t;
    n.detachEvent&&(typeof n[r]===o&&(n[r]=null),n.detachEvent(r,i))
    };
    
i.Event=function(n,t){
    if(!(this instanceof i.Event))return new i.Event(n,t);
    n&&n.type?(this.originalEvent=n,this.type=n.type,this.isDefaultPrevented=n.defaultPrevented||n.returnValue===!1||n.getPreventDefault&&n.getPreventDefault()?ct:g):this.type=n;
    t&&i.extend(this,t);
    this.timeStamp=n&&n.timeStamp||i.now();
    this[i.expando]=!0
    };
    
i.Event.prototype={
    isDefaultPrevented:g,
    isPropagationStopped:g,
    isImmediatePropagationStopped:g,
    preventDefault:function(){
        var n=this.originalEvent;
        (this.isDefaultPrevented=ct,n)&&(n.preventDefault?n.preventDefault():n.returnValue=!1)
        },
    stopPropagation:function(){
        var n=this.originalEvent;
        (this.isPropagationStopped=ct,n)&&(n.stopPropagation&&n.stopPropagation(),n.cancelBubble=!0)
        },
    stopImmediatePropagation:function(){
        this.isImmediatePropagationStopped=ct;
        this.stopPropagation()
        }
    };

i.each({
    mouseenter:"mouseover",
    mouseleave:"mouseout"
},function(n,t){
    i.event.special[n]={
        delegateType:t,
        bindType:t,
        handle:function(n){
            var u,f=this,r=n.relatedTarget,e=n.handleObj;
            return r&&(r===f||i.contains(f,r))||(n.type=e.origType,u=e.handler.apply(this,arguments),n.type=t),u
            }
        }
});
i.support.submitBubbles||(i.event.special.submit={
    setup:function(){
        if(i.nodeName(this,"form"))return!1;
        i.event.add(this,"click._submit keypress._submit",function(n){
            var u=n.target,r=i.nodeName(u,"input")||i.nodeName(u,"button")?u.form:t;
            r&&!i._data(r,"submitBubbles")&&(i.event.add(r,"submit._submit",function(n){
                n._submit_bubble=!0
                }),i._data(r,"submitBubbles",!0))
            })
        },
    postDispatch:function(n){
        n._submit_bubble&&(delete n._submit_bubble,this.parentNode&&!n.isTrigger&&i.event.simulate("submit",this.parentNode,n,!0))
        },
    teardown:function(){
        if(i.nodeName(this,"form"))return!1;
        i.event.remove(this,"._submit")
        }
    });
i.support.changeBubbles||(i.event.special.change={
    setup:function(){
        if(ui.test(this.nodeName))return(this.type==="checkbox"||this.type==="radio")&&(i.event.add(this,"propertychange._change",function(n){
            n.originalEvent.propertyName==="checked"&&(this._just_changed=!0)
            }),i.event.add(this,"click._change",function(n){
            this._just_changed&&!n.isTrigger&&(this._just_changed=!1);
            i.event.simulate("change",this,n,!0)
            })),!1;
        i.event.add(this,"beforeactivate._change",function(n){
            var t=n.target;
            ui.test(t.nodeName)&&!i._data(t,"changeBubbles")&&(i.event.add(t,"change._change",function(n){
                !this.parentNode||n.isSimulated||n.isTrigger||i.event.simulate("change",this.parentNode,n,!0)
                }),i._data(t,"changeBubbles",!0))
            })
        },
    handle:function(n){
        var t=n.target;
        if(this!==t||n.isSimulated||n.isTrigger||t.type!=="radio"&&t.type!=="checkbox")return n.handleObj.handler.apply(this,arguments)
            },
    teardown:function(){
        return i.event.remove(this,"._change"),!ui.test(this.nodeName)
        }
    });
i.support.focusinBubbles||i.each({
    focus:"focusin",
    blur:"focusout"
},function(n,t){
    var u=0,f=function(n){
        i.event.simulate(t,n.target,i.event.fix(n),!0)
        };
        
    i.event.special[t]={
        setup:function(){
            u++==0&&r.addEventListener(n,f,!0)
            },
        teardown:function(){
            --u==0&&r.removeEventListener(n,f,!0)
            }
        }
});
i.fn.extend({
    on:function(n,r,u,f,e){
        var s,o;
        if(typeof n=="object"){
            typeof r!="string"&&(u=u||r,r=t);
            for(s in n)this.on(s,r,u,n[s],e);return this
            }
            if(u==null&&f==null?(f=r,u=r=t):f==null&&(typeof r=="string"?(f=u,u=t):(f=u,u=r,r=t)),f===!1)f=g;
        else if(!f)return this;
        return e===1&&(o=f,f=function(n){
            return i().off(n),o.apply(this,arguments)
            },f.guid=o.guid||(o.guid=i.guid++)),this.each(function(){
            i.event.add(this,n,f,u,r)
            })
        },
    one:function(n,t,i,r){
        return this.on(n,t,i,r,1)
        },
    off:function(n,r,u){
        var f,e;
        if(n&&n.preventDefault&&n.handleObj)return f=n.handleObj,i(n.delegateTarget).off(f.namespace?f.origType+"."+f.namespace:f.origType,f.selector,f.handler),this;
        if(typeof n=="object"){
            for(e in n)this.off(e,r,n[e]);return this
            }
            return(r===!1||typeof r=="function")&&(u=r,r=t),u===!1&&(u=g),this.each(function(){
            i.event.remove(this,n,u,r)
            })
        },
    trigger:function(n,t){
        return this.each(function(){
            i.event.trigger(n,t,this)
            })
        },
    triggerHandler:function(n,t){
        var r=this[0];
        if(r)return i.event.trigger(n,t,r,!0)
            }
        });
var oe=/^.[^:#\[\.,]*$/,se=/^(?:parents|prev(?:Until|All))/,lr=i.expr.match.needsContext,he={
    children:!0,
    contents:!0,
    next:!0,
    prev:!0
    };
    
i.fn.extend({
    find:function(n){
        var t,r=[],u=this,f=u.length;
        if(typeof n!="string")return this.pushStack(i(n).filter(function(){
            for(t=0;t<f;t++)if(i.contains(u[t],this))return!0
                }));
        for(t=0;t<f;t++)i.find(n,u[t],r);
        return r=this.pushStack(f>1?i.unique(r):r),r.selector=this.selector?this.selector+" "+n:n,r
        },
    has:function(n){
        var t,r=i(n,this),u=r.length;
        return this.filter(function(){
            for(t=0;t<u;t++)if(i.contains(this,r[t]))return!0
                })
        },
    not:function(n){
        return this.pushStack(fi(this,n||[],!0))
        },
    filter:function(n){
        return this.pushStack(fi(this,n||[],!1))
        },
    is:function(n){
        return!!fi(this,typeof n=="string"&&lr.test(n)?i(n):n||[],!1).length
        },
    closest:function(n,t){
        for(var r,f=0,o=this.length,u=[],e=lr.test(n)||typeof n!="string"?i(n,t||this.context):0;f<o;f++)for(r=this[f];r&&r!==t;r=r.parentNode)if(r.nodeType<11&&(e?e.index(r)>-1:r.nodeType===1&&i.find.matchesSelector(r,n))){
            r=u.push(r);
            break
        }
        return this.pushStack(u.length>1?i.unique(u):u)
        },
    index:function(n){
        return n?typeof n=="string"?i.inArray(this[0],i(n)):i.inArray(n.jquery?n[0]:n,this):this[0]&&this[0].parentNode?this.first().prevAll().length:-1
        },
    add:function(n,t){
        var r=typeof n=="string"?i(n,t):i.makeArray(n&&n.nodeType?[n]:n),u=i.merge(this.get(),r);
        return this.pushStack(i.unique(u))
        },
    addBack:function(n){
        return this.add(n==null?this.prevObject:this.prevObject.filter(n))
        }
    });
i.each({
    parent:function(n){
        var t=n.parentNode;
        return t&&t.nodeType!==11?t:null
        },
    parents:function(n){
        return i.dir(n,"parentNode")
        },
    parentsUntil:function(n,t,r){
        return i.dir(n,"parentNode",r)
        },
    next:function(n){
        return ar(n,"nextSibling")
        },
    prev:function(n){
        return ar(n,"previousSibling")
        },
    nextAll:function(n){
        return i.dir(n,"nextSibling")
        },
    prevAll:function(n){
        return i.dir(n,"previousSibling")
        },
    nextUntil:function(n,t,r){
        return i.dir(n,"nextSibling",r)
        },
    prevUntil:function(n,t,r){
        return i.dir(n,"previousSibling",r)
        },
    siblings:function(n){
        return i.sibling((n.parentNode||{}).firstChild,n)
        },
    children:function(n){
        return i.sibling(n.firstChild)
        },
    contents:function(n){
        return i.nodeName(n,"iframe")?n.contentDocument||n.contentWindow.document:i.merge([],n.childNodes)
        }
    },function(n,t){
    i.fn[n]=function(r,u){
        var f=i.map(this,t,r);
        return n.slice(-5)!=="Until"&&(u=r),u&&typeof u=="string"&&(f=i.filter(u,f)),this.length>1&&(he[n]||(f=i.unique(f)),se.test(n)&&(f=f.reverse())),this.pushStack(f)
        }
    });
i.extend({
    filter:function(n,t,r){
        var u=t[0];
        return r&&(n=":not("+n+")"),t.length===1&&u.nodeType===1?i.find.matchesSelector(u,n)?[u]:[]:i.find.matches(n,i.grep(t,function(n){
            return n.nodeType===1
            }))
        },
    dir:function(n,r,u){
        for(var e=[],f=n[r];f&&f.nodeType!==9&&(u===t||f.nodeType!==1||!i(f).is(u));)f.nodeType===1&&e.push(f),f=f[r];
        return e
        },
    sibling:function(n,t){
        for(var i=[];n;n=n.nextSibling)n.nodeType===1&&n!==t&&i.push(n);
        return i
        }
    });
var yr="abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",ce=/ jQuery\d+="(?:null|\d+)"/g,pr=new RegExp("<(?:"+yr+")[\\s/>]","i"),ei=/^\s+/,wr=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,br=/<([\w:]+)/,kr=/<tbody/i,le=/<|&#?\w+;/,ae=/<(?:script|style|link)/i,oi=/^(?:checkbox|radio)$/i,ve=/checked\s*(?:[^=]|=\s*.checked.)/i,dr=/^$|\/(?:java|ecma)script/i,ye=/^true\/(.*)/,pe=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,e={
    option:[1,"<select multiple='multiple'>","<\/select>"],
    legend:[1,"<fieldset>","<\/fieldset>"],
    area:[1,"<map>","<\/map>"],
    param:[1,"<object>","<\/object>"],
    thead:[1,"<table>","<\/table>"],
    tr:[2,"<table><tbody>","<\/tbody><\/table>"],
    col:[2,"<table><tbody><\/tbody><colgroup>","<\/colgroup><\/table>"],
    td:[3,"<table><tbody><tr>","<\/tr><\/tbody><\/table>"],
    _default:i.support.htmlSerialize?[0,"",""]:[1,"X<div>","<\/div>"]
    },we=vr(r),si=we.appendChild(r.createElement("div"));
e.optgroup=e.option;
e.tbody=e.tfoot=e.colgroup=e.caption=e.thead;
e.th=e.td;
i.fn.extend({
    text:function(n){
        return i.access(this,function(n){
            return n===t?i.text(this):this.empty().append((this[0]&&this[0].ownerDocument||r).createTextNode(n))
            },null,n,arguments.length)
        },
    append:function(){
        return this.domManip(arguments,function(n){
            if(this.nodeType===1||this.nodeType===11||this.nodeType===9){
                var t=gr(this,n);
                t.appendChild(n)
                }
            })
    },
prepend:function(){
    return this.domManip(arguments,function(n){
        if(this.nodeType===1||this.nodeType===11||this.nodeType===9){
            var t=gr(this,n);
            t.insertBefore(n,t.firstChild)
            }
        })
},
before:function(){
    return this.domManip(arguments,function(n){
        this.parentNode&&this.parentNode.insertBefore(n,this)
        })
    },
after:function(){
    return this.domManip(arguments,function(n){
        this.parentNode&&this.parentNode.insertBefore(n,this.nextSibling)
        })
    },
remove:function(n,t){
    for(var r,e=n?i.filter(n,this):this,f=0;(r=e[f])!=null;f++)t||r.nodeType!==1||i.cleanData(u(r)),r.parentNode&&(t&&i.contains(r.ownerDocument,r)&&hi(u(r,"script")),r.parentNode.removeChild(r));
    return this
    },
empty:function(){
    for(var n,t=0;(n=this[t])!=null;t++){
        for(n.nodeType===1&&i.cleanData(u(n,!1));n.firstChild;)n.removeChild(n.firstChild);
        n.options&&i.nodeName(n,"select")&&(n.options.length=0)
        }
        return this
    },
clone:function(n,t){
    return n=n==null?!1:n,t=t==null?n:t,this.map(function(){
        return i.clone(this,n,t)
        })
    },
html:function(n){
    return i.access(this,function(n){
        var r=this[0]||{},f=0,o=this.length;
        if(n===t)return r.nodeType===1?r.innerHTML.replace(ce,""):t;
        if(typeof n=="string"&&!ae.test(n)&&(i.support.htmlSerialize||!pr.test(n))&&(i.support.leadingWhitespace||!ei.test(n))&&!e[(br.exec(n)||["",""])[1].toLowerCase()]){
            n=n.replace(wr,"<$1><\/$2>");
            try{
                for(;f<o;f++)r=this[f]||{},r.nodeType===1&&(i.cleanData(u(r,!1)),r.innerHTML=n);
                r=0
                }catch(s){}
        }
        r&&this.empty().append(n)
        },null,n,arguments.length)
},
replaceWith:function(){
    var t=i.map(this,function(n){
        return[n.nextSibling,n.parentNode]
        }),n=0;
    return this.domManip(arguments,function(r){
        var u=t[n++],f=t[n++];
        f&&(u&&u.parentNode!==f&&(u=this.nextSibling),i(this).remove(),f.insertBefore(r,u))
        },!0),n?this:this.remove()
    },
detach:function(n){
    return this.remove(n,!0)
    },
domManip:function(n,t,r){
    n=di.apply([],n);
    var h,f,c,o,v,s,e=0,l=this.length,p=this,w=l-1,a=n[0],y=i.isFunction(a);
    if(y||!(l<=1||typeof a!="string"||i.support.checkClone||!ve.test(a)))return this.each(function(i){
        var u=p.eq(i);
        y&&(n[0]=a.call(this,i,u.html()));
        u.domManip(n,t,r)
        });
    if(l&&(s=i.buildFragment(n,this[0].ownerDocument,!1,!r&&this),h=s.firstChild,s.childNodes.length===1&&(s=h),h)){
        for(o=i.map(u(s,"script"),nu),c=o.length;e<l;e++)f=s,e!==w&&(f=i.clone(f,!0,!0),c&&i.merge(o,u(f,"script"))),t.call(this[e],f,e);
        if(c)for(v=o[o.length-1].ownerDocument,i.map(o,tu),e=0;e<c;e++)f=o[e],dr.test(f.type||"")&&!i._data(f,"globalEval")&&i.contains(v,f)&&(f.src?i._evalUrl(f.src):i.globalEval((f.text||f.textContent||f.innerHTML||"").replace(pe,"")));
        s=h=null
        }
        return this
    }
});
i.each({
    appendTo:"append",
    prependTo:"prepend",
    insertBefore:"before",
    insertAfter:"after",
    replaceAll:"replaceWith"
},function(n,t){
    i.fn[n]=function(n){
        for(var u,r=0,f=[],e=i(n),o=e.length-1;r<=o;r++)u=r===o?this:this.clone(!0),i(e[r])[t](u),kt.apply(f,u.get());
        return this.pushStack(f)
        }
    });
i.extend({
    clone:function(n,t,r){
        var f,h,o,e,s,c=i.contains(n.ownerDocument,n);
        if(i.support.html5Clone||i.isXMLDoc(n)||!pr.test("<"+n.nodeName+">")?o=n.cloneNode(!0):(si.innerHTML=n.outerHTML,si.removeChild(o=si.firstChild)),(!i.support.noCloneEvent||!i.support.noCloneChecked)&&(n.nodeType===1||n.nodeType===11)&&!i.isXMLDoc(n))for(f=u(o),s=u(n),e=0;(h=s[e])!=null;++e)f[e]&&be(h,f[e]);
        if(t)if(r)for(s=s||u(n),f=f||u(o),e=0;(h=s[e])!=null;e++)iu(h,f[e]);else iu(n,o);
        return f=u(o,"script"),f.length>0&&hi(f,!c&&u(n,"script")),f=s=h=null,o
        },
    buildFragment:function(n,t,r,f){
        for(var h,o,w,s,y,p,l,b=n.length,a=vr(t),c=[],v=0;v<b;v++)if(o=n[v],o||o===0)if(i.type(o)==="object")i.merge(c,o.nodeType?[o]:o);
            else if(le.test(o)){
            for(s=s||a.appendChild(t.createElement("div")),y=(br.exec(o)||["",""])[1].toLowerCase(),l=e[y]||e._default,s.innerHTML=l[1]+o.replace(wr,"<$1><\/$2>")+l[2],h=l[0];h--;)s=s.lastChild;
            if(!i.support.leadingWhitespace&&ei.test(o)&&c.push(t.createTextNode(ei.exec(o)[0])),!i.support.tbody)for(o=y==="table"&&!kr.test(o)?s.firstChild:l[1]==="<table>"&&!kr.test(o)?s:0,h=o&&o.childNodes.length;h--;)i.nodeName(p=o.childNodes[h],"tbody")&&!p.childNodes.length&&o.removeChild(p);
            for(i.merge(c,s.childNodes),s.textContent="";s.firstChild;)s.removeChild(s.firstChild);
            s=a.lastChild
            }else c.push(t.createTextNode(o));for(s&&a.removeChild(s),i.support.appendChecked||i.grep(u(c,"input"),ke),v=0;o=c[v++];)if((!f||i.inArray(o,f)===-1)&&(w=i.contains(o.ownerDocument,o),s=u(a.appendChild(o),"script"),w&&hi(s),r))for(h=0;o=s[h++];)dr.test(o.type||"")&&r.push(o);return s=null,a
        },
    cleanData:function(n,t){
        for(var r,e,u,f,c=0,s=i.expando,h=i.cache,l=i.support.deleteExpando,a=i.event.special;(r=n[c])!=null;c++)if((t||i.acceptData(r))&&(u=r[s],f=u&&h[u],f)){
            if(f.events)for(e in f.events)a[e]?i.event.remove(r,e):i.removeEvent(r,e,f.handle);h[u]&&(delete h[u],l?delete r[s]:typeof r.removeAttribute!==o?r.removeAttribute(s):r[s]=null,b.push(u))
            }
        },
_evalUrl:function(n){
    return i.ajax({
        url:n,
        type:"GET",
        dataType:"script",
        async:!1,
        global:!1,
        throws:!0
        })
    }
});
i.fn.extend({
    wrapAll:function(n){
        if(i.isFunction(n))return this.each(function(t){
            i(this).wrapAll(n.call(this,t))
            });
        if(this[0]){
            var t=i(n,this[0].ownerDocument).eq(0).clone(!0);
            this[0].parentNode&&t.insertBefore(this[0]);
            t.map(function(){
                for(var n=this;n.firstChild&&n.firstChild.nodeType===1;)n=n.firstChild;
                return n
                }).append(this)
            }
            return this
        },
    wrapInner:function(n){
        return i.isFunction(n)?this.each(function(t){
            i(this).wrapInner(n.call(this,t))
            }):this.each(function(){
            var t=i(this),r=t.contents();
            r.length?r.wrapAll(n):t.append(n)
            })
        },
    wrap:function(n){
        var t=i.isFunction(n);
        return this.each(function(r){
            i(this).wrapAll(t?n.call(this,r):n)
            })
        },
    unwrap:function(){
        return this.parent().each(function(){
            i.nodeName(this,"body")||i(this).replaceWith(this.childNodes)
            }).end()
        }
    });
var rt,v,y,ci=/alpha\([^)]*\)/i,de=/opacity\s*=\s*([^)]*)/,ge=/^(top|right|bottom|left)$/,no=/^(none|table(?!-c[ea]).+)/,ru=/^margin/,to=new RegExp("^("+st+")(.*)$","i"),lt=new RegExp("^("+st+")(?!px)[a-z%]+$","i"),io=new RegExp("^([+-])=("+st+")","i"),uu={
    BODY:"block"
},ro={
    position:"absolute",
    visibility:"hidden",
    display:"block"
},fu={
    letterSpacing:0,
    fontWeight:400
},p=["Top","Right","Bottom","Left"],eu=["Webkit","O","Moz","ms"];
i.fn.extend({
    css:function(n,r){
        return i.access(this,function(n,r,u){
            var e,o,s={},f=0;
            if(i.isArray(r)){
                for(o=v(n),e=r.length;f<e;f++)s[r[f]]=i.css(n,r[f],!1,o);
                return s
                }
                return u!==t?i.style(n,r,u):i.css(n,r)
            },n,r,arguments.length>1)
        },
    show:function(){
        return su(this,!0)
        },
    hide:function(){
        return su(this)
        },
    toggle:function(n){
        return typeof n=="boolean"?n?this.show():this.hide():this.each(function(){
            ut(this)?i(this).show():i(this).hide()
            })
        }
    });
i.extend({
    cssHooks:{
        opacity:{
            get:function(n,t){
                if(t){
                    var i=y(n,"opacity");
                    return i===""?"1":i
                    }
                }
        }
},
cssNumber:{
    columnCount:!0,
    fillOpacity:!0,
    fontWeight:!0,
    lineHeight:!0,
    opacity:!0,
    order:!0,
    orphans:!0,
    widows:!0,
    zIndex:!0,
    zoom:!0
    },
cssProps:{
    float:i.support.cssFloat?"cssFloat":"styleFloat"
    },
style:function(n,r,u,f){
    if(n&&n.nodeType!==3&&n.nodeType!==8&&n.style){
        var o,s,e,h=i.camelCase(r),c=n.style;
        if(r=i.cssProps[h]||(i.cssProps[h]=ou(c,h)),e=i.cssHooks[r]||i.cssHooks[h],u!==t){
            if(s=typeof u,s==="string"&&(o=io.exec(u))&&(u=(o[1]+1)*o[2]+parseFloat(i.css(n,r)),s="number"),u==null||s==="number"&&isNaN(u))return;
            if(s!=="number"||i.cssNumber[h]||(u+="px"),i.support.clearCloneStyle||u!==""||r.indexOf("background")!==0||(c[r]="inherit"),!e||!("set"in e)||(u=e.set(n,u,f))!==t)try{
                c[r]=u
                }catch(l){}
            }else return e&&"get"in e&&(o=e.get(n,!1,f))!==t?o:c[r]
        }
    },
css:function(n,r,u,f){
    var h,e,o,s=i.camelCase(r);
    return(r=i.cssProps[s]||(i.cssProps[s]=ou(n.style,s)),o=i.cssHooks[r]||i.cssHooks[s],o&&"get"in o&&(e=o.get(n,!0,u)),e===t&&(e=y(n,r,f)),e==="normal"&&r in fu&&(e=fu[r]),u===""||u)?(h=parseFloat(e),u===!0||i.isNumeric(h)?h||0:e):e
    }
});
n.getComputedStyle?(v=function(t){
    return n.getComputedStyle(t,null)
    },y=function(n,r,u){
    var s,h,c,o=u||v(n),e=o?o.getPropertyValue(r)||o[r]:t,f=n.style;
    return o&&(e!==""||i.contains(n.ownerDocument,n)||(e=i.style(n,r)),lt.test(e)&&ru.test(r)&&(s=f.width,h=f.minWidth,c=f.maxWidth,f.minWidth=f.maxWidth=f.width=e,e=o.width,f.width=s,f.minWidth=h,f.maxWidth=c)),e
    }):r.documentElement.currentStyle&&(v=function(n){
    return n.currentStyle
    },y=function(n,i,r){
    var s,e,o,h=r||v(n),u=h?h[i]:t,f=n.style;
    return u==null&&f&&f[i]&&(u=f[i]),lt.test(u)&&!ge.test(i)&&(s=f.left,e=n.runtimeStyle,o=e&&e.left,o&&(e.left=n.currentStyle.left),f.left=i==="fontSize"?"1em":u,u=f.pixelLeft+"px",f.left=s,o&&(e.left=o)),u===""?"auto":u
    });
i.each(["height","width"],function(n,t){
    i.cssHooks[t]={
        get:function(n,r,u){
            if(r)return n.offsetWidth===0&&no.test(i.css(n,"display"))?i.swap(n,ro,function(){
                return lu(n,t,u)
                }):lu(n,t,u)
                },
        set:function(n,r,u){
            var f=u&&v(n);
            return hu(n,r,u?cu(n,t,u,i.support.boxSizing&&i.css(n,"boxSizing",!1,f)==="border-box",f):0)
            }
        }
});
i.support.opacity||(i.cssHooks.opacity={
    get:function(n,t){
        return de.test((t&&n.currentStyle?n.currentStyle.filter:n.style.filter)||"")?.01*parseFloat(RegExp.$1)+"":t?"1":""
        },
    set:function(n,t){
        var r=n.style,u=n.currentStyle,e=i.isNumeric(t)?"alpha(opacity="+t*100+")":"",f=u&&u.filter||r.filter||"";
        (r.zoom=1,(t>=1||t==="")&&i.trim(f.replace(ci,""))===""&&r.removeAttribute&&(r.removeAttribute("filter"),t===""||u&&!u.filter))||(r.filter=ci.test(f)?f.replace(ci,e):f+" "+e)
        }
    });
i(function(){
    i.support.reliableMarginRight||(i.cssHooks.marginRight={
        get:function(n,t){
            if(t)return i.swap(n,{
                display:"inline-block"
            },y,[n,"marginRight"])
            }
            });
!i.support.pixelPosition&&i.fn.position&&i.each(["top","left"],function(n,t){
    i.cssHooks[t]={
        get:function(n,r){
            if(r)return r=y(n,t),lt.test(r)?i(n).position()[t]+"px":r
                }
            }
})
});
i.expr&&i.expr.filters&&(i.expr.filters.hidden=function(n){
    return n.offsetWidth<=0&&n.offsetHeight<=0||!i.support.reliableHiddenOffsets&&(n.style&&n.style.display||i.css(n,"display"))==="none"
    },i.expr.filters.visible=function(n){
    return!i.expr.filters.hidden(n)
    });
i.each({
    margin:"",
    padding:"",
    border:"Width"
},function(n,t){
    i.cssHooks[n+t]={
        expand:function(i){
            for(var r=0,f={},u=typeof i=="string"?i.split(" "):[i];r<4;r++)f[n+p[r]+t]=u[r]||u[r-2]||u[0];
            return f
            }
        };
    
ru.test(n)||(i.cssHooks[n+t].set=hu)
    });
var uo=/%20/g,fo=/\[\]$/,yu=/\r?\n/g,eo=/^(?:submit|button|image|reset|file)$/i,oo=/^(?:input|select|textarea|keygen)/i;
i.fn.extend({
    serialize:function(){
        return i.param(this.serializeArray())
        },
    serializeArray:function(){
        return this.map(function(){
            var n=i.prop(this,"elements");
            return n?i.makeArray(n):this
            }).filter(function(){
            var n=this.type;
            return this.name&&!i(this).is(":disabled")&&oo.test(this.nodeName)&&!eo.test(n)&&(this.checked||!oi.test(n))
            }).map(function(n,t){
            var r=i(this).val();
            return r==null?null:i.isArray(r)?i.map(r,function(n){
                return{
                    name:t.name,
                    value:n.replace(yu,"\r\n")
                    }
                }):{
            name:t.name,
            value:r.replace(yu,"\r\n")
            }
        }).get()
    }
});
i.param=function(n,r){
    var u,f=[],e=function(n,t){
        t=i.isFunction(t)?t():t==null?"":t;
        f[f.length]=encodeURIComponent(n)+"="+encodeURIComponent(t)
        };
        
    if(r===t&&(r=i.ajaxSettings&&i.ajaxSettings.traditional),i.isArray(n)||n.jquery&&!i.isPlainObject(n))i.each(n,function(){
        e(this.name,this.value)
        });else for(u in n)li(u,n[u],r,e);return f.join("&").replace(uo,"+")
    };
    
i.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(n,t){
    i.fn[t]=function(n,i){
        return arguments.length>0?this.on(t,null,n,i):this.trigger(t)
        }
    });
i.fn.extend({
    hover:function(n,t){
        return this.mouseenter(n).mouseleave(t||n)
        },
    bind:function(n,t,i){
        return this.on(n,null,t,i)
        },
    unbind:function(n,t){
        return this.off(n,null,t)
        },
    delegate:function(n,t,i,r){
        return this.on(t,n,i,r)
        },
    undelegate:function(n,t,i){
        return arguments.length===1?this.off(n,"**"):this.off(t,n||"**",i)
        }
    });
var w,c,ai=i.now(),vi=/\?/,so=/#.*$/,pu=/([?&])_=[^&]*/,ho=/^(.*?):[ \t]*([^\r\n]*)\r?$/mg,co=/^(?:GET|HEAD)$/,lo=/^\/\//,wu=/^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,bu=i.fn.load,ku={},yi={},du="*/".concat("*");
try{
    c=hf.href
    }catch(go){
    c=r.createElement("a");
    c.href="";
    c=c.href
    }
    w=wu.exec(c.toLowerCase())||[];
i.fn.load=function(n,r,u){
    if(typeof n!="string"&&bu)return bu.apply(this,arguments);
    var f,s,h,e=this,o=n.indexOf(" ");
    return o>=0&&(f=n.slice(o,n.length),n=n.slice(0,o)),i.isFunction(r)?(u=r,r=t):r&&typeof r=="object"&&(h="POST"),e.length>0&&i.ajax({
        url:n,
        type:h,
        dataType:"html",
        data:r
    }).done(function(n){
        s=arguments;
        e.html(f?i("<div>").append(i.parseHTML(n)).find(f):n)
        }).complete(u&&function(n,t){
        e.each(u,s||[n.responseText,t,n])
        }),this
    };
    
i.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(n,t){
    i.fn[t]=function(n){
        return this.on(t,n)
        }
    });
i.extend({
    active:0,
    lastModified:{},
    etag:{},
    ajaxSettings:{
        url:c,
        type:"GET",
        isLocal:/^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(w[1]),
        global:!0,
        processData:!0,
        async:!0,
        contentType:"application/x-www-form-urlencoded; charset=UTF-8",
        accepts:{
            "*":du,
            text:"text/plain",
            html:"text/html",
            xml:"application/xml, text/xml",
            json:"application/json, text/javascript"
        },
        contents:{
            xml:/xml/,
            html:/html/,
            json:/json/
        },
        responseFields:{
            xml:"responseXML",
            text:"responseText",
            json:"responseJSON"
        },
        converters:{
            "* text":String,
            "text html":!0,
            "text json":i.parseJSON,
            "text xml":i.parseXML
            },
        flatOptions:{
            url:!0,
            context:!0
            }
        },
ajaxSetup:function(n,t){
    return t?pi(pi(n,i.ajaxSettings),t):pi(i.ajaxSettings,n)
    },
ajaxPrefilter:gu(ku),
    ajaxTransport:gu(yi),
    ajax:function(n,r){
    function k(n,r,s,c){
        var a,rt,k,p,w,l=r;
        o!==2&&(o=2,g&&clearTimeout(g),v=t,d=c||"",f.readyState=n>0?4:0,a=n>=200&&n<300||n===304,s&&(p=ao(u,f,s)),p=vo(u,p,f,a),a?(u.ifModified&&(w=f.getResponseHeader("Last-Modified"),w&&(i.lastModified[e]=w),w=f.getResponseHeader("etag"),w&&(i.etag[e]=w)),n===204||u.type==="HEAD"?l="nocontent":n===304?l="notmodified":(l=p.state,rt=p.data,k=p.error,a=!k)):(k=l,(n||!l)&&(l="error",n<0&&(n=0))),f.status=n,f.statusText=(r||l)+"",a?tt.resolveWith(h,[rt,l,f]):tt.rejectWith(h,[f,l,k]),f.statusCode(b),b=t,y&&nt.trigger(a?"ajaxSuccess":"ajaxError",[f,u,a?rt:k]),it.fireWith(h,[f,l]),y&&(nt.trigger("ajaxComplete",[f,u]),--i.active||i.event.trigger("ajaxStop")))
        }
        typeof n=="object"&&(r=n,n=t);
    r=r||{};
    
    var l,a,e,d,g,y,v,p,u=i.ajaxSetup({},r),h=u.context||u,nt=u.context&&(h.nodeType||h.jquery)?i(h):i.event,tt=i.Deferred(),it=i.Callbacks("once memory"),b=u.statusCode||{},rt={},ut={},o=0,ft="canceled",f={
        readyState:0,
        getResponseHeader:function(n){
            var t;
            if(o===2){
                if(!p)for(p={};
                    t=ho.exec(d);)p[t[1].toLowerCase()]=t[2];
                t=p[n.toLowerCase()]
                }
                return t==null?null:t
            },
        getAllResponseHeaders:function(){
            return o===2?d:null
            },
        setRequestHeader:function(n,t){
            var i=n.toLowerCase();
            return o||(n=ut[i]=ut[i]||n,rt[n]=t),this
            },
        overrideMimeType:function(n){
            return o||(u.mimeType=n),this
            },
        statusCode:function(n){
            var t;
            if(n)if(o<2)for(t in n)b[t]=[b[t],n[t]];else f.always(n[f.status]);
            return this
            },
        abort:function(n){
            var t=n||ft;
            return v&&v.abort(t),k(0,t),this
            }
        };
    
if(tt.promise(f).complete=it.add,f.success=f.done,f.error=f.fail,u.url=((n||u.url||c)+"").replace(so,"").replace(lo,w[1]+"//"),u.type=r.method||r.type||u.method||u.type,u.dataTypes=i.trim(u.dataType||"*").toLowerCase().match(s)||[""],u.crossDomain==null&&(l=wu.exec(u.url.toLowerCase()),u.crossDomain=!!(l&&(l[1]!==w[1]||l[2]!==w[2]||(l[3]||(l[1]==="http:"?"80":"443"))!==(w[3]||(w[1]==="http:"?"80":"443"))))),u.data&&u.processData&&typeof u.data!="string"&&(u.data=i.param(u.data,u.traditional)),nf(ku,u,r,f),o===2)return f;
    y=u.global;
    y&&i.active++==0&&i.event.trigger("ajaxStart");
    u.type=u.type.toUpperCase();
    u.hasContent=!co.test(u.type);
    e=u.url;
    u.hasContent||(u.data&&(e=u.url+=(vi.test(e)?"&":"?")+u.data,delete u.data),u.cache===!1&&(u.url=pu.test(e)?e.replace(pu,"$1_="+ai++):e+(vi.test(e)?"&":"?")+"_="+ai++));
    u.ifModified&&(i.lastModified[e]&&f.setRequestHeader("If-Modified-Since",i.lastModified[e]),i.etag[e]&&f.setRequestHeader("If-None-Match",i.etag[e]));
    (u.data&&u.hasContent&&u.contentType!==!1||r.contentType)&&f.setRequestHeader("Content-Type",u.contentType);
    f.setRequestHeader("Accept",u.dataTypes[0]&&u.accepts[u.dataTypes[0]]?u.accepts[u.dataTypes[0]]+(u.dataTypes[0]!=="*"?", "+du+"; q=0.01":""):u.accepts["*"]);
    for(a in u.headers)f.setRequestHeader(a,u.headers[a]);if(u.beforeSend&&(u.beforeSend.call(h,f,u)===!1||o===2))return f.abort();
    ft="abort";
    for(a in{
    success:1,
    error:1,
    complete:1
})f[a](u[a]);if(v=nf(yi,u,r,f),v){
    f.readyState=1;
    y&&nt.trigger("ajaxSend",[f,u]);
    u.async&&u.timeout>0&&(g=setTimeout(function(){
        f.abort("timeout")
        },u.timeout));
    try{
        o=1;
        v.send(rt,k)
        }catch(et){
        if(o<2)k(-1,et);else throw et;
    }
}else k(-1,"No Transport");
return f
},
getJSON:function(n,t,r){
    return i.get(n,t,r,"json")
    },
getScript:function(n,r){
    return i.get(n,t,r,"script")
    }
});
i.each(["get","post"],function(n,r){
    i[r]=function(n,u,f,e){
        return i.isFunction(u)&&(e=e||f,f=u,u=t),i.ajax({
            url:n,
            type:r,
            dataType:e,
            data:u,
            success:f
        })
        }
    });
i.ajaxSetup({
    accepts:{
        script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
    },
    contents:{
        script:/(?:java|ecma)script/
    },
    converters:{
        "text script":function(n){
            return i.globalEval(n),n
            }
        }
});
i.ajaxPrefilter("script",function(n){
    n.cache===t&&(n.cache=!1);
    n.crossDomain&&(n.type="GET",n.global=!1)
    });
i.ajaxTransport("script",function(n){
    if(n.crossDomain){
        var u,f=r.head||i("head")[0]||r.documentElement;
        return{
            send:function(t,i){
                u=r.createElement("script");
                u.async=!0;
                n.scriptCharset&&(u.charset=n.scriptCharset);
                u.src=n.url;
                u.onload=u.onreadystatechange=function(n,t){
                    (t||!u.readyState||/loaded|complete/.test(u.readyState))&&(u.onload=u.onreadystatechange=null,u.parentNode&&u.parentNode.removeChild(u),u=null,t||i(200,"success"))
                    };
                    
                f.insertBefore(u,f.firstChild)
                },
            abort:function(){
                if(u)u.onload(t,!0)
                    }
                }
    }
});
wi=[];
at=/(=)\?(?=&|$)|\?\?/;
i.ajaxSetup({
    jsonp:"callback",
    jsonpCallback:function(){
        var n=wi.pop()||i.expando+"_"+ai++;
        return this[n]=!0,n
        }
    });
i.ajaxPrefilter("json jsonp",function(r,u,f){
    var e,s,o,h=r.jsonp!==!1&&(at.test(r.url)?"url":typeof r.data=="string"&&!(r.contentType||"").indexOf("application/x-www-form-urlencoded")&&at.test(r.data)&&"data");
    if(h||r.dataTypes[0]==="jsonp")return e=r.jsonpCallback=i.isFunction(r.jsonpCallback)?r.jsonpCallback():r.jsonpCallback,h?r[h]=r[h].replace(at,"$1"+e):r.jsonp!==!1&&(r.url+=(vi.test(r.url)?"&":"?")+r.jsonp+"="+e),r.converters["script json"]=function(){
        return o||i.error(e+" was not called"),o[0]
        },r.dataTypes[0]="json",s=n[e],n[e]=function(){
        o=arguments
        },f.always(function(){
        n[e]=s;
        r[e]&&(r.jsonpCallback=u.jsonpCallback,wi.push(e));
        o&&i.isFunction(s)&&s(o[0]);
        o=s=t
        }),"script"
    });
tf=0;
vt=n.ActiveXObject&&function(){
    for(var n in nt)nt[n](t,!0)
        };
        
i.ajaxSettings.xhr=n.ActiveXObject?function(){
    return!this.isLocal&&rf()||yo()
    }:rf;
tt=i.ajaxSettings.xhr();
i.support.cors=!!tt&&"withCredentials"in tt;
tt=i.support.ajax=!!tt;
tt&&i.ajaxTransport(function(r){
    if(!r.crossDomain||i.support.cors){
        var u;
        return{
            send:function(f,e){
                var h,s,o=r.xhr();
                if(r.username?o.open(r.type,r.url,r.async,r.username,r.password):o.open(r.type,r.url,r.async),r.xhrFields)for(s in r.xhrFields)o[s]=r.xhrFields[s];r.mimeType&&o.overrideMimeType&&o.overrideMimeType(r.mimeType);
                r.crossDomain||f["X-Requested-With"]||(f["X-Requested-With"]="XMLHttpRequest");
                try{
                    for(s in f)o.setRequestHeader(s,f[s])
                        }catch(c){}
                o.send(r.hasContent&&r.data||null);
                u=function(n,f){
                    var s,a,l,c;
                    try{
                        if(u&&(f||o.readyState===4))if(u=t,h&&(o.onreadystatechange=i.noop,vt&&delete nt[h]),f)o.readyState!==4&&o.abort();
                            else{
                            c={};
                            
                            s=o.status;
                            a=o.getAllResponseHeaders();
                            typeof o.responseText=="string"&&(c.text=o.responseText);
                            try{
                                l=o.statusText
                                }catch(y){
                                l=""
                                }
                                s||!r.isLocal||r.crossDomain?s===1223&&(s=204):s=c.text?200:404
                            }
                        }catch(v){
                    f||e(-1,v)
                    }
                    c&&e(s,l,c,a)
                };
                
            r.async?o.readyState===4?setTimeout(u):(h=++tf,vt&&(nt||(nt={},i(n).unload(vt)),nt[h]=u),o.onreadystatechange=u):u()
            },
        abort:function(){
            u&&u(t,!0)
            }
        }
}
});
var it,yt,po=/^(?:toggle|show|hide)$/,uf=new RegExp("^(?:([+-])=|)("+st+")([a-z%]*)$","i"),wo=/queueHooks$/,pt=[ko],ft={
    "*":[function(n,t){
        var f=this.createTween(n,t),s=f.cur(),u=uf.exec(t),e=u&&u[3]||(i.cssNumber[n]?"":"px"),r=(i.cssNumber[n]||e!=="px"&&+s)&&uf.exec(i.css(f.elem,n)),o=1,h=20;
        if(r&&r[3]!==e){
            e=e||r[3];
            u=u||[];
            r=+s||1;
            do o=o||".5",r=r/o,i.style(f.elem,n,r+e);while(o!==(o=f.cur()/s)&&o!==1&&--h)
        }
        return u&&(r=f.start=+r||+s||0,f.unit=e,f.end=u[1]?r+(u[1]+1)*u[2]:+u[2]),f
        }]
    };
    
i.Animation=i.extend(of,{
    tweener:function(n,t){
        i.isFunction(n)?(t=n,n=["*"]):n=n.split(" ");
        for(var r,u=0,f=n.length;u<f;u++)r=n[u],ft[r]=ft[r]||[],ft[r].unshift(t)
            },
    prefilter:function(n,t){
        t?pt.unshift(n):pt.push(n)
        }
    });
i.Tween=f;
f.prototype={
    constructor:f,
    init:function(n,t,r,u,f,e){
        this.elem=n;
        this.prop=r;
        this.easing=f||"swing";
        this.options=t;
        this.start=this.now=this.cur();
        this.end=u;
        this.unit=e||(i.cssNumber[r]?"":"px")
        },
    cur:function(){
        var n=f.propHooks[this.prop];
        return n&&n.get?n.get(this):f.propHooks._default.get(this)
        },
    run:function(n){
        var t,r=f.propHooks[this.prop];
        return this.pos=this.options.duration?t=i.easing[this.easing](n,this.options.duration*n,0,1,this.options.duration):t=n,this.now=(this.end-this.start)*t+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),r&&r.set?r.set(this):f.propHooks._default.set(this),this
        }
    };

f.prototype.init.prototype=f.prototype;
f.propHooks={
    _default:{
        get:function(n){
            var t;
            return n.elem[n.prop]!=null&&(!n.elem.style||n.elem.style[n.prop]==null)?n.elem[n.prop]:(t=i.css(n.elem,n.prop,""),!t||t==="auto"?0:t)
            },
        set:function(n){
            i.fx.step[n.prop]?i.fx.step[n.prop](n):n.elem.style&&(n.elem.style[i.cssProps[n.prop]]!=null||i.cssHooks[n.prop])?i.style(n.elem,n.prop,n.now+n.unit):n.elem[n.prop]=n.now
            }
        }
};

f.propHooks.scrollTop=f.propHooks.scrollLeft={
    set:function(n){
        n.elem.nodeType&&n.elem.parentNode&&(n.elem[n.prop]=n.now)
        }
    };

i.each(["toggle","show","hide"],function(n,t){
    var r=i.fn[t];
    i.fn[t]=function(n,i,u){
        return n==null||typeof n=="boolean"?r.apply(this,arguments):this.animate(wt(t,!0),n,i,u)
        }
    });
i.fn.extend({
    fadeTo:function(n,t,i,r){
        return this.filter(ut).css("opacity",0).show().end().animate({
            opacity:t
        },n,i,r)
        },
    animate:function(n,t,r,u){
        var o=i.isEmptyObject(n),e=i.speed(t,r,u),f=function(){
            var t=of(this,i.extend({},n),e);
            (o||i._data(this,"finish"))&&t.stop(!0)
            };
            
        return f.finish=f,o||e.queue===!1?this.each(f):this.queue(e.queue,f)
        },
    stop:function(n,r,u){
        var f=function(n){
            var t=n.stop;
            delete n.stop;
            t(u)
            };
            
        return typeof n!="string"&&(u=r,r=n,n=t),r&&n!==!1&&this.queue(n||"fx",[]),this.each(function(){
            var o=!0,t=n!=null&&n+"queueHooks",e=i.timers,r=i._data(this);
            if(t)r[t]&&r[t].stop&&f(r[t]);else for(t in r)r[t]&&r[t].stop&&wo.test(t)&&f(r[t]);for(t=e.length;t--;)e[t].elem===this&&(n==null||e[t].queue===n)&&(e[t].anim.stop(u),o=!1,e.splice(t,1));
            (o||!u)&&i.dequeue(this,n)
            })
        },
    finish:function(n){
        return n!==!1&&(n=n||"fx"),this.each(function(){
            var t,f=i._data(this),r=f[n+"queue"],e=f[n+"queueHooks"],u=i.timers,o=r?r.length:0;
            for(f.finish=!0,i.queue(this,n,[]),e&&e.stop&&e.stop.call(this,!0),t=u.length;t--;)u[t].elem===this&&u[t].queue===n&&(u[t].anim.stop(!0),u.splice(t,1));
            for(t=0;t<o;t++)r[t]&&r[t].finish&&r[t].finish.call(this);
            delete f.finish
            })
        }
    });
i.each({
    slideDown:wt("show"),
    slideUp:wt("hide"),
    slideToggle:wt("toggle"),
    fadeIn:{
        opacity:"show"
    },
    fadeOut:{
        opacity:"hide"
    },
    fadeToggle:{
        opacity:"toggle"
    }
},function(n,t){
    i.fn[n]=function(n,i,r){
        return this.animate(t,n,i,r)
        }
    });
i.speed=function(n,t,r){
    var u=n&&typeof n=="object"?i.extend({},n):{
        complete:r||!r&&t||i.isFunction(n)&&n,
        duration:n,
        easing:r&&t||t&&!i.isFunction(t)&&t
        };
        
    return u.duration=i.fx.off?0:typeof u.duration=="number"?u.duration:u.duration in i.fx.speeds?i.fx.speeds[u.duration]:i.fx.speeds._default,(u.queue==null||u.queue===!0)&&(u.queue="fx"),u.old=u.complete,u.complete=function(){
        i.isFunction(u.old)&&u.old.call(this);
        u.queue&&i.dequeue(this,u.queue)
        },u
    };
    
i.easing={
    linear:function(n){
        return n
        },
    swing:function(n){
        return.5-Math.cos(n*Math.PI)/2
        }
    };

i.timers=[];
i.fx=f.prototype.init;
i.fx.tick=function(){
    var u,n=i.timers,r=0;
    for(it=i.now();r<n.length;r++)u=n[r],u()||n[r]!==u||n.splice(r--,1);
    n.length||i.fx.stop();
    it=t
    };
    
i.fx.timer=function(n){
    n()&&i.timers.push(n)&&i.fx.start()
    };
    
i.fx.interval=13;
i.fx.start=function(){
    yt||(yt=setInterval(i.fx.tick,i.fx.interval))
    };
    
i.fx.stop=function(){
    clearInterval(yt);
    yt=null
    };
    
i.fx.speeds={
    slow:600,
    fast:200,
    _default:400
};

i.fx.step={};

i.expr&&i.expr.filters&&(i.expr.filters.animated=function(n){
    return i.grep(i.timers,function(t){
        return n===t.elem
        }).length
    });
i.fn.offset=function(n){
    if(arguments.length)return n===t?this:this.each(function(t){
        i.offset.setOffset(this,n,t)
        });
    var r,e,f={
        top:0,
        left:0
    },u=this[0],s=u&&u.ownerDocument;
    if(s)return(r=s.documentElement,!i.contains(r,u))?f:(typeof u.getBoundingClientRect!==o&&(f=u.getBoundingClientRect()),e=sf(s),{
        top:f.top+(e.pageYOffset||r.scrollTop)-(r.clientTop||0),
        left:f.left+(e.pageXOffset||r.scrollLeft)-(r.clientLeft||0)
        })
    };
    
i.offset={
    setOffset:function(n,t,r){
        var f=i.css(n,"position");
        f==="static"&&(n.style.position="relative");
        var e=i(n),o=e.offset(),l=i.css(n,"top"),a=i.css(n,"left"),v=(f==="absolute"||f==="fixed")&&i.inArray("auto",[l,a])>-1,u={},s={},h,c;
        v?(s=e.position(),h=s.top,c=s.left):(h=parseFloat(l)||0,c=parseFloat(a)||0);
        i.isFunction(t)&&(t=t.call(n,r,o));
        t.top!=null&&(u.top=t.top-o.top+h);
        t.left!=null&&(u.left=t.left-o.left+c);
        "using"in t?t.using.call(n,u):e.css(u)
        }
    };

i.fn.extend({
    position:function(){
        if(this[0]){
            var n,r,t={
                top:0,
                left:0
            },u=this[0];
            return i.css(u,"position")==="fixed"?r=u.getBoundingClientRect():(n=this.offsetParent(),r=this.offset(),i.nodeName(n[0],"html")||(t=n.offset()),t.top+=i.css(n[0],"borderTopWidth",!0),t.left+=i.css(n[0],"borderLeftWidth",!0)),{
                top:r.top-t.top-i.css(u,"marginTop",!0),
                left:r.left-t.left-i.css(u,"marginLeft",!0)
                }
            }
    },
offsetParent:function(){
    return this.map(function(){
        for(var n=this.offsetParent||ki;n&&!i.nodeName(n,"html")&&i.css(n,"position")==="static";)n=n.offsetParent;
        return n||ki
        })
    }
});
i.each({
    scrollLeft:"pageXOffset",
    scrollTop:"pageYOffset"
},function(n,r){
    var u=/Y/.test(r);
    i.fn[n]=function(f){
        return i.access(this,function(n,f,e){
            var o=sf(n);
            if(e===t)return o?r in o?o[r]:o.document.documentElement[f]:n[f];
            o?o.scrollTo(u?i(o).scrollLeft():e,u?e:i(o).scrollTop()):n[f]=e
            },n,f,arguments.length,null)
        }
    });
i.each({
    Height:"height",
    Width:"width"
},function(n,r){
    i.each({
        padding:"inner"+n,
        content:r,
        "":"outer"+n
        },function(u,f){
        i.fn[f]=function(f,e){
            var o=arguments.length&&(u||typeof f!="boolean"),s=u||(f===!0||e===!0?"margin":"border");
            return i.access(this,function(r,u,f){
                var e;
                return i.isWindow(r)?r.document.documentElement["client"+n]:r.nodeType===9?(e=r.documentElement,Math.max(r.body["scroll"+n],e["scroll"+n],r.body["offset"+n],e["offset"+n],e["client"+n])):f===t?i.css(r,u,s):i.style(r,u,f,s)
                },r,o?f:t,o,null)
            }
        })
});
i.fn.size=function(){
    return this.length
    };
    
i.fn.andSelf=i.fn.addBack;
typeof module=="object"&&module&&typeof module.exports=="object"?module.exports=i:(n.jQuery=n.$=i,typeof define=="function"&&define.amd&&define("jquery",[],function(){
    return i
    }))
})(window),function(n,t){
    function i(t,i){
        var u,f,e,o=t.nodeName.toLowerCase();
        return"area"===o?(u=t.parentNode,f=u.name,!t.href||!f||u.nodeName.toLowerCase()!=="map")?!1:(e=n("img[usemap=#"+f+"]")[0],!!e&&r(e)):(/input|select|textarea|button|object/.test(o)?!t.disabled:"a"===o?t.href||i:i)&&r(t)
        }
        function r(t){
        return n.expr.filters.visible(t)&&!n(t).parents().addBack().filter(function(){
            return n.css(this,"visibility")==="hidden"
            }).length
        }
        var u=0,f=/^ui-id-\d+$/;
    n.ui=n.ui||{};
    
    n.extend(n.ui,{
        version:"1.10.4",
        keyCode:{
            BACKSPACE:8,
            COMMA:188,
            DELETE:46,
            DOWN:40,
            END:35,
            ENTER:13,
            ESCAPE:27,
            HOME:36,
            LEFT:37,
            NUMPAD_ADD:107,
            NUMPAD_DECIMAL:110,
            NUMPAD_DIVIDE:111,
            NUMPAD_ENTER:108,
            NUMPAD_MULTIPLY:106,
            NUMPAD_SUBTRACT:109,
            PAGE_DOWN:34,
            PAGE_UP:33,
            PERIOD:190,
            RIGHT:39,
            SPACE:32,
            TAB:9,
            UP:38
        }
    });
n.fn.extend({
    focus:function(t){
        return function(i,r){
            return typeof i=="number"?this.each(function(){
                var t=this;
                setTimeout(function(){
                    n(t).focus();
                    r&&r.call(t)
                    },i)
                }):t.apply(this,arguments)
            }
        }(n.fn.focus),
    scrollParent:function(){
    var t;
    return t=n.ui.ie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?this.parents().filter(function(){
        return/(relative|absolute|fixed)/.test(n.css(this,"position"))&&/(auto|scroll)/.test(n.css(this,"overflow")+n.css(this,"overflow-y")+n.css(this,"overflow-x"))
        }).eq(0):this.parents().filter(function(){
        return/(auto|scroll)/.test(n.css(this,"overflow")+n.css(this,"overflow-y")+n.css(this,"overflow-x"))
        }).eq(0),/fixed/.test(this.css("position"))||!t.length?n(document):t
    },
zIndex:function(i){
    if(i!==t)return this.css("zIndex",i);
    if(this.length)for(var r=n(this[0]),u,f;r.length&&r[0]!==document;){
        if(u=r.css("position"),(u==="absolute"||u==="relative"||u==="fixed")&&(f=parseInt(r.css("zIndex"),10),!isNaN(f)&&f!==0))return f;
        r=r.parent()
        }
        return 0
    },
uniqueId:function(){
    return this.each(function(){
        this.id||(this.id="ui-id-"+ ++u)
        })
    },
removeUniqueId:function(){
    return this.each(function(){
        f.test(this.id)&&n(this).removeAttr("id")
        })
    }
});
n.extend(n.expr[":"],{
    data:n.expr.createPseudo?n.expr.createPseudo(function(t){
        return function(i){
            return!!n.data(i,t)
            }
        }):function(t,i,r){
    return!!n.data(t,r[3])
    },
focusable:function(t){
    return i(t,!isNaN(n.attr(t,"tabindex")))
    },
tabbable:function(t){
    var r=n.attr(t,"tabindex"),u=isNaN(r);
    return(u||r>=0)&&i(t,!u)
    }
});
n("<a>").outerWidth(1).jquery||n.each(["Width","Height"],function(i,r){
    function e(t,i,r,u){
        return n.each(o,function(){
            i-=parseFloat(n.css(t,"padding"+this))||0;
            r&&(i-=parseFloat(n.css(t,"border"+this+"Width"))||0);
            u&&(i-=parseFloat(n.css(t,"margin"+this))||0)
            }),i
        }
        var o=r==="Width"?["Left","Right"]:["Top","Bottom"],u=r.toLowerCase(),f={
        innerWidth:n.fn.innerWidth,
        innerHeight:n.fn.innerHeight,
        outerWidth:n.fn.outerWidth,
        outerHeight:n.fn.outerHeight
        };
        
    n.fn["inner"+r]=function(i){
        return i===t?f["inner"+r].call(this):this.each(function(){
            n(this).css(u,e(this,i)+"px")
            })
        };
        
    n.fn["outer"+r]=function(t,i){
        return typeof t!="number"?f["outer"+r].call(this,t):this.each(function(){
            n(this).css(u,e(this,t,!0,i)+"px")
            })
        }
    });
n.fn.addBack||(n.fn.addBack=function(n){
    return this.add(n==null?this.prevObject:this.prevObject.filter(n))
    });
n("<a>").data("a-b","a").removeData("a-b").data("a-b")&&(n.fn.removeData=function(t){
    return function(i){
        return arguments.length?t.call(this,n.camelCase(i)):t.call(this)
        }
    }(n.fn.removeData));
n.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());
n.support.selectstart="onselectstart"in document.createElement("div");
n.fn.extend({
    disableSelection:function(){
        return this.bind((n.support.selectstart?"selectstart":"mousedown")+".ui-disableSelection",function(n){
            n.preventDefault()
            })
        },
    enableSelection:function(){
        return this.unbind(".ui-disableSelection")
        }
    });
n.extend(n.ui,{
    plugin:{
        add:function(t,i,r){
            var u,f=n.ui[t].prototype;
            for(u in r)f.plugins[u]=f.plugins[u]||[],f.plugins[u].push([i,r[u]])
                },
        call:function(n,t,i){
            var r,u=n.plugins[t];
            if(u&&n.element[0].parentNode&&n.element[0].parentNode.nodeType!==11)for(r=0;r<u.length;r++)n.options[u[r][0]]&&u[r][1].apply(n.element,i)
                }
            },
hasScroll:function(t,i){
    if(n(t).css("overflow")==="hidden")return!1;
    var r=i&&i==="left"?"scrollLeft":"scrollTop",u=!1;
    return t[r]>0?!0:(t[r]=1,u=t[r]>0,t[r]=0,u)
    }
})
}(jQuery),function(n,t){
    var r=0,i=Array.prototype.slice,u=n.cleanData;
    n.cleanData=function(t){
        for(var i=0,r;(r=t[i])!=null;i++)try{
            n(r).triggerHandler("remove")
            }catch(f){}
            u(t)
        };
        
    n.widget=function(t,i,r){
        var s,f,u,o,h={},e=t.split(".")[0];
        t=t.split(".")[1];
        s=e+"-"+t;
        r||(r=i,i=n.Widget);
        n.expr[":"][s.toLowerCase()]=function(t){
            return!!n.data(t,s)
            };
            
        n[e]=n[e]||{};
        
        f=n[e][t];
        u=n[e][t]=function(n,t){
            if(!this._createWidget)return new u(n,t);
            arguments.length&&this._createWidget(n,t)
            };
            
        n.extend(u,f,{
            version:r.version,
            _proto:n.extend({},r),
            _childConstructors:[]
        });
        o=new i;
        o.options=n.widget.extend({},o.options);
        n.each(r,function(t,r){
            if(!n.isFunction(r)){
                h[t]=r;
                return
            }
            h[t]=function(){
                var n=function(){
                    return i.prototype[t].apply(this,arguments)
                    },u=function(n){
                    return i.prototype[t].apply(this,n)
                    };
                    
                return function(){
                    var i=this._super,f=this._superApply,t;
                    return this._super=n,this._superApply=u,t=r.apply(this,arguments),this._super=i,this._superApply=f,t
                    }
                }()
            });
    u.prototype=n.widget.extend(o,{
        widgetEventPrefix:f?o.widgetEventPrefix||t:t
        },h,{
        constructor:u,
        namespace:e,
        widgetName:t,
        widgetFullName:s
    });
    f?(n.each(f._childConstructors,function(t,i){
        var r=i.prototype;
        n.widget(r.namespace+"."+r.widgetName,u,i._proto)
        }),delete f._childConstructors):i._childConstructors.push(u);
    n.widget.bridge(t,u)
    };
    
n.widget.extend=function(r){
    for(var o=i.call(arguments,1),e=0,s=o.length,u,f;e<s;e++)for(u in o[e])f=o[e][u],o[e].hasOwnProperty(u)&&f!==t&&(r[u]=n.isPlainObject(f)?n.isPlainObject(r[u])?n.widget.extend({},r[u],f):n.widget.extend({},f):f);return r
    };
    
n.widget.bridge=function(r,u){
    var f=u.prototype.widgetFullName||r;
    n.fn[r]=function(e){
        var h=typeof e=="string",o=i.call(arguments,1),s=this;
        return e=!h&&o.length?n.widget.extend.apply(null,[e].concat(o)):e,h?this.each(function(){
            var i,u=n.data(this,f);
            return u?!n.isFunction(u[e])||e.charAt(0)==="_"?n.error("no such method '"+e+"' for "+r+" widget instance"):(i=u[e].apply(u,o),i!==u&&i!==t?(s=i&&i.jquery?s.pushStack(i.get()):i,!1):void 0):n.error("cannot call methods on "+r+" prior to initialization; attempted to call method '"+e+"'")
            }):this.each(function(){
            var t=n.data(this,f);
            t?t.option(e||{})._init():n.data(this,f,new u(e,this))
            }),s
        }
    };

n.Widget=function(){};

n.Widget._childConstructors=[];
n.Widget.prototype={
    widgetName:"widget",
    widgetEventPrefix:"",
    defaultElement:"<div>",
    options:{
        disabled:!1,
        create:null
    },
    _createWidget:function(t,i){
        i=n(i||this.defaultElement||this)[0];
        this.element=n(i);
        this.uuid=r++;
        this.eventNamespace="."+this.widgetName+this.uuid;
        this.options=n.widget.extend({},this.options,this._getCreateOptions(),t);
        this.bindings=n();
        this.hoverable=n();
        this.focusable=n();
        i!==this&&(n.data(i,this.widgetFullName,this),this._on(!0,this.element,{
            remove:function(n){
                n.target===i&&this.destroy()
                }
            }),this.document=n(i.style?i.ownerDocument:i.document||i),this.window=n(this.document[0].defaultView||this.document[0].parentWindow));
    this._create();
    this._trigger("create",null,this._getCreateEventData());
    this._init()
    },
_getCreateOptions:n.noop,
_getCreateEventData:n.noop,
_create:n.noop,
_init:n.noop,
destroy:function(){
    this._destroy();
    this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(n.camelCase(this.widgetFullName));
    this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName+"-disabled ui-state-disabled");
    this.bindings.unbind(this.eventNamespace);
    this.hoverable.removeClass("ui-state-hover");
    this.focusable.removeClass("ui-state-focus")
    },
_destroy:n.noop,
widget:function(){
    return this.element
    },
option:function(i,r){
    var o=i,u,f,e;
    if(arguments.length===0)return n.widget.extend({},this.options);
    if(typeof i=="string")if(o={},u=i.split("."),i=u.shift(),u.length){
        for(f=o[i]=n.widget.extend({},this.options[i]),e=0;e<u.length-1;e++)f[u[e]]=f[u[e]]||{},f=f[u[e]];
        if(i=u.pop(),arguments.length===1)return f[i]===t?null:f[i];
        f[i]=r
        }else{
        if(arguments.length===1)return this.options[i]===t?null:this.options[i];
        o[i]=r
        }
        return this._setOptions(o),this
    },
_setOptions:function(n){
    for(var t in n)this._setOption(t,n[t]);return this
    },
_setOption:function(n,t){
    return this.options[n]=t,n==="disabled"&&(this.widget().toggleClass(this.widgetFullName+"-disabled ui-state-disabled",!!t).attr("aria-disabled",t),this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus")),this
    },
enable:function(){
    return this._setOption("disabled",!1)
    },
disable:function(){
    return this._setOption("disabled",!0)
    },
_on:function(t,i,r){
    var f,u=this;
    typeof t!="boolean"&&(r=i,i=t,t=!1);
    r?(i=f=n(i),this.bindings=this.bindings.add(i)):(r=i,i=this.element,f=this.widget());
    n.each(r,function(r,e){
        function o(){
            if(t||u.options.disabled!==!0&&!n(this).hasClass("ui-state-disabled"))return(typeof e=="string"?u[e]:e).apply(u,arguments)
                }
                typeof e!="string"&&(o.guid=e.guid=e.guid||o.guid||n.guid++);
        var s=r.match(/^(\w+)\s*(.*)$/),h=s[1]+u.eventNamespace,c=s[2];
        c?f.delegate(c,h,o):i.bind(h,o)
        })
    },
_off:function(n,t){
    t=(t||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace;
    n.unbind(t).undelegate(t)
    },
_delay:function(n,t){
    function r(){
        return(typeof n=="string"?i[n]:n).apply(i,arguments)
        }
        var i=this;
    return setTimeout(r,t||0)
    },
_hoverable:function(t){
    this.hoverable=this.hoverable.add(t);
    this._on(t,{
        mouseenter:function(t){
            n(t.currentTarget).addClass("ui-state-hover")
            },
        mouseleave:function(t){
            n(t.currentTarget).removeClass("ui-state-hover")
            }
        })
},
_focusable:function(t){
    this.focusable=this.focusable.add(t);
    this._on(t,{
        focusin:function(t){
            n(t.currentTarget).addClass("ui-state-focus")
            },
        focusout:function(t){
            n(t.currentTarget).removeClass("ui-state-focus")
            }
        })
},
_trigger:function(t,i,r){
    var u,f,e=this.options[t];
    if(r=r||{},i=n.Event(i),i.type=(t===this.widgetEventPrefix?t:this.widgetEventPrefix+t).toLowerCase(),i.target=this.element[0],f=i.originalEvent,f)for(u in f)u in i||(i[u]=f[u]);return this.element.trigger(i,r),!(n.isFunction(e)&&e.apply(this.element[0],[i].concat(r))===!1||i.isDefaultPrevented())
    }
};

n.each({
    show:"fadeIn",
    hide:"fadeOut"
},function(t,i){
    n.Widget.prototype["_"+t]=function(r,u,f){
        typeof u=="string"&&(u={
            effect:u
        });
        var o,e=u?u===!0||typeof u=="number"?i:u.effect||i:t;
        u=u||{};
        
        typeof u=="number"&&(u={
            duration:u
        });
        o=!n.isEmptyObject(u);
        u.complete=f;
        u.delay&&r.delay(u.delay);
        o&&n.effects&&n.effects.effect[e]?r[t](u):e!==t&&r[e]?r[e](u.duration,u.easing,f):r.queue(function(i){
            n(this)[t]();
            f&&f.call(r[0]);
            i()
            })
        }
    })
}(jQuery),function(n){
    var t=!1;
    n(document).mouseup(function(){
        t=!1
        });
    n.widget("ui.mouse",{
        version:"1.10.4",
        options:{
            cancel:"input,textarea,button,select,option",
            distance:1,
            delay:0
        },
        _mouseInit:function(){
            var t=this;
            this.element.bind("mousedown."+this.widgetName,function(n){
                return t._mouseDown(n)
                }).bind("click."+this.widgetName,function(i){
                if(!0===n.data(i.target,t.widgetName+".preventClickEvent"))return n.removeData(i.target,t.widgetName+".preventClickEvent"),i.stopImmediatePropagation(),!1
                    });
            this.started=!1
            },
        _mouseDestroy:function(){
            this.element.unbind("."+this.widgetName);
            this._mouseMoveDelegate&&n(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate)
            },
        _mouseDown:function(i){
            if(!t){
                this._mouseStarted&&this._mouseUp(i);
                this._mouseDownEvent=i;
                var r=this,u=i.which===1,f=typeof this.options.cancel=="string"&&i.target.nodeName?n(i.target).closest(this.options.cancel).length:!1;
                return!u||f||!this._mouseCapture(i)?!0:(this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){
                    r.mouseDelayMet=!0
                    },this.options.delay)),this._mouseDistanceMet(i)&&this._mouseDelayMet(i)&&(this._mouseStarted=this._mouseStart(i)!==!1,!this._mouseStarted))?(i.preventDefault(),!0):(!0===n.data(i.target,this.widgetName+".preventClickEvent")&&n.removeData(i.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(n){
                    return r._mouseMove(n)
                    },this._mouseUpDelegate=function(n){
                    return r._mouseUp(n)
                    },n(document).bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate),i.preventDefault(),t=!0,!0)
                }
            },
    _mouseMove:function(t){
        return n.ui.ie&&(!document.documentMode||document.documentMode<9)&&!t.button?this._mouseUp(t):this._mouseStarted?(this._mouseDrag(t),t.preventDefault()):(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=this._mouseStart(this._mouseDownEvent,t)!==!1,this._mouseStarted?this._mouseDrag(t):this._mouseUp(t)),!this._mouseStarted)
        },
    _mouseUp:function(t){
        return n(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,t.target===this._mouseDownEvent.target&&n.data(t.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(t)),!1
        },
    _mouseDistanceMet:function(n){
        return Math.max(Math.abs(this._mouseDownEvent.pageX-n.pageX),Math.abs(this._mouseDownEvent.pageY-n.pageY))>=this.options.distance
        },
    _mouseDelayMet:function(){
        return this.mouseDelayMet
        },
    _mouseStart:function(){},
        _mouseDrag:function(){},
        _mouseStop:function(){},
        _mouseCapture:function(){
        return!0
        }
    })
}(jQuery),function(n,t){
    function a(n,t,i){
        return[parseFloat(n[0])*(l.test(n[0])?t/100:1),parseFloat(n[1])*(l.test(n[1])?i/100:1)]
        }
        function u(t,i){
        return parseInt(n.css(t,i),10)||0
        }
        function y(t){
        var i=t[0];
        return i.nodeType===9?{
            width:t.width(),
            height:t.height(),
            offset:{
                top:0,
                left:0
            }
        }:n.isWindow(i)?{
        width:t.width(),
        height:t.height(),
        offset:{
            top:t.scrollTop(),
            left:t.scrollLeft()
            }
        }:i.preventDefault?{
    width:0,
    height:0,
    offset:{
        top:i.pageY,
        left:i.pageX
        }
    }:{
    width:t.outerWidth(),
    height:t.outerHeight(),
    offset:t.offset()
    }
}
n.ui=n.ui||{};

var f,r=Math.max,i=Math.abs,e=Math.round,o=/left|center|right/,s=/top|center|bottom/,h=/[\+\-]\d+(\.[\d]+)?%?/,c=/^\w+/,l=/%$/,v=n.fn.position;
n.position={
    scrollbarWidth:function(){
        if(f!==t)return f;
        var u,r,i=n("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'><\/div><\/div>"),e=i.children()[0];
        return n("body").append(i),u=e.offsetWidth,i.css("overflow","scroll"),r=e.offsetWidth,u===r&&(r=i[0].clientWidth),i.remove(),f=u-r
        },
    getScrollInfo:function(t){
        var i=t.isWindow||t.isDocument?"":t.element.css("overflow-x"),r=t.isWindow||t.isDocument?"":t.element.css("overflow-y"),u=i==="scroll"||i==="auto"&&t.width<t.element[0].scrollWidth,f=r==="scroll"||r==="auto"&&t.height<t.element[0].scrollHeight;
        return{
            width:f?n.position.scrollbarWidth():0,
            height:u?n.position.scrollbarWidth():0
            }
        },
getWithinInfo:function(t){
    var i=n(t||window),r=n.isWindow(i[0]),u=!!i[0]&&i[0].nodeType===9;
    return{
        element:i,
        isWindow:r,
        isDocument:u,
        offset:i.offset()||{
            left:0,
            top:0
        },
        scrollLeft:i.scrollLeft(),
        scrollTop:i.scrollTop(),
        width:r?i.width():i.outerWidth(),
        height:r?i.height():i.outerHeight()
        }
    }
};

n.fn.position=function(t){
    if(!t||!t.of)return v.apply(this,arguments);
    t=n.extend({},t);
    var b,f,l,w,p,d,g=n(t.of),tt=n.position.getWithinInfo(t.within),it=n.position.getScrollInfo(tt),k=(t.collision||"flip").split(" "),nt={};
    
    return d=y(g),g[0].preventDefault&&(t.at="left top"),f=d.width,l=d.height,w=d.offset,p=n.extend({},w),n.each(["my","at"],function(){
        var n=(t[this]||"").split(" "),i,r;
        n.length===1&&(n=o.test(n[0])?n.concat(["center"]):s.test(n[0])?["center"].concat(n):["center","center"]);
        n[0]=o.test(n[0])?n[0]:"center";
        n[1]=s.test(n[1])?n[1]:"center";
        i=h.exec(n[0]);
        r=h.exec(n[1]);
        nt[this]=[i?i[0]:0,r?r[0]:0];
        t[this]=[c.exec(n[0])[0],c.exec(n[1])[0]]
        }),k.length===1&&(k[1]=k[0]),t.at[0]==="right"?p.left+=f:t.at[0]==="center"&&(p.left+=f/2),t.at[1]==="bottom"?p.top+=l:t.at[1]==="center"&&(p.top+=l/2),b=a(nt.at,f,l),p.left+=b[0],p.top+=b[1],this.each(function(){
        var y,d,s=n(this),h=s.outerWidth(),c=s.outerHeight(),rt=u(this,"marginLeft"),ut=u(this,"marginTop"),ft=h+rt+u(this,"marginRight")+it.width,et=c+ut+u(this,"marginBottom")+it.height,o=n.extend({},p),v=a(nt.my,s.outerWidth(),s.outerHeight());
        t.my[0]==="right"?o.left-=h:t.my[0]==="center"&&(o.left-=h/2);
        t.my[1]==="bottom"?o.top-=c:t.my[1]==="center"&&(o.top-=c/2);
        o.left+=v[0];
        o.top+=v[1];
        n.support.offsetFractions||(o.left=e(o.left),o.top=e(o.top));
        y={
            marginLeft:rt,
            marginTop:ut
        };
        
        n.each(["left","top"],function(i,r){
            n.ui.position[k[i]]&&n.ui.position[k[i]][r](o,{
                targetWidth:f,
                targetHeight:l,
                elemWidth:h,
                elemHeight:c,
                collisionPosition:y,
                collisionWidth:ft,
                collisionHeight:et,
                offset:[b[0]+v[0],b[1]+v[1]],
                my:t.my,
                at:t.at,
                within:tt,
                elem:s
            })
            });
        t.using&&(d=function(n){
            var u=w.left-o.left,v=u+f-h,e=w.top-o.top,y=e+l-c,a={
                target:{
                    element:g,
                    left:w.left,
                    top:w.top,
                    width:f,
                    height:l
                },
                element:{
                    element:s,
                    left:o.left,
                    top:o.top,
                    width:h,
                    height:c
                },
                horizontal:v<0?"left":u>0?"right":"center",
                vertical:y<0?"top":e>0?"bottom":"middle"
                };
                
            f<h&&i(u+v)<f&&(a.horizontal="center");
            l<c&&i(e+y)<l&&(a.vertical="middle");
            a.important=r(i(u),i(v))>r(i(e),i(y))?"horizontal":"vertical";
            t.using.call(this,n,a)
            });
        s.offset(n.extend(o,{
            using:d
        }))
        })
    };
    
n.ui.position={
    fit:{
        left:function(n,t){
            var e=t.within,u=e.isWindow?e.scrollLeft:e.offset.left,o=e.width,s=n.left-t.collisionPosition.marginLeft,i=u-s,f=s+t.collisionWidth-o-u,h;
            t.collisionWidth>o?i>0&&f<=0?(h=n.left+i+t.collisionWidth-o-u,n.left+=i-h):n.left=f>0&&i<=0?u:i>f?u+o-t.collisionWidth:u:i>0?n.left+=i:f>0?n.left-=f:n.left=r(n.left-s,n.left)
            },
        top:function(n,t){
            var o=t.within,u=o.isWindow?o.scrollTop:o.offset.top,e=t.within.height,s=n.top-t.collisionPosition.marginTop,i=u-s,f=s+t.collisionHeight-e-u,h;
            t.collisionHeight>e?i>0&&f<=0?(h=n.top+i+t.collisionHeight-e-u,n.top+=i-h):n.top=f>0&&i<=0?u:i>f?u+e-t.collisionHeight:u:i>0?n.top+=i:f>0?n.top-=f:n.top=r(n.top-s,n.top)
            }
        },
flip:{
    left:function(n,t){
        var r=t.within,y=r.offset.left+r.scrollLeft,c=r.width,o=r.isWindow?r.scrollLeft:r.offset.left,l=n.left-t.collisionPosition.marginLeft,a=l-o,v=l+t.collisionWidth-c-o,u=t.my[0]==="left"?-t.elemWidth:t.my[0]==="right"?t.elemWidth:0,f=t.at[0]==="left"?t.targetWidth:t.at[0]==="right"?-t.targetWidth:0,e=-2*t.offset[0],s,h;
        a<0?(s=n.left+u+f+e+t.collisionWidth-c-y,(s<0||s<i(a))&&(n.left+=u+f+e)):v>0&&(h=n.left-t.collisionPosition.marginLeft+u+f+e-o,(h>0||i(h)<v)&&(n.left+=u+f+e))
        },
    top:function(n,t){
        var r=t.within,y=r.offset.top+r.scrollTop,a=r.height,o=r.isWindow?r.scrollTop:r.offset.top,v=n.top-t.collisionPosition.marginTop,s=v-o,h=v+t.collisionHeight-a-o,p=t.my[1]==="top",u=p?-t.elemHeight:t.my[1]==="bottom"?t.elemHeight:0,f=t.at[1]==="top"?t.targetHeight:t.at[1]==="bottom"?-t.targetHeight:0,e=-2*t.offset[1],c,l;
        s<0?(l=n.top+u+f+e+t.collisionHeight-a-y,n.top+u+f+e>s&&(l<0||l<i(s))&&(n.top+=u+f+e)):h>0&&(c=n.top-t.collisionPosition.marginTop+u+f+e-o,n.top+u+f+e>h&&(c>0||i(c)<h)&&(n.top+=u+f+e))
        }
    },
flipfit:{
    left:function(){
        n.ui.position.flip.left.apply(this,arguments);
        n.ui.position.fit.left.apply(this,arguments)
        },
    top:function(){
        n.ui.position.flip.top.apply(this,arguments);
        n.ui.position.fit.top.apply(this,arguments)
        }
    }
},function(){
    var t,i,r,u,f,e=document.getElementsByTagName("body")[0],o=document.createElement("div");
    t=document.createElement(e?"div":"body");
    r={
        visibility:"hidden",
        width:0,
        height:0,
        border:0,
        margin:0,
        background:"none"
    };
    
    e&&n.extend(r,{
        position:"absolute",
        left:"-1000px",
        top:"-1000px"
    });
    for(f in r)t.style[f]=r[f];t.appendChild(o);
    i=e||document.documentElement;
    i.insertBefore(t,i.firstChild);
    o.style.cssText="position: absolute; left: 10.7432222px;";
    u=n(o).offset().left;
    n.support.offsetFractions=u>10&&u<11;
    t.innerHTML="";
    i.removeChild(t)
    }()
}(jQuery),function(n){
    n.widget("ui.draggable",n.ui.mouse,{
        version:"1.10.4",
        widgetEventPrefix:"drag",
        options:{
            addClasses:!0,
            appendTo:"parent",
            axis:!1,
            connectToSortable:!1,
            containment:!1,
            cursor:"auto",
            cursorAt:!1,
            grid:!1,
            handle:!1,
            helper:"original",
            iframeFix:!1,
            opacity:!1,
            refreshPositions:!1,
            revert:!1,
            revertDuration:500,
            scope:"default",
            scroll:!0,
            scrollSensitivity:20,
            scrollSpeed:20,
            snap:!1,
            snapMode:"both",
            snapTolerance:20,
            stack:!1,
            zIndex:!1,
            drag:null,
            start:null,
            stop:null
        },
        _create:function(){
            this.options.helper!=="original"||/^(?:r|a|f)/.test(this.element.css("position"))||(this.element[0].style.position="relative");
            this.options.addClasses&&this.element.addClass("ui-draggable");
            this.options.disabled&&this.element.addClass("ui-draggable-disabled");
            this._mouseInit()
            },
        _destroy:function(){
            this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled");
            this._mouseDestroy()
            },
        _mouseCapture:function(t){
            var i=this.options;
            return this.helper||i.disabled||n(t.target).closest(".ui-resizable-handle").length>0?!1:(this.handle=this._getHandle(t),!this.handle)?!1:(n(i.iframeFix===!0?"iframe":i.iframeFix).each(function(){
                n("<div class='ui-draggable-iframeFix' style='background: #fff;'><\/div>").css({
                    width:this.offsetWidth+"px",
                    height:this.offsetHeight+"px",
                    position:"absolute",
                    opacity:"0.001",
                    zIndex:1e3
                }).css(n(this).offset()).appendTo("body")
                }),!0)
            },
        _mouseStart:function(t){
            var i=this.options;
            return(this.helper=this._createHelper(t),this.helper.addClass("ui-draggable-dragging"),this._cacheHelperProportions(),n.ui.ddmanager&&(n.ui.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(),this.offsetParent=this.helper.offsetParent(),this.offsetParentCssPosition=this.offsetParent.css("position"),this.offset=this.positionAbs=this.element.offset(),this.offset={
                top:this.offset.top-this.margins.top,
                left:this.offset.left-this.margins.left
                },this.offset.scroll=!1,n.extend(this.offset,{
                click:{
                    left:t.pageX-this.offset.left,
                    top:t.pageY-this.offset.top
                    },
                parent:this._getParentOffset(),
                relative:this._getRelativeOffset()
                }),this.originalPosition=this.position=this._generatePosition(t),this.originalPageX=t.pageX,this.originalPageY=t.pageY,i.cursorAt&&this._adjustOffsetFromHelper(i.cursorAt),this._setContainment(),this._trigger("start",t)===!1)?(this._clear(),!1):(this._cacheHelperProportions(),n.ui.ddmanager&&!i.dropBehaviour&&n.ui.ddmanager.prepareOffsets(this,t),this._mouseDrag(t,!0),n.ui.ddmanager&&n.ui.ddmanager.dragStart(this,t),!0)
            },
        _mouseDrag:function(t,i){
            if(this.offsetParentCssPosition==="fixed"&&(this.offset.parent=this._getParentOffset()),this.position=this._generatePosition(t),this.positionAbs=this._convertPositionTo("absolute"),!i){
                var r=this._uiHash();
                if(this._trigger("drag",t,r)===!1)return this._mouseUp({}),!1;
                this.position=r.position
                }
                return this.options.axis&&this.options.axis==="y"||(this.helper[0].style.left=this.position.left+"px"),this.options.axis&&this.options.axis==="x"||(this.helper[0].style.top=this.position.top+"px"),n.ui.ddmanager&&n.ui.ddmanager.drag(this,t),!1
            },
        _mouseStop:function(t){
            var r=this,i=!1;
            return(n.ui.ddmanager&&!this.options.dropBehaviour&&(i=n.ui.ddmanager.drop(this,t)),this.dropped&&(i=this.dropped,this.dropped=!1),this.options.helper==="original"&&!n.contains(this.element[0].ownerDocument,this.element[0]))?!1:(this.options.revert==="invalid"&&!i||this.options.revert==="valid"&&i||this.options.revert===!0||n.isFunction(this.options.revert)&&this.options.revert.call(this.element,i)?n(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){
                r._trigger("stop",t)!==!1&&r._clear()
                }):this._trigger("stop",t)!==!1&&this._clear(),!1)
            },
        _mouseUp:function(t){
            return n("div.ui-draggable-iframeFix").each(function(){
                this.parentNode.removeChild(this)
                }),n.ui.ddmanager&&n.ui.ddmanager.dragStop(this,t),n.ui.mouse.prototype._mouseUp.call(this,t)
            },
        cancel:function(){
            return this.helper.is(".ui-draggable-dragging")?this._mouseUp({}):this._clear(),this
            },
        _getHandle:function(t){
            return this.options.handle?!!n(t.target).closest(this.element.find(this.options.handle)).length:!0
            },
        _createHelper:function(t){
            var r=this.options,i=n.isFunction(r.helper)?n(r.helper.apply(this.element[0],[t])):r.helper==="clone"?this.element.clone().removeAttr("id"):this.element;
            return i.parents("body").length||i.appendTo(r.appendTo==="parent"?this.element[0].parentNode:r.appendTo),i[0]===this.element[0]||/(fixed|absolute)/.test(i.css("position"))||i.css("position","absolute"),i
            },
        _adjustOffsetFromHelper:function(t){
            typeof t=="string"&&(t=t.split(" "));
            n.isArray(t)&&(t={
                left:+t[0],
                top:+t[1]||0
                });
            "left"in t&&(this.offset.click.left=t.left+this.margins.left);
            "right"in t&&(this.offset.click.left=this.helperProportions.width-t.right+this.margins.left);
            "top"in t&&(this.offset.click.top=t.top+this.margins.top);
            "bottom"in t&&(this.offset.click.top=this.helperProportions.height-t.bottom+this.margins.top)
            },
        _getParentOffset:function(){
            var t=this.offsetParent.offset();
            return this.cssPosition==="absolute"&&this.scrollParent[0]!==document&&n.contains(this.scrollParent[0],this.offsetParent[0])&&(t.left+=this.scrollParent.scrollLeft(),t.top+=this.scrollParent.scrollTop()),(this.offsetParent[0]===document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()==="html"&&n.ui.ie)&&(t={
                top:0,
                left:0
            }),{
                top:t.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),
                left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)
                }
            },
    _getRelativeOffset:function(){
        if(this.cssPosition==="relative"){
            var n=this.element.position();
            return{
                top:n.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),
                left:n.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()
                }
            }
        return{
        top:0,
        left:0
    }
    },
_cacheMargins:function(){
    this.margins={
        left:parseInt(this.element.css("marginLeft"),10)||0,
        top:parseInt(this.element.css("marginTop"),10)||0,
        right:parseInt(this.element.css("marginRight"),10)||0,
        bottom:parseInt(this.element.css("marginBottom"),10)||0
        }
    },
_cacheHelperProportions:function(){
    this.helperProportions={
        width:this.helper.outerWidth(),
        height:this.helper.outerHeight()
        }
    },
_setContainment:function(){
    var u,t,i,r=this.options;
    if(!r.containment){
        this.containment=null;
        return
    }
    if(r.containment==="window"){
        this.containment=[n(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,n(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,n(window).scrollLeft()+n(window).width()-this.helperProportions.width-this.margins.left,n(window).scrollTop()+(n(window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];
        return
    }
    if(r.containment==="document"){
        this.containment=[0,0,n(document).width()-this.helperProportions.width-this.margins.left,(n(document).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];
        return
    }
    if(r.containment.constructor===Array){
        this.containment=r.containment;
        return
    }(r.containment==="parent"&&(r.containment=this.helper[0].parentNode),t=n(r.containment),i=t[0],i)&&(u=t.css("overflow")!=="hidden",this.containment=[(parseInt(t.css("borderLeftWidth"),10)||0)+(parseInt(t.css("paddingLeft"),10)||0),(parseInt(t.css("borderTopWidth"),10)||0)+(parseInt(t.css("paddingTop"),10)||0),(u?Math.max(i.scrollWidth,i.offsetWidth):i.offsetWidth)-(parseInt(t.css("borderRightWidth"),10)||0)-(parseInt(t.css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(u?Math.max(i.scrollHeight,i.offsetHeight):i.offsetHeight)-(parseInt(t.css("borderBottomWidth"),10)||0)-(parseInt(t.css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relative_container=t)
    },
_convertPositionTo:function(t,i){
    i||(i=this.position);
    var r=t==="absolute"?1:-1,u=this.cssPosition==="absolute"&&!(this.scrollParent[0]!==document&&n.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent;
    return this.offset.scroll||(this.offset.scroll={
        top:u.scrollTop(),
        left:u.scrollLeft()
        }),{
        top:i.top+this.offset.relative.top*r+this.offset.parent.top*r-(this.cssPosition==="fixed"?-this.scrollParent.scrollTop():this.offset.scroll.top)*r,
        left:i.left+this.offset.relative.left*r+this.offset.parent.left*r-(this.cssPosition==="fixed"?-this.scrollParent.scrollLeft():this.offset.scroll.left)*r
        }
    },
_generatePosition:function(t){
    var i,e,u,f,r=this.options,h=this.cssPosition==="absolute"&&!(this.scrollParent[0]!==document&&n.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,o=t.pageX,s=t.pageY;
    return this.offset.scroll||(this.offset.scroll={
        top:h.scrollTop(),
        left:h.scrollLeft()
        }),this.originalPosition&&(this.containment&&(this.relative_container?(e=this.relative_container.offset(),i=[this.containment[0]+e.left,this.containment[1]+e.top,this.containment[2]+e.left,this.containment[3]+e.top]):i=this.containment,t.pageX-this.offset.click.left<i[0]&&(o=i[0]+this.offset.click.left),t.pageY-this.offset.click.top<i[1]&&(s=i[1]+this.offset.click.top),t.pageX-this.offset.click.left>i[2]&&(o=i[2]+this.offset.click.left),t.pageY-this.offset.click.top>i[3]&&(s=i[3]+this.offset.click.top)),r.grid&&(u=r.grid[1]?this.originalPageY+Math.round((s-this.originalPageY)/r.grid[1])*r.grid[1]:this.originalPageY,s=i?u-this.offset.click.top>=i[1]||u-this.offset.click.top>i[3]?u:u-this.offset.click.top>=i[1]?u-r.grid[1]:u+r.grid[1]:u,f=r.grid[0]?this.originalPageX+Math.round((o-this.originalPageX)/r.grid[0])*r.grid[0]:this.originalPageX,o=i?f-this.offset.click.left>=i[0]||f-this.offset.click.left>i[2]?f:f-this.offset.click.left>=i[0]?f-r.grid[0]:f+r.grid[0]:f)),{
        top:s-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(this.cssPosition==="fixed"?-this.scrollParent.scrollTop():this.offset.scroll.top),
        left:o-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(this.cssPosition==="fixed"?-this.scrollParent.scrollLeft():this.offset.scroll.left)
        }
    },
_clear:function(){
    this.helper.removeClass("ui-draggable-dragging");
    this.helper[0]===this.element[0]||this.cancelHelperRemoval||this.helper.remove();
    this.helper=null;
    this.cancelHelperRemoval=!1
    },
_trigger:function(t,i,r){
    return r=r||this._uiHash(),n.ui.plugin.call(this,t,[i,r]),t==="drag"&&(this.positionAbs=this._convertPositionTo("absolute")),n.Widget.prototype._trigger.call(this,t,i,r)
    },
plugins:{},
_uiHash:function(){
    return{
        helper:this.helper,
        position:this.position,
        originalPosition:this.originalPosition,
        offset:this.positionAbs
        }
    }
});
n.ui.plugin.add("draggable","connectToSortable",{
    start:function(t,i){
        var r=n(this).data("ui-draggable"),u=r.options,f=n.extend({},i,{
            item:r.element
            });
        r.sortables=[];
        n(u.connectToSortable).each(function(){
            var i=n.data(this,"ui-sortable");
            i&&!i.options.disabled&&(r.sortables.push({
                instance:i,
                shouldRevert:i.options.revert
                }),i.refreshPositions(),i._trigger("activate",t,f))
            })
        },
    stop:function(t,i){
        var r=n(this).data("ui-draggable"),u=n.extend({},i,{
            item:r.element
            });
        n.each(r.sortables,function(){
            this.instance.isOver?(this.instance.isOver=0,r.cancelHelperRemoval=!0,this.instance.cancelHelperRemoval=!1,this.shouldRevert&&(this.instance.options.revert=this.shouldRevert),this.instance._mouseStop(t),this.instance.options.helper=this.instance.options._helper,r.options.helper==="original"&&this.instance.currentItem.css({
                top:"auto",
                left:"auto"
            })):(this.instance.cancelHelperRemoval=!1,this.instance._trigger("deactivate",t,u))
            })
        },
    drag:function(t,i){
        var r=n(this).data("ui-draggable"),u=this;
        n.each(r.sortables,function(){
            var f=!1,e=this;
            this.instance.positionAbs=r.positionAbs;
            this.instance.helperProportions=r.helperProportions;
            this.instance.offset.click=r.offset.click;
            this.instance._intersectsWith(this.instance.containerCache)&&(f=!0,n.each(r.sortables,function(){
                return this.instance.positionAbs=r.positionAbs,this.instance.helperProportions=r.helperProportions,this.instance.offset.click=r.offset.click,this!==e&&this.instance._intersectsWith(this.instance.containerCache)&&n.contains(e.instance.element[0],this.instance.element[0])&&(f=!1),f
                }));
            f?(this.instance.isOver||(this.instance.isOver=1,this.instance.currentItem=n(u).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item",!0),this.instance.options._helper=this.instance.options.helper,this.instance.options.helper=function(){
                return i.helper[0]
                },t.target=this.instance.currentItem[0],this.instance._mouseCapture(t,!0),this.instance._mouseStart(t,!0,!0),this.instance.offset.click.top=r.offset.click.top,this.instance.offset.click.left=r.offset.click.left,this.instance.offset.parent.left-=r.offset.parent.left-this.instance.offset.parent.left,this.instance.offset.parent.top-=r.offset.parent.top-this.instance.offset.parent.top,r._trigger("toSortable",t),r.dropped=this.instance.element,r.currentItem=r.element,this.instance.fromOutside=r),this.instance.currentItem&&this.instance._mouseDrag(t)):this.instance.isOver&&(this.instance.isOver=0,this.instance.cancelHelperRemoval=!0,this.instance.options.revert=!1,this.instance._trigger("out",t,this.instance._uiHash(this.instance)),this.instance._mouseStop(t,!0),this.instance.options.helper=this.instance.options._helper,this.instance.currentItem.remove(),this.instance.placeholder&&this.instance.placeholder.remove(),r._trigger("fromSortable",t),r.dropped=!1)
            })
        }
    });
n.ui.plugin.add("draggable","cursor",{
    start:function(){
        var t=n("body"),i=n(this).data("ui-draggable").options;
        t.css("cursor")&&(i._cursor=t.css("cursor"));
        t.css("cursor",i.cursor)
        },
    stop:function(){
        var t=n(this).data("ui-draggable").options;
        t._cursor&&n("body").css("cursor",t._cursor)
        }
    });
n.ui.plugin.add("draggable","opacity",{
    start:function(t,i){
        var r=n(i.helper),u=n(this).data("ui-draggable").options;
        r.css("opacity")&&(u._opacity=r.css("opacity"));
        r.css("opacity",u.opacity)
        },
    stop:function(t,i){
        var r=n(this).data("ui-draggable").options;
        r._opacity&&n(i.helper).css("opacity",r._opacity)
        }
    });
n.ui.plugin.add("draggable","scroll",{
    start:function(){
        var t=n(this).data("ui-draggable");
        t.scrollParent[0]!==document&&t.scrollParent[0].tagName!=="HTML"&&(t.overflowOffset=t.scrollParent.offset())
        },
    drag:function(t){
        var r=n(this).data("ui-draggable"),i=r.options,u=!1;
        r.scrollParent[0]!==document&&r.scrollParent[0].tagName!=="HTML"?(i.axis&&i.axis==="x"||(r.overflowOffset.top+r.scrollParent[0].offsetHeight-t.pageY<i.scrollSensitivity?r.scrollParent[0].scrollTop=u=r.scrollParent[0].scrollTop+i.scrollSpeed:t.pageY-r.overflowOffset.top<i.scrollSensitivity&&(r.scrollParent[0].scrollTop=u=r.scrollParent[0].scrollTop-i.scrollSpeed)),i.axis&&i.axis==="y"||(r.overflowOffset.left+r.scrollParent[0].offsetWidth-t.pageX<i.scrollSensitivity?r.scrollParent[0].scrollLeft=u=r.scrollParent[0].scrollLeft+i.scrollSpeed:t.pageX-r.overflowOffset.left<i.scrollSensitivity&&(r.scrollParent[0].scrollLeft=u=r.scrollParent[0].scrollLeft-i.scrollSpeed))):(i.axis&&i.axis==="x"||(t.pageY-n(document).scrollTop()<i.scrollSensitivity?u=n(document).scrollTop(n(document).scrollTop()-i.scrollSpeed):n(window).height()-(t.pageY-n(document).scrollTop())<i.scrollSensitivity&&(u=n(document).scrollTop(n(document).scrollTop()+i.scrollSpeed))),i.axis&&i.axis==="y"||(t.pageX-n(document).scrollLeft()<i.scrollSensitivity?u=n(document).scrollLeft(n(document).scrollLeft()-i.scrollSpeed):n(window).width()-(t.pageX-n(document).scrollLeft())<i.scrollSensitivity&&(u=n(document).scrollLeft(n(document).scrollLeft()+i.scrollSpeed))));
        u!==!1&&n.ui.ddmanager&&!i.dropBehaviour&&n.ui.ddmanager.prepareOffsets(r,t)
        }
    });
n.ui.plugin.add("draggable","snap",{
    start:function(){
        var t=n(this).data("ui-draggable"),i=t.options;
        t.snapElements=[];
        n(i.snap.constructor!==String?i.snap.items||":data(ui-draggable)":i.snap).each(function(){
            var i=n(this),r=i.offset();
            this!==t.element[0]&&t.snapElements.push({
                item:this,
                width:i.outerWidth(),
                height:i.outerHeight(),
                top:r.top,
                left:r.left
                })
            })
        },
    drag:function(t,i){
        for(var e,o,s,h,c,a,l,v,w,r=n(this).data("ui-draggable"),b=r.options,f=b.snapTolerance,y=i.offset.left,k=y+r.helperProportions.width,p=i.offset.top,d=p+r.helperProportions.height,u=r.snapElements.length-1;u>=0;u--){
            if(c=r.snapElements[u].left,a=c+r.snapElements[u].width,l=r.snapElements[u].top,v=l+r.snapElements[u].height,k<c-f||y>a+f||d<l-f||p>v+f||!n.contains(r.snapElements[u].item.ownerDocument,r.snapElements[u].item)){
                r.snapElements[u].snapping&&r.options.snap.release&&r.options.snap.release.call(r.element,t,n.extend(r._uiHash(),{
                    snapItem:r.snapElements[u].item
                    }));
                r.snapElements[u].snapping=!1;
                continue
            }
            b.snapMode!=="inner"&&(e=Math.abs(l-d)<=f,o=Math.abs(v-p)<=f,s=Math.abs(c-k)<=f,h=Math.abs(a-y)<=f,e&&(i.position.top=r._convertPositionTo("relative",{
                top:l-r.helperProportions.height,
                left:0
            }).top-r.margins.top),o&&(i.position.top=r._convertPositionTo("relative",{
                top:v,
                left:0
            }).top-r.margins.top),s&&(i.position.left=r._convertPositionTo("relative",{
                top:0,
                left:c-r.helperProportions.width
                }).left-r.margins.left),h&&(i.position.left=r._convertPositionTo("relative",{
                top:0,
                left:a
            }).left-r.margins.left));
            w=e||o||s||h;
            b.snapMode!=="outer"&&(e=Math.abs(l-p)<=f,o=Math.abs(v-d)<=f,s=Math.abs(c-y)<=f,h=Math.abs(a-k)<=f,e&&(i.position.top=r._convertPositionTo("relative",{
                top:l,
                left:0
            }).top-r.margins.top),o&&(i.position.top=r._convertPositionTo("relative",{
                top:v-r.helperProportions.height,
                left:0
            }).top-r.margins.top),s&&(i.position.left=r._convertPositionTo("relative",{
                top:0,
                left:c
            }).left-r.margins.left),h&&(i.position.left=r._convertPositionTo("relative",{
                top:0,
                left:a-r.helperProportions.width
                }).left-r.margins.left));
            !r.snapElements[u].snapping&&(e||o||s||h||w)&&r.options.snap.snap&&r.options.snap.snap.call(r.element,t,n.extend(r._uiHash(),{
                snapItem:r.snapElements[u].item
                }));
            r.snapElements[u].snapping=e||o||s||h||w
            }
        }
    });
n.ui.plugin.add("draggable","stack",{
    start:function(){
        var i,r=this.data("ui-draggable").options,t=n.makeArray(n(r.stack)).sort(function(t,i){
            return(parseInt(n(t).css("zIndex"),10)||0)-(parseInt(n(i).css("zIndex"),10)||0)
            });
        t.length&&(i=parseInt(n(t[0]).css("zIndex"),10)||0,n(t).each(function(t){
            n(this).css("zIndex",i+t)
            }),this.css("zIndex",i+t.length))
        }
    });
n.ui.plugin.add("draggable","zIndex",{
    start:function(t,i){
        var r=n(i.helper),u=n(this).data("ui-draggable").options;
        r.css("zIndex")&&(u._zIndex=r.css("zIndex"));
        r.css("zIndex",u.zIndex)
        },
    stop:function(t,i){
        var r=n(this).data("ui-draggable").options;
        r._zIndex&&n(i.helper).css("zIndex",r._zIndex)
        }
    })
}(jQuery),function(n){
    function t(n,t,i){
        return n>t&&n<t+i
        }
        n.widget("ui.droppable",{
        version:"1.10.4",
        widgetEventPrefix:"drop",
        options:{
            accept:"*",
            activeClass:!1,
            addClasses:!0,
            greedy:!1,
            hoverClass:!1,
            scope:"default",
            tolerance:"intersect",
            activate:null,
            deactivate:null,
            drop:null,
            out:null,
            over:null
        },
        _create:function(){
            var i,t=this.options,r=t.accept;
            this.isover=!1;
            this.isout=!0;
            this.accept=n.isFunction(r)?r:function(n){
                return n.is(r)
                };
                
            this.proportions=function(){
                if(arguments.length)i=arguments[0];else return i?i:i={
                    width:this.element[0].offsetWidth,
                    height:this.element[0].offsetHeight
                    }
                };
                
        n.ui.ddmanager.droppables[t.scope]=n.ui.ddmanager.droppables[t.scope]||[];
        n.ui.ddmanager.droppables[t.scope].push(this);
        t.addClasses&&this.element.addClass("ui-droppable")
        },
    _destroy:function(){
        for(var t=0,i=n.ui.ddmanager.droppables[this.options.scope];t<i.length;t++)i[t]===this&&i.splice(t,1);
        this.element.removeClass("ui-droppable ui-droppable-disabled")
        },
    _setOption:function(t,i){
        t==="accept"&&(this.accept=n.isFunction(i)?i:function(n){
            return n.is(i)
            });
        n.Widget.prototype._setOption.apply(this,arguments)
        },
    _activate:function(t){
        var i=n.ui.ddmanager.current;
        this.options.activeClass&&this.element.addClass(this.options.activeClass);
        i&&this._trigger("activate",t,this.ui(i))
        },
    _deactivate:function(t){
        var i=n.ui.ddmanager.current;
        this.options.activeClass&&this.element.removeClass(this.options.activeClass);
        i&&this._trigger("deactivate",t,this.ui(i))
        },
    _over:function(t){
        var i=n.ui.ddmanager.current;
        i&&(i.currentItem||i.element)[0]!==this.element[0]&&this.accept.call(this.element[0],i.currentItem||i.element)&&(this.options.hoverClass&&this.element.addClass(this.options.hoverClass),this._trigger("over",t,this.ui(i)))
        },
    _out:function(t){
        var i=n.ui.ddmanager.current;
        i&&(i.currentItem||i.element)[0]!==this.element[0]&&this.accept.call(this.element[0],i.currentItem||i.element)&&(this.options.hoverClass&&this.element.removeClass(this.options.hoverClass),this._trigger("out",t,this.ui(i)))
        },
    _drop:function(t,i){
        var r=i||n.ui.ddmanager.current,u=!1;
        return!r||(r.currentItem||r.element)[0]===this.element[0]?!1:(this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function(){
            var t=n.data(this,"ui-droppable");
            if(t.options.greedy&&!t.options.disabled&&t.options.scope===r.options.scope&&t.accept.call(t.element[0],r.currentItem||r.element)&&n.ui.intersect(r,n.extend(t,{
                offset:t.element.offset()
                }),t.options.tolerance))return u=!0,!1
                }),u)?!1:this.accept.call(this.element[0],r.currentItem||r.element)?(this.options.activeClass&&this.element.removeClass(this.options.activeClass),this.options.hoverClass&&this.element.removeClass(this.options.hoverClass),this._trigger("drop",t,this.ui(r)),this.element):!1
        },
    ui:function(n){
        return{
            draggable:n.currentItem||n.element,
            helper:n.helper,
            position:n.position,
            offset:n.positionAbs
            }
        }
    });
n.ui.intersect=function(n,i,r){
    if(!i.offset)return!1;
    var a,v,e=(n.positionAbs||n.position.absolute).left,o=(n.positionAbs||n.position.absolute).top,s=e+n.helperProportions.width,h=o+n.helperProportions.height,u=i.offset.left,f=i.offset.top,c=u+i.proportions().width,l=f+i.proportions().height;
    switch(r){
        case"fit":
            return u<=e&&s<=c&&f<=o&&h<=l;
        case"intersect":
            return u<e+n.helperProportions.width/2&&s-n.helperProportions.width/2<c&&f<o+n.helperProportions.height/2&&h-n.helperProportions.height/2<l;
        case"pointer":
            return a=(n.positionAbs||n.position.absolute).left+(n.clickOffset||n.offset.click).left,v=(n.positionAbs||n.position.absolute).top+(n.clickOffset||n.offset.click).top,t(v,f,i.proportions().height)&&t(a,u,i.proportions().width);
        case"touch":
            return(o>=f&&o<=l||h>=f&&h<=l||o<f&&h>l)&&(e>=u&&e<=c||s>=u&&s<=c||e<u&&s>c);
        default:
            return!1
            }
        };

n.ui.ddmanager={
    current:null,
    droppables:{
        "default":[]
    },
    prepareOffsets:function(t,i){
        var r,f,u=n.ui.ddmanager.droppables[t.options.scope]||[],o=i?i.type:null,e=(t.currentItem||t.element).find(":data(ui-droppable)").addBack();
            n:for(r=0;r<u.length;r++)if(!u[r].options.disabled&&(!t||u[r].accept.call(u[r].element[0],t.currentItem||t.element))){
            for(f=0;f<e.length;f++)if(e[f]===u[r].element[0]){
                u[r].proportions().height=0;
                continue n
            }(u[r].visible=u[r].element.css("display")!=="none",u[r].visible)&&(o==="mousedown"&&u[r]._activate.call(u[r],i),u[r].offset=u[r].element.offset(),u[r].proportions({
                width:u[r].element[0].offsetWidth,
                height:u[r].element[0].offsetHeight
                }))
            }
        },
drop:function(t,i){
    var r=!1;
    return n.each((n.ui.ddmanager.droppables[t.options.scope]||[]).slice(),function(){
        this.options&&(!this.options.disabled&&this.visible&&n.ui.intersect(t,this,this.options.tolerance)&&(r=this._drop.call(this,i)||r),!this.options.disabled&&this.visible&&this.accept.call(this.element[0],t.currentItem||t.element)&&(this.isout=!0,this.isover=!1,this._deactivate.call(this,i)))
        }),r
    },
dragStart:function(t,i){
    t.element.parentsUntil("body").bind("scroll.droppable",function(){
        t.options.refreshPositions||n.ui.ddmanager.prepareOffsets(t,i)
        })
    },
drag:function(t,i){
    t.options.refreshPositions&&n.ui.ddmanager.prepareOffsets(t,i);
    n.each(n.ui.ddmanager.droppables[t.options.scope]||[],function(){
        if(!this.options.disabled&&!this.greedyChild&&this.visible){
            var r,e,f,o=n.ui.intersect(t,this,this.options.tolerance),u=!o&&this.isover?"isout":o&&!this.isover?"isover":null;
            u&&(this.options.greedy&&(e=this.options.scope,f=this.element.parents(":data(ui-droppable)").filter(function(){
                return n.data(this,"ui-droppable").options.scope===e
                }),f.length&&(r=n.data(f[0],"ui-droppable"),r.greedyChild=u==="isover")),r&&u==="isover"&&(r.isover=!1,r.isout=!0,r._out.call(r,i)),this[u]=!0,this[u==="isout"?"isover":"isout"]=!1,this[u==="isover"?"_over":"_out"].call(this,i),r&&u==="isout"&&(r.isout=!1,r.isover=!0,r._over.call(r,i)))
            }
        })
},
dragStop:function(t,i){
    t.element.parentsUntil("body").unbind("scroll.droppable");
    t.options.refreshPositions||n.ui.ddmanager.prepareOffsets(t,i)
    }
}
}(jQuery),function(n){
    function i(n){
        return parseInt(n,10)||0
        }
        function t(n){
        return!isNaN(parseInt(n,10))
        }
        n.widget("ui.resizable",n.ui.mouse,{
        version:"1.10.4",
        widgetEventPrefix:"resize",
        options:{
            alsoResize:!1,
            animate:!1,
            animateDuration:"slow",
            animateEasing:"swing",
            aspectRatio:!1,
            autoHide:!1,
            containment:!1,
            ghost:!1,
            grid:!1,
            handles:"e,s,se",
            helper:!1,
            maxHeight:null,
            maxWidth:null,
            minHeight:10,
            minWidth:10,
            zIndex:90,
            resize:null,
            start:null,
            stop:null
        },
        _create:function(){
            var e,f,r,i,o,u=this,t=this.options;
            if(this.element.addClass("ui-resizable"),n.extend(this,{
                _aspectRatio:!!t.aspectRatio,
                aspectRatio:t.aspectRatio,
                originalElement:this.element,
                _proportionallyResizeElements:[],
                _helper:t.helper||t.ghost||t.animate?t.helper||"ui-resizable-helper":null
                }),this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i)&&(this.element.wrap(n("<div class='ui-wrapper' style='overflow: hidden;'><\/div>").css({
                position:this.element.css("position"),
                width:this.element.outerWidth(),
                height:this.element.outerHeight(),
                top:this.element.css("top"),
                left:this.element.css("left")
                })),this.element=this.element.parent().data("ui-resizable",this.element.data("ui-resizable")),this.elementIsWrapper=!0,this.element.css({
                marginLeft:this.originalElement.css("marginLeft"),
                marginTop:this.originalElement.css("marginTop"),
                marginRight:this.originalElement.css("marginRight"),
                marginBottom:this.originalElement.css("marginBottom")
                }),this.originalElement.css({
                marginLeft:0,
                marginTop:0,
                marginRight:0,
                marginBottom:0
            }),this.originalResizeStyle=this.originalElement.css("resize"),this.originalElement.css("resize","none"),this._proportionallyResizeElements.push(this.originalElement.css({
                position:"static",
                zoom:1,
                display:"block"
            })),this.originalElement.css({
                margin:this.originalElement.css("margin")
                }),this._proportionallyResize()),this.handles=t.handles||(n(".ui-resizable-handle",this.element).length?{
                n:".ui-resizable-n",
                e:".ui-resizable-e",
                s:".ui-resizable-s",
                w:".ui-resizable-w",
                se:".ui-resizable-se",
                sw:".ui-resizable-sw",
                ne:".ui-resizable-ne",
                nw:".ui-resizable-nw"
            }:"e,s,se"),this.handles.constructor===String)for(this.handles==="all"&&(this.handles="n,e,s,w,se,sw,ne,nw"),e=this.handles.split(","),this.handles={},f=0;f<e.length;f++)r=n.trim(e[f]),o="ui-resizable-"+r,i=n("<div class='ui-resizable-handle "+o+"'><\/div>"),i.css({
                zIndex:t.zIndex
                }),"se"===r&&i.addClass("ui-icon ui-icon-gripsmall-diagonal-se"),this.handles[r]=".ui-resizable-"+r,this.element.append(i);
            this._renderAxis=function(t){
                var i,r,u,f;
                t=t||this.element;
                for(i in this.handles)this.handles[i].constructor===String&&(this.handles[i]=n(this.handles[i],this.element).show()),this.elementIsWrapper&&this.originalElement[0].nodeName.match(/textarea|input|select|button/i)&&(r=n(this.handles[i],this.element),f=/sw|ne|nw|se|n|s/.test(i)?r.outerHeight():r.outerWidth(),u=["padding",/ne|nw|n/.test(i)?"Top":/se|sw|s/.test(i)?"Bottom":/^e$/.test(i)?"Right":"Left"].join(""),t.css(u,f),this._proportionallyResize()),!n(this.handles[i]).length
                    };
                    
            this._renderAxis(this.element);
            this._handles=n(".ui-resizable-handle",this.element).disableSelection();
            this._handles.mouseover(function(){
                u.resizing||(this.className&&(i=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)),u.axis=i&&i[1]?i[1]:"se")
                });
            t.autoHide&&(this._handles.hide(),n(this.element).addClass("ui-resizable-autohide").mouseenter(function(){
                t.disabled||(n(this).removeClass("ui-resizable-autohide"),u._handles.show())
                }).mouseleave(function(){
                t.disabled||u.resizing||(n(this).addClass("ui-resizable-autohide"),u._handles.hide())
                }));
            this._mouseInit()
            },
        _destroy:function(){
            this._mouseDestroy();
            var t,i=function(t){
                n(t).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()
                };
                
            return this.elementIsWrapper&&(i(this.element),t=this.element,this.originalElement.css({
                position:t.css("position"),
                width:t.outerWidth(),
                height:t.outerHeight(),
                top:t.css("top"),
                left:t.css("left")
                }).insertAfter(t),t.remove()),this.originalElement.css("resize",this.originalResizeStyle),i(this.originalElement),this
            },
        _mouseCapture:function(t){
            var r,i,u=!1;
            for(r in this.handles)i=n(this.handles[r])[0],(i===t.target||n.contains(i,t.target))&&(u=!0);return!this.options.disabled&&u
            },
        _mouseStart:function(t){
            var f,e,o,u=this.options,s=this.element.position(),r=this.element;
            return this.resizing=!0,/absolute/.test(r.css("position"))?r.css({
                position:"absolute",
                top:r.css("top"),
                left:r.css("left")
                }):r.is(".ui-draggable")&&r.css({
                position:"absolute",
                top:s.top,
                left:s.left
                }),this._renderProxy(),f=i(this.helper.css("left")),e=i(this.helper.css("top")),u.containment&&(f+=n(u.containment).scrollLeft()||0,e+=n(u.containment).scrollTop()||0),this.offset=this.helper.offset(),this.position={
                left:f,
                top:e
            },this.size=this._helper?{
                width:this.helper.width(),
                height:this.helper.height()
                }:{
                width:r.width(),
                height:r.height()
                },this.originalSize=this._helper?{
                width:r.outerWidth(),
                height:r.outerHeight()
                }:{
                width:r.width(),
                height:r.height()
                },this.originalPosition={
                left:f,
                top:e
            },this.sizeDiff={
                width:r.outerWidth()-r.width(),
                height:r.outerHeight()-r.height()
                },this.originalMousePosition={
                left:t.pageX,
                top:t.pageY
                },this.aspectRatio=typeof u.aspectRatio=="number"?u.aspectRatio:this.originalSize.width/this.originalSize.height||1,o=n(".ui-resizable-"+this.axis).css("cursor"),n("body").css("cursor",o==="auto"?this.axis+"-resize":o),r.addClass("ui-resizable-resizing"),this._propagate("start",t),!0
            },
        _mouseDrag:function(t){
            var i,e=this.helper,r={},u=this.originalMousePosition,o=this.axis,s=this.position.top,h=this.position.left,c=this.size.width,l=this.size.height,a=t.pageX-u.left||0,v=t.pageY-u.top||0,f=this._change[o];
            return f?(i=f.apply(this,[t,a,v]),this._updateVirtualBoundaries(t.shiftKey),(this._aspectRatio||t.shiftKey)&&(i=this._updateRatio(i,t)),i=this._respectSize(i,t),this._updateCache(i),this._propagate("resize",t),this.position.top!==s&&(r.top=this.position.top+"px"),this.position.left!==h&&(r.left=this.position.left+"px"),this.size.width!==c&&(r.width=this.size.width+"px"),this.size.height!==l&&(r.height=this.size.height+"px"),e.css(r),!this._helper&&this._proportionallyResizeElements.length&&this._proportionallyResize(),n.isEmptyObject(r)||this._trigger("resize",t,this.ui()),!1):!1
            },
        _mouseStop:function(t){
            this.resizing=!1;
            var r,u,f,e,o,s,h,c=this.options,i=this;
            return this._helper&&(r=this._proportionallyResizeElements,u=r.length&&/textarea/i.test(r[0].nodeName),f=u&&n.ui.hasScroll(r[0],"left")?0:i.sizeDiff.height,e=u?0:i.sizeDiff.width,o={
                width:i.helper.width()-e,
                height:i.helper.height()-f
                },s=parseInt(i.element.css("left"),10)+(i.position.left-i.originalPosition.left)||null,h=parseInt(i.element.css("top"),10)+(i.position.top-i.originalPosition.top)||null,c.animate||this.element.css(n.extend(o,{
                top:h,
                left:s
            })),i.helper.height(i.size.height),i.helper.width(i.size.width),this._helper&&!c.animate&&this._proportionallyResize()),n("body").css("cursor","auto"),this.element.removeClass("ui-resizable-resizing"),this._propagate("stop",t),this._helper&&this.helper.remove(),!1
            },
        _updateVirtualBoundaries:function(n){
            var u,f,e,o,i,r=this.options;
            i={
                minWidth:t(r.minWidth)?r.minWidth:0,
                maxWidth:t(r.maxWidth)?r.maxWidth:Infinity,
                minHeight:t(r.minHeight)?r.minHeight:0,
                maxHeight:t(r.maxHeight)?r.maxHeight:Infinity
                };
            (this._aspectRatio||n)&&(u=i.minHeight*this.aspectRatio,e=i.minWidth/this.aspectRatio,f=i.maxHeight*this.aspectRatio,o=i.maxWidth/this.aspectRatio,u>i.minWidth&&(i.minWidth=u),e>i.minHeight&&(i.minHeight=e),f<i.maxWidth&&(i.maxWidth=f),o<i.maxHeight&&(i.maxHeight=o));
            this._vBoundaries=i
            },
        _updateCache:function(n){
            this.offset=this.helper.offset();
            t(n.left)&&(this.position.left=n.left);
            t(n.top)&&(this.position.top=n.top);
            t(n.height)&&(this.size.height=n.height);
            t(n.width)&&(this.size.width=n.width)
            },
        _updateRatio:function(n){
            var i=this.position,r=this.size,u=this.axis;
            return t(n.height)?n.width=n.height*this.aspectRatio:t(n.width)&&(n.height=n.width/this.aspectRatio),u==="sw"&&(n.left=i.left+(r.width-n.width),n.top=null),u==="nw"&&(n.top=i.top+(r.height-n.height),n.left=i.left+(r.width-n.width)),n
            },
        _respectSize:function(n){
            var i=this._vBoundaries,r=this.axis,u=t(n.width)&&i.maxWidth&&i.maxWidth<n.width,f=t(n.height)&&i.maxHeight&&i.maxHeight<n.height,e=t(n.width)&&i.minWidth&&i.minWidth>n.width,o=t(n.height)&&i.minHeight&&i.minHeight>n.height,s=this.originalPosition.left+this.originalSize.width,h=this.position.top+this.size.height,c=/sw|nw|w/.test(r),l=/nw|ne|n/.test(r);
            return e&&(n.width=i.minWidth),o&&(n.height=i.minHeight),u&&(n.width=i.maxWidth),f&&(n.height=i.maxHeight),e&&c&&(n.left=s-i.minWidth),u&&c&&(n.left=s-i.maxWidth),o&&l&&(n.top=h-i.minHeight),f&&l&&(n.top=h-i.maxHeight),n.width||n.height||n.left||!n.top?n.width||n.height||n.top||!n.left||(n.left=null):n.top=null,n
            },
        _proportionallyResize:function(){
            if(this._proportionallyResizeElements.length)for(var t,r,u,n,f=this.helper||this.element,i=0;i<this._proportionallyResizeElements.length;i++){
                if(n=this._proportionallyResizeElements[i],!this.borderDif)for(this.borderDif=[],r=[n.css("borderTopWidth"),n.css("borderRightWidth"),n.css("borderBottomWidth"),n.css("borderLeftWidth")],u=[n.css("paddingTop"),n.css("paddingRight"),n.css("paddingBottom"),n.css("paddingLeft")],t=0;t<r.length;t++)this.borderDif[t]=(parseInt(r[t],10)||0)+(parseInt(u[t],10)||0);
                n.css({
                    height:f.height()-this.borderDif[0]-this.borderDif[2]||0,
                    width:f.width()-this.borderDif[1]-this.borderDif[3]||0
                    })
                }
            },
    _renderProxy:function(){
        var t=this.element,i=this.options;
        this.elementOffset=t.offset();
        this._helper?(this.helper=this.helper||n("<div style='overflow:hidden;'><\/div>"),this.helper.addClass(this._helper).css({
            width:this.element.outerWidth()-1,
            height:this.element.outerHeight()-1,
            position:"absolute",
            left:this.elementOffset.left+"px",
            top:this.elementOffset.top+"px",
            zIndex:++i.zIndex
            }),this.helper.appendTo("body").disableSelection()):this.helper=this.element
        },
    _change:{
        e:function(n,t){
            return{
                width:this.originalSize.width+t
                }
            },
    w:function(n,t){
        var i=this.originalSize,r=this.originalPosition;
        return{
            left:r.left+t,
            width:i.width-t
            }
        },
    n:function(n,t,i){
        var r=this.originalSize,u=this.originalPosition;
        return{
            top:u.top+i,
            height:r.height-i
            }
        },
s:function(n,t,i){
    return{
        height:this.originalSize.height+i
        }
    },
se:function(t,i,r){
    return n.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[t,i,r]))
    },
sw:function(t,i,r){
    return n.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[t,i,r]))
    },
ne:function(t,i,r){
    return n.extend(this._change.n.apply(this,arguments),this._change.e.apply(this,[t,i,r]))
    },
nw:function(t,i,r){
    return n.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[t,i,r]))
    }
},
_propagate:function(t,i){
    n.ui.plugin.call(this,t,[i,this.ui()]);
    t!=="resize"&&this._trigger(t,i,this.ui())
    },
plugins:{},
ui:function(){
    return{
        originalElement:this.originalElement,
        element:this.element,
        helper:this.helper,
        position:this.position,
        size:this.size,
        originalSize:this.originalSize,
        originalPosition:this.originalPosition
        }
    }
});
n.ui.plugin.add("resizable","animate",{
    stop:function(t){
        var i=n(this).data("ui-resizable"),u=i.options,r=i._proportionallyResizeElements,f=r.length&&/textarea/i.test(r[0].nodeName),s=f&&n.ui.hasScroll(r[0],"left")?0:i.sizeDiff.height,h=f?0:i.sizeDiff.width,c={
            width:i.size.width-h,
            height:i.size.height-s
            },e=parseInt(i.element.css("left"),10)+(i.position.left-i.originalPosition.left)||null,o=parseInt(i.element.css("top"),10)+(i.position.top-i.originalPosition.top)||null;
        i.element.animate(n.extend(c,o&&e?{
            top:o,
            left:e
        }:{}),{
            duration:u.animateDuration,
            easing:u.animateEasing,
            step:function(){
                var u={
                    width:parseInt(i.element.css("width"),10),
                    height:parseInt(i.element.css("height"),10),
                    top:parseInt(i.element.css("top"),10),
                    left:parseInt(i.element.css("left"),10)
                    };
                    
                r&&r.length&&n(r[0]).css({
                    width:u.width,
                    height:u.height
                    });
                i._updateCache(u);
                i._propagate("resize",t)
                }
            })
    }
});
n.ui.plugin.add("resizable","containment",{
    start:function(){
        var u,e,o,s,h,c,l,t=n(this).data("ui-resizable"),a=t.options,v=t.element,f=a.containment,r=f instanceof n?f.get(0):/parent/.test(f)?v.parent().get(0):f;
        r&&(t.containerElement=n(r),/document/.test(f)||f===document?(t.containerOffset={
            left:0,
            top:0
        },t.containerPosition={
            left:0,
            top:0
        },t.parentData={
            element:n(document),
            left:0,
            top:0,
            width:n(document).width(),
            height:n(document).height()||document.body.parentNode.scrollHeight
            }):(u=n(r),e=[],n(["Top","Right","Left","Bottom"]).each(function(n,t){
            e[n]=i(u.css("padding"+t))
            }),t.containerOffset=u.offset(),t.containerPosition=u.position(),t.containerSize={
            height:u.innerHeight()-e[3],
            width:u.innerWidth()-e[1]
            },o=t.containerOffset,s=t.containerSize.height,h=t.containerSize.width,c=n.ui.hasScroll(r,"left")?r.scrollWidth:h,l=n.ui.hasScroll(r)?r.scrollHeight:s,t.parentData={
            element:r,
            left:o.left,
            top:o.top,
            width:c,
            height:l
        }))
        },
    resize:function(t){
        var f,o,s,h,i=n(this).data("ui-resizable"),a=i.options,r=i.containerOffset,c=i.position,e=i._aspectRatio||t.shiftKey,u={
            top:0,
            left:0
        },l=i.containerElement;
        l[0]!==document&&/static/.test(l.css("position"))&&(u=r);
        c.left<(i._helper?r.left:0)&&(i.size.width=i.size.width+(i._helper?i.position.left-r.left:i.position.left-u.left),e&&(i.size.height=i.size.width/i.aspectRatio),i.position.left=a.helper?r.left:0);
        c.top<(i._helper?r.top:0)&&(i.size.height=i.size.height+(i._helper?i.position.top-r.top:i.position.top),e&&(i.size.width=i.size.height*i.aspectRatio),i.position.top=i._helper?r.top:0);
        i.offset.left=i.parentData.left+i.position.left;
        i.offset.top=i.parentData.top+i.position.top;
        f=Math.abs((i._helper?i.offset.left-u.left:i.offset.left-u.left)+i.sizeDiff.width);
        o=Math.abs((i._helper?i.offset.top-u.top:i.offset.top-r.top)+i.sizeDiff.height);
        s=i.containerElement.get(0)===i.element.parent().get(0);
        h=/relative|absolute/.test(i.containerElement.css("position"));
        s&&h&&(f-=Math.abs(i.parentData.left));
        f+i.size.width>=i.parentData.width&&(i.size.width=i.parentData.width-f,e&&(i.size.height=i.size.width/i.aspectRatio));
        o+i.size.height>=i.parentData.height&&(i.size.height=i.parentData.height-o,e&&(i.size.width=i.size.height*i.aspectRatio))
        },
    stop:function(){
        var t=n(this).data("ui-resizable"),r=t.options,u=t.containerOffset,f=t.containerPosition,e=t.containerElement,i=n(t.helper),o=i.offset(),s=i.outerWidth()-t.sizeDiff.width,h=i.outerHeight()-t.sizeDiff.height;
        t._helper&&!r.animate&&/relative/.test(e.css("position"))&&n(this).css({
            left:o.left-f.left-u.left,
            width:s,
            height:h
        });
        t._helper&&!r.animate&&/static/.test(e.css("position"))&&n(this).css({
            left:o.left-f.left-u.left,
            width:s,
            height:h
        })
        }
    });
n.ui.plugin.add("resizable","alsoResize",{
    start:function(){
        var r=n(this).data("ui-resizable"),t=r.options,i=function(t){
            n(t).each(function(){
                var t=n(this);
                t.data("ui-resizable-alsoresize",{
                    width:parseInt(t.width(),10),
                    height:parseInt(t.height(),10),
                    left:parseInt(t.css("left"),10),
                    top:parseInt(t.css("top"),10)
                    })
                })
            };
            
        typeof t.alsoResize!="object"||t.alsoResize.parentNode?i(t.alsoResize):t.alsoResize.length?(t.alsoResize=t.alsoResize[0],i(t.alsoResize)):n.each(t.alsoResize,function(n){
            i(n)
            })
        },
    resize:function(t,i){
        var r=n(this).data("ui-resizable"),u=r.options,f=r.originalSize,e=r.originalPosition,s={
            height:r.size.height-f.height||0,
            width:r.size.width-f.width||0,
            top:r.position.top-e.top||0,
            left:r.position.left-e.left||0
            },o=function(t,r){
            n(t).each(function(){
                var t=n(this),f=n(this).data("ui-resizable-alsoresize"),u={},e=r&&r.length?r:t.parents(i.originalElement[0]).length?["width","height"]:["width","height","top","left"];
                n.each(e,function(n,t){
                    var i=(f[t]||0)+(s[t]||0);
                    i&&i>=0&&(u[t]=i||null)
                    });
                t.css(u)
                })
            };
            
        typeof u.alsoResize!="object"||u.alsoResize.nodeType?o(u.alsoResize):n.each(u.alsoResize,function(n,t){
            o(n,t)
            })
        },
    stop:function(){
        n(this).removeData("resizable-alsoresize")
        }
    });
n.ui.plugin.add("resizable","ghost",{
    start:function(){
        var t=n(this).data("ui-resizable"),i=t.options,r=t.size;
        t.ghost=t.originalElement.clone();
        t.ghost.css({
            opacity:.25,
            display:"block",
            position:"relative",
            height:r.height,
            width:r.width,
            margin:0,
            left:0,
            top:0
        }).addClass("ui-resizable-ghost").addClass(typeof i.ghost=="string"?i.ghost:"");
        t.ghost.appendTo(t.helper)
        },
    resize:function(){
        var t=n(this).data("ui-resizable");
        t.ghost&&t.ghost.css({
            position:"relative",
            height:t.size.height,
            width:t.size.width
            })
        },
    stop:function(){
        var t=n(this).data("ui-resizable");
        t.ghost&&t.helper&&t.helper.get(0).removeChild(t.ghost.get(0))
        }
    });
n.ui.plugin.add("resizable","grid",{
    resize:function(){
        var t=n(this).data("ui-resizable"),i=t.options,v=t.size,o=t.originalSize,s=t.originalPosition,h=t.axis,c=typeof i.grid=="number"?[i.grid,i.grid]:i.grid,f=c[0]||1,e=c[1]||1,l=Math.round((v.width-o.width)/f)*f,a=Math.round((v.height-o.height)/e)*e,r=o.width+l,u=o.height+a,y=i.maxWidth&&i.maxWidth<r,p=i.maxHeight&&i.maxHeight<u,w=i.minWidth&&i.minWidth>r,b=i.minHeight&&i.minHeight>u;
        i.grid=c;
        w&&(r=r+f);
        b&&(u=u+e);
        y&&(r=r-f);
        p&&(u=u-e);
        /^(se|s|e)$/.test(h)?(t.size.width=r,t.size.height=u):/^(ne)$/.test(h)?(t.size.width=r,t.size.height=u,t.position.top=s.top-a):/^(sw)$/.test(h)?(t.size.width=r,t.size.height=u,t.position.left=s.left-l):(u-e>0?(t.size.height=u,t.position.top=s.top-a):(t.size.height=e,t.position.top=s.top+o.height-e),r-f>0?(t.size.width=r,t.position.left=s.left-l):(t.size.width=f,t.position.left=s.left+o.width-f))
        }
    })
}(jQuery),function(n){
    n.widget("ui.selectable",n.ui.mouse,{
        version:"1.10.4",
        options:{
            appendTo:"body",
            autoRefresh:!0,
            distance:0,
            filter:"*",
            tolerance:"touch",
            selected:null,
            selecting:null,
            start:null,
            stop:null,
            unselected:null,
            unselecting:null
        },
        _create:function(){
            var t,i=this;
            this.element.addClass("ui-selectable");
            this.dragged=!1;
            this.refresh=function(){
                t=n(i.options.filter,i.element[0]);
                t.addClass("ui-selectee");
                t.each(function(){
                    var t=n(this),i=t.offset();
                    n.data(this,"selectable-item",{
                        element:this,
                        $element:t,
                        left:i.left,
                        top:i.top,
                        right:i.left+t.outerWidth(),
                        bottom:i.top+t.outerHeight(),
                        startselected:!1,
                        selected:t.hasClass("ui-selected"),
                        selecting:t.hasClass("ui-selecting"),
                        unselecting:t.hasClass("ui-unselecting")
                        })
                    })
                };
                
            this.refresh();
            this.selectees=t.addClass("ui-selectee");
            this._mouseInit();
            this.helper=n("<div class='ui-selectable-helper'><\/div>")
            },
        _destroy:function(){
            this.selectees.removeClass("ui-selectee").removeData("selectable-item");
            this.element.removeClass("ui-selectable ui-selectable-disabled");
            this._mouseDestroy()
            },
        _mouseStart:function(t){
            var i=this,r=this.options;
            (this.opos=[t.pageX,t.pageY],this.options.disabled)||(this.selectees=n(r.filter,this.element[0]),this._trigger("start",t),n(r.appendTo).append(this.helper),this.helper.css({
                left:t.pageX,
                top:t.pageY,
                width:0,
                height:0
            }),r.autoRefresh&&this.refresh(),this.selectees.filter(".ui-selected").each(function(){
                var r=n.data(this,"selectable-item");
                r.startselected=!0;
                t.metaKey||t.ctrlKey||(r.$element.removeClass("ui-selected"),r.selected=!1,r.$element.addClass("ui-unselecting"),r.unselecting=!0,i._trigger("unselecting",t,{
                    unselecting:r.element
                    }))
                }),n(t.target).parents().addBack().each(function(){
                var u,r=n.data(this,"selectable-item");
                if(r)return u=!t.metaKey&&!t.ctrlKey||!r.$element.hasClass("ui-selected"),r.$element.removeClass(u?"ui-unselecting":"ui-selected").addClass(u?"ui-selecting":"ui-unselecting"),r.unselecting=!u,r.selecting=u,r.selected=u,u?i._trigger("selecting",t,{
                    selecting:r.element
                    }):i._trigger("unselecting",t,{
                    unselecting:r.element
                    }),!1
                }))
            },
        _mouseDrag:function(t){
            if(this.dragged=!0,!this.options.disabled){
                var e,o=this,s=this.options,i=this.opos[0],r=this.opos[1],u=t.pageX,f=t.pageY;
                return i>u&&(e=u,u=i,i=e),r>f&&(e=f,f=r,r=e),this.helper.css({
                    left:i,
                    top:r,
                    width:u-i,
                    height:f-r
                    }),this.selectees.each(function(){
                    var e=n.data(this,"selectable-item"),h=!1;
                    e&&e.element!==o.element[0]&&(s.tolerance==="touch"?h=!(e.left>u||e.right<i||e.top>f||e.bottom<r):s.tolerance==="fit"&&(h=e.left>i&&e.right<u&&e.top>r&&e.bottom<f),h?(e.selected&&(e.$element.removeClass("ui-selected"),e.selected=!1),e.unselecting&&(e.$element.removeClass("ui-unselecting"),e.unselecting=!1),e.selecting||(e.$element.addClass("ui-selecting"),e.selecting=!0,o._trigger("selecting",t,{
                        selecting:e.element
                        }))):(e.selecting&&((t.metaKey||t.ctrlKey)&&e.startselected?(e.$element.removeClass("ui-selecting"),e.selecting=!1,e.$element.addClass("ui-selected"),e.selected=!0):(e.$element.removeClass("ui-selecting"),e.selecting=!1,e.startselected&&(e.$element.addClass("ui-unselecting"),e.unselecting=!0),o._trigger("unselecting",t,{
                        unselecting:e.element
                        }))),e.selected&&(t.metaKey||t.ctrlKey||e.startselected||(e.$element.removeClass("ui-selected"),e.selected=!1,e.$element.addClass("ui-unselecting"),e.unselecting=!0,o._trigger("unselecting",t,{
                        unselecting:e.element
                        })))))
                    }),!1
                }
            },
    _mouseStop:function(t){
        var i=this;
        return this.dragged=!1,n(".ui-unselecting",this.element[0]).each(function(){
            var r=n.data(this,"selectable-item");
            r.$element.removeClass("ui-unselecting");
            r.unselecting=!1;
            r.startselected=!1;
            i._trigger("unselected",t,{
                unselected:r.element
                })
            }),n(".ui-selecting",this.element[0]).each(function(){
            var r=n.data(this,"selectable-item");
            r.$element.removeClass("ui-selecting").addClass("ui-selected");
            r.selecting=!1;
            r.selected=!0;
            r.startselected=!0;
            i._trigger("selected",t,{
                selected:r.element
                })
            }),this._trigger("stop",t),this.helper.remove(),!1
        }
    })
}(jQuery),function(n){
    function t(n,t,i){
        return n>t&&n<t+i
        }
        function i(n){
        return/left|right/.test(n.css("float"))||/inline|table-cell/.test(n.css("display"))
        }
        n.widget("ui.sortable",n.ui.mouse,{
        version:"1.10.4",
        widgetEventPrefix:"sort",
        ready:!1,
        options:{
            appendTo:"parent",
            axis:!1,
            connectWith:!1,
            containment:!1,
            cursor:"auto",
            cursorAt:!1,
            dropOnEmpty:!0,
            forcePlaceholderSize:!1,
            forceHelperSize:!1,
            grid:!1,
            handle:!1,
            helper:"original",
            items:"> *",
            opacity:!1,
            placeholder:!1,
            revert:!1,
            scroll:!0,
            scrollSensitivity:20,
            scrollSpeed:20,
            scope:"default",
            tolerance:"intersect",
            zIndex:1e3,
            activate:null,
            beforeStop:null,
            change:null,
            deactivate:null,
            out:null,
            over:null,
            receive:null,
            remove:null,
            sort:null,
            start:null,
            stop:null,
            update:null
        },
        _create:function(){
            var n=this.options;
            this.containerCache={};
            
            this.element.addClass("ui-sortable");
            this.refresh();
            this.floating=this.items.length?n.axis==="x"||i(this.items[0].item):!1;
            this.offset=this.element.offset();
            this._mouseInit();
            this.ready=!0
            },
        _destroy:function(){
            this.element.removeClass("ui-sortable ui-sortable-disabled");
            this._mouseDestroy();
            for(var n=this.items.length-1;n>=0;n--)this.items[n].item.removeData(this.widgetName+"-item");
            return this
            },
        _setOption:function(t,i){
            t==="disabled"?(this.options[t]=i,this.widget().toggleClass("ui-sortable-disabled",!!i)):n.Widget.prototype._setOption.apply(this,arguments)
            },
        _mouseCapture:function(t,i){
            var r=null,f=!1,u=this;
            return this.reverting?!1:this.options.disabled||this.options.type==="static"?!1:(this._refreshItems(t),n(t.target).parents().each(function(){
                if(n.data(this,u.widgetName+"-item")===u)return r=n(this),!1
                    }),n.data(t.target,u.widgetName+"-item")===u&&(r=n(t.target)),!r)?!1:this.options.handle&&!i&&(n(this.options.handle,r).find("*").addBack().each(function(){
                this===t.target&&(f=!0)
                }),!f)?!1:(this.currentItem=r,this._removeCurrentsFromItems(),!0)
            },
        _mouseStart:function(t,i,r){
            var f,e,u=this.options;
            if(this.currentContainer=this,this.refreshPositions(),this.helper=this._createHelper(t),this._cacheHelperProportions(),this._cacheMargins(),this.scrollParent=this.helper.scrollParent(),this.offset=this.currentItem.offset(),this.offset={
                top:this.offset.top-this.margins.top,
                left:this.offset.left-this.margins.left
                },n.extend(this.offset,{
                click:{
                    left:t.pageX-this.offset.left,
                    top:t.pageY-this.offset.top
                    },
                parent:this._getParentOffset(),
                relative:this._getRelativeOffset()
                }),this.helper.css("position","absolute"),this.cssPosition=this.helper.css("position"),this.originalPosition=this._generatePosition(t),this.originalPageX=t.pageX,this.originalPageY=t.pageY,u.cursorAt&&this._adjustOffsetFromHelper(u.cursorAt),this.domPosition={
                prev:this.currentItem.prev()[0],
                parent:this.currentItem.parent()[0]
                },this.helper[0]!==this.currentItem[0]&&this.currentItem.hide(),this._createPlaceholder(),u.containment&&this._setContainment(),u.cursor&&u.cursor!=="auto"&&(e=this.document.find("body"),this.storedCursor=e.css("cursor"),e.css("cursor",u.cursor),this.storedStylesheet=n("<style>*{ cursor: "+u.cursor+" !important; }<\/style>").appendTo(e)),u.opacity&&(this.helper.css("opacity")&&(this._storedOpacity=this.helper.css("opacity")),this.helper.css("opacity",u.opacity)),u.zIndex&&(this.helper.css("zIndex")&&(this._storedZIndex=this.helper.css("zIndex")),this.helper.css("zIndex",u.zIndex)),this.scrollParent[0]!==document&&this.scrollParent[0].tagName!=="HTML"&&(this.overflowOffset=this.scrollParent.offset()),this._trigger("start",t,this._uiHash()),this._preserveHelperProportions||this._cacheHelperProportions(),!r)for(f=this.containers.length-1;f>=0;f--)this.containers[f]._trigger("activate",t,this._uiHash(this));
            return n.ui.ddmanager&&(n.ui.ddmanager.current=this),n.ui.ddmanager&&!u.dropBehaviour&&n.ui.ddmanager.prepareOffsets(this,t),this.dragging=!0,this.helper.addClass("ui-sortable-helper"),this._mouseDrag(t),!0
            },
        _mouseDrag:function(t){
            var e,u,f,o,i=this.options,r=!1;
            for(this.position=this._generatePosition(t),this.positionAbs=this._convertPositionTo("absolute"),this.lastPositionAbs||(this.lastPositionAbs=this.positionAbs),this.options.scroll&&(this.scrollParent[0]!==document&&this.scrollParent[0].tagName!=="HTML"?(this.overflowOffset.top+this.scrollParent[0].offsetHeight-t.pageY<i.scrollSensitivity?this.scrollParent[0].scrollTop=r=this.scrollParent[0].scrollTop+i.scrollSpeed:t.pageY-this.overflowOffset.top<i.scrollSensitivity&&(this.scrollParent[0].scrollTop=r=this.scrollParent[0].scrollTop-i.scrollSpeed),this.overflowOffset.left+this.scrollParent[0].offsetWidth-t.pageX<i.scrollSensitivity?this.scrollParent[0].scrollLeft=r=this.scrollParent[0].scrollLeft+i.scrollSpeed:t.pageX-this.overflowOffset.left<i.scrollSensitivity&&(this.scrollParent[0].scrollLeft=r=this.scrollParent[0].scrollLeft-i.scrollSpeed)):(t.pageY-n(document).scrollTop()<i.scrollSensitivity?r=n(document).scrollTop(n(document).scrollTop()-i.scrollSpeed):n(window).height()-(t.pageY-n(document).scrollTop())<i.scrollSensitivity&&(r=n(document).scrollTop(n(document).scrollTop()+i.scrollSpeed)),t.pageX-n(document).scrollLeft()<i.scrollSensitivity?r=n(document).scrollLeft(n(document).scrollLeft()-i.scrollSpeed):n(window).width()-(t.pageX-n(document).scrollLeft())<i.scrollSensitivity&&(r=n(document).scrollLeft(n(document).scrollLeft()+i.scrollSpeed))),r!==!1&&n.ui.ddmanager&&!i.dropBehaviour&&n.ui.ddmanager.prepareOffsets(this,t)),this.positionAbs=this._convertPositionTo("absolute"),this.options.axis&&this.options.axis==="y"||(this.helper[0].style.left=this.position.left+"px"),this.options.axis&&this.options.axis==="x"||(this.helper[0].style.top=this.position.top+"px"),e=this.items.length-1;e>=0;e--)if((u=this.items[e],f=u.item[0],o=this._intersectsWithPointer(u),o)&&u.instance===this.currentContainer&&f!==this.currentItem[0]&&this.placeholder[o===1?"next":"prev"]()[0]!==f&&!n.contains(this.placeholder[0],f)&&(this.options.type==="semi-dynamic"?!n.contains(this.element[0],f):!0)){
                if(this.direction=o===1?"down":"up",this.options.tolerance==="pointer"||this._intersectsWithSides(u))this._rearrange(t,u);else break;
                this._trigger("change",t,this._uiHash());
                break
            }
            return this._contactContainers(t),n.ui.ddmanager&&n.ui.ddmanager.drag(this,t),this._trigger("sort",t,this._uiHash()),this.lastPositionAbs=this.positionAbs,!1
            },
        _mouseStop:function(t,i){
            if(t){
                if(n.ui.ddmanager&&!this.options.dropBehaviour&&n.ui.ddmanager.drop(this,t),this.options.revert){
                    var e=this,f=this.placeholder.offset(),r=this.options.axis,u={};
                    
                    r&&r!=="x"||(u.left=f.left-this.offset.parent.left-this.margins.left+(this.offsetParent[0]===document.body?0:this.offsetParent[0].scrollLeft));
                    r&&r!=="y"||(u.top=f.top-this.offset.parent.top-this.margins.top+(this.offsetParent[0]===document.body?0:this.offsetParent[0].scrollTop));
                    this.reverting=!0;
                    n(this.helper).animate(u,parseInt(this.options.revert,10)||500,function(){
                        e._clear(t)
                        })
                    }else this._clear(t,i);
                return!1
                }
            },
    cancel:function(){
        if(this.dragging){
            this._mouseUp({
                target:null
            });
            this.options.helper==="original"?this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper"):this.currentItem.show();
            for(var t=this.containers.length-1;t>=0;t--)this.containers[t]._trigger("deactivate",null,this._uiHash(this)),this.containers[t].containerCache.over&&(this.containers[t]._trigger("out",null,this._uiHash(this)),this.containers[t].containerCache.over=0)
                }
                return this.placeholder&&(this.placeholder[0].parentNode&&this.placeholder[0].parentNode.removeChild(this.placeholder[0]),this.options.helper!=="original"&&this.helper&&this.helper[0].parentNode&&this.helper.remove(),n.extend(this,{
            helper:null,
            dragging:!1,
            reverting:!1,
            _noFinalSort:null
        }),this.domPosition.prev?n(this.domPosition.prev).after(this.currentItem):n(this.domPosition.parent).prepend(this.currentItem)),this
        },
    serialize:function(t){
        var r=this._getItemsAsjQuery(t&&t.connected),i=[];
        return t=t||{},n(r).each(function(){
            var r=(n(t.item||this).attr(t.attribute||"id")||"").match(t.expression||/(.+)[\-=_](.+)/);
            r&&i.push((t.key||r[1]+"[]")+"="+(t.key&&t.expression?r[1]:r[2]))
            }),!i.length&&t.key&&i.push(t.key+"="),i.join("&")
        },
    toArray:function(t){
        var r=this._getItemsAsjQuery(t&&t.connected),i=[];
        return t=t||{},r.each(function(){
            i.push(n(t.item||this).attr(t.attribute||"id")||"")
            }),i
        },
    _intersectsWith:function(n){
        var t=this.positionAbs.left,h=t+this.helperProportions.width,i=this.positionAbs.top,c=i+this.helperProportions.height,r=n.left,f=r+n.width,u=n.top,e=u+n.height,o=this.offset.click.top,s=this.offset.click.left,l=this.options.axis==="x"||i+o>u&&i+o<e,a=this.options.axis==="y"||t+s>r&&t+s<f,v=l&&a;
        return this.options.tolerance==="pointer"||this.options.forcePointerForContainers||this.options.tolerance!=="pointer"&&this.helperProportions[this.floating?"width":"height"]>n[this.floating?"width":"height"]?v:r<t+this.helperProportions.width/2&&h-this.helperProportions.width/2<f&&u<i+this.helperProportions.height/2&&c-this.helperProportions.height/2<e
        },
    _intersectsWithPointer:function(n){
        var u=this.options.axis==="x"||t(this.positionAbs.top+this.offset.click.top,n.top,n.height),f=this.options.axis==="y"||t(this.positionAbs.left+this.offset.click.left,n.left,n.width),e=u&&f,i=this._getDragVerticalDirection(),r=this._getDragHorizontalDirection();
        return e?this.floating?r&&r==="right"||i==="down"?2:1:i&&(i==="down"?2:1):!1
        },
    _intersectsWithSides:function(n){
        var u=t(this.positionAbs.top+this.offset.click.top,n.top+n.height/2,n.height),f=t(this.positionAbs.left+this.offset.click.left,n.left+n.width/2,n.width),i=this._getDragVerticalDirection(),r=this._getDragHorizontalDirection();
        return this.floating&&r?r==="right"&&f||r==="left"&&!f:i&&(i==="down"&&u||i==="up"&&!u)
        },
    _getDragVerticalDirection:function(){
        var n=this.positionAbs.top-this.lastPositionAbs.top;
        return n!==0&&(n>0?"down":"up")
        },
    _getDragHorizontalDirection:function(){
        var n=this.positionAbs.left-this.lastPositionAbs.left;
        return n!==0&&(n>0?"right":"left")
        },
    refresh:function(n){
        return this._refreshItems(n),this.refreshPositions(),this
        },
    _connectWith:function(){
        var n=this.options;
        return n.connectWith.constructor===String?[n.connectWith]:n.connectWith
        },
    _getItemsAsjQuery:function(t){
        function h(){
            s.push(this)
            }
            var r,u,e,i,s=[],f=[],o=this._connectWith();
        if(o&&t)for(r=o.length-1;r>=0;r--)for(e=n(o[r]),u=e.length-1;u>=0;u--)i=n.data(e[u],this.widgetFullName),i&&i!==this&&!i.options.disabled&&f.push([n.isFunction(i.options.items)?i.options.items.call(i.element):n(i.options.items,i.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),i]);
        for(f.push([n.isFunction(this.options.items)?this.options.items.call(this.element,null,{
            options:this.options,
            item:this.currentItem
            }):n(this.options.items,this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),this]),r=f.length-1;r>=0;r--)f[r][0].each(h);
        return n(s)
        },
    _removeCurrentsFromItems:function(){
        var t=this.currentItem.find(":data("+this.widgetName+"-item)");
        this.items=n.grep(this.items,function(n){
            for(var i=0;i<t.length;i++)if(t[i]===n.item[0])return!1;return!0
            })
        },
    _refreshItems:function(t){
        this.items=[];
        this.containers=[this];
        var r,u,e,i,o,s,h,l,a=this.items,f=[[n.isFunction(this.options.items)?this.options.items.call(this.element[0],t,{
            item:this.currentItem
            }):n(this.options.items,this.element),this]],c=this._connectWith();
        if(c&&this.ready)for(r=c.length-1;r>=0;r--)for(e=n(c[r]),u=e.length-1;u>=0;u--)i=n.data(e[u],this.widgetFullName),i&&i!==this&&!i.options.disabled&&(f.push([n.isFunction(i.options.items)?i.options.items.call(i.element[0],t,{
            item:this.currentItem
            }):n(i.options.items,i.element),i]),this.containers.push(i));
        for(r=f.length-1;r>=0;r--)for(o=f[r][1],s=f[r][0],u=0,l=s.length;u<l;u++)h=n(s[u]),h.data(this.widgetName+"-item",o),a.push({
            item:h,
            instance:o,
            width:0,
            height:0,
            left:0,
            top:0
        })
        },
    refreshPositions:function(t){
        this.offsetParent&&this.helper&&(this.offset.parent=this._getParentOffset());
        for(var r,f,u,i=this.items.length-1;i>=0;i--)(r=this.items[i],r.instance!==this.currentContainer&&this.currentContainer&&r.item[0]!==this.currentItem[0])||(f=this.options.toleranceElement?n(this.options.toleranceElement,r.item):r.item,t||(r.width=f.outerWidth(),r.height=f.outerHeight()),u=f.offset(),r.left=u.left,r.top=u.top);
        if(this.options.custom&&this.options.custom.refreshContainers)this.options.custom.refreshContainers.call(this);else for(i=this.containers.length-1;i>=0;i--)u=this.containers[i].element.offset(),this.containers[i].containerCache.left=u.left,this.containers[i].containerCache.top=u.top,this.containers[i].containerCache.width=this.containers[i].element.outerWidth(),this.containers[i].containerCache.height=this.containers[i].element.outerHeight();
        return this
        },
    _createPlaceholder:function(t){
        t=t||this;
        var r,i=t.options;
        i.placeholder&&i.placeholder.constructor!==String||(r=i.placeholder,i.placeholder={
            element:function(){
                var u=t.currentItem[0].nodeName.toLowerCase(),i=n("<"+u+">",t.document[0]).addClass(r||t.currentItem[0].className+" ui-sortable-placeholder").removeClass("ui-sortable-helper");
                return u==="tr"?t.currentItem.children().each(function(){
                    n("<td>&#160;<\/td>",t.document[0]).attr("colspan",n(this).attr("colspan")||1).appendTo(i)
                    }):u==="img"&&i.attr("src",t.currentItem.attr("src")),r||i.css("visibility","hidden"),i
                },
            update:function(n,u){
                (!r||i.forcePlaceholderSize)&&(u.height()||u.height(t.currentItem.innerHeight()-parseInt(t.currentItem.css("paddingTop")||0,10)-parseInt(t.currentItem.css("paddingBottom")||0,10)),u.width()||u.width(t.currentItem.innerWidth()-parseInt(t.currentItem.css("paddingLeft")||0,10)-parseInt(t.currentItem.css("paddingRight")||0,10)))
                }
            });
    t.placeholder=n(i.placeholder.element.call(t.element,t.currentItem));
        t.currentItem.after(t.placeholder);
        i.placeholder.update(t,t.placeholder)
        },
    _contactContainers:function(r){
        for(var f,v,s,l,y,h,o,p,a,c=null,e=null,u=this.containers.length-1;u>=0;u--)if(!n.contains(this.currentItem[0],this.containers[u].element[0]))if(this._intersectsWith(this.containers[u].containerCache)){
            if(c&&n.contains(this.containers[u].element[0],c.element[0]))continue;
            c=this.containers[u];
            e=u
            }else this.containers[u].containerCache.over&&(this.containers[u]._trigger("out",r,this._uiHash(this)),this.containers[u].containerCache.over=0);if(c)if(this.containers.length===1)this.containers[e].containerCache.over||(this.containers[e]._trigger("over",r,this._uiHash(this)),this.containers[e].containerCache.over=1);
            else{
            for(v=1e4,s=null,a=c.floating||i(this.currentItem),l=a?"left":"top",y=a?"width":"height",h=this.positionAbs[l]+this.offset.click[l],f=this.items.length-1;f>=0;f--)n.contains(this.containers[e].element[0],this.items[f].item[0])&&this.items[f].item[0]!==this.currentItem[0]&&(!a||t(this.positionAbs.top+this.offset.click.top,this.items[f].top,this.items[f].height))&&(o=this.items[f].item.offset()[l],p=!1,Math.abs(o-h)>Math.abs(o+this.items[f][y]-h)&&(p=!0,o+=this.items[f][y]),Math.abs(o-h)<v&&(v=Math.abs(o-h),s=this.items[f],this.direction=p?"up":"down"));
            if(!s&&!this.options.dropOnEmpty)return;
            if(this.currentContainer===this.containers[e])return;
            s?this._rearrange(r,s,null,!0):this._rearrange(r,null,this.containers[e].element,!0);
            this._trigger("change",r,this._uiHash());
            this.containers[e]._trigger("change",r,this._uiHash(this));
            this.currentContainer=this.containers[e];
            this.options.placeholder.update(this.currentContainer,this.placeholder);
            this.containers[e]._trigger("over",r,this._uiHash(this));
            this.containers[e].containerCache.over=1
            }
        },
_createHelper:function(t){
    var r=this.options,i=n.isFunction(r.helper)?n(r.helper.apply(this.element[0],[t,this.currentItem])):r.helper==="clone"?this.currentItem.clone():this.currentItem;
    return i.parents("body").length||n(r.appendTo!=="parent"?r.appendTo:this.currentItem[0].parentNode)[0].appendChild(i[0]),i[0]===this.currentItem[0]&&(this._storedCSS={
        width:this.currentItem[0].style.width,
        height:this.currentItem[0].style.height,
        position:this.currentItem.css("position"),
        top:this.currentItem.css("top"),
        left:this.currentItem.css("left")
        }),(!i[0].style.width||r.forceHelperSize)&&i.width(this.currentItem.width()),(!i[0].style.height||r.forceHelperSize)&&i.height(this.currentItem.height()),i
    },
_adjustOffsetFromHelper:function(t){
    typeof t=="string"&&(t=t.split(" "));
    n.isArray(t)&&(t={
        left:+t[0],
        top:+t[1]||0
        });
    "left"in t&&(this.offset.click.left=t.left+this.margins.left);
    "right"in t&&(this.offset.click.left=this.helperProportions.width-t.right+this.margins.left);
    "top"in t&&(this.offset.click.top=t.top+this.margins.top);
    "bottom"in t&&(this.offset.click.top=this.helperProportions.height-t.bottom+this.margins.top)
    },
_getParentOffset:function(){
    this.offsetParent=this.helper.offsetParent();
    var t=this.offsetParent.offset();
    return this.cssPosition==="absolute"&&this.scrollParent[0]!==document&&n.contains(this.scrollParent[0],this.offsetParent[0])&&(t.left+=this.scrollParent.scrollLeft(),t.top+=this.scrollParent.scrollTop()),(this.offsetParent[0]===document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()==="html"&&n.ui.ie)&&(t={
        top:0,
        left:0
    }),{
        top:t.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),
        left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)
        }
    },
_getRelativeOffset:function(){
    if(this.cssPosition==="relative"){
        var n=this.currentItem.position();
        return{
            top:n.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),
            left:n.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()
            }
        }
    return{
    top:0,
    left:0
}
},
_cacheMargins:function(){
    this.margins={
        left:parseInt(this.currentItem.css("marginLeft"),10)||0,
        top:parseInt(this.currentItem.css("marginTop"),10)||0
        }
    },
_cacheHelperProportions:function(){
    this.helperProportions={
        width:this.helper.outerWidth(),
        height:this.helper.outerHeight()
        }
    },
_setContainment:function(){
    var t,r,u,i=this.options;
    i.containment==="parent"&&(i.containment=this.helper[0].parentNode);
    (i.containment==="document"||i.containment==="window")&&(this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,n(i.containment==="document"?document:window).width()-this.helperProportions.width-this.margins.left,(n(i.containment==="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top]);
    /^(document|window|parent)$/.test(i.containment)||(t=n(i.containment)[0],r=n(i.containment).offset(),u=n(t).css("overflow")!=="hidden",this.containment=[r.left+(parseInt(n(t).css("borderLeftWidth"),10)||0)+(parseInt(n(t).css("paddingLeft"),10)||0)-this.margins.left,r.top+(parseInt(n(t).css("borderTopWidth"),10)||0)+(parseInt(n(t).css("paddingTop"),10)||0)-this.margins.top,r.left+(u?Math.max(t.scrollWidth,t.offsetWidth):t.offsetWidth)-(parseInt(n(t).css("borderLeftWidth"),10)||0)-(parseInt(n(t).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,r.top+(u?Math.max(t.scrollHeight,t.offsetHeight):t.offsetHeight)-(parseInt(n(t).css("borderTopWidth"),10)||0)-(parseInt(n(t).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top])
    },
_convertPositionTo:function(t,i){
    i||(i=this.position);
    var r=t==="absolute"?1:-1,u=this.cssPosition==="absolute"&&!(this.scrollParent[0]!==document&&n.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,f=/(html|body)/i.test(u[0].tagName);
    return{
        top:i.top+this.offset.relative.top*r+this.offset.parent.top*r-(this.cssPosition==="fixed"?-this.scrollParent.scrollTop():f?0:u.scrollTop())*r,
        left:i.left+this.offset.relative.left*r+this.offset.parent.left*r-(this.cssPosition==="fixed"?-this.scrollParent.scrollLeft():f?0:u.scrollLeft())*r
        }
    },
_generatePosition:function(t){
    var r,u,i=this.options,f=t.pageX,e=t.pageY,o=this.cssPosition==="absolute"&&!(this.scrollParent[0]!==document&&n.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,s=/(html|body)/i.test(o[0].tagName);
    return this.cssPosition!=="relative"||this.scrollParent[0]!==document&&this.scrollParent[0]!==this.offsetParent[0]||(this.offset.relative=this._getRelativeOffset()),this.originalPosition&&(this.containment&&(t.pageX-this.offset.click.left<this.containment[0]&&(f=this.containment[0]+this.offset.click.left),t.pageY-this.offset.click.top<this.containment[1]&&(e=this.containment[1]+this.offset.click.top),t.pageX-this.offset.click.left>this.containment[2]&&(f=this.containment[2]+this.offset.click.left),t.pageY-this.offset.click.top>this.containment[3]&&(e=this.containment[3]+this.offset.click.top)),i.grid&&(r=this.originalPageY+Math.round((e-this.originalPageY)/i.grid[1])*i.grid[1],e=this.containment?r-this.offset.click.top>=this.containment[1]&&r-this.offset.click.top<=this.containment[3]?r:r-this.offset.click.top>=this.containment[1]?r-i.grid[1]:r+i.grid[1]:r,u=this.originalPageX+Math.round((f-this.originalPageX)/i.grid[0])*i.grid[0],f=this.containment?u-this.offset.click.left>=this.containment[0]&&u-this.offset.click.left<=this.containment[2]?u:u-this.offset.click.left>=this.containment[0]?u-i.grid[0]:u+i.grid[0]:u)),{
        top:e-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(this.cssPosition==="fixed"?-this.scrollParent.scrollTop():s?0:o.scrollTop()),
        left:f-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(this.cssPosition==="fixed"?-this.scrollParent.scrollLeft():s?0:o.scrollLeft())
        }
    },
_rearrange:function(n,t,i,r){
    i?i[0].appendChild(this.placeholder[0]):t.item[0].parentNode.insertBefore(this.placeholder[0],this.direction==="down"?t.item[0]:t.item[0].nextSibling);
    this.counter=this.counter?++this.counter:1;
    var u=this.counter;
    this._delay(function(){
        u===this.counter&&this.refreshPositions(!r)
        })
    },
_clear:function(n,t){
    function u(n,t,i){
        return function(r){
            i._trigger(n,r,t._uiHash(t))
            }
        }
    this.reverting=!1;
var i,r=[];
if(!this._noFinalSort&&this.currentItem.parent().length&&this.placeholder.before(this.currentItem),this._noFinalSort=null,this.helper[0]===this.currentItem[0]){
    for(i in this._storedCSS)(this._storedCSS[i]==="auto"||this._storedCSS[i]==="static")&&(this._storedCSS[i]="");this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")
    }else this.currentItem.show();
for(this.fromOutside&&!t&&r.push(function(n){
    this._trigger("receive",n,this._uiHash(this.fromOutside))
    }),(this.fromOutside||this.domPosition.prev!==this.currentItem.prev().not(".ui-sortable-helper")[0]||this.domPosition.parent!==this.currentItem.parent()[0])&&!t&&r.push(function(n){
    this._trigger("update",n,this._uiHash())
    }),this!==this.currentContainer&&(t||(r.push(function(n){
    this._trigger("remove",n,this._uiHash())
    }),r.push(function(n){
    return function(t){
        n._trigger("receive",t,this._uiHash(this))
        }
    }.call(this,this.currentContainer)),r.push(function(n){
    return function(t){
        n._trigger("update",t,this._uiHash(this))
        }
    }.call(this,this.currentContainer)))),i=this.containers.length-1;i>=0;i--)t||r.push(u("deactivate",this,this.containers[i])),this.containers[i].containerCache.over&&(r.push(u("out",this,this.containers[i])),this.containers[i].containerCache.over=0);
if(this.storedCursor&&(this.document.find("body").css("cursor",this.storedCursor),this.storedStylesheet.remove()),this._storedOpacity&&this.helper.css("opacity",this._storedOpacity),this._storedZIndex&&this.helper.css("zIndex",this._storedZIndex==="auto"?"":this._storedZIndex),this.dragging=!1,this.cancelHelperRemoval){
    if(!t){
        for(this._trigger("beforeStop",n,this._uiHash()),i=0;i<r.length;i++)r[i].call(this,n);
        this._trigger("stop",n,this._uiHash())
        }
        return this.fromOutside=!1,!1
    }
    if(t||this._trigger("beforeStop",n,this._uiHash()),this.placeholder[0].parentNode.removeChild(this.placeholder[0]),this.helper[0]!==this.currentItem[0]&&this.helper.remove(),this.helper=null,!t){
    for(i=0;i<r.length;i++)r[i].call(this,n);
    this._trigger("stop",n,this._uiHash())
    }
    return this.fromOutside=!1,!0
},
_trigger:function(){
    n.Widget.prototype._trigger.apply(this,arguments)===!1&&this.cancel()
    },
_uiHash:function(t){
    var i=t||this;
    return{
        helper:i.helper,
        placeholder:i.placeholder||n([]),
        position:i.position,
        originalPosition:i.originalPosition,
        offset:i.positionAbs,
        item:i.currentItem,
        sender:t?t.element:null
        }
    }
})
}(jQuery),function(n){
    var r=0,t={},i={};
    
    t.height=t.paddingTop=t.paddingBottom=t.borderTopWidth=t.borderBottomWidth="hide";
    i.height=i.paddingTop=i.paddingBottom=i.borderTopWidth=i.borderBottomWidth="show";
    n.widget("ui.accordion",{
        version:"1.10.4",
        options:{
            active:0,
            animate:{},
            collapsible:!1,
            event:"click",
            header:"> li > :first-child,> :not(li):even",
            heightStyle:"auto",
            icons:{
                activeHeader:"ui-icon-triangle-1-s",
                header:"ui-icon-triangle-1-e"
            },
            activate:null,
            beforeActivate:null
        },
        _create:function(){
            var t=this.options;
            this.prevShow=this.prevHide=n();
            this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role","tablist");
            t.collapsible||t.active!==!1&&t.active!=null||(t.active=0);
            this._processPanels();
            t.active<0&&(t.active+=this.headers.length);
            this._refresh()
            },
        _getCreateEventData:function(){
            return{
                header:this.active,
                panel:this.active.length?this.active.next():n(),
                content:this.active.length?this.active.next():n()
                }
            },
    _createIcons:function(){
        var t=this.options.icons;
        t&&(n("<span>").addClass("ui-accordion-header-icon ui-icon "+t.header).prependTo(this.headers),this.active.children(".ui-accordion-header-icon").removeClass(t.header).addClass(t.activeHeader),this.headers.addClass("ui-accordion-icons"))
        },
    _destroyIcons:function(){
        this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove()
        },
    _destroy:function(){
        var n;
        this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role");
        this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").each(function(){
            /^ui-accordion/.test(this.id)&&this.removeAttribute("id")
            });
        this._destroyIcons();
        n=this.headers.next().css("display","").removeAttr("role").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").each(function(){
            /^ui-accordion/.test(this.id)&&this.removeAttribute("id")
            });
        this.options.heightStyle!=="content"&&n.css("height","")
        },
    _setOption:function(n,t){
        if(n==="active"){
            this._activate(t);
            return
        }
        n==="event"&&(this.options.event&&this._off(this.headers,this.options.event),this._setupEvents(t));
        this._super(n,t);
        n!=="collapsible"||t||this.options.active!==!1||this._activate(0);
        n==="icons"&&(this._destroyIcons(),t&&this._createIcons());
        n==="disabled"&&this.headers.add(this.headers.next()).toggleClass("ui-state-disabled",!!t)
        },
    _keydown:function(t){
        if(!t.altKey&&!t.ctrlKey){
            var i=n.ui.keyCode,u=this.headers.length,f=this.headers.index(t.target),r=!1;
            switch(t.keyCode){
                case i.RIGHT:case i.DOWN:
                    r=this.headers[(f+1)%u];
                    break;
                case i.LEFT:case i.UP:
                    r=this.headers[(f-1+u)%u];
                    break;
                case i.SPACE:case i.ENTER:
                    this._eventHandler(t);
                    break;
                case i.HOME:
                    r=this.headers[0];
                    break;
                case i.END:
                    r=this.headers[u-1]
                    }
                    r&&(n(t.target).attr("tabIndex",-1),n(r).attr("tabIndex",0),r.focus(),t.preventDefault())
            }
        },
    _panelKeyDown:function(t){
        t.keyCode===n.ui.keyCode.UP&&t.ctrlKey&&n(t.currentTarget).prev().focus()
        },
    refresh:function(){
        var t=this.options;
        this._processPanels();
        (t.active!==!1||t.collapsible!==!0)&&this.headers.length?t.active===!1?this._activate(0):this.active.length&&!n.contains(this.element[0],this.active[0])?this.headers.length===this.headers.find(".ui-state-disabled").length?(t.active=!1,this.active=n()):this._activate(Math.max(0,t.active-1)):t.active=this.headers.index(this.active):(t.active=!1,this.active=n());
        this._destroyIcons();
        this._refresh()
        },
    _processPanels:function(){
        this.headers=this.element.find(this.options.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all");
        this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide()
        },
    _refresh:function(){
        var t,i=this.options,u=i.heightStyle,e=this.element.parent(),f=this.accordionId="ui-accordion-"+(this.element.attr("id")||++r);
        this.active=this._findActive(i.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all");
        this.active.next().addClass("ui-accordion-content-active").show();
        this.headers.attr("role","tab").each(function(t){
            var i=n(this),r=i.attr("id"),e=i.next(),u=e.attr("id");
            r||(r=f+"-header-"+t,i.attr("id",r));
            u||(u=f+"-panel-"+t,e.attr("id",u));
            i.attr("aria-controls",u);
            e.attr("aria-labelledby",r)
            }).next().attr("role","tabpanel");
        this.headers.not(this.active).attr({
            "aria-selected":"false",
            "aria-expanded":"false",
            tabIndex:-1
        }).next().attr({
            "aria-hidden":"true"
        }).hide();
        this.active.length?this.active.attr({
            "aria-selected":"true",
            "aria-expanded":"true",
            tabIndex:0
        }).next().attr({
            "aria-hidden":"false"
        }):this.headers.eq(0).attr("tabIndex",0);
        this._createIcons();
        this._setupEvents(i.event);
        u==="fill"?(t=e.height(),this.element.siblings(":visible").each(function(){
            var i=n(this),r=i.css("position");
            r!=="absolute"&&r!=="fixed"&&(t-=i.outerHeight(!0))
            }),this.headers.each(function(){
            t-=n(this).outerHeight(!0)
            }),this.headers.next().each(function(){
            n(this).height(Math.max(0,t-n(this).innerHeight()+n(this).height()))
            }).css("overflow","auto")):u==="auto"&&(t=0,this.headers.next().each(function(){
            t=Math.max(t,n(this).css("height","").height())
            }).height(t))
        },
    _activate:function(t){
        var i=this._findActive(t)[0];
        i!==this.active[0]&&(i=i||this.active[0],this._eventHandler({
            target:i,
            currentTarget:i,
            preventDefault:n.noop
            }))
        },
    _findActive:function(t){
        return typeof t=="number"?this.headers.eq(t):n()
        },
    _setupEvents:function(t){
        var i={
            keydown:"_keydown"
        };
        
        t&&n.each(t.split(" "),function(n,t){
            i[t]="_eventHandler"
            });
        this._off(this.headers.add(this.headers.next()));
        this._on(this.headers,i);
        this._on(this.headers.next(),{
            keydown:"_panelKeyDown"
        });
        this._hoverable(this.headers);
        this._focusable(this.headers)
        },
    _eventHandler:function(t){
        var i=this.options,u=this.active,r=n(t.currentTarget),f=r[0]===u[0],e=f&&i.collapsible,s=e?n():r.next(),h=u.next(),o={
            oldHeader:u,
            oldPanel:h,
            newHeader:e?n():r,
            newPanel:s
        };
        (t.preventDefault(),(!f||i.collapsible)&&this._trigger("beforeActivate",t,o)!==!1)&&(i.active=e?!1:this.headers.index(r),this.active=f?n():r,this._toggle(o),u.removeClass("ui-accordion-header-active ui-state-active"),i.icons&&u.children(".ui-accordion-header-icon").removeClass(i.icons.activeHeader).addClass(i.icons.header),f||(r.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"),i.icons&&r.children(".ui-accordion-header-icon").removeClass(i.icons.header).addClass(i.icons.activeHeader),r.next().addClass("ui-accordion-content-active")))
        },
    _toggle:function(t){
        var r=t.newPanel,i=this.prevShow.length?this.prevShow:t.oldPanel;
        this.prevShow.add(this.prevHide).stop(!0,!0);
        this.prevShow=r;
        this.prevHide=i;
        this.options.animate?this._animate(r,i,t):(i.hide(),r.show(),this._toggleComplete(t));
        i.attr({
            "aria-hidden":"true"
        });
        i.prev().attr("aria-selected","false");
        r.length&&i.length?i.prev().attr({
            tabIndex:-1,
            "aria-expanded":"false"
        }):r.length&&this.headers.filter(function(){
            return n(this).attr("tabIndex")===0
            }).attr("tabIndex",-1);
        r.attr("aria-hidden","false").prev().attr({
            "aria-selected":"true",
            tabIndex:0,
            "aria-expanded":"true"
        })
        },
    _animate:function(n,r,u){
        var l,f,e,a=this,h=0,v=n.length&&(!r.length||n.index()<r.index()),s=this.options.animate||{},o=v&&s.down||s,c=function(){
            a._toggleComplete(u)
            };
            
        if(typeof o=="number"&&(e=o),typeof o=="string"&&(f=o),f=f||o.easing||s.easing,e=e||o.duration||s.duration,!r.length)return n.animate(i,e,f,c);
        if(!n.length)return r.animate(t,e,f,c);
        l=n.show().outerHeight();
        r.animate(t,{
            duration:e,
            easing:f,
            step:function(n,t){
                t.now=Math.round(n)
                }
            });
    n.hide().animate(i,{
        duration:e,
        easing:f,
        complete:c,
        step:function(n,t){
            t.now=Math.round(n);
            t.prop!=="height"?h+=t.now:a.options.heightStyle!=="content"&&(t.now=Math.round(l-r.outerHeight()-h),h=0)
            }
        })
},
_toggleComplete:function(n){
    var t=n.oldPanel;
    t.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all");
    t.length&&(t.parent()[0].className=t.parent()[0].className);
    this._trigger("activate",null,n)
    }
})
}(jQuery),function(n){
    n.widget("ui.autocomplete",{
        version:"1.10.4",
        defaultElement:"<input>",
        options:{
            appendTo:null,
            autoFocus:!1,
            delay:300,
            minLength:1,
            position:{
                my:"left top",
                at:"left bottom",
                collision:"none"
            },
            source:null,
            change:null,
            close:null,
            focus:null,
            open:null,
            response:null,
            search:null,
            select:null
        },
        requestIndex:0,
        pending:0,
        _create:function(){
            var t,i,r,u=this.element[0].nodeName.toLowerCase(),f=u==="textarea",e=u==="input";
            this.isMultiLine=f?!0:e?!1:this.element.prop("isContentEditable");
            this.valueMethod=this.element[f||e?"val":"text"];
            this.isNewMenu=!0;
            this.element.addClass("ui-autocomplete-input").attr("autocomplete","off");
            this._on(this.element,{
                keydown:function(u){
                    if(this.element.prop("readOnly")){
                        t=!0;
                        r=!0;
                        i=!0;
                        return
                    }
                    t=!1;
                    r=!1;
                    i=!1;
                    var f=n.ui.keyCode;
                    switch(u.keyCode){
                        case f.PAGE_UP:
                            t=!0;
                            this._move("previousPage",u);
                            break;
                        case f.PAGE_DOWN:
                            t=!0;
                            this._move("nextPage",u);
                            break;
                        case f.UP:
                            t=!0;
                            this._keyEvent("previous",u);
                            break;
                        case f.DOWN:
                            t=!0;
                            this._keyEvent("next",u);
                            break;
                        case f.ENTER:case f.NUMPAD_ENTER:
                            this.menu.active&&(t=!0,u.preventDefault(),this.menu.select(u));
                            break;
                        case f.TAB:
                            this.menu.active&&this.menu.select(u);
                            break;
                        case f.ESCAPE:
                            this.menu.element.is(":visible")&&(this._value(this.term),this.close(u),u.preventDefault());
                            break;
                        default:
                            i=!0;
                            this._searchTimeout(u)
                            }
                        },
            keypress:function(r){
                if(t){
                    t=!1;
                    (!this.isMultiLine||this.menu.element.is(":visible"))&&r.preventDefault();
                    return
                }
                if(!i){
                    var u=n.ui.keyCode;
                    switch(r.keyCode){
                        case u.PAGE_UP:
                            this._move("previousPage",r);
                            break;
                        case u.PAGE_DOWN:
                            this._move("nextPage",r);
                            break;
                        case u.UP:
                            this._keyEvent("previous",r);
                            break;
                        case u.DOWN:
                            this._keyEvent("next",r)
                            }
                        }
            },
        input:function(n){
            if(r){
                r=!1;
                n.preventDefault();
                return
            }
            this._searchTimeout(n)
            },
        focus:function(){
            this.selectedItem=null;
            this.previous=this._value()
            },
        blur:function(n){
            if(this.cancelBlur){
                delete this.cancelBlur;
                return
            }
            clearTimeout(this.searching);
            this.close(n);
            this._change(n)
            }
        });
this._initSource();
this.menu=n("<ul>").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({
    role:null
}).hide().data("ui-menu");
this._on(this.menu.element,{
    mousedown:function(t){
        t.preventDefault();
        this.cancelBlur=!0;
        this._delay(function(){
            delete this.cancelBlur
            });
        var i=this.menu.element[0];
        n(t.target).closest(".ui-menu-item").length||this._delay(function(){
            var t=this;
            this.document.one("mousedown",function(r){
                r.target===t.element[0]||r.target===i||n.contains(i,r.target)||t.close()
                })
            })
        },
    menufocus:function(t,i){
        if(this.isNewMenu&&(this.isNewMenu=!1,t.originalEvent&&/^mouse/.test(t.originalEvent.type))){
            this.menu.blur();
            this.document.one("mousemove",function(){
                n(t.target).trigger(t.originalEvent)
                });
            return
        }
        var r=i.item.data("ui-autocomplete-item");
        !1!==this._trigger("focus",t,{
            item:r
        })?t.originalEvent&&/^key/.test(t.originalEvent.type)&&this._value(r.value):this.liveRegion.text(r.value)
        },
    menuselect:function(n,t){
        var i=t.item.data("ui-autocomplete-item"),r=this.previous;
        this.element[0]!==this.document[0].activeElement&&(this.element.focus(),this.previous=r,this._delay(function(){
            this.previous=r;
            this.selectedItem=i
            }));
        !1!==this._trigger("select",n,{
            item:i
        })&&this._value(i.value);
        this.term=this._value();
        this.close(n);
        this.selectedItem=i
        }
    });
this.liveRegion=n("<span>",{
    role:"status",
    "aria-live":"polite"
}).addClass("ui-helper-hidden-accessible").insertBefore(this.element);
this._on(this.window,{
    beforeunload:function(){
        this.element.removeAttr("autocomplete")
        }
    })
},
_destroy:function(){
    clearTimeout(this.searching);
    this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete");
    this.menu.element.remove();
    this.liveRegion.remove()
    },
_setOption:function(n,t){
    this._super(n,t);
    n==="source"&&this._initSource();
    n==="appendTo"&&this.menu.element.appendTo(this._appendTo());
    n==="disabled"&&t&&this.xhr&&this.xhr.abort()
    },
_appendTo:function(){
    var t=this.options.appendTo;
    return t&&(t=t.jquery||t.nodeType?n(t):this.document.find(t).eq(0)),t||(t=this.element.closest(".ui-front")),t.length||(t=this.document[0].body),t
    },
_initSource:function(){
    var i,r,t=this;
    n.isArray(this.options.source)?(i=this.options.source,this.source=function(t,r){
        r(n.ui.autocomplete.filter(i,t.term))
        }):typeof this.options.source=="string"?(r=this.options.source,this.source=function(i,u){
        t.xhr&&t.xhr.abort();
        t.xhr=n.ajax({
            url:r,
            data:i,
            dataType:"json",
            success:function(n){
                u(n)
                },
            error:function(){
                u([])
                }
            })
    }):this.source=this.options.source
},
_searchTimeout:function(n){
    clearTimeout(this.searching);
    this.searching=this._delay(function(){
        this.term!==this._value()&&(this.selectedItem=null,this.search(null,n))
        },this.options.delay)
    },
search:function(n,t){
    return(n=n!=null?n:this._value(),this.term=this._value(),n.length<this.options.minLength)?this.close(t):this._trigger("search",t)===!1?void 0:this._search(n)
    },
_search:function(n){
    this.pending++;
    this.element.addClass("ui-autocomplete-loading");
    this.cancelSearch=!1;
    this.source({
        term:n
    },this._response())
    },
_response:function(){
    var t=++this.requestIndex;
    return n.proxy(function(n){
        t===this.requestIndex&&this.__response(n);
        this.pending--;
        this.pending||this.element.removeClass("ui-autocomplete-loading")
        },this)
    },
__response:function(n){
    n&&(n=this._normalize(n));
    this._trigger("response",null,{
        content:n
    });
    !this.options.disabled&&n&&n.length&&!this.cancelSearch?(this._suggest(n),this._trigger("open")):this._close()
    },
close:function(n){
    this.cancelSearch=!0;
    this._close(n)
    },
_close:function(n){
    this.menu.element.is(":visible")&&(this.menu.element.hide(),this.menu.blur(),this.isNewMenu=!0,this._trigger("close",n))
    },
_change:function(n){
    this.previous!==this._value()&&this._trigger("change",n,{
        item:this.selectedItem
        })
    },
_normalize:function(t){
    return t.length&&t[0].label&&t[0].value?t:n.map(t,function(t){
        return typeof t=="string"?{
            label:t,
            value:t
        }:n.extend({
            label:t.label||t.value,
            value:t.value||t.label
            },t)
        })
    },
_suggest:function(t){
    var i=this.menu.element.empty();
    this._renderMenu(i,t);
    this.isNewMenu=!0;
    this.menu.refresh();
    i.show();
    this._resizeMenu();
    i.position(n.extend({
        of:this.element
        },this.options.position));
    this.options.autoFocus&&this.menu.next()
    },
_resizeMenu:function(){
    var n=this.menu.element;
    n.outerWidth(Math.max(n.width("").outerWidth()+1,this.element.outerWidth()))
    },
_renderMenu:function(t,i){
    var r=this;
    n.each(i,function(n,i){
        r._renderItemData(t,i)
        })
    },
_renderItemData:function(n,t){
    return this._renderItem(n,t).data("ui-autocomplete-item",t)
    },
_renderItem:function(t,i){
    return n("<li>").append(n("<a>").text(i.label)).appendTo(t)
    },
_move:function(n,t){
    if(!this.menu.element.is(":visible")){
        this.search(null,t);
        return
    }
    if(this.menu.isFirstItem()&&/^previous/.test(n)||this.menu.isLastItem()&&/^next/.test(n)){
        this._value(this.term);
        this.menu.blur();
        return
    }
    this.menu[n](t)
    },
widget:function(){
    return this.menu.element
    },
_value:function(){
    return this.valueMethod.apply(this.element,arguments)
    },
_keyEvent:function(n,t){
    (!this.isMultiLine||this.menu.element.is(":visible"))&&(this._move(n,t),t.preventDefault())
    }
});
n.extend(n.ui.autocomplete,{
    escapeRegex:function(n){
        return n.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&")
        },
    filter:function(t,i){
        var r=new RegExp(n.ui.autocomplete.escapeRegex(i),"i");
        return n.grep(t,function(n){
            return r.test(n.label||n.value||n)
            })
        }
    });
n.widget("ui.autocomplete",n.ui.autocomplete,{
    options:{
        messages:{
            noResults:"No search results.",
            results:function(n){
                return n+(n>1?" results are":" result is")+" available, use up and down arrow keys to navigate."
                }
            }
    },
__response:function(n){
    var t;
    (this._superApply(arguments),this.options.disabled||this.cancelSearch)||(t=n&&n.length?this.options.messages.results(n.length):this.options.messages.noResults,this.liveRegion.text(t))
    }
})
}(jQuery),function(n){
    var t,i="ui-button ui-widget ui-state-default ui-corner-all",r="ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",f=function(){
        var t=n(this);
        setTimeout(function(){
            t.find(":ui-button").button("refresh")
            },1)
        },u=function(t){
        var i=t.name,r=t.form,u=n([]);
        return i&&(i=i.replace(/'/g,"\\'"),u=r?n(r).find("[name='"+i+"']"):n("[name='"+i+"']",t.ownerDocument).filter(function(){
            return!this.form
            })),u
        };
        
    n.widget("ui.button",{
        version:"1.10.4",
        defaultElement:"<button>",
        options:{
            disabled:null,
            text:!0,
            label:null,
            icons:{
                primary:null,
                secondary:null
            }
        },
    _create:function(){
        this.element.closest("form").unbind("reset"+this.eventNamespace).bind("reset"+this.eventNamespace,f);
        typeof this.options.disabled!="boolean"?this.options.disabled=!!this.element.prop("disabled"):this.element.prop("disabled",this.options.disabled);
        this._determineButtonType();
        this.hasTitle=!!this.buttonElement.attr("title");
        var e=this,r=this.options,o=this.type==="checkbox"||this.type==="radio",s=o?"":"ui-state-active";
        r.label===null&&(r.label=this.type==="input"?this.buttonElement.val():this.buttonElement.html());
        this._hoverable(this.buttonElement);
        this.buttonElement.addClass(i).attr("role","button").bind("mouseenter"+this.eventNamespace,function(){
            r.disabled||this===t&&n(this).addClass("ui-state-active")
            }).bind("mouseleave"+this.eventNamespace,function(){
            r.disabled||n(this).removeClass(s)
            }).bind("click"+this.eventNamespace,function(n){
            r.disabled&&(n.preventDefault(),n.stopImmediatePropagation())
            });
        this._on({
            focus:function(){
                this.buttonElement.addClass("ui-state-focus")
                },
            blur:function(){
                this.buttonElement.removeClass("ui-state-focus")
                }
            });
    o&&this.element.bind("change"+this.eventNamespace,function(){
        e.refresh()
        });
    this.type==="checkbox"?this.buttonElement.bind("click"+this.eventNamespace,function(){
        if(r.disabled)return!1
            }):this.type==="radio"?this.buttonElement.bind("click"+this.eventNamespace,function(){
        if(r.disabled)return!1;
        n(this).addClass("ui-state-active");
        e.buttonElement.attr("aria-pressed","true");
        var t=e.element[0];
        u(t).not(t).map(function(){
            return n(this).button("widget")[0]
            }).removeClass("ui-state-active").attr("aria-pressed","false")
        }):(this.buttonElement.bind("mousedown"+this.eventNamespace,function(){
        if(r.disabled)return!1;
        n(this).addClass("ui-state-active");
        t=this;
        e.document.one("mouseup",function(){
            t=null
            })
        }).bind("mouseup"+this.eventNamespace,function(){
        if(r.disabled)return!1;
        n(this).removeClass("ui-state-active")
        }).bind("keydown"+this.eventNamespace,function(t){
        if(r.disabled)return!1;
        (t.keyCode===n.ui.keyCode.SPACE||t.keyCode===n.ui.keyCode.ENTER)&&n(this).addClass("ui-state-active")
        }).bind("keyup"+this.eventNamespace+" blur"+this.eventNamespace,function(){
        n(this).removeClass("ui-state-active")
        }),this.buttonElement.is("a")&&this.buttonElement.keyup(function(t){
        t.keyCode===n.ui.keyCode.SPACE&&n(this).click()
        }));
    this._setOption("disabled",r.disabled);
        this._resetButton()
        },
    _determineButtonType:function(){
        var n,t,i;
        this.type=this.element.is("[type=checkbox]")?"checkbox":this.element.is("[type=radio]")?"radio":this.element.is("input")?"input":"button";
        this.type==="checkbox"||this.type==="radio"?(n=this.element.parents().last(),t="label[for='"+this.element.attr("id")+"']",this.buttonElement=n.find(t),this.buttonElement.length||(n=n.length?n.siblings():this.element.siblings(),this.buttonElement=n.filter(t),this.buttonElement.length||(this.buttonElement=n.find(t))),this.element.addClass("ui-helper-hidden-accessible"),i=this.element.is(":checked"),i&&this.buttonElement.addClass("ui-state-active"),this.buttonElement.prop("aria-pressed",i)):this.buttonElement=this.element
        },
    widget:function(){
        return this.buttonElement
        },
    _destroy:function(){
        this.element.removeClass("ui-helper-hidden-accessible");
        this.buttonElement.removeClass(i+" ui-state-active "+r).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html());
        this.hasTitle||this.buttonElement.removeAttr("title")
        },
    _setOption:function(n,t){
        if(this._super(n,t),n==="disabled"){
            this.element.prop("disabled",!!t);
            t&&this.buttonElement.removeClass("ui-state-focus");
            return
        }
        this._resetButton()
        },
    refresh:function(){
        var t=this.element.is("input, button")?this.element.is(":disabled"):this.element.hasClass("ui-button-disabled");
        t!==this.options.disabled&&this._setOption("disabled",t);
        this.type==="radio"?u(this.element[0]).each(function(){
            n(this).is(":checked")?n(this).button("widget").addClass("ui-state-active").attr("aria-pressed","true"):n(this).button("widget").removeClass("ui-state-active").attr("aria-pressed","false")
            }):this.type==="checkbox"&&(this.element.is(":checked")?this.buttonElement.addClass("ui-state-active").attr("aria-pressed","true"):this.buttonElement.removeClass("ui-state-active").attr("aria-pressed","false"))
        },
    _resetButton:function(){
        if(this.type==="input"){
            this.options.label&&this.element.val(this.options.label);
            return
        }
        var i=this.buttonElement.removeClass(r),e=n("<span><\/span>",this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(i.empty()).text(),t=this.options.icons,f=t.primary&&t.secondary,u=[];
        t.primary||t.secondary?(this.options.text&&u.push("ui-button-text-icon"+(f?"s":t.primary?"-primary":"-secondary")),t.primary&&i.prepend("<span class='ui-button-icon-primary ui-icon "+t.primary+"'><\/span>"),t.secondary&&i.append("<span class='ui-button-icon-secondary ui-icon "+t.secondary+"'><\/span>"),this.options.text||(u.push(f?"ui-button-icons-only":"ui-button-icon-only"),this.hasTitle||i.attr("title",n.trim(e)))):u.push("ui-button-text-only");
        i.addClass(u.join(" "))
        }
    });
n.widget("ui.buttonset",{
    version:"1.10.4",
    options:{
        items:"button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"
    },
    _create:function(){
        this.element.addClass("ui-buttonset")
        },
    _init:function(){
        this.refresh()
        },
    _setOption:function(n,t){
        n==="disabled"&&this.buttons.button("option",n,t);
        this._super(n,t)
        },
    refresh:function(){
        var t=this.element.css("direction")==="rtl";
        this.buttons=this.element.find(this.options.items).filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map(function(){
            return n(this).button("widget")[0]
            }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(t?"ui-corner-right":"ui-corner-left").end().filter(":last").addClass(t?"ui-corner-left":"ui-corner-right").end().end()
        },
    _destroy:function(){
        this.element.removeClass("ui-buttonset");
        this.buttons.map(function(){
            return n(this).button("widget")[0]
            }).removeClass("ui-corner-left ui-corner-right").end().button("destroy")
        }
    })
}(jQuery),function(n,t){
    function f(){
        this._curInst=null;
        this._keyEvent=!1;
        this._disabledInputs=[];
        this._datepickerShowing=!1;
        this._inDialog=!1;
        this._mainDivId="ui-datepicker-div";
        this._inlineClass="ui-datepicker-inline";
        this._appendClass="ui-datepicker-append";
        this._triggerClass="ui-datepicker-trigger";
        this._dialogClass="ui-datepicker-dialog";
        this._disableClass="ui-datepicker-disabled";
        this._unselectableClass="ui-datepicker-unselectable";
        this._currentClass="ui-datepicker-current-day";
        this._dayOverClass="ui-datepicker-days-cell-over";
        this.regional=[];
        this.regional[""]={
            closeText:"Done",
            prevText:"Prev",
            nextText:"Next",
            currentText:"Today",
            monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],
            monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
            dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
            dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],
            dayNamesMin:["Su","Mo","Tu","We","Th","Fr","Sa"],
            weekHeader:"Wk",
            dateFormat:"mm/dd/yy",
            firstDay:0,
            isRTL:!1,
            showMonthAfterYear:!1,
            yearSuffix:""
        };
        
        this._defaults={
            showOn:"focus",
            showAnim:"fadeIn",
            showOptions:{},
            defaultDate:null,
            appendText:"",
            buttonText:"...",
            buttonImage:"",
            buttonImageOnly:!1,
            hideIfNoPrevNext:!1,
            navigationAsDateFormat:!1,
            gotoCurrent:!1,
            changeMonth:!1,
            changeYear:!1,
            yearRange:"c-10:c+10",
            showOtherMonths:!1,
            selectOtherMonths:!1,
            showWeek:!1,
            calculateWeek:this.iso8601Week,
            shortYearCutoff:"+10",
            minDate:null,
            maxDate:null,
            duration:"fast",
            beforeShowDay:null,
            beforeShow:null,
            onSelect:null,
            onChangeMonthYear:null,
            onClose:null,
            numberOfMonths:1,
            showCurrentAtPos:0,
            stepMonths:1,
            stepBigMonths:12,
            altField:"",
            altFormat:"",
            constrainInput:!0,
            showButtonPanel:!1,
            autoSize:!1,
            disabled:!1
            };
            
        n.extend(this._defaults,this.regional[""]);
        this.dpDiv=e(n("<div id='"+this._mainDivId+"' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'><\/div>"))
        }
        function e(t){
        var i="button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
        return t.delegate(i,"mouseout",function(){
            n(this).removeClass("ui-state-hover");
            this.className.indexOf("ui-datepicker-prev")!==-1&&n(this).removeClass("ui-datepicker-prev-hover");
            this.className.indexOf("ui-datepicker-next")!==-1&&n(this).removeClass("ui-datepicker-next-hover")
            }).delegate(i,"mouseover",function(){
            n.datepicker._isDisabledDatepicker(u.inline?t.parent()[0]:u.input[0])||(n(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"),n(this).addClass("ui-state-hover"),this.className.indexOf("ui-datepicker-prev")!==-1&&n(this).addClass("ui-datepicker-prev-hover"),this.className.indexOf("ui-datepicker-next")!==-1&&n(this).addClass("ui-datepicker-next-hover"))
            })
        }
        function r(t,i){
        n.extend(t,i);
        for(var r in i)i[r]==null&&(t[r]=i[r]);return t
        }
        n.extend(n.ui,{
        datepicker:{
            version:"1.10.4"
        }
    });
var i="datepicker",u;
n.extend(f.prototype,{
    markerClassName:"hasDatepicker",
    maxRows:4,
    _widgetDatepicker:function(){
        return this.dpDiv
        },
    setDefaults:function(n){
        return r(this._defaults,n||{}),this
        },
    _attachDatepicker:function(t,i){
        var r,f,u;
        r=t.nodeName.toLowerCase();
        f=r==="div"||r==="span";
        t.id||(this.uuid+=1,t.id="dp"+this.uuid);
        u=this._newInst(n(t),f);
        u.settings=n.extend({},i||{});
        r==="input"?this._connectDatepicker(t,u):f&&this._inlineDatepicker(t,u)
        },
    _newInst:function(t,i){
        var r=t[0].id.replace(/([^A-Za-z0-9_\-])/g,"\\\\$1");
        return{
            id:r,
            input:t,
            selectedDay:0,
            selectedMonth:0,
            selectedYear:0,
            drawMonth:0,
            drawYear:0,
            inline:i,
            dpDiv:i?e(n("<div class='"+this._inlineClass+" ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'><\/div>")):this.dpDiv
            }
        },
_connectDatepicker:function(t,r){
    var u=n(t);
    (r.append=n([]),r.trigger=n([]),u.hasClass(this.markerClassName))||(this._attachments(u,r),u.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp),this._autoSize(r),n.data(t,i,r),r.settings.disabled&&this._disableDatepicker(t))
    },
_attachments:function(t,i){
    var u,r,f,e=this._get(i,"appendText"),o=this._get(i,"isRTL");
    i.append&&i.append.remove();
    e&&(i.append=n("<span class='"+this._appendClass+"'>"+e+"<\/span>"),t[o?"before":"after"](i.append));
    t.unbind("focus",this._showDatepicker);
    i.trigger&&i.trigger.remove();
    u=this._get(i,"showOn");
    (u==="focus"||u==="both")&&t.focus(this._showDatepicker);
    (u==="button"||u==="both")&&(r=this._get(i,"buttonText"),f=this._get(i,"buttonImage"),i.trigger=n(this._get(i,"buttonImageOnly")?n("<img/>").addClass(this._triggerClass).attr({
        src:f,
        alt:r,
        title:r
    }):n("<button type='button'><\/button>").addClass(this._triggerClass).html(f?n("<img/>").attr({
        src:f,
        alt:r,
        title:r
    }):r)),t[o?"before":"after"](i.trigger),i.trigger.click(function(){
        return n.datepicker._datepickerShowing&&n.datepicker._lastInput===t[0]?n.datepicker._hideDatepicker():n.datepicker._datepickerShowing&&n.datepicker._lastInput!==t[0]?(n.datepicker._hideDatepicker(),n.datepicker._showDatepicker(t[0])):n.datepicker._showDatepicker(t[0]),!1
        }))
    },
_autoSize:function(n){
    if(this._get(n,"autoSize")&&!n.inline){
        var r,u,f,t,i=new Date(2009,11,20),e=this._get(n,"dateFormat");
        e.match(/[DM]/)&&(r=function(n){
            for(u=0,f=0,t=0;t<n.length;t++)n[t].length>u&&(u=n[t].length,f=t);
            return f
            },i.setMonth(r(this._get(n,e.match(/MM/)?"monthNames":"monthNamesShort"))),i.setDate(r(this._get(n,e.match(/DD/)?"dayNames":"dayNamesShort"))+20-i.getDay()));
        n.input.attr("size",this._formatDate(n,i).length)
        }
    },
_inlineDatepicker:function(t,r){
    var u=n(t);
    u.hasClass(this.markerClassName)||(u.addClass(this.markerClassName).append(r.dpDiv),n.data(t,i,r),this._setDate(r,this._getDefaultDate(r),!0),this._updateDatepicker(r),this._updateAlternate(r),r.settings.disabled&&this._disableDatepicker(t),r.dpDiv.css("display","block"))
    },
_dialogDatepicker:function(t,u,f,e,o){
    var h,c,l,a,v,s=this._dialogInst;
    return s||(this.uuid+=1,h="dp"+this.uuid,this._dialogInput=n("<input type='text' id='"+h+"' style='position: absolute; top: -100px; width: 0px;'/>"),this._dialogInput.keydown(this._doKeyDown),n("body").append(this._dialogInput),s=this._dialogInst=this._newInst(this._dialogInput,!1),s.settings={},n.data(this._dialogInput[0],i,s)),r(s.settings,e||{}),u=u&&u.constructor===Date?this._formatDate(s,u):u,this._dialogInput.val(u),this._pos=o?o.length?o:[o.pageX,o.pageY]:null,this._pos||(c=document.documentElement.clientWidth,l=document.documentElement.clientHeight,a=document.documentElement.scrollLeft||document.body.scrollLeft,v=document.documentElement.scrollTop||document.body.scrollTop,this._pos=[c/2-100+a,l/2-150+v]),this._dialogInput.css("left",this._pos[0]+20+"px").css("top",this._pos[1]+"px"),s.settings.onSelect=f,this._inDialog=!0,this.dpDiv.addClass(this._dialogClass),this._showDatepicker(this._dialogInput[0]),n.blockUI&&n.blockUI(this.dpDiv),n.data(this._dialogInput[0],i,s),this
    },
_destroyDatepicker:function(t){
    var r,u=n(t),f=n.data(t,i);
    u.hasClass(this.markerClassName)&&(r=t.nodeName.toLowerCase(),n.removeData(t,i),r==="input"?(f.append.remove(),f.trigger.remove(),u.removeClass(this.markerClassName).unbind("focus",this._showDatepicker).unbind("keydown",this._doKeyDown).unbind("keypress",this._doKeyPress).unbind("keyup",this._doKeyUp)):(r==="div"||r==="span")&&u.removeClass(this.markerClassName).empty())
    },
_enableDatepicker:function(t){
    var r,u,f=n(t),e=n.data(t,i);
    f.hasClass(this.markerClassName)&&(r=t.nodeName.toLowerCase(),r==="input"?(t.disabled=!1,e.trigger.filter("button").each(function(){
        this.disabled=!1
        }).end().filter("img").css({
        opacity:"1.0",
        cursor:""
    })):(r==="div"||r==="span")&&(u=f.children("."+this._inlineClass),u.children().removeClass("ui-state-disabled"),u.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!1)),this._disabledInputs=n.map(this._disabledInputs,function(n){
        return n===t?null:n
        }))
    },
_disableDatepicker:function(t){
    var r,u,f=n(t),e=n.data(t,i);
    f.hasClass(this.markerClassName)&&(r=t.nodeName.toLowerCase(),r==="input"?(t.disabled=!0,e.trigger.filter("button").each(function(){
        this.disabled=!0
        }).end().filter("img").css({
        opacity:"0.5",
        cursor:"default"
    })):(r==="div"||r==="span")&&(u=f.children("."+this._inlineClass),u.children().addClass("ui-state-disabled"),u.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!0)),this._disabledInputs=n.map(this._disabledInputs,function(n){
        return n===t?null:n
        }),this._disabledInputs[this._disabledInputs.length]=t)
    },
_isDisabledDatepicker:function(n){
    if(!n)return!1;
    for(var t=0;t<this._disabledInputs.length;t++)if(this._disabledInputs[t]===n)return!0;return!1
    },
_getInst:function(t){
    try{
        return n.data(t,i)
        }catch(r){
        throw"Missing instance data for this datepicker";
    }
},
_optionDatepicker:function(i,u,f){
    var o,c,s,h,e=this._getInst(i);
    if(arguments.length===2&&typeof u=="string")return u==="defaults"?n.extend({},n.datepicker._defaults):e?u==="all"?n.extend({},e.settings):this._get(e,u):null;
    o=u||{};
    
    typeof u=="string"&&(o={},o[u]=f);
    e&&(this._curInst===e&&this._hideDatepicker(),c=this._getDateDatepicker(i,!0),s=this._getMinMaxDate(e,"min"),h=this._getMinMaxDate(e,"max"),r(e.settings,o),s!==null&&o.dateFormat!==t&&o.minDate===t&&(e.settings.minDate=this._formatDate(e,s)),h!==null&&o.dateFormat!==t&&o.maxDate===t&&(e.settings.maxDate=this._formatDate(e,h)),"disabled"in o&&(o.disabled?this._disableDatepicker(i):this._enableDatepicker(i)),this._attachments(n(i),e),this._autoSize(e),this._setDate(e,c),this._updateAlternate(e),this._updateDatepicker(e))
    },
_changeDatepicker:function(n,t,i){
    this._optionDatepicker(n,t,i)
    },
_refreshDatepicker:function(n){
    var t=this._getInst(n);
    t&&this._updateDatepicker(t)
    },
_setDateDatepicker:function(n,t){
    var i=this._getInst(n);
    i&&(this._setDate(i,t),this._updateDatepicker(i),this._updateAlternate(i))
    },
_getDateDatepicker:function(n,t){
    var i=this._getInst(n);
    return i&&!i.inline&&this._setDateFromField(i,t),i?this._getDate(i):null
    },
_doKeyDown:function(t){
    var u,e,f,i=n.datepicker._getInst(t.target),r=!0,o=i.dpDiv.is(".ui-datepicker-rtl");
    if(i._keyEvent=!0,n.datepicker._datepickerShowing)switch(t.keyCode){
        case 9:
            n.datepicker._hideDatepicker();
            r=!1;
            break;
        case 13:
            return f=n("td."+n.datepicker._dayOverClass+":not(."+n.datepicker._currentClass+")",i.dpDiv),f[0]&&n.datepicker._selectDay(t.target,i.selectedMonth,i.selectedYear,f[0]),u=n.datepicker._get(i,"onSelect"),u?(e=n.datepicker._formatDate(i),u.apply(i.input?i.input[0]:null,[e,i])):n.datepicker._hideDatepicker(),!1;
        case 27:
            n.datepicker._hideDatepicker();
            break;
        case 33:
            n.datepicker._adjustDate(t.target,t.ctrlKey?-n.datepicker._get(i,"stepBigMonths"):-n.datepicker._get(i,"stepMonths"),"M");
            break;
        case 34:
            n.datepicker._adjustDate(t.target,t.ctrlKey?+n.datepicker._get(i,"stepBigMonths"):+n.datepicker._get(i,"stepMonths"),"M");
            break;
        case 35:
            (t.ctrlKey||t.metaKey)&&n.datepicker._clearDate(t.target);
            r=t.ctrlKey||t.metaKey;
            break;
        case 36:
            (t.ctrlKey||t.metaKey)&&n.datepicker._gotoToday(t.target);
            r=t.ctrlKey||t.metaKey;
            break;
        case 37:
            (t.ctrlKey||t.metaKey)&&n.datepicker._adjustDate(t.target,o?1:-1,"D");
            r=t.ctrlKey||t.metaKey;
            t.originalEvent.altKey&&n.datepicker._adjustDate(t.target,t.ctrlKey?-n.datepicker._get(i,"stepBigMonths"):-n.datepicker._get(i,"stepMonths"),"M");
            break;
        case 38:
            (t.ctrlKey||t.metaKey)&&n.datepicker._adjustDate(t.target,-7,"D");
            r=t.ctrlKey||t.metaKey;
            break;
        case 39:
            (t.ctrlKey||t.metaKey)&&n.datepicker._adjustDate(t.target,o?-1:1,"D");
            r=t.ctrlKey||t.metaKey;
            t.originalEvent.altKey&&n.datepicker._adjustDate(t.target,t.ctrlKey?+n.datepicker._get(i,"stepBigMonths"):+n.datepicker._get(i,"stepMonths"),"M");
            break;
        case 40:
            (t.ctrlKey||t.metaKey)&&n.datepicker._adjustDate(t.target,7,"D");
            r=t.ctrlKey||t.metaKey;
            break;
        default:
            r=!1
            }else t.keyCode===36&&t.ctrlKey?n.datepicker._showDatepicker(this):r=!1;
    r&&(t.preventDefault(),t.stopPropagation())
    },
_doKeyPress:function(t){
    var i,r,u=n.datepicker._getInst(t.target);
    if(n.datepicker._get(u,"constrainInput"))return i=n.datepicker._possibleChars(n.datepicker._get(u,"dateFormat")),r=String.fromCharCode(t.charCode==null?t.keyCode:t.charCode),t.ctrlKey||t.metaKey||r<" "||!i||i.indexOf(r)>-1
        },
_doKeyUp:function(t){
    var r,i=n.datepicker._getInst(t.target);
    if(i.input.val()!==i.lastVal)try{
        r=n.datepicker.parseDate(n.datepicker._get(i,"dateFormat"),i.input?i.input.val():null,n.datepicker._getFormatConfig(i));
        r&&(n.datepicker._setDateFromField(i),n.datepicker._updateAlternate(i),n.datepicker._updateDatepicker(i))
        }catch(u){}
        return!0
    },
_showDatepicker:function(t){
    if(t=t.target||t,t.nodeName.toLowerCase()!=="input"&&(t=n("input",t.parentNode)[0]),!n.datepicker._isDisabledDatepicker(t)&&n.datepicker._lastInput!==t){
        var i,o,s,u,f,e,h;
        (i=n.datepicker._getInst(t),n.datepicker._curInst&&n.datepicker._curInst!==i&&(n.datepicker._curInst.dpDiv.stop(!0,!0),i&&n.datepicker._datepickerShowing&&n.datepicker._hideDatepicker(n.datepicker._curInst.input[0])),o=n.datepicker._get(i,"beforeShow"),s=o?o.apply(t,[t,i]):{},s!==!1)&&(r(i.settings,s),i.lastVal=null,n.datepicker._lastInput=t,n.datepicker._setDateFromField(i),n.datepicker._inDialog&&(t.value=""),n.datepicker._pos||(n.datepicker._pos=n.datepicker._findPos(t),n.datepicker._pos[1]+=t.offsetHeight),u=!1,n(t).parents().each(function(){
            return u|=n(this).css("position")==="fixed",!u
            }),f={
            left:n.datepicker._pos[0],
            top:n.datepicker._pos[1]
            },n.datepicker._pos=null,i.dpDiv.empty(),i.dpDiv.css({
            position:"absolute",
            display:"block",
            top:"-1000px"
        }),n.datepicker._updateDatepicker(i),f=n.datepicker._checkOffset(i,f,u),i.dpDiv.css({
            position:n.datepicker._inDialog&&n.blockUI?"static":u?"fixed":"absolute",
            display:"none",
            left:f.left+"px",
            top:f.top+"px"
            }),i.inline||(e=n.datepicker._get(i,"showAnim"),h=n.datepicker._get(i,"duration"),i.dpDiv.zIndex(n(t).zIndex()+1),n.datepicker._datepickerShowing=!0,n.effects&&n.effects.effect[e]?i.dpDiv.show(e,n.datepicker._get(i,"showOptions"),h):i.dpDiv[e||"show"](e?h:null),n.datepicker._shouldFocusInput(i)&&i.input.focus(),n.datepicker._curInst=i))
        }
    },
_updateDatepicker:function(t){
    this.maxRows=4;
    u=t;
    t.dpDiv.empty().append(this._generateHTML(t));
    this._attachHandlers(t);
    t.dpDiv.find("."+this._dayOverClass+" a").mouseover();
    var i,r=this._getNumberOfMonths(t),f=r[1];
    t.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width("");
    f>1&&t.dpDiv.addClass("ui-datepicker-multi-"+f).css("width",17*f+"em");
    t.dpDiv[(r[0]!==1||r[1]!==1?"add":"remove")+"Class"]("ui-datepicker-multi");
    t.dpDiv[(this._get(t,"isRTL")?"add":"remove")+"Class"]("ui-datepicker-rtl");
    t===n.datepicker._curInst&&n.datepicker._datepickerShowing&&n.datepicker._shouldFocusInput(t)&&t.input.focus();
    t.yearshtml&&(i=t.yearshtml,setTimeout(function(){
        i===t.yearshtml&&t.yearshtml&&t.dpDiv.find("select.ui-datepicker-year:first").replaceWith(t.yearshtml);
        i=t.yearshtml=null
        },0))
    },
_shouldFocusInput:function(n){
    return n.input&&n.input.is(":visible")&&!n.input.is(":disabled")&&!n.input.is(":focus")
    },
_checkOffset:function(t,i,r){
    var u=t.dpDiv.outerWidth(),f=t.dpDiv.outerHeight(),h=t.input?t.input.outerWidth():0,o=t.input?t.input.outerHeight():0,e=document.documentElement.clientWidth+(r?0:n(document).scrollLeft()),s=document.documentElement.clientHeight+(r?0:n(document).scrollTop());
    return i.left-=this._get(t,"isRTL")?u-h:0,i.left-=r&&i.left===t.input.offset().left?n(document).scrollLeft():0,i.top-=r&&i.top===t.input.offset().top+o?n(document).scrollTop():0,i.left-=Math.min(i.left,i.left+u>e&&e>u?Math.abs(i.left+u-e):0),i.top-=Math.min(i.top,i.top+f>s&&s>f?Math.abs(f+o):0),i
    },
_findPos:function(t){
    for(var i,r=this._getInst(t),u=this._get(r,"isRTL");t&&(t.type==="hidden"||t.nodeType!==1||n.expr.filters.hidden(t));)t=t[u?"previousSibling":"nextSibling"];
    return i=n(t).offset(),[i.left,i.top]
    },
_hideDatepicker:function(t){
    var u,e,f,o,r=this._curInst;
    r&&(!t||r===n.data(t,i))&&this._datepickerShowing&&(u=this._get(r,"showAnim"),e=this._get(r,"duration"),f=function(){
        n.datepicker._tidyDialog(r)
        },n.effects&&(n.effects.effect[u]||n.effects[u])?r.dpDiv.hide(u,n.datepicker._get(r,"showOptions"),e,f):r.dpDiv[u==="slideDown"?"slideUp":u==="fadeIn"?"fadeOut":"hide"](u?e:null,f),u||f(),this._datepickerShowing=!1,o=this._get(r,"onClose"),o&&o.apply(r.input?r.input[0]:null,[r.input?r.input.val():"",r]),this._lastInput=null,this._inDialog&&(this._dialogInput.css({
        position:"absolute",
        left:"0",
        top:"-100px"
    }),n.blockUI&&(n.unblockUI(),n("body").append(this.dpDiv))),this._inDialog=!1)
    },
_tidyDialog:function(n){
    n.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")
    },
_checkExternalClick:function(t){
    if(n.datepicker._curInst){
        var i=n(t.target),r=n.datepicker._getInst(i[0]);
        (i[0].id===n.datepicker._mainDivId||i.parents("#"+n.datepicker._mainDivId).length!==0||i.hasClass(n.datepicker.markerClassName)||i.closest("."+n.datepicker._triggerClass).length||!n.datepicker._datepickerShowing||n.datepicker._inDialog&&n.blockUI)&&(!i.hasClass(n.datepicker.markerClassName)||n.datepicker._curInst===r)||n.datepicker._hideDatepicker()
        }
    },
_adjustDate:function(t,i,r){
    var f=n(t),u=this._getInst(f[0]);
    this._isDisabledDatepicker(f[0])||(this._adjustInstDate(u,i+(r==="M"?this._get(u,"showCurrentAtPos"):0),r),this._updateDatepicker(u))
    },
_gotoToday:function(t){
    var r,u=n(t),i=this._getInst(u[0]);
    this._get(i,"gotoCurrent")&&i.currentDay?(i.selectedDay=i.currentDay,i.drawMonth=i.selectedMonth=i.currentMonth,i.drawYear=i.selectedYear=i.currentYear):(r=new Date,i.selectedDay=r.getDate(),i.drawMonth=i.selectedMonth=r.getMonth(),i.drawYear=i.selectedYear=r.getFullYear());
    this._notifyChange(i);
    this._adjustDate(u)
    },
_selectMonthYear:function(t,i,r){
    var f=n(t),u=this._getInst(f[0]);
    u["selected"+(r==="M"?"Month":"Year")]=u["draw"+(r==="M"?"Month":"Year")]=parseInt(i.options[i.selectedIndex].value,10);
    this._notifyChange(u);
    this._adjustDate(f)
    },
_selectDay:function(t,i,r,u){
    var f,e=n(t);
    n(u).hasClass(this._unselectableClass)||this._isDisabledDatepicker(e[0])||(f=this._getInst(e[0]),f.selectedDay=f.currentDay=n("a",u).html(),f.selectedMonth=f.currentMonth=i,f.selectedYear=f.currentYear=r,this._selectDate(t,this._formatDate(f,f.currentDay,f.currentMonth,f.currentYear)))
    },
_clearDate:function(t){
    var i=n(t);
    this._selectDate(i,"")
    },
_selectDate:function(t,i){
    var u,f=n(t),r=this._getInst(f[0]);
    i=i!=null?i:this._formatDate(r);
    r.input&&r.input.val(i);
    this._updateAlternate(r);
    u=this._get(r,"onSelect");
    u?u.apply(r.input?r.input[0]:null,[i,r]):r.input&&r.input.trigger("change");
    r.inline?this._updateDatepicker(r):(this._hideDatepicker(),this._lastInput=r.input[0],typeof r.input[0]!="object"&&r.input.focus(),this._lastInput=null)
    },
_updateAlternate:function(t){
    var i,r,u,f=this._get(t,"altField");
    f&&(i=this._get(t,"altFormat")||this._get(t,"dateFormat"),r=this._getDate(t),u=this.formatDate(i,r,this._getFormatConfig(t)),n(f).each(function(){
        n(this).val(u)
        }))
    },
noWeekends:function(n){
    var t=n.getDay();
    return[t>0&&t<6,""]
    },
iso8601Week:function(n){
    var i,t=new Date(n.getTime());
    return t.setDate(t.getDate()+4-(t.getDay()||7)),i=t.getTime(),t.setMonth(0),t.setDate(1),Math.floor(Math.round((i-t)/864e5)/7)+1
    },
parseDate:function(t,i,r){
    if(t==null||i==null)throw"Invalid arguments";
    if(i=typeof i=="object"?i.toString():i+"",i==="")return null;
    for(var a,v,f=0,y=(r?r.shortYearCutoff:null)||this._defaults.shortYearCutoff,d=typeof y!="string"?y:(new Date).getFullYear()%100+parseInt(y,10),g=(r?r.dayNamesShort:null)||this._defaults.dayNamesShort,nt=(r?r.dayNames:null)||this._defaults.dayNames,tt=(r?r.monthNamesShort:null)||this._defaults.monthNamesShort,it=(r?r.monthNames:null)||this._defaults.monthNames,e=-1,s=-1,h=-1,p=-1,w=!1,u,l=function(n){
        var i=o+1<t.length&&t.charAt(o+1)===n;
        return i&&o++,i
        },c=function(n){
        var r=l(n),u=n==="@"?14:n==="!"?20:n==="y"&&r?4:n==="o"?3:2,e=new RegExp("^\\d{1,"+u+"}"),t=i.substring(f).match(e);
        if(!t)throw"Missing number at position "+f;
        return f+=t[0].length,parseInt(t[0],10)
        },k=function(t,r,u){
        var e=-1,o=n.map(l(t)?u:r,function(n,t){
            return[[t,n]]
            }).sort(function(n,t){
            return-(n[1].length-t[1].length)
            });
        if(n.each(o,function(n,t){
            var r=t[1];
            if(i.substr(f,r.length).toLowerCase()===r.toLowerCase())return e=t[0],f+=r.length,!1
                }),e!==-1)return e+1;
        throw"Unknown name at position "+f;
    },b=function(){
        if(i.charAt(f)!==t.charAt(o))throw"Unexpected literal at position "+f;
        f++
    },o=0;o<t.length;o++)if(w)t.charAt(o)!=="'"||l("'")?b():w=!1;else switch(t.charAt(o)){
        case"d":
            h=c("d");
            break;
        case"D":
            k("D",g,nt);
            break;
        case"o":
            p=c("o");
            break;
        case"m":
            s=c("m");
            break;
        case"M":
            s=k("M",tt,it);
            break;
        case"y":
            e=c("y");
            break;
        case"@":
            u=new Date(c("@"));
            e=u.getFullYear();
            s=u.getMonth()+1;
            h=u.getDate();
            break;
        case"!":
            u=new Date((c("!")-this._ticksTo1970)/1e4);
            e=u.getFullYear();
            s=u.getMonth()+1;
            h=u.getDate();
            break;
        case"'":
            l("'")?b():w=!0;
            break;
        default:
            b()
            }
            if(f<i.length&&(v=i.substr(f),!/^\s+/.test(v)))throw"Extra/unparsed characters found in date: "+v;
    if(e===-1?e=(new Date).getFullYear():e<100&&(e+=(new Date).getFullYear()-(new Date).getFullYear()%100+(e<=d?0:-100)),p>-1){
        s=1;
        h=p;
        do{
            if(a=this._getDaysInMonth(e,s-1),h<=a)break;
            s++;
            h-=a
            }while(1)
    }
    if(u=this._daylightSavingAdjust(new Date(e,s-1,h)),u.getFullYear()!==e||u.getMonth()+1!==s||u.getDate()!==h)throw"Invalid date";
    return u
    },
ATOM:"yy-mm-dd",
COOKIE:"D, dd M yy",
ISO_8601:"yy-mm-dd",
RFC_822:"D, d M y",
RFC_850:"DD, dd-M-y",
RFC_1036:"D, d M y",
RFC_1123:"D, d M yy",
RFC_2822:"D, d M yy",
RSS:"D, d M y",
TICKS:"!",
TIMESTAMP:"@",
W3C:"yy-mm-dd",
_ticksTo1970:(718685+Math.floor(1970/4)-Math.floor(1970/100)+Math.floor(1970/400))*864e9,
formatDate:function(n,t,i){
    if(!t)return"";
    var u,h=(i?i.dayNamesShort:null)||this._defaults.dayNamesShort,c=(i?i.dayNames:null)||this._defaults.dayNames,l=(i?i.monthNamesShort:null)||this._defaults.monthNamesShort,a=(i?i.monthNames:null)||this._defaults.monthNames,f=function(t){
        var i=u+1<n.length&&n.charAt(u+1)===t;
        return i&&u++,i
        },e=function(n,t,i){
        var r=""+t;
        if(f(n))while(r.length<i)r="0"+r;
        return r
        },s=function(n,t,i,r){
        return f(n)?r[t]:i[t]
        },r="",o=!1;
    if(t)for(u=0;u<n.length;u++)if(o)n.charAt(u)!=="'"||f("'")?r+=n.charAt(u):o=!1;else switch(n.charAt(u)){
        case"d":
            r+=e("d",t.getDate(),2);
            break;
        case"D":
            r+=s("D",t.getDay(),h,c);
            break;
        case"o":
            r+=e("o",Math.round((new Date(t.getFullYear(),t.getMonth(),t.getDate()).getTime()-new Date(t.getFullYear(),0,0).getTime())/864e5),3);
            break;
        case"m":
            r+=e("m",t.getMonth()+1,2);
            break;
        case"M":
            r+=s("M",t.getMonth(),l,a);
            break;
        case"y":
            r+=f("y")?t.getFullYear():(t.getYear()%100<10?"0":"")+t.getYear()%100;
            break;
        case"@":
            r+=t.getTime();
            break;
        case"!":
            r+=t.getTime()*1e4+this._ticksTo1970;
            break;
        case"'":
            f("'")?r+="'":o=!0;
            break;
        default:
            r+=n.charAt(u)
            }
            return r
    },
_possibleChars:function(n){
    for(var i="",r=!1,u=function(i){
        var r=t+1<n.length&&n.charAt(t+1)===i;
        return r&&t++,r
        },t=0;t<n.length;t++)if(r)n.charAt(t)!=="'"||u("'")?i+=n.charAt(t):r=!1;else switch(n.charAt(t)){
        case"d":case"m":case"y":case"@":
            i+="0123456789";
            break;
        case"D":case"M":
            return null;
        case"'":
            u("'")?i+="'":r=!0;
            break;
        default:
            i+=n.charAt(t)
            }
            return i
    },
_get:function(n,i){
    return n.settings[i]!==t?n.settings[i]:this._defaults[i]
    },
_setDateFromField:function(n,t){
    if(n.input.val()!==n.lastVal){
        var f=this._get(n,"dateFormat"),r=n.lastVal=n.input?n.input.val():null,u=this._getDefaultDate(n),i=u,e=this._getFormatConfig(n);
        try{
            i=this.parseDate(f,r,e)||u
            }catch(o){
            r=t?"":r
            }
            n.selectedDay=i.getDate();
        n.drawMonth=n.selectedMonth=i.getMonth();
        n.drawYear=n.selectedYear=i.getFullYear();
        n.currentDay=r?i.getDate():0;
        n.currentMonth=r?i.getMonth():0;
        n.currentYear=r?i.getFullYear():0;
        this._adjustInstDate(n)
        }
    },
_getDefaultDate:function(n){
    return this._restrictMinMax(n,this._determineDate(n,this._get(n,"defaultDate"),new Date))
    },
_determineDate:function(t,i,r){
    var f=function(n){
        var t=new Date;
        return t.setDate(t.getDate()+n),t
        },e=function(i){
        try{
            return n.datepicker.parseDate(n.datepicker._get(t,"dateFormat"),i,n.datepicker._getFormatConfig(t))
            }catch(h){}
        for(var o=(i.toLowerCase().match(/^c/)?n.datepicker._getDate(t):null)||new Date,f=o.getFullYear(),e=o.getMonth(),r=o.getDate(),s=/([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,u=s.exec(i);u;){
            switch(u[2]||"d"){
                case"d":case"D":
                    r+=parseInt(u[1],10);
                    break;
                case"w":case"W":
                    r+=parseInt(u[1],10)*7;
                    break;
                case"m":case"M":
                    e+=parseInt(u[1],10);
                    r=Math.min(r,n.datepicker._getDaysInMonth(f,e));
                    break;
                case"y":case"Y":
                    f+=parseInt(u[1],10);
                    r=Math.min(r,n.datepicker._getDaysInMonth(f,e))
                    }
                    u=s.exec(i)
            }
            return new Date(f,e,r)
        },u=i==null||i===""?r:typeof i=="string"?e(i):typeof i=="number"?isNaN(i)?r:f(i):new Date(i.getTime());
    return u=u&&u.toString()==="Invalid Date"?r:u,u&&(u.setHours(0),u.setMinutes(0),u.setSeconds(0),u.setMilliseconds(0)),this._daylightSavingAdjust(u)
    },
_daylightSavingAdjust:function(n){
    return n?(n.setHours(n.getHours()>12?n.getHours()+2:0),n):null
    },
_setDate:function(n,t,i){
    var u=!t,f=n.selectedMonth,e=n.selectedYear,r=this._restrictMinMax(n,this._determineDate(n,t,new Date));
    n.selectedDay=n.currentDay=r.getDate();
    n.drawMonth=n.selectedMonth=n.currentMonth=r.getMonth();
    n.drawYear=n.selectedYear=n.currentYear=r.getFullYear();
    f===n.selectedMonth&&e===n.selectedYear||i||this._notifyChange(n);
    this._adjustInstDate(n);
    n.input&&n.input.val(u?"":this._formatDate(n))
    },
_getDate:function(n){
    return!n.currentYear||n.input&&n.input.val()===""?null:this._daylightSavingAdjust(new Date(n.currentYear,n.currentMonth,n.currentDay))
    },
_attachHandlers:function(t){
    var r=this._get(t,"stepMonths"),i="#"+t.id.replace(/\\\\/g,"\\");
    t.dpDiv.find("[data-handler]").map(function(){
        var t={
            prev:function(){
                n.datepicker._adjustDate(i,-r,"M")
                },
            next:function(){
                n.datepicker._adjustDate(i,+r,"M")
                },
            hide:function(){
                n.datepicker._hideDatepicker()
                },
            today:function(){
                n.datepicker._gotoToday(i)
                },
            selectDay:function(){
                return n.datepicker._selectDay(i,+this.getAttribute("data-month"),+this.getAttribute("data-year"),this),!1
                },
            selectMonth:function(){
                return n.datepicker._selectMonthYear(i,this,"M"),!1
                },
            selectYear:function(){
                return n.datepicker._selectMonthYear(i,this,"Y"),!1
                }
            };
        
    n(this).bind(this.getAttribute("data-event"),t[this.getAttribute("data-handler")])
        })
},
_generateHTML:function(n){
    var b,s,rt,h,ut,k,ft,et,ri,c,ot,ui,fi,ei,oi,st,g,si,ht,nt,f,y,ct,p,lt,l,u,at,vt,yt,pt,tt,wt,i,bt,kt,d,a,it,dt=new Date,gt=this._daylightSavingAdjust(new Date(dt.getFullYear(),dt.getMonth(),dt.getDate())),e=this._get(n,"isRTL"),li=this._get(n,"showButtonPanel"),hi=this._get(n,"hideIfNoPrevNext"),ni=this._get(n,"navigationAsDateFormat"),o=this._getNumberOfMonths(n),ai=this._get(n,"showCurrentAtPos"),ci=this._get(n,"stepMonths"),ti=o[0]!==1||o[1]!==1,ii=this._daylightSavingAdjust(n.currentDay?new Date(n.currentYear,n.currentMonth,n.currentDay):new Date(9999,9,9)),w=this._getMinMaxDate(n,"min"),v=this._getMinMaxDate(n,"max"),t=n.drawMonth-ai,r=n.drawYear;
    if(t<0&&(t+=12,r--),v)for(b=this._daylightSavingAdjust(new Date(v.getFullYear(),v.getMonth()-o[0]*o[1]+1,v.getDate())),b=w&&b<w?w:b;this._daylightSavingAdjust(new Date(r,t,1))>b;)t--,t<0&&(t=11,r--);
    for(n.drawMonth=t,n.drawYear=r,s=this._get(n,"prevText"),s=ni?this.formatDate(s,this._daylightSavingAdjust(new Date(r,t-ci,1)),this._getFormatConfig(n)):s,rt=this._canAdjustMonth(n,-1,r,t)?"<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='"+s+"'><span class='ui-icon ui-icon-circle-triangle-"+(e?"e":"w")+"'>"+s+"<\/span><\/a>":hi?"":"<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='"+s+"'><span class='ui-icon ui-icon-circle-triangle-"+(e?"e":"w")+"'>"+s+"<\/span><\/a>",h=this._get(n,"nextText"),h=ni?this.formatDate(h,this._daylightSavingAdjust(new Date(r,t+ci,1)),this._getFormatConfig(n)):h,ut=this._canAdjustMonth(n,1,r,t)?"<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='"+h+"'><span class='ui-icon ui-icon-circle-triangle-"+(e?"w":"e")+"'>"+h+"<\/span><\/a>":hi?"":"<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='"+h+"'><span class='ui-icon ui-icon-circle-triangle-"+(e?"w":"e")+"'>"+h+"<\/span><\/a>",k=this._get(n,"currentText"),ft=this._get(n,"gotoCurrent")&&n.currentDay?ii:gt,k=ni?this.formatDate(k,ft,this._getFormatConfig(n)):k,et=n.inline?"":"<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>"+this._get(n,"closeText")+"<\/button>",ri=li?"<div class='ui-datepicker-buttonpane ui-widget-content'>"+(e?et:"")+(this._isInRange(n,ft)?"<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>"+k+"<\/button>":"")+(e?"":et)+"<\/div>":"",c=parseInt(this._get(n,"firstDay"),10),c=isNaN(c)?0:c,ot=this._get(n,"showWeek"),ui=this._get(n,"dayNames"),fi=this._get(n,"dayNamesMin"),ei=this._get(n,"monthNames"),oi=this._get(n,"monthNamesShort"),st=this._get(n,"beforeShowDay"),g=this._get(n,"showOtherMonths"),si=this._get(n,"selectOtherMonths"),ht=this._getDefaultDate(n),nt="",f,y=0;y<o[0];y++){
        for(ct="",this.maxRows=4,p=0;p<o[1];p++){
            if(lt=this._daylightSavingAdjust(new Date(r,t,n.selectedDay)),l=" ui-corner-all",u="",ti){
                if(u+="<div class='ui-datepicker-group",o[1]>1)switch(p){
                    case 0:
                        u+=" ui-datepicker-group-first";
                        l=" ui-corner-"+(e?"right":"left");
                        break;
                    case o[1]-1:
                        u+=" ui-datepicker-group-last";
                        l=" ui-corner-"+(e?"left":"right");
                        break;
                    default:
                        u+=" ui-datepicker-group-middle";
                        l=""
                        }
                        u+="'>"
                }
                for(u+="<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix"+l+"'>"+(/all|left/.test(l)&&y===0?e?ut:rt:"")+(/all|right/.test(l)&&y===0?e?rt:ut:"")+this._generateMonthYearHeader(n,t,r,w,v,y>0||p>0,ei,oi)+"<\/div><table class='ui-datepicker-calendar'><thead><tr>",at=ot?"<th class='ui-datepicker-week-col'>"+this._get(n,"weekHeader")+"<\/th>":"",f=0;f<7;f++)vt=(f+c)%7,at+="<th"+((f+c+6)%7>=5?" class='ui-datepicker-week-end'":"")+"><span title='"+ui[vt]+"'>"+fi[vt]+"<\/span><\/th>";
            for(u+=at+"<\/tr><\/thead><tbody>",yt=this._getDaysInMonth(r,t),r===n.selectedYear&&t===n.selectedMonth&&(n.selectedDay=Math.min(n.selectedDay,yt)),pt=(this._getFirstDayOfMonth(r,t)-c+7)%7,tt=Math.ceil((pt+yt)/7),wt=ti?this.maxRows>tt?this.maxRows:tt:tt,this.maxRows=wt,i=this._daylightSavingAdjust(new Date(r,t,1-pt)),bt=0;bt<wt;bt++){
                for(u+="<tr>",kt=ot?"<td class='ui-datepicker-week-col'>"+this._get(n,"calculateWeek")(i)+"<\/td>":"",f=0;f<7;f++)d=st?st.apply(n.input?n.input[0]:null,[i]):[!0,""],a=i.getMonth()!==t,it=a&&!si||!d[0]||w&&i<w||v&&i>v,kt+="<td class='"+((f+c+6)%7>=5?" ui-datepicker-week-end":"")+(a?" ui-datepicker-other-month":"")+(i.getTime()===lt.getTime()&&t===n.selectedMonth&&n._keyEvent||ht.getTime()===i.getTime()&&ht.getTime()===lt.getTime()?" "+this._dayOverClass:"")+(it?" "+this._unselectableClass+" ui-state-disabled":"")+(a&&!g?"":" "+d[1]+(i.getTime()===ii.getTime()?" "+this._currentClass:"")+(i.getTime()===gt.getTime()?" ui-datepicker-today":""))+"'"+((!a||g)&&d[2]?" title='"+d[2].replace(/'/g,"&#39;")+"'":"")+(it?"":" data-handler='selectDay' data-event='click' data-month='"+i.getMonth()+"' data-year='"+i.getFullYear()+"'")+">"+(a&&!g?"&#xa0;":it?"<span class='ui-state-default'>"+i.getDate()+"<\/span>":"<a class='ui-state-default"+(i.getTime()===gt.getTime()?" ui-state-highlight":"")+(i.getTime()===ii.getTime()?" ui-state-active":"")+(a?" ui-priority-secondary":"")+"' href='#'>"+i.getDate()+"<\/a>")+"<\/td>",i.setDate(i.getDate()+1),i=this._daylightSavingAdjust(i);
                u+=kt+"<\/tr>"
                }
                t++;
            t>11&&(t=0,r++);
            u+="<\/tbody><\/table>"+(ti?"<\/div>"+(o[0]>0&&p===o[1]-1?"<div class='ui-datepicker-row-break'><\/div>":""):"");
            ct+=u
            }
            nt+=ct
        }
        return nt+=ri,n._keyEvent=!1,nt
    },
_generateMonthYearHeader:function(n,t,i,r,u,f,e,o){
    var k,d,h,v,y,p,s,a,w=this._get(n,"changeMonth"),b=this._get(n,"changeYear"),g=this._get(n,"showMonthAfterYear"),c="<div class='ui-datepicker-title'>",l="";
    if(f||!w)l+="<span class='ui-datepicker-month'>"+e[t]+"<\/span>";
    else{
        for(k=r&&r.getFullYear()===i,d=u&&u.getFullYear()===i,l+="<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>",h=0;h<12;h++)(!k||h>=r.getMonth())&&(!d||h<=u.getMonth())&&(l+="<option value='"+h+"'"+(h===t?" selected='selected'":"")+">"+o[h]+"<\/option>");
        l+="<\/select>"
        }
        if(g||(c+=l+(f||!(w&&b)?"&#xa0;":"")),!n.yearshtml)if(n.yearshtml="",f||!b)c+="<span class='ui-datepicker-year'>"+i+"<\/span>";
        else{
        for(v=this._get(n,"yearRange").split(":"),y=(new Date).getFullYear(),p=function(n){
            var t=n.match(/c[+\-].*/)?i+parseInt(n.substring(1),10):n.match(/[+\-].*/)?y+parseInt(n,10):parseInt(n,10);
            return isNaN(t)?y:t
            },s=p(v[0]),a=Math.max(s,p(v[1]||"")),s=r?Math.max(s,r.getFullYear()):s,a=u?Math.min(a,u.getFullYear()):a,n.yearshtml+="<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>";s<=a;s++)n.yearshtml+="<option value='"+s+"'"+(s===i?" selected='selected'":"")+">"+s+"<\/option>";
        n.yearshtml+="<\/select>";
        c+=n.yearshtml;
        n.yearshtml=null
        }
        return c+=this._get(n,"yearSuffix"),g&&(c+=(f||!(w&&b)?"&#xa0;":"")+l),c+"<\/div>"
    },
_adjustInstDate:function(n,t,i){
    var u=n.drawYear+(i==="Y"?t:0),f=n.drawMonth+(i==="M"?t:0),e=Math.min(n.selectedDay,this._getDaysInMonth(u,f))+(i==="D"?t:0),r=this._restrictMinMax(n,this._daylightSavingAdjust(new Date(u,f,e)));
    n.selectedDay=r.getDate();
    n.drawMonth=n.selectedMonth=r.getMonth();
    n.drawYear=n.selectedYear=r.getFullYear();
    (i==="M"||i==="Y")&&this._notifyChange(n)
    },
_restrictMinMax:function(n,t){
    var i=this._getMinMaxDate(n,"min"),r=this._getMinMaxDate(n,"max"),u=i&&t<i?i:t;
    return r&&u>r?r:u
    },
_notifyChange:function(n){
    var t=this._get(n,"onChangeMonthYear");
    t&&t.apply(n.input?n.input[0]:null,[n.selectedYear,n.selectedMonth+1,n])
    },
_getNumberOfMonths:function(n){
    var t=this._get(n,"numberOfMonths");
    return t==null?[1,1]:typeof t=="number"?[1,t]:t
    },
_getMinMaxDate:function(n,t){
    return this._determineDate(n,this._get(n,t+"Date"),null)
    },
_getDaysInMonth:function(n,t){
    return 32-this._daylightSavingAdjust(new Date(n,t,32)).getDate()
    },
_getFirstDayOfMonth:function(n,t){
    return new Date(n,t,1).getDay()
    },
_canAdjustMonth:function(n,t,i,r){
    var f=this._getNumberOfMonths(n),u=this._daylightSavingAdjust(new Date(i,r+(t<0?t:f[0]*f[1]),1));
    return t<0&&u.setDate(this._getDaysInMonth(u.getFullYear(),u.getMonth())),this._isInRange(n,u)
    },
_isInRange:function(n,t){
    var i,f,e=this._getMinMaxDate(n,"min"),o=this._getMinMaxDate(n,"max"),r=null,u=null,s=this._get(n,"yearRange");
    return s&&(i=s.split(":"),f=(new Date).getFullYear(),r=parseInt(i[0],10),u=parseInt(i[1],10),i[0].match(/[+\-].*/)&&(r+=f),i[1].match(/[+\-].*/)&&(u+=f)),(!e||t.getTime()>=e.getTime())&&(!o||t.getTime()<=o.getTime())&&(!r||t.getFullYear()>=r)&&(!u||t.getFullYear()<=u)
    },
_getFormatConfig:function(n){
    var t=this._get(n,"shortYearCutoff");
    return t=typeof t!="string"?t:(new Date).getFullYear()%100+parseInt(t,10),{
        shortYearCutoff:t,
        dayNamesShort:this._get(n,"dayNamesShort"),
        dayNames:this._get(n,"dayNames"),
        monthNamesShort:this._get(n,"monthNamesShort"),
        monthNames:this._get(n,"monthNames")
        }
    },
_formatDate:function(n,t,i,r){
    t||(n.currentDay=n.selectedDay,n.currentMonth=n.selectedMonth,n.currentYear=n.selectedYear);
    var u=t?typeof t=="object"?t:this._daylightSavingAdjust(new Date(r,i,t)):this._daylightSavingAdjust(new Date(n.currentYear,n.currentMonth,n.currentDay));
    return this.formatDate(this._get(n,"dateFormat"),u,this._getFormatConfig(n))
    }
});
n.fn.datepicker=function(t){
    if(!this.length)return this;
    n.datepicker.initialized||(n(document).mousedown(n.datepicker._checkExternalClick),n.datepicker.initialized=!0);
    n("#"+n.datepicker._mainDivId).length===0&&n("body").append(n.datepicker.dpDiv);
    var i=Array.prototype.slice.call(arguments,1);
    return typeof t=="string"&&(t==="isDisabled"||t==="getDate"||t==="widget")?n.datepicker["_"+t+"Datepicker"].apply(n.datepicker,[this[0]].concat(i)):t==="option"&&arguments.length===2&&typeof arguments[1]=="string"?n.datepicker["_"+t+"Datepicker"].apply(n.datepicker,[this[0]].concat(i)):this.each(function(){
        typeof t=="string"?n.datepicker["_"+t+"Datepicker"].apply(n.datepicker,[this].concat(i)):n.datepicker._attachDatepicker(this,t)
        })
    };
    
n.datepicker=new f;
n.datepicker.initialized=!1;
n.datepicker.uuid=(new Date).getTime();
n.datepicker.version="1.10.4"
}(jQuery),function(n){
    var t={
        buttons:!0,
        height:!0,
        maxHeight:!0,
        maxWidth:!0,
        minHeight:!0,
        minWidth:!0,
        width:!0
        },i={
        maxHeight:!0,
        maxWidth:!0,
        minHeight:!0,
        minWidth:!0
        };
        
    n.widget("ui.dialog",{
        version:"1.10.4",
        options:{
            appendTo:"body",
            autoOpen:!0,
            buttons:[],
            closeOnEscape:!0,
            closeText:"close",
            dialogClass:"",
            draggable:!0,
            hide:null,
            height:"auto",
            maxHeight:null,
            maxWidth:null,
            minHeight:150,
            minWidth:150,
            modal:!1,
            position:{
                my:"center",
                at:"center",
                of:window,
                collision:"fit",
                using:function(t){
                    var i=n(this).css(t).offset().top;
                    i<0&&n(this).css("top",t.top-i)
                    }
                },
        resizable:!0,
        show:null,
        title:null,
        width:300,
        beforeClose:null,
        close:null,
        drag:null,
        dragStart:null,
        dragStop:null,
        focus:null,
        open:null,
        resize:null,
        resizeStart:null,
        resizeStop:null
    },
    _create:function(){
        this.originalCss={
            display:this.element[0].style.display,
            width:this.element[0].style.width,
            minHeight:this.element[0].style.minHeight,
            maxHeight:this.element[0].style.maxHeight,
            height:this.element[0].style.height
            };
            
        this.originalPosition={
            parent:this.element.parent(),
            index:this.element.parent().children().index(this.element)
            };
            
        this.originalTitle=this.element.attr("title");
        this.options.title=this.options.title||this.originalTitle;
        this._createWrapper();
        this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog);
        this._createTitlebar();
        this._createButtonPane();
        this.options.draggable&&n.fn.draggable&&this._makeDraggable();
        this.options.resizable&&n.fn.resizable&&this._makeResizable();
        this._isOpen=!1
        },
    _init:function(){
        this.options.autoOpen&&this.open()
        },
    _appendTo:function(){
        var t=this.options.appendTo;
        return t&&(t.jquery||t.nodeType)?n(t):this.document.find(t||"body").eq(0)
        },
    _destroy:function(){
        var n,t=this.originalPosition;
        this._destroyOverlay();
        this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach();
        this.uiDialog.stop(!0,!0).remove();
        this.originalTitle&&this.element.attr("title",this.originalTitle);
        n=t.parent.children().eq(t.index);
        n.length&&n[0]!==this.element[0]?n.before(this.element):t.parent.append(this.element)
        },
    widget:function(){
        return this.uiDialog
        },
    disable:n.noop,
    enable:n.noop,
    close:function(t){
        var i,r=this;
        if(this._isOpen&&this._trigger("beforeClose",t)!==!1){
            if(this._isOpen=!1,this._destroyOverlay(),!this.opener.filter(":focusable").focus().length)try{
                i=this.document[0].activeElement;
                i&&i.nodeName.toLowerCase()!=="body"&&n(i).blur()
                }catch(u){}
                this._hide(this.uiDialog,this.options.hide,function(){
                r._trigger("close",t)
                })
            }
        },
    isOpen:function(){
        return this._isOpen
        },
    moveToTop:function(){
        this._moveToTop()
        },
    _moveToTop:function(n,t){
        var i=!!this.uiDialog.nextAll(":visible").insertBefore(this.uiDialog).length;
        return i&&!t&&this._trigger("focus",n),i
        },
    open:function(){
        var t=this;
        if(this._isOpen){
            this._moveToTop()&&this._focusTabbable();
            return
        }
        this._isOpen=!0;
        this.opener=n(this.document[0].activeElement);
        this._size();
        this._position();
        this._createOverlay();
        this._moveToTop(null,!0);
        this._show(this.uiDialog,this.options.show,function(){
            t._focusTabbable();
            t._trigger("focus")
            });
        this._trigger("open")
        },
    _focusTabbable:function(){
        var n=this.element.find("[autofocus]");
        n.length||(n=this.element.find(":tabbable"));
        n.length||(n=this.uiDialogButtonPane.find(":tabbable"));
        n.length||(n=this.uiDialogTitlebarClose.filter(":tabbable"));
        n.length||(n=this.uiDialog);
        n.eq(0).focus()
        },
    _keepFocus:function(t){
        function i(){
            var t=this.document[0].activeElement,i=this.uiDialog[0]===t||n.contains(this.uiDialog[0],t);
            i||this._focusTabbable()
            }
            t.preventDefault();
        i.call(this);
        this._delay(i)
        },
    _createWrapper:function(){
        this.uiDialog=n("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front "+this.options.dialogClass).hide().attr({
            tabIndex:-1,
            role:"dialog"
        }).appendTo(this._appendTo());
        this._on(this.uiDialog,{
            keydown:function(t){
                if(this.options.closeOnEscape&&!t.isDefaultPrevented()&&t.keyCode&&t.keyCode===n.ui.keyCode.ESCAPE){
                    t.preventDefault();
                    this.close(t);
                    return
                }
                if(t.keyCode===n.ui.keyCode.TAB){
                    var i=this.uiDialog.find(":tabbable"),r=i.filter(":first"),u=i.filter(":last");
                    t.target!==u[0]&&t.target!==this.uiDialog[0]||t.shiftKey?(t.target===r[0]||t.target===this.uiDialog[0])&&t.shiftKey&&(u.focus(1),t.preventDefault()):(r.focus(1),t.preventDefault())
                    }
                },
        mousedown:function(n){
            this._moveToTop(n)&&this._focusTabbable()
            }
        });
this.element.find("[aria-describedby]").length||this.uiDialog.attr({
    "aria-describedby":this.element.uniqueId().attr("id")
    })
},
_createTitlebar:function(){
    var t;
    this.uiDialogTitlebar=n("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog);
    this._on(this.uiDialogTitlebar,{
        mousedown:function(t){
            n(t.target).closest(".ui-dialog-titlebar-close")||this.uiDialog.focus()
            }
        });
this.uiDialogTitlebarClose=n("<button type='button'><\/button>").button({
    label:this.options.closeText,
    icons:{
        primary:"ui-icon-closethick"
    },
    text:!1
    }).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar);
this._on(this.uiDialogTitlebarClose,{
    click:function(n){
        n.preventDefault();
        this.close(n)
        }
    });
t=n("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar);
this._title(t);
this.uiDialog.attr({
    "aria-labelledby":t.attr("id")
    })
},
_title:function(n){
    this.options.title||n.html("&#160;");
    n.text(this.options.title)
    },
_createButtonPane:function(){
    this.uiDialogButtonPane=n("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix");
    this.uiButtonSet=n("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane);
    this._createButtons()
    },
_createButtons:function(){
    var i=this,t=this.options.buttons;
    if(this.uiDialogButtonPane.remove(),this.uiButtonSet.empty(),n.isEmptyObject(t)||n.isArray(t)&&!t.length){
        this.uiDialog.removeClass("ui-dialog-buttons");
        return
    }
    n.each(t,function(t,r){
        var u,f;
        r=n.isFunction(r)?{
            click:r,
            text:t
        }:r;
        r=n.extend({
            type:"button"
        },r);
        u=r.click;
        r.click=function(){
            u.apply(i.element[0],arguments)
            };
            
        f={
            icons:r.icons,
            text:r.showText
            };
            
        delete r.icons;
        delete r.showText;
        n("<button><\/button>",r).button(f).appendTo(i.uiButtonSet)
        });
    this.uiDialog.addClass("ui-dialog-buttons");
    this.uiDialogButtonPane.appendTo(this.uiDialog)
    },
_makeDraggable:function(){
    function i(n){
        return{
            position:n.position,
            offset:n.offset
            }
        }
    var t=this,r=this.options;
this.uiDialog.draggable({
    cancel:".ui-dialog-content, .ui-dialog-titlebar-close",
    handle:".ui-dialog-titlebar",
    containment:"document",
    start:function(r,u){
        n(this).addClass("ui-dialog-dragging");
        t._blockFrames();
        t._trigger("dragStart",r,i(u))
        },
    drag:function(n,r){
        t._trigger("drag",n,i(r))
        },
    stop:function(u,f){
        r.position=[f.position.left-t.document.scrollLeft(),f.position.top-t.document.scrollTop()];
        n(this).removeClass("ui-dialog-dragging");
        t._unblockFrames();
        t._trigger("dragStop",u,i(f))
        }
    })
},
_makeResizable:function(){
    function r(n){
        return{
            originalPosition:n.originalPosition,
            originalSize:n.originalSize,
            position:n.position,
            size:n.size
            }
        }
    var i=this,t=this.options,u=t.resizable,f=this.uiDialog.css("position"),e=typeof u=="string"?u:"n,e,s,w,se,sw,ne,nw";
this.uiDialog.resizable({
    cancel:".ui-dialog-content",
    containment:"document",
    alsoResize:this.element,
    maxWidth:t.maxWidth,
    maxHeight:t.maxHeight,
    minWidth:t.minWidth,
    minHeight:this._minHeight(),
    handles:e,
    start:function(t,u){
        n(this).addClass("ui-dialog-resizing");
        i._blockFrames();
        i._trigger("resizeStart",t,r(u))
        },
    resize:function(n,t){
        i._trigger("resize",n,r(t))
        },
    stop:function(u,f){
        t.height=n(this).height();
        t.width=n(this).width();
        n(this).removeClass("ui-dialog-resizing");
        i._unblockFrames();
        i._trigger("resizeStop",u,r(f))
        }
    }).css("position",f)
},
_minHeight:function(){
    var n=this.options;
    return n.height==="auto"?n.minHeight:Math.min(n.minHeight,n.height)
    },
_position:function(){
    var n=this.uiDialog.is(":visible");
    n||this.uiDialog.show();
    this.uiDialog.position(this.options.position);
    n||this.uiDialog.hide()
    },
_setOptions:function(r){
    var e=this,u=!1,f={};
    
    n.each(r,function(n,r){
        e._setOption(n,r);
        n in t&&(u=!0);
        n in i&&(f[n]=r)
        });
    u&&(this._size(),this._position());
    this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option",f)
    },
_setOption:function(n,t){
    var u,r,i=this.uiDialog;
    (n==="dialogClass"&&i.removeClass(this.options.dialogClass).addClass(t),n!=="disabled")&&(this._super(n,t),n==="appendTo"&&this.uiDialog.appendTo(this._appendTo()),n==="buttons"&&this._createButtons(),n==="closeText"&&this.uiDialogTitlebarClose.button({
        label:""+t
        }),n==="draggable"&&(u=i.is(":data(ui-draggable)"),u&&!t&&i.draggable("destroy"),!u&&t&&this._makeDraggable()),n==="position"&&this._position(),n==="resizable"&&(r=i.is(":data(ui-resizable)"),r&&!t&&i.resizable("destroy"),r&&typeof t=="string"&&i.resizable("option","handles",t),r||t===!1||this._makeResizable()),n==="title"&&this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))
    },
_size:function(){
    var t,i,r,n=this.options;
    this.element.show().css({
        width:"auto",
        minHeight:0,
        maxHeight:"none",
        height:0
    });
    n.minWidth>n.width&&(n.width=n.minWidth);
    t=this.uiDialog.css({
        height:"auto",
        width:n.width
        }).outerHeight();
    i=Math.max(0,n.minHeight-t);
    r=typeof n.maxHeight=="number"?Math.max(0,n.maxHeight-t):"none";
    n.height==="auto"?this.element.css({
        minHeight:i,
        maxHeight:r,
        height:"auto"
    }):this.element.height(Math.max(0,n.height-t));
    this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option","minHeight",this._minHeight())
    },
_blockFrames:function(){
    this.iframeBlocks=this.document.find("iframe").map(function(){
        var t=n(this);
        return n("<div>").css({
            position:"absolute",
            width:t.outerWidth(),
            height:t.outerHeight()
            }).appendTo(t.parent()).offset(t.offset())[0]
        })
    },
_unblockFrames:function(){
    this.iframeBlocks&&(this.iframeBlocks.remove(),delete this.iframeBlocks)
    },
_allowInteraction:function(t){
    return n(t.target).closest(".ui-dialog").length?!0:!!n(t.target).closest(".ui-datepicker").length
    },
_createOverlay:function(){
    if(this.options.modal){
        var t=this,i=this.widgetFullName;
        n.ui.dialog.overlayInstances||this._delay(function(){
            n.ui.dialog.overlayInstances&&this.document.bind("focusin.dialog",function(r){
                t._allowInteraction(r)||(r.preventDefault(),n(".ui-dialog:visible:last .ui-dialog-content").data(i)._focusTabbable())
                })
            });
        this.overlay=n("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo());
        this._on(this.overlay,{
            mousedown:"_keepFocus"
        });
        n.ui.dialog.overlayInstances++
    }
},
_destroyOverlay:function(){
    this.options.modal&&this.overlay&&(n.ui.dialog.overlayInstances--,n.ui.dialog.overlayInstances||this.document.unbind("focusin.dialog"),this.overlay.remove(),this.overlay=null)
    }
});
n.ui.dialog.overlayInstances=0;
n.uiBackCompat!==!1&&n.widget("ui.dialog",n.ui.dialog,{
    _position:function(){
        var t=this.options.position,i=[],r=[0,0],u;
        t?((typeof t=="string"||typeof t=="object"&&"0"in t)&&(i=t.split?t.split(" "):[t[0],t[1]],i.length===1&&(i[1]=i[0]),n.each(["left","top"],function(n,t){
            +i[n]===i[n]&&(r[n]=i[n],i[n]=t)
            }),t={
            my:i[0]+(r[0]<0?r[0]:"+"+r[0])+" "+i[1]+(r[1]<0?r[1]:"+"+r[1]),
            at:i.join(" ")
            }),t=n.extend({},n.ui.dialog.prototype.options.position,t)):t=n.ui.dialog.prototype.options.position;
        u=this.uiDialog.is(":visible");
        u||this.uiDialog.show();
        this.uiDialog.position(t);
        u||this.uiDialog.hide()
        }
    })
}(jQuery),function(n){
    n.widget("ui.menu",{
        version:"1.10.4",
        defaultElement:"<ul>",
        delay:300,
        options:{
            icons:{
                submenu:"ui-icon-carat-1-e"
            },
            menus:"ul",
            position:{
                my:"left top",
                at:"right top"
            },
            role:"menu",
            blur:null,
            focus:null,
            select:null
        },
        _create:function(){
            this.activeMenu=this.element;
            this.mouseHandled=!1;
            this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content ui-corner-all").toggleClass("ui-menu-icons",!!this.element.find(".ui-icon").length).attr({
                role:this.options.role,
                tabIndex:0
            }).bind("click"+this.eventNamespace,n.proxy(function(n){
                this.options.disabled&&n.preventDefault()
                },this));
            this.options.disabled&&this.element.addClass("ui-state-disabled").attr("aria-disabled","true");
            this._on({
                "mousedown .ui-menu-item > a":function(n){
                    n.preventDefault()
                    },
                "click .ui-state-disabled > a":function(n){
                    n.preventDefault()
                    },
                "click .ui-menu-item:has(a)":function(t){
                    var i=n(t.target).closest(".ui-menu-item");
                    !this.mouseHandled&&i.not(".ui-state-disabled").length&&(this.select(t),t.isPropagationStopped()||(this.mouseHandled=!0),i.has(".ui-menu").length?this.expand(t):!this.element.is(":focus")&&n(this.document[0].activeElement).closest(".ui-menu").length&&(this.element.trigger("focus",[!0]),this.active&&this.active.parents(".ui-menu").length===1&&clearTimeout(this.timer)))
                    },
                "mouseenter .ui-menu-item":function(t){
                    var i=n(t.currentTarget);
                    i.siblings().children(".ui-state-active").removeClass("ui-state-active");
                    this.focus(t,i)
                    },
                mouseleave:"collapseAll",
                "mouseleave .ui-menu":"collapseAll",
                focus:function(n,t){
                    var i=this.active||this.element.children(".ui-menu-item").eq(0);
                    t||this.focus(n,i)
                    },
                blur:function(t){
                    this._delay(function(){
                        n.contains(this.element[0],this.document[0].activeElement)||this.collapseAll(t)
                        })
                    },
                keydown:"_keydown"
            });
            this.refresh();
            this._on(this.document,{
                click:function(t){
                    n(t.target).closest(".ui-menu").length||this.collapseAll(t);
                    this.mouseHandled=!1
                    }
                })
        },
    _destroy:function(){
        this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-corner-all ui-menu-icons").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show();
        this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").children("a").removeUniqueId().removeClass("ui-corner-all ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function(){
            var t=n(this);
            t.data("ui-menu-submenu-carat")&&t.remove()
            });
        this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content")
        },
    _keydown:function(t){
        function s(n){
            return n.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&")
            }
            var i,f,r,e,u,o=!0;
        switch(t.keyCode){
            case n.ui.keyCode.PAGE_UP:
                this.previousPage(t);
                break;
            case n.ui.keyCode.PAGE_DOWN:
                this.nextPage(t);
                break;
            case n.ui.keyCode.HOME:
                this._move("first","first",t);
                break;
            case n.ui.keyCode.END:
                this._move("last","last",t);
                break;
            case n.ui.keyCode.UP:
                this.previous(t);
                break;
            case n.ui.keyCode.DOWN:
                this.next(t);
                break;
            case n.ui.keyCode.LEFT:
                this.collapse(t);
                break;
            case n.ui.keyCode.RIGHT:
                this.active&&!this.active.is(".ui-state-disabled")&&this.expand(t);
                break;
            case n.ui.keyCode.ENTER:case n.ui.keyCode.SPACE:
                this._activate(t);
                break;
            case n.ui.keyCode.ESCAPE:
                this.collapse(t);
                break;
            default:
                o=!1;
                f=this.previousFilter||"";
                r=String.fromCharCode(t.keyCode);
                e=!1;
                clearTimeout(this.filterTimer);
                r===f?e=!0:r=f+r;
                u=new RegExp("^"+s(r),"i");
                i=this.activeMenu.children(".ui-menu-item").filter(function(){
                return u.test(n(this).children("a").text())
                });
            i=e&&i.index(this.active.next())!==-1?this.active.nextAll(".ui-menu-item"):i;
                i.length||(r=String.fromCharCode(t.keyCode),u=new RegExp("^"+s(r),"i"),i=this.activeMenu.children(".ui-menu-item").filter(function(){
                return u.test(n(this).children("a").text())
                }));
            i.length?(this.focus(t,i),i.length>1?(this.previousFilter=r,this.filterTimer=this._delay(function(){
                delete this.previousFilter
                },1e3)):delete this.previousFilter):delete this.previousFilter
            }
            o&&t.preventDefault()
        },
    _activate:function(n){
        this.active.is(".ui-state-disabled")||(this.active.children("a[aria-haspopup='true']").length?this.expand(n):this.select(n))
        },
    refresh:function(){
        var t,r=this.options.icons.submenu,i=this.element.find(this.options.menus);
        this.element.toggleClass("ui-menu-icons",!!this.element.find(".ui-icon").length);
        i.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-corner-all").hide().attr({
            role:this.options.role,
            "aria-hidden":"true",
            "aria-expanded":"false"
        }).each(function(){
            var t=n(this),i=t.prev("a"),u=n("<span>").addClass("ui-menu-icon ui-icon "+r).data("ui-menu-submenu-carat",!0);
            i.attr("aria-haspopup","true").prepend(u);
            t.attr("aria-labelledby",i.attr("id"))
            });
        t=i.add(this.element);
        t.children(":not(.ui-menu-item):has(a)").addClass("ui-menu-item").attr("role","presentation").children("a").uniqueId().addClass("ui-corner-all").attr({
            tabIndex:-1,
            role:this._itemRole()
            });
        t.children(":not(.ui-menu-item)").each(function(){
            var t=n(this);
            /[^\-\u2014\u2013\s]/.test(t.text())||t.addClass("ui-widget-content ui-menu-divider")
            });
        t.children(".ui-state-disabled").attr("aria-disabled","true");
        this.active&&!n.contains(this.element[0],this.active[0])&&this.blur()
        },
    _itemRole:function(){
        return{
            menu:"menuitem",
            listbox:"option"
        }
        [this.options.role]
        },
    _setOption:function(n,t){
        n==="icons"&&this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(t.submenu);
        this._super(n,t)
        },
    focus:function(n,t){
        var i,r;
        this.blur(n,n&&n.type==="focus");
        this._scrollIntoView(t);
        this.active=t.first();
        r=this.active.children("a").addClass("ui-state-focus");
        this.options.role&&this.element.attr("aria-activedescendant",r.attr("id"));
        this.active.parent().closest(".ui-menu-item").children("a:first").addClass("ui-state-active");
        n&&n.type==="keydown"?this._close():this.timer=this._delay(function(){
            this._close()
            },this.delay);
        i=t.children(".ui-menu");
        i.length&&n&&/^mouse/.test(n.type)&&this._startOpening(i);
        this.activeMenu=t.parent();
        this._trigger("focus",n,{
            item:t
        })
        },
    _scrollIntoView:function(t){
        var e,o,i,r,u,f;
        this._hasScroll()&&(e=parseFloat(n.css(this.activeMenu[0],"borderTopWidth"))||0,o=parseFloat(n.css(this.activeMenu[0],"paddingTop"))||0,i=t.offset().top-this.activeMenu.offset().top-e-o,r=this.activeMenu.scrollTop(),u=this.activeMenu.height(),f=t.height(),i<0?this.activeMenu.scrollTop(r+i):i+f>u&&this.activeMenu.scrollTop(r+i-u+f))
        },
    blur:function(n,t){
        (t||clearTimeout(this.timer),this.active)&&(this.active.children("a").removeClass("ui-state-focus"),this.active=null,this._trigger("blur",n,{
            item:this.active
            }))
        },
    _startOpening:function(n){
        (clearTimeout(this.timer),n.attr("aria-hidden")==="true")&&(this.timer=this._delay(function(){
            this._close();
            this._open(n)
            },this.delay))
        },
    _open:function(t){
        var i=n.extend({
            of:this.active
            },this.options.position);
        clearTimeout(this.timer);
        this.element.find(".ui-menu").not(t.parents(".ui-menu")).hide().attr("aria-hidden","true");
        t.show().removeAttr("aria-hidden").attr("aria-expanded","true").position(i)
        },
    collapseAll:function(t,i){
        clearTimeout(this.timer);
        this.timer=this._delay(function(){
            var r=i?this.element:n(t&&t.target).closest(this.element.find(".ui-menu"));
            r.length||(r=this.element);
            this._close(r);
            this.blur(t);
            this.activeMenu=r
            },this.delay)
        },
    _close:function(n){
        n||(n=this.active?this.active.parent():this.element);
        n.find(".ui-menu").hide().attr("aria-hidden","true").attr("aria-expanded","false").end().find("a.ui-state-active").removeClass("ui-state-active")
        },
    collapse:function(n){
        var t=this.active&&this.active.parent().closest(".ui-menu-item",this.element);
        t&&t.length&&(this._close(),this.focus(n,t))
        },
    expand:function(n){
        var t=this.active&&this.active.children(".ui-menu ").children(".ui-menu-item").first();
        t&&t.length&&(this._open(t.parent()),this._delay(function(){
            this.focus(n,t)
            }))
        },
    next:function(n){
        this._move("next","first",n)
        },
    previous:function(n){
        this._move("prev","last",n)
        },
    isFirstItem:function(){
        return this.active&&!this.active.prevAll(".ui-menu-item").length
        },
    isLastItem:function(){
        return this.active&&!this.active.nextAll(".ui-menu-item").length
        },
    _move:function(n,t,i){
        var r;
        this.active&&(r=n==="first"||n==="last"?this.active[n==="first"?"prevAll":"nextAll"](".ui-menu-item").eq(-1):this.active[n+"All"](".ui-menu-item").eq(0));
        r&&r.length&&this.active||(r=this.activeMenu.children(".ui-menu-item")[t]());
        this.focus(i,r)
        },
    nextPage:function(t){
        var i,r,u;
        if(!this.active){
            this.next(t);
            return
        }
        this.isLastItem()||(this._hasScroll()?(r=this.active.offset().top,u=this.element.height(),this.active.nextAll(".ui-menu-item").each(function(){
            return i=n(this),i.offset().top-r-u<0
            }),this.focus(t,i)):this.focus(t,this.activeMenu.children(".ui-menu-item")[this.active?"last":"first"]()))
        },
    previousPage:function(t){
        var i,r,u;
        if(!this.active){
            this.next(t);
            return
        }
        this.isFirstItem()||(this._hasScroll()?(r=this.active.offset().top,u=this.element.height(),this.active.prevAll(".ui-menu-item").each(function(){
            return i=n(this),i.offset().top-r+u>0
            }),this.focus(t,i)):this.focus(t,this.activeMenu.children(".ui-menu-item").first()))
        },
    _hasScroll:function(){
        return this.element.outerHeight()<this.element.prop("scrollHeight")
        },
    select:function(t){
        this.active=this.active||n(t.target).closest(".ui-menu-item");
        var i={
            item:this.active
            };
            
        this.active.has(".ui-menu").length||this.collapseAll(t,!0);
        this._trigger("select",t,i)
        }
    })
}(jQuery),function(n,t){
    n.widget("ui.progressbar",{
        version:"1.10.4",
        options:{
            max:100,
            value:0,
            change:null,
            complete:null
        },
        min:0,
        _create:function(){
            this.oldValue=this.options.value=this._constrainedValue();
            this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({
                role:"progressbar",
                "aria-valuemin":this.min
                });
            this.valueDiv=n("<div class='ui-progressbar-value ui-widget-header ui-corner-left'><\/div>").appendTo(this.element);
            this._refreshValue()
            },
        _destroy:function(){
            this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow");
            this.valueDiv.remove()
            },
        value:function(n){
            if(n===t)return this.options.value;
            this.options.value=this._constrainedValue(n);
            this._refreshValue()
            },
        _constrainedValue:function(n){
            return n===t&&(n=this.options.value),this.indeterminate=n===!1,typeof n!="number"&&(n=0),this.indeterminate?!1:Math.min(this.options.max,Math.max(this.min,n))
            },
        _setOptions:function(n){
            var t=n.value;
            delete n.value;
            this._super(n);
            this.options.value=this._constrainedValue(t);
            this._refreshValue()
            },
        _setOption:function(n,t){
            n==="max"&&(t=Math.max(this.min,t));
            this._super(n,t)
            },
        _percentage:function(){
            return this.indeterminate?100:100*(this.options.value-this.min)/(this.options.max-this.min)
            },
        _refreshValue:function(){
            var t=this.options.value,i=this._percentage();
            this.valueDiv.toggle(this.indeterminate||t>this.min).toggleClass("ui-corner-right",t===this.options.max).width(i.toFixed(0)+"%");
            this.element.toggleClass("ui-progressbar-indeterminate",this.indeterminate);
            this.indeterminate?(this.element.removeAttr("aria-valuenow"),this.overlayDiv||(this.overlayDiv=n("<div class='ui-progressbar-overlay'><\/div>").appendTo(this.valueDiv))):(this.element.attr({
                "aria-valuemax":this.options.max,
                "aria-valuenow":t
            }),this.overlayDiv&&(this.overlayDiv.remove(),this.overlayDiv=null));
            this.oldValue!==t&&(this.oldValue=t,this._trigger("change"));
            t===this.options.max&&this._trigger("complete")
            }
        })
}(jQuery),function(n){
    var t=5;
    n.widget("ui.slider",n.ui.mouse,{
        version:"1.10.4",
        widgetEventPrefix:"slide",
        options:{
            animate:!1,
            distance:0,
            max:100,
            min:0,
            orientation:"horizontal",
            range:!1,
            step:1,
            value:0,
            values:null,
            change:null,
            slide:null,
            start:null,
            stop:null
        },
        _create:function(){
            this._keySliding=!1;
            this._mouseSliding=!1;
            this._animateOff=!0;
            this._handleIndex=null;
            this._detectOrientation();
            this._mouseInit();
            this.element.addClass("ui-slider ui-slider-"+this.orientation+" ui-widget ui-widget-content ui-corner-all");
            this._refresh();
            this._setOption("disabled",this.options.disabled);
            this._animateOff=!1
            },
        _refresh:function(){
            this._createRange();
            this._createHandles();
            this._setupEvents();
            this._refreshValue()
            },
        _createHandles:function(){
            var r,i,u=this.options,t=this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),f=[];
            for(i=u.values&&u.values.length||1,t.length>i&&(t.slice(i).remove(),t=t.slice(0,i)),r=t.length;r<i;r++)f.push("<a class='ui-slider-handle ui-state-default ui-corner-all' href='#'><\/a>");
            this.handles=t.add(n(f.join("")).appendTo(this.element));
            this.handle=this.handles.eq(0);
            this.handles.each(function(t){
                n(this).data("ui-slider-handle-index",t)
                })
            },
        _createRange:function(){
            var t=this.options,i="";
            t.range?(t.range===!0&&(t.values?t.values.length&&t.values.length!==2?t.values=[t.values[0],t.values[0]]:n.isArray(t.values)&&(t.values=t.values.slice(0)):t.values=[this._valueMin(),this._valueMin()]),this.range&&this.range.length?this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({
                left:"",
                bottom:""
            }):(this.range=n("<div><\/div>").appendTo(this.element),i="ui-slider-range ui-widget-header ui-corner-all"),this.range.addClass(i+(t.range==="min"||t.range==="max"?" ui-slider-range-"+t.range:""))):(this.range&&this.range.remove(),this.range=null)
            },
        _setupEvents:function(){
            var n=this.handles.add(this.range).filter("a");
            this._off(n);
            this._on(n,this._handleEvents);
            this._hoverable(n);
            this._focusable(n)
            },
        _destroy:function(){
            this.handles.remove();
            this.range&&this.range.remove();
            this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all");
            this._mouseDestroy()
            },
        _mouseCapture:function(t){
            var s,f,r,i,u,h,e,c,o=this,l=this.options;
            return l.disabled?!1:(this.elementSize={
                width:this.element.outerWidth(),
                height:this.element.outerHeight()
                },this.elementOffset=this.element.offset(),s={
                x:t.pageX,
                y:t.pageY
                },f=this._normValueFromMouse(s),r=this._valueMax()-this._valueMin()+1,this.handles.each(function(t){
                var e=Math.abs(f-o.values(t));
                (r>e||r===e&&(t===o._lastChangedValue||o.values(t)===l.min))&&(r=e,i=n(this),u=t)
                }),h=this._start(t,u),h===!1)?!1:(this._mouseSliding=!0,this._handleIndex=u,i.addClass("ui-state-active").focus(),e=i.offset(),c=!n(t.target).parents().addBack().is(".ui-slider-handle"),this._clickOffset=c?{
                left:0,
                top:0
            }:{
                left:t.pageX-e.left-i.width()/2,
                top:t.pageY-e.top-i.height()/2-(parseInt(i.css("borderTopWidth"),10)||0)-(parseInt(i.css("borderBottomWidth"),10)||0)+(parseInt(i.css("marginTop"),10)||0)
                },this.handles.hasClass("ui-state-hover")||this._slide(t,u,f),this._animateOff=!0,!0)
            },
        _mouseStart:function(){
            return!0
            },
        _mouseDrag:function(n){
            var t={
                x:n.pageX,
                y:n.pageY
                },i=this._normValueFromMouse(t);
            return this._slide(n,this._handleIndex,i),!1
            },
        _mouseStop:function(n){
            return this.handles.removeClass("ui-state-active"),this._mouseSliding=!1,this._stop(n,this._handleIndex),this._change(n,this._handleIndex),this._handleIndex=null,this._clickOffset=null,this._animateOff=!1,!1
            },
        _detectOrientation:function(){
            this.orientation=this.options.orientation==="vertical"?"vertical":"horizontal"
            },
        _normValueFromMouse:function(n){
            var i,r,t,u,f;
            return this.orientation==="horizontal"?(i=this.elementSize.width,r=n.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)):(i=this.elementSize.height,r=n.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)),t=r/i,t>1&&(t=1),t<0&&(t=0),this.orientation==="vertical"&&(t=1-t),u=this._valueMax()-this._valueMin(),f=this._valueMin()+t*u,this._trimAlignValue(f)
            },
        _start:function(n,t){
            var i={
                handle:this.handles[t],
                value:this.value()
                };
                
            return this.options.values&&this.options.values.length&&(i.value=this.values(t),i.values=this.values()),this._trigger("start",n,i)
            },
        _slide:function(n,t,i){
            var r,f,u;
            this.options.values&&this.options.values.length?(r=this.values(t?0:1),this.options.values.length===2&&this.options.range===!0&&(t===0&&i>r||t===1&&i<r)&&(i=r),i!==this.values(t)&&(f=this.values(),f[t]=i,u=this._trigger("slide",n,{
                handle:this.handles[t],
                value:i,
                values:f
            }),r=this.values(t?0:1),u!==!1&&this.values(t,i))):i!==this.value()&&(u=this._trigger("slide",n,{
                handle:this.handles[t],
                value:i
            }),u!==!1&&this.value(i))
            },
        _stop:function(n,t){
            var i={
                handle:this.handles[t],
                value:this.value()
                };
                
            this.options.values&&this.options.values.length&&(i.value=this.values(t),i.values=this.values());
            this._trigger("stop",n,i)
            },
        _change:function(n,t){
            if(!this._keySliding&&!this._mouseSliding){
                var i={
                    handle:this.handles[t],
                    value:this.value()
                    };
                    
                this.options.values&&this.options.values.length&&(i.value=this.values(t),i.values=this.values());
                this._lastChangedValue=t;
                this._trigger("change",n,i)
                }
            },
    value:function(n){
        if(arguments.length){
            this.options.value=this._trimAlignValue(n);
            this._refreshValue();
            this._change(null,0);
            return
        }
        return this._value()
        },
    values:function(t,i){
        var u,f,r;
        if(arguments.length>1){
            this.options.values[t]=this._trimAlignValue(i);
            this._refreshValue();
            this._change(null,t);
            return
        }
        if(arguments.length)if(n.isArray(arguments[0])){
            for(u=this.options.values,f=arguments[0],r=0;r<u.length;r+=1)u[r]=this._trimAlignValue(f[r]),this._change(null,r);
            this._refreshValue()
            }else return this.options.values&&this.options.values.length?this._values(t):this.value();else return this._values()
            },
    _setOption:function(t,i){
        var r,u=0;
        t==="range"&&this.options.range===!0&&(i==="min"?(this.options.value=this._values(0),this.options.values=null):i==="max"&&(this.options.value=this._values(this.options.values.length-1),this.options.values=null));
        n.isArray(this.options.values)&&(u=this.options.values.length);
        n.Widget.prototype._setOption.apply(this,arguments);
        switch(t){
            case"orientation":
                this._detectOrientation();
                this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-"+this.orientation);
                this._refreshValue();
                break;
            case"value":
                this._animateOff=!0;
                this._refreshValue();
                this._change(null,0);
                this._animateOff=!1;
                break;
            case"values":
                for(this._animateOff=!0,this._refreshValue(),r=0;r<u;r+=1)this._change(null,r);
                this._animateOff=!1;
                break;
            case"min":case"max":
                this._animateOff=!0;
                this._refreshValue();
                this._animateOff=!1;
                break;
            case"range":
                this._animateOff=!0;
                this._refresh();
                this._animateOff=!1
                }
            },
    _value:function(){
        var n=this.options.value;
        return this._trimAlignValue(n)
        },
    _values:function(n){
        var r,t,i;
        if(arguments.length)return r=this.options.values[n],this._trimAlignValue(r);
        if(this.options.values&&this.options.values.length){
            for(t=this.options.values.slice(),i=0;i<t.length;i+=1)t[i]=this._trimAlignValue(t[i]);
            return t
            }
            return[]
        },
    _trimAlignValue:function(n){
        if(n<=this._valueMin())return this._valueMin();
        if(n>=this._valueMax())return this._valueMax();
        var t=this.options.step>0?this.options.step:1,i=(n-this._valueMin())%t,r=n-i;
        return Math.abs(i)*2>=t&&(r+=i>0?t:-t),parseFloat(r.toFixed(5))
        },
    _valueMin:function(){
        return this.options.min
        },
    _valueMax:function(){
        return this.options.max
        },
    _refreshValue:function(){
        var s,t,c,f,h,e=this.options.range,i=this.options,r=this,u=this._animateOff?!1:i.animate,o={};
        
        this.options.values&&this.options.values.length?this.handles.each(function(f){
            t=(r.values(f)-r._valueMin())/(r._valueMax()-r._valueMin())*100;
            o[r.orientation==="horizontal"?"left":"bottom"]=t+"%";
            n(this).stop(1,1)[u?"animate":"css"](o,i.animate);
            r.options.range===!0&&(r.orientation==="horizontal"?(f===0&&r.range.stop(1,1)[u?"animate":"css"]({
                left:t+"%"
                },i.animate),f===1&&r.range[u?"animate":"css"]({
                width:t-s+"%"
                },{
                queue:!1,
                duration:i.animate
                })):(f===0&&r.range.stop(1,1)[u?"animate":"css"]({
                bottom:t+"%"
                },i.animate),f===1&&r.range[u?"animate":"css"]({
                height:t-s+"%"
                },{
                queue:!1,
                duration:i.animate
                })));
            s=t
            }):(c=this.value(),f=this._valueMin(),h=this._valueMax(),t=h!==f?(c-f)/(h-f)*100:0,o[this.orientation==="horizontal"?"left":"bottom"]=t+"%",this.handle.stop(1,1)[u?"animate":"css"](o,i.animate),e==="min"&&this.orientation==="horizontal"&&this.range.stop(1,1)[u?"animate":"css"]({
            width:t+"%"
            },i.animate),e==="max"&&this.orientation==="horizontal"&&this.range[u?"animate":"css"]({
            width:100-t+"%"
            },{
            queue:!1,
            duration:i.animate
            }),e==="min"&&this.orientation==="vertical"&&this.range.stop(1,1)[u?"animate":"css"]({
            height:t+"%"
            },i.animate),e==="max"&&this.orientation==="vertical"&&this.range[u?"animate":"css"]({
            height:100-t+"%"
            },{
            queue:!1,
            duration:i.animate
            }))
        },
    _handleEvents:{
        keydown:function(i){
            var o,u,r,f,e=n(i.target).data("ui-slider-handle-index");
            switch(i.keyCode){
                case n.ui.keyCode.HOME:case n.ui.keyCode.END:case n.ui.keyCode.PAGE_UP:case n.ui.keyCode.PAGE_DOWN:case n.ui.keyCode.UP:case n.ui.keyCode.RIGHT:case n.ui.keyCode.DOWN:case n.ui.keyCode.LEFT:
                    if(i.preventDefault(),!this._keySliding&&(this._keySliding=!0,n(i.target).addClass("ui-state-active"),o=this._start(i,e),o===!1))return
                    }
                    f=this.options.step;
            u=this.options.values&&this.options.values.length?r=this.values(e):r=this.value();
            switch(i.keyCode){
                case n.ui.keyCode.HOME:
                    r=this._valueMin();
                    break;
                case n.ui.keyCode.END:
                    r=this._valueMax();
                    break;
                case n.ui.keyCode.PAGE_UP:
                    r=this._trimAlignValue(u+(this._valueMax()-this._valueMin())/t);
                    break;
                case n.ui.keyCode.PAGE_DOWN:
                    r=this._trimAlignValue(u-(this._valueMax()-this._valueMin())/t);
                    break;
                case n.ui.keyCode.UP:case n.ui.keyCode.RIGHT:
                    if(u===this._valueMax())return;
                    r=this._trimAlignValue(u+f);
                    break;
                case n.ui.keyCode.DOWN:case n.ui.keyCode.LEFT:
                    if(u===this._valueMin())return;
                    r=this._trimAlignValue(u-f)
                    }
                    this._slide(i,e,r)
            },
        click:function(n){
            n.preventDefault()
            },
        keyup:function(t){
            var i=n(t.target).data("ui-slider-handle-index");
            this._keySliding&&(this._keySliding=!1,this._stop(t,i),this._change(t,i),n(t.target).removeClass("ui-state-active"))
            }
        }
})
}(jQuery),function(n){
    function i(t,i){
        var r=(t.attr("aria-describedby")||"").split(/\s+/);
        r.push(i);
        t.data("ui-tooltip-id",i).attr("aria-describedby",n.trim(r.join(" ")))
        }
        function r(t){
        var u=t.data("ui-tooltip-id"),i=(t.attr("aria-describedby")||"").split(/\s+/),r=n.inArray(u,i);
        r!==-1&&i.splice(r,1);
        t.removeData("ui-tooltip-id");
        i=n.trim(i.join(" "));
        i?t.attr("aria-describedby",i):t.removeAttr("aria-describedby")
        }
        var t=0;
    n.widget("ui.tooltip",{
        version:"1.10.4",
        options:{
            content:function(){
                var t=n(this).attr("title")||"";
                return n("<a>").text(t).html()
                },
            hide:!0,
            items:"[title]:not([disabled])",
            position:{
                my:"left top+15",
                at:"left bottom",
                collision:"flipfit flip"
            },
            show:!0,
            tooltipClass:null,
            track:!1,
            close:null,
            open:null
        },
        _create:function(){
            this._on({
                mouseover:"open",
                focusin:"open"
            });
            this.tooltips={};
            
            this.parents={};
            
            this.options.disabled&&this._disable()
            },
        _setOption:function(t,i){
            var r=this;
            if(t==="disabled"){
                this[i?"_disable":"_enable"]();
                this.options[t]=i;
                return
            }
            this._super(t,i);
            t==="content"&&n.each(this.tooltips,function(n,t){
                r._updateContent(t)
                })
            },
        _disable:function(){
            var t=this;
            n.each(this.tooltips,function(i,r){
                var u=n.Event("blur");
                u.target=u.currentTarget=r[0];
                t.close(u,!0)
                });
            this.element.find(this.options.items).addBack().each(function(){
                var t=n(this);
                t.is("[title]")&&t.data("ui-tooltip-title",t.attr("title")).attr("title","")
                })
            },
        _enable:function(){
            this.element.find(this.options.items).addBack().each(function(){
                var t=n(this);
                t.data("ui-tooltip-title")&&t.attr("title",t.data("ui-tooltip-title"))
                })
            },
        open:function(t){
            var r=this,i=n(t?t.target:this.element).closest(this.options.items);
            i.length&&!i.data("ui-tooltip-id")&&(i.attr("title")&&i.data("ui-tooltip-title",i.attr("title")),i.data("ui-tooltip-open",!0),t&&t.type==="mouseover"&&i.parents().each(function(){
                var t=n(this),i;
                t.data("ui-tooltip-open")&&(i=n.Event("blur"),i.target=i.currentTarget=this,r.close(i,!0));
                t.attr("title")&&(t.uniqueId(),r.parents[this.id]={
                    element:this,
                    title:t.attr("title")
                    },t.attr("title",""))
                }),this._updateContent(i,t))
            },
        _updateContent:function(n,t){
            var i,r=this.options.content,u=this,f=t?t.type:null;
            if(typeof r=="string")return this._open(t,n,r);
            i=r.call(n[0],function(i){
                n.data("ui-tooltip-open")&&u._delay(function(){
                    t&&(t.type=f);
                    this._open(t,n,i)
                    })
                });
            i&&this._open(t,n,i)
            },
        _open:function(t,r,u){
            function s(n){
                (o.of=n,f.is(":hidden"))||f.position(o)
                }
                var f,e,h,o=n.extend({},this.options.position);
            if(u){
                if(f=this._find(r),f.length){
                    f.find(".ui-tooltip-content").html(u);
                    return
                }
                r.is("[title]")&&(t&&t.type==="mouseover"?r.attr("title",""):r.removeAttr("title"));
                f=this._tooltip(r);
                i(r,f.attr("id"));
                f.find(".ui-tooltip-content").html(u);
                this.options.track&&t&&/^mouse/.test(t.type)?(this._on(this.document,{
                    mousemove:s
                }),s(t)):f.position(n.extend({
                    of:r
                },this.options.position));
                f.hide();
                this._show(f,this.options.show);
                this.options.show&&this.options.show.delay&&(h=this.delayedShow=setInterval(function(){
                    f.is(":visible")&&(s(o.of),clearInterval(h))
                    },n.fx.interval));
                this._trigger("open",t,{
                    tooltip:f
                });
                e={
                    keyup:function(t){
                        if(t.keyCode===n.ui.keyCode.ESCAPE){
                            var i=n.Event(t);
                            i.currentTarget=r[0];
                            this.close(i,!0)
                            }
                        },
                remove:function(){
                    this._removeTooltip(f)
                    }
                };
            
        t&&t.type!=="mouseover"||(e.mouseleave="close");
        t&&t.type!=="focusin"||(e.focusout="close");
        this._on(!0,r,e)
        }
    },
close:function(t){
    var f=this,i=n(t?t.currentTarget:this.element),u=this._find(i);
    this.closing||(clearInterval(this.delayedShow),i.data("ui-tooltip-title")&&i.attr("title",i.data("ui-tooltip-title")),r(i),u.stop(!0),this._hide(u,this.options.hide,function(){
        f._removeTooltip(n(this))
        }),i.removeData("ui-tooltip-open"),this._off(i,"mouseleave focusout keyup"),i[0]!==this.element[0]&&this._off(i,"remove"),this._off(this.document,"mousemove"),t&&t.type==="mouseleave"&&n.each(this.parents,function(t,i){
        n(i.element).attr("title",i.title);
        delete f.parents[t]
    }),this.closing=!0,this._trigger("close",t,{
        tooltip:u
    }),this.closing=!1)
    },
_tooltip:function(i){
    var u="ui-tooltip-"+t++,r=n("<div>").attr({
        id:u,
        role:"tooltip"
    }).addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content "+(this.options.tooltipClass||""));
    return n("<div>").addClass("ui-tooltip-content").appendTo(r),r.appendTo(this.document[0].body),this.tooltips[u]=i,r
    },
_find:function(t){
    var i=t.data("ui-tooltip-id");
    return i?n("#"+i):n()
    },
_removeTooltip:function(n){
    n.remove();
    delete this.tooltips[n.attr("id")]
},
_destroy:function(){
    var t=this;
    n.each(this.tooltips,function(i,r){
        var u=n.Event("blur");
        u.target=u.currentTarget=r[0];
        t.close(u,!0);
        n("#"+i).remove();
        r.data("ui-tooltip-title")&&(r.attr("title",r.data("ui-tooltip-title")),r.removeData("ui-tooltip-title"))
        })
    }
})
}(jQuery),function(n,t){
    var i="ui-effects-";
    n.effects={
        effect:{}
},function(n,t){
    function e(n,t,i){
        var r=s[t.type]||{};
        
        return n==null?i||!t.def?null:t.def:(n=r.floor?~~n:parseFloat(n),isNaN(n))?t.def:r.mod?(n+r.mod)%r.mod:0>n?0:r.max<n?r.max:n
        }
        function l(t){
        var e=i(),o=e._rgba=[];
        return(t=t.toLowerCase(),r(v,function(n,i){
            var r,s=i.re.exec(t),h=s&&i.parse(s),f=i.space||"rgba";
            if(h)return r=e[f](h),e[u[f].cache]=r[u[f].cache],o=e._rgba=r._rgba,!1
                }),o.length)?(o.join()==="0,0,0,0"&&n.extend(o,f.transparent),e):f[t]
        }
        function o(n,t,i){
        return(i=(i+1)%1,i*6<1)?n+(t-n)*i*6:i*2<1?t:i*3<2?n+(t-n)*(2/3-i)*6:n
        }
        var a=/^([\-+])=\s*(\d+\.?\d*)/,v=[{
        re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
        parse:function(n){
            return[n[1],n[2],n[3],n[4]]
            }
        },{
    re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
    parse:function(n){
        return[n[1]*2.55,n[2]*2.55,n[3]*2.55,n[4]]
        }
    },{
    re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
    parse:function(n){
        return[parseInt(n[1],16),parseInt(n[2],16),parseInt(n[3],16)]
        }
    },{
    re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,
    parse:function(n){
        return[parseInt(n[1]+n[1],16),parseInt(n[2]+n[2],16),parseInt(n[3]+n[3],16)]
        }
    },{
    re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
    space:"hsla",
    parse:function(n){
        return[n[1],n[2]/100,n[3]/100,n[4]]
        }
    }],i=n.Color=function(t,i,r,u){
    return new n.Color.fn.parse(t,i,r,u)
    },u={
    rgba:{
        props:{
            red:{
                idx:0,
                type:"byte"
            },
            green:{
                idx:1,
                type:"byte"
            },
            blue:{
                idx:2,
                type:"byte"
            }
        }
    },
hsla:{
    props:{
        hue:{
            idx:0,
            type:"degrees"
        },
        saturation:{
            idx:1,
            type:"percent"
        },
        lightness:{
            idx:2,
            type:"percent"
        }
    }
}
},s={
    byte:{
        floor:!0,
        max:255
    },
    percent:{
        max:1
    },
    degrees:{
        mod:360,
        floor:!0
        }
    },h=i.support={},c=n("<p>")[0],f,r=n.each;
c.style.cssText="background-color:rgba(1,1,1,.5)";
h.rgba=c.style.backgroundColor.indexOf("rgba")>-1;
r(u,function(n,t){
    t.cache="_"+n;
    t.props.alpha={
        idx:3,
        type:"percent",
        def:1
    }
});
i.fn=n.extend(i.prototype,{
    parse:function(o,s,h,c){
        if(o===t)return this._rgba=[null,null,null,null],this;
        (o.jquery||o.nodeType)&&(o=n(o).css(s),s=t);
        var a=this,v=n.type(o),y=this._rgba=[];
        return(s!==t&&(o=[o,s,h,c],v="array"),v==="string")?this.parse(l(o)||f._default):v==="array"?(r(u.rgba.props,function(n,t){
            y[t.idx]=e(o[t.idx],t)
            }),this):v==="object"?(o instanceof i?r(u,function(n,t){
            o[t.cache]&&(a[t.cache]=o[t.cache].slice())
            }):r(u,function(t,i){
            var u=i.cache;
            r(i.props,function(n,t){
                if(!a[u]&&i.to){
                    if(n==="alpha"||o[n]==null)return;
                    a[u]=i.to(a._rgba)
                    }
                    a[u][t.idx]=e(o[n],t,!0)
                });
            a[u]&&n.inArray(null,a[u].slice(0,3))<0&&(a[u][3]=1,i.from&&(a._rgba=i.from(a[u])))
            }),this):void 0
        },
    is:function(n){
        var e=i(n),t=!0,f=this;
        return r(u,function(n,i){
            var o,u=e[i.cache];
            return u&&(o=f[i.cache]||i.to&&i.to(f._rgba)||[],r(i.props,function(n,i){
                if(u[i.idx]!=null)return t=u[i.idx]===o[i.idx]
                    })),t
            }),t
        },
    _space:function(){
        var n=[],t=this;
        return r(u,function(i,r){
            t[r.cache]&&n.push(i)
            }),n.pop()
        },
    transition:function(n,t){
        var f=i(n),c=f._space(),o=u[c],l=this.alpha()===0?i("transparent"):this,a=l[o.cache]||o.to(l._rgba),h=a.slice();
        return f=f[o.cache],r(o.props,function(n,i){
            var c=i.idx,r=a[c],u=f[c],o=s[i.type]||{};
            
            u!==null&&(r===null?h[c]=u:(o.mod&&(u-r>o.mod/2?r+=o.mod:r-u>o.mod/2&&(r-=o.mod)),h[c]=e((u-r)*t+r,i)))
            }),this[c](h)
        },
    blend:function(t){
        if(this._rgba[3]===1)return this;
        var r=this._rgba.slice(),u=r.pop(),f=i(t)._rgba;
        return i(n.map(r,function(n,t){
            return(1-u)*f[t]+u*n
            }))
        },
    toRgbaString:function(){
        var i="rgba(",t=n.map(this._rgba,function(n,t){
            return n==null?t>2?1:0:n
            });
        return t[3]===1&&(t.pop(),i="rgb("),i+t.join()+")"
        },
    toHslaString:function(){
        var i="hsla(",t=n.map(this.hsla(),function(n,t){
            return n==null&&(n=t>2?1:0),t&&t<3&&(n=Math.round(n*100)+"%"),n
            });
        return t[3]===1&&(t.pop(),i="hsl("),i+t.join()+")"
        },
    toHexString:function(t){
        var i=this._rgba.slice(),r=i.pop();
        return t&&i.push(~~(r*255)),"#"+n.map(i,function(n){
            return n=(n||0).toString(16),n.length===1?"0"+n:n
            }).join("")
        },
    toString:function(){
        return this._rgba[3]===0?"transparent":this.toRgbaString()
        }
    });
i.fn.parse.prototype=i.fn;
u.hsla.to=function(n){
    if(n[0]==null||n[1]==null||n[2]==null)return[null,null,null,n[3]];
    var i=n[0]/255,r=n[1]/255,f=n[2]/255,s=n[3],u=Math.max(i,r,f),e=Math.min(i,r,f),t=u-e,o=u+e,h=o*.5,c,l;
    return c=e===u?0:i===u?60*(r-f)/t+360:r===u?60*(f-i)/t+120:60*(i-r)/t+240,l=t===0?0:h<=.5?t/o:t/(2-o),[Math.round(c)%360,l,h,s==null?1:s]
    };
    
u.hsla.from=function(n){
    if(n[0]==null||n[1]==null||n[2]==null)return[null,null,null,n[3]];
    var r=n[0]/360,u=n[1],t=n[2],e=n[3],i=t<=.5?t*(1+u):t+u-t*u,f=2*t-i;
    return[Math.round(o(f,i,r+1/3)*255),Math.round(o(f,i,r)*255),Math.round(o(f,i,r-1/3)*255),e]
    };
    
r(u,function(u,f){
    var s=f.props,o=f.cache,h=f.to,c=f.from;
    i.fn[u]=function(u){
        if(h&&!this[o]&&(this[o]=h(this._rgba)),u===t)return this[o].slice();
        var l,a=n.type(u),v=a==="array"||a==="object"?u:arguments,f=this[o].slice();
        return r(s,function(n,t){
            var i=v[a==="object"?n:t.idx];
            i==null&&(i=f[t.idx]);
            f[t.idx]=e(i,t)
            }),c?(l=i(c(f)),l[o]=f,l):i(f)
        };
        
    r(s,function(t,r){
        i.fn[t]||(i.fn[t]=function(i){
            var f=n.type(i),h=t==="alpha"?this._hsla?"hsla":"rgba":u,o=this[h](),s=o[r.idx],e;
            return f==="undefined"?s:(f==="function"&&(i=i.call(this,s),f=n.type(i)),i==null&&r.empty)?this:(f==="string"&&(e=a.exec(i),e&&(i=s+parseFloat(e[2])*(e[1]==="+"?1:-1))),o[r.idx]=i,this[h](o))
            })
        })
    });
i.hook=function(t){
    var u=t.split(" ");
    r(u,function(t,r){
        n.cssHooks[r]={
            set:function(t,u){
                var o,f,e="";
                if(u!=="transparent"&&(n.type(u)!=="string"||(o=l(u)))){
                    if(u=i(o||u),!h.rgba&&u._rgba[3]!==1){
                        for(f=r==="backgroundColor"?t.parentNode:t;(e===""||e==="transparent")&&f&&f.style;)try{
                            e=n.css(f,"backgroundColor");
                            f=f.parentNode
                            }catch(s){}
                            u=u.blend(e&&e!=="transparent"?e:"_default")
                        }
                        u=u.toRgbaString()
                    }
                    try{
                    t.style[r]=u
                    }catch(s){}
            }
        };
    
    n.fx.step[r]=function(t){
        t.colorInit||(t.start=i(t.elem,r),t.end=i(t.end),t.colorInit=!0);
        n.cssHooks[r].set(t.elem,t.start.transition(t.end,t.pos))
        }
    })
};

i.hook("backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor");
n.cssHooks.borderColor={
    expand:function(n){
        var t={};
        
        return r(["Top","Right","Bottom","Left"],function(i,r){
            t["border"+r+"Color"]=n
            }),t
        }
    };

f=n.Color.names={
    aqua:"#00ffff",
    black:"#000000",
    blue:"#0000ff",
    fuchsia:"#ff00ff",
    gray:"#808080",
    green:"#008000",
    lime:"#00ff00",
    maroon:"#800000",
    navy:"#000080",
    olive:"#808000",
    purple:"#800080",
    red:"#ff0000",
    silver:"#c0c0c0",
    teal:"#008080",
    white:"#ffffff",
    yellow:"#ffff00",
    transparent:[null,null,null,0],
    _default:"#ffffff"
}
}(jQuery),function(){
    function i(t){
        var r,u,i=t.ownerDocument.defaultView?t.ownerDocument.defaultView.getComputedStyle(t,null):t.currentStyle,f={};
        
        if(i&&i.length&&i[0]&&i[i[0]])for(u=i.length;u--;)r=i[u],typeof i[r]=="string"&&(f[n.camelCase(r)]=i[r]);else for(r in i)typeof i[r]=="string"&&(f[r]=i[r]);return f
        }
        function f(t,i){
        var e={},r,f;
        for(r in i)f=i[r],t[r]!==f&&(u[r]||(n.fx.step[r]||!isNaN(parseFloat(f)))&&(e[r]=f));return e
        }
        var r=["add","remove","toggle"],u={
        border:1,
        borderBottom:1,
        borderColor:1,
        borderLeft:1,
        borderRight:1,
        borderTop:1,
        borderWidth:1,
        margin:1,
        padding:1
    };
    
    n.each(["borderLeftStyle","borderRightStyle","borderBottomStyle","borderTopStyle"],function(t,i){
        n.fx.step[i]=function(n){
            (n.end==="none"||n.setAttr)&&(n.pos!==1||n.setAttr)||(jQuery.style(n.elem,i,n.end),n.setAttr=!0)
            }
        });
n.fn.addBack||(n.fn.addBack=function(n){
    return this.add(n==null?this.prevObject:this.prevObject.filter(n))
    });
n.effects.animateClass=function(t,u,e,o){
    var s=n.speed(u,e,o);
    return this.queue(function(){
        var e=n(this),h=e.attr("class")||"",o,u=s.children?e.find("*").addBack():e;
        u=u.map(function(){
            var t=n(this);
            return{
                el:t,
                start:i(this)
                }
            });
    o=function(){
        n.each(r,function(n,i){
            t[i]&&e[i+"Class"](t[i])
            })
        };
        
    o();
        u=u.map(function(){
        return this.end=i(this.el[0]),this.diff=f(this.start,this.end),this
        });
    e.attr("class",h);
        u=u.map(function(){
        var i=this,t=n.Deferred(),r=n.extend({},s,{
            queue:!1,
            complete:function(){
                t.resolve(i)
                }
            });
    return this.el.animate(this.diff,r),t.promise()
        });
    n.when.apply(n,u.get()).done(function(){
        o();
        n.each(arguments,function(){
            var t=this.el;
            n.each(this.diff,function(n){
                t.css(n,"")
                })
            });
        s.complete.call(e[0])
        })
    })
};

n.fn.extend({
    addClass:function(t){
        return function(i,r,u,f){
            return r?n.effects.animateClass.call(this,{
                add:i
            },r,u,f):t.apply(this,arguments)
            }
        }(n.fn.addClass),
    removeClass:function(t){
    return function(i,r,u,f){
        return arguments.length>1?n.effects.animateClass.call(this,{
            remove:i
        },r,u,f):t.apply(this,arguments)
        }
    }(n.fn.removeClass),
toggleClass:function(i){
    return function(r,u,f,e,o){
        return typeof u=="boolean"||u===t?f?n.effects.animateClass.call(this,u?{
            add:r
        }:{
            remove:r
        },f,e,o):i.apply(this,arguments):n.effects.animateClass.call(this,{
            toggle:r
        },u,f,e)
        }
    }(n.fn.toggleClass),
switchClass:function(t,i,r,u,f){
    return n.effects.animateClass.call(this,{
        add:i,
        remove:t
    },r,u,f)
    }
})
}(),function(){
    function r(t,i,r,u){
        return n.isPlainObject(t)&&(i=t,t=t.effect),t={
            effect:t
        },i==null&&(i={}),n.isFunction(i)&&(u=i,r=null,i={}),(typeof i=="number"||n.fx.speeds[i])&&(u=r,r=i,i={}),n.isFunction(r)&&(u=r,r=null),i&&n.extend(t,i),r=r||i.duration,t.duration=n.fx.off?0:typeof r=="number"?r:r in n.fx.speeds?n.fx.speeds[r]:n.fx.speeds._default,t.complete=u||i.complete,t
        }
        function u(t){
        return!t||typeof t=="number"||n.fx.speeds[t]?!0:typeof t=="string"&&!n.effects.effect[t]?!0:n.isFunction(t)?!0:typeof t=="object"&&!t.effect?!0:!1
        }
        n.extend(n.effects,{
        version:"1.10.4",
        save:function(n,t){
            for(var r=0;r<t.length;r++)t[r]!==null&&n.data(i+t[r],n[0].style[t[r]])
                },
        restore:function(n,r){
            for(var f,u=0;u<r.length;u++)r[u]!==null&&(f=n.data(i+r[u]),f===t&&(f=""),n.css(r[u],f))
                },
        setMode:function(n,t){
            return t==="toggle"&&(t=n.is(":hidden")?"show":"hide"),t
            },
        getBaseline:function(n,t){
            var i,r;
            switch(n[0]){
                case"top":
                    i=0;
                    break;
                case"middle":
                    i=.5;
                    break;
                case"bottom":
                    i=1;
                    break;
                default:
                    i=n[0]/t.height
                    }
                    switch(n[1]){
                case"left":
                    r=0;
                    break;
                case"center":
                    r=.5;
                    break;
                case"right":
                    r=1;
                    break;
                default:
                    r=n[1]/t.width
                    }
                    return{
                x:r,
                y:i
            }
        },
    createWrapper:function(t){
        if(t.parent().is(".ui-effects-wrapper"))return t.parent();
        var i={
            width:t.outerWidth(!0),
            height:t.outerHeight(!0),
            float:t.css("float")
            },u=n("<div><\/div>").addClass("ui-effects-wrapper").css({
            fontSize:"100%",
            background:"transparent",
            border:"none",
            margin:0,
            padding:0
        }),f={
            width:t.width(),
            height:t.height()
            },r=document.activeElement;
        try{
            r.id
            }catch(e){
            r=document.body
            }
            return t.wrap(u),(t[0]===r||n.contains(t[0],r))&&n(r).focus(),u=t.parent(),t.css("position")==="static"?(u.css({
            position:"relative"
        }),t.css({
            position:"relative"
        })):(n.extend(i,{
            position:t.css("position"),
            zIndex:t.css("z-index")
            }),n.each(["top","left","bottom","right"],function(n,r){
            i[r]=t.css(r);
            isNaN(parseInt(i[r],10))&&(i[r]="auto")
            }),t.css({
            position:"relative",
            top:0,
            left:0,
            right:"auto",
            bottom:"auto"
        })),t.css(f),u.css(i).show()
        },
    removeWrapper:function(t){
        var i=document.activeElement;
        return t.parent().is(".ui-effects-wrapper")&&(t.parent().replaceWith(t),(t[0]===i||n.contains(t[0],i))&&n(i).focus()),t
        },
    setTransition:function(t,i,r,u){
        return u=u||{},n.each(i,function(n,i){
            var f=t.cssUnit(i);
            f[0]>0&&(u[i]=f[0]*r+f[1])
            }),u
        }
    });
n.fn.extend({
    effect:function(){
        function e(i){
            function o(){
                n.isFunction(e)&&e.call(r[0]);
                n.isFunction(i)&&i()
                }
                var r=n(this),e=t.complete,u=t.mode;
            (r.is(":hidden")?u==="hide":u==="show")?(r[u](),o()):f.call(r[0],t,o)
            }
            var t=r.apply(this,arguments),i=t.mode,u=t.queue,f=n.effects.effect[t.effect];
        return n.fx.off||!f?i?this[i](t.duration,t.complete):this.each(function(){
            t.complete&&t.complete.call(this)
            }):u===!1?this.each(e):this.queue(u||"fx",e)
        },
    show:function(n){
        return function(t){
            if(u(t))return n.apply(this,arguments);
            var i=r.apply(this,arguments);
            return i.mode="show",this.effect.call(this,i)
            }
        }(n.fn.show),
    hide:function(n){
    return function(t){
        if(u(t))return n.apply(this,arguments);
        var i=r.apply(this,arguments);
        return i.mode="hide",this.effect.call(this,i)
        }
    }(n.fn.hide),
toggle:function(n){
    return function(t){
        if(u(t)||typeof t=="boolean")return n.apply(this,arguments);
        var i=r.apply(this,arguments);
        return i.mode="toggle",this.effect.call(this,i)
        }
    }(n.fn.toggle),
cssUnit:function(t){
    var i=this.css(t),r=[];
    return n.each(["em","px","%","pt"],function(n,t){
        i.indexOf(t)>0&&(r=[parseFloat(i),t])
        }),r
    }
})
}(),function(){
    var t={};
    
    n.each(["Quad","Cubic","Quart","Quint","Expo"],function(n,i){
        t[i]=function(t){
            return Math.pow(t,n+2)
            }
        });
n.extend(t,{
    Sine:function(n){
        return 1-Math.cos(n*Math.PI/2)
        },
    Circ:function(n){
        return 1-Math.sqrt(1-n*n)
        },
    Elastic:function(n){
        return n===0||n===1?n:-Math.pow(2,8*(n-1))*Math.sin(((n-1)*80-7.5)*Math.PI/15)
        },
    Back:function(n){
        return n*n*(3*n-2)
        },
    Bounce:function(n){
        for(var t,i=4;n<((t=Math.pow(2,--i))-1)/11;);
        return 1/Math.pow(4,3-i)-7.5625*Math.pow((t*3-2)/22-n,2)
        }
    });
n.each(t,function(t,i){
    n.easing["easeIn"+t]=i;
    n.easing["easeOut"+t]=function(n){
        return 1-i(1-n)
        };
        
    n.easing["easeInOut"+t]=function(n){
        return n<.5?i(n*2)/2:1-i(n*-2+2)/2
        }
    })
}()
}(jQuery),function(n){
    var t=/up|down|vertical/,i=/up|left|vertical|horizontal/;
    n.effects.effect.blind=function(r,u){
        var f=n(this),c=["position","top","bottom","left","right","height","width"],p=n.effects.setMode(f,r.mode||"hide"),w=r.direction||"up",o=t.test(w),l=o?"height":"width",a=o?"top":"left",b=i.test(w),v={},y=p==="show",e,s,h;
        f.parent().is(".ui-effects-wrapper")?n.effects.save(f.parent(),c):n.effects.save(f,c);
        f.show();
        e=n.effects.createWrapper(f).css({
            overflow:"hidden"
        });
        s=e[l]();
        h=parseFloat(e.css(a))||0;
        v[l]=y?s:0;
        b||(f.css(o?"bottom":"right",0).css(o?"top":"left","auto").css({
            position:"absolute"
        }),v[a]=y?h:s+h);
        y&&(e.css(l,0),b||e.css(a,h+s));
        e.animate(v,{
            duration:r.duration,
            easing:r.easing,
            queue:!1,
            complete:function(){
                p==="hide"&&f.hide();
                n.effects.restore(f,c);
                n.effects.removeWrapper(f);
                u()
                }
            })
    }
}(jQuery),function(n){
    n.effects.effect.bounce=function(t,i){
        var r=n(this),v=["position","top","bottom","left","right","height","width"],k=n.effects.setMode(r,t.mode||"effect"),f=k==="hide",y=k==="show",h=t.direction||"up",u=t.distance,p=t.times||5,d=p*2+(y||f?1:0),c=t.duration/d,l=t.easing,e=h==="up"||h==="down"?"top":"left",w=h==="up"||h==="left",b,o,s,a=r.queue(),g=a.length;
        for((y||f)&&v.push("opacity"),n.effects.save(r,v),r.show(),n.effects.createWrapper(r),u||(u=r[e==="top"?"outerHeight":"outerWidth"]()/3),y&&(s={
            opacity:1
        },s[e]=0,r.css("opacity",0).css(e,w?-u*2:u*2).animate(s,c,l)),f&&(u=u/Math.pow(2,p-1)),s={},s[e]=0,b=0;b<p;b++)o={},o[e]=(w?"-=":"+=")+u,r.animate(o,c,l).animate(s,c,l),u=f?u*2:u/2;
        f&&(o={
            opacity:0
        },o[e]=(w?"-=":"+=")+u,r.animate(o,c,l));
        r.queue(function(){
            f&&r.hide();
            n.effects.restore(r,v);
            n.effects.removeWrapper(r);
            i()
            });
        g>1&&a.splice.apply(a,[1,0].concat(a.splice(g,d+1)));
        r.dequeue()
        }
    }(jQuery),function(n){
    n.effects.effect.clip=function(t,i){
        var r=n(this),h=["position","top","bottom","left","right","height","width"],v=n.effects.setMode(r,t.mode||"hide"),f=v==="show",y=t.direction||"vertical",c=y==="vertical",o=c?"height":"width",l=c?"top":"left",s={},a,u,e;
        n.effects.save(r,h);
        r.show();
        a=n.effects.createWrapper(r).css({
            overflow:"hidden"
        });
        u=r[0].tagName==="IMG"?a:r;
        e=u[o]();
        f&&(u.css(o,0),u.css(l,e/2));
        s[o]=f?e:0;
        s[l]=f?0:e/2;
        u.animate(s,{
            queue:!1,
            duration:t.duration,
            easing:t.easing,
            complete:function(){
                f||r.hide();
                n.effects.restore(r,h);
                n.effects.removeWrapper(r);
                i()
                }
            })
    }
}(jQuery),function(n){
    n.effects.effect.drop=function(t,i){
        var r=n(this),h=["position","top","bottom","left","right","opacity","height","width"],c=n.effects.setMode(r,t.mode||"hide"),e=c==="show",u=t.direction||"left",o=u==="up"||u==="down"?"top":"left",s=u==="up"||u==="left"?"pos":"neg",l={
            opacity:e?1:0
            },f;
        n.effects.save(r,h);
        r.show();
        n.effects.createWrapper(r);
        f=t.distance||r[o==="top"?"outerHeight":"outerWidth"](!0)/2;
        e&&r.css("opacity",0).css(o,s==="pos"?-f:f);
        l[o]=(e?s==="pos"?"+=":"-=":s==="pos"?"-=":"+=")+f;
        r.animate(l,{
            queue:!1,
            duration:t.duration,
            easing:t.easing,
            complete:function(){
                c==="hide"&&r.hide();
                n.effects.restore(r,h);
                n.effects.removeWrapper(r);
                i()
                }
            })
    }
}(jQuery),function(n){
    n.effects.effect.explode=function(t,i){
        function k(){
            l.push(this);
            l.length===o*c&&d()
            }
            function d(){
            r.css({
                visibility:"visible"
            });
            n(l).remove();
            u||r.hide();
            i()
            }
            for(var o=t.pieces?Math.round(Math.sqrt(t.pieces)):3,c=o,r=n(this),b=n.effects.setMode(r,t.mode||"hide"),u=b==="show",w=r.show().css("visibility","hidden").offset(),s=Math.ceil(r.outerWidth()/c),h=Math.ceil(r.outerHeight()/o),l=[],e,a,v,y,p,f=0;f<o;f++)for(v=w.top+f*h,p=f-(o-1)/2,e=0;e<c;e++)a=w.left+e*s,y=e-(c-1)/2,r.clone().appendTo("body").wrap("<div><\/div>").css({
            position:"absolute",
            visibility:"visible",
            left:-e*s,
            top:-f*h
            }).parent().addClass("ui-effects-explode").css({
            position:"absolute",
            overflow:"hidden",
            width:s,
            height:h,
            left:a+(u?y*s:0),
            top:v+(u?p*h:0),
            opacity:u?0:1
            }).animate({
            left:a+(u?0:y*s),
            top:v+(u?0:p*h),
            opacity:u?1:0
            },t.duration||500,t.easing,k)
        }
        }(jQuery),function(n){
    n.effects.effect.fade=function(t,i){
        var r=n(this),u=n.effects.setMode(r,t.mode||"toggle");
        r.animate({
            opacity:u
        },{
            queue:!1,
            duration:t.duration,
            easing:t.easing,
            complete:i
        })
        }
    }(jQuery),function(n){
    n.effects.effect.fold=function(t,i){
        var r=n(this),s=["position","top","bottom","left","right","height","width"],h=n.effects.setMode(r,t.mode||"hide"),e=h==="show",c=h==="hide",f=t.size||15,l=/([0-9]+)%/.exec(f),a=!!t.horizFirst,v=e!==a,y=v?["width","height"]:["height","width"],p=t.duration/2,u,o,w={},b={};
        
        n.effects.save(r,s);
        r.show();
        u=n.effects.createWrapper(r).css({
            overflow:"hidden"
        });
        o=v?[u.width(),u.height()]:[u.height(),u.width()];
        l&&(f=parseInt(l[1],10)/100*o[c?0:1]);
        e&&u.css(a?{
            height:0,
            width:f
        }:{
            height:f,
            width:0
        });
        w[y[0]]=e?o[0]:f;
        b[y[1]]=e?o[1]:0;
        u.animate(w,p,t.easing).animate(b,p,t.easing,function(){
            c&&r.hide();
            n.effects.restore(r,s);
            n.effects.removeWrapper(r);
            i()
            })
        }
    }(jQuery),function(n){
    n.effects.effect.highlight=function(t,i){
        var r=n(this),u=["backgroundImage","backgroundColor","opacity"],f=n.effects.setMode(r,t.mode||"show"),e={
            backgroundColor:r.css("backgroundColor")
            };
            
        f==="hide"&&(e.opacity=0);
        n.effects.save(r,u);
        r.show().css({
            backgroundImage:"none",
            backgroundColor:t.color||"#ffff99"
            }).animate(e,{
            queue:!1,
            duration:t.duration,
            easing:t.easing,
            complete:function(){
                f==="hide"&&r.hide();
                n.effects.restore(r,u);
                i()
                }
            })
    }
}(jQuery),function(n){
    n.effects.effect.pulsate=function(t,i){
        var r=n(this),e=n.effects.setMode(r,t.mode||"show"),h=e==="show",a=e==="hide",v=h||e==="hide",o=(t.times||5)*2+(v?1:0),c=t.duration/o,u=0,f=r.queue(),l=f.length,s;
        for((h||!r.is(":visible"))&&(r.css("opacity",0).show(),u=1),s=1;s<o;s++)r.animate({
            opacity:u
        },c,t.easing),u=1-u;
        r.animate({
            opacity:u
        },c,t.easing);
        r.queue(function(){
            a&&r.hide();
            i()
            });
        l>1&&f.splice.apply(f,[1,0].concat(f.splice(l,o+1)));
        r.dequeue()
        }
    }(jQuery),function(n){
    n.effects.effect.puff=function(t,i){
        var r=n(this),e=n.effects.setMode(r,t.mode||"hide"),o=e==="hide",s=parseInt(t.percent,10)||150,f=s/100,u={
            height:r.height(),
            width:r.width(),
            outerHeight:r.outerHeight(),
            outerWidth:r.outerWidth()
            };
            
        n.extend(t,{
            effect:"scale",
            queue:!1,
            fade:!0,
            mode:e,
            complete:i,
            percent:o?s:100,
            from:o?u:{
                height:u.height*f,
                width:u.width*f,
                outerHeight:u.outerHeight*f,
                outerWidth:u.outerWidth*f
                }
            });
    r.effect(t)
    };
    
n.effects.effect.scale=function(t,i){
    var u=n(this),r=n.extend(!0,{},t),f=n.effects.setMode(u,t.mode||"effect"),s=parseInt(t.percent,10)||(parseInt(t.percent,10)===0?0:f==="hide"?0:100),h=t.direction||"both",c=t.origin,e={
        height:u.height(),
        width:u.width(),
        outerHeight:u.outerHeight(),
        outerWidth:u.outerWidth()
        },o={
        y:h!=="horizontal"?s/100:1,
        x:h!=="vertical"?s/100:1
        };
        
    r.effect="size";
    r.queue=!1;
    r.complete=i;
    f!=="effect"&&(r.origin=c||["middle","center"],r.restore=!0);
    r.from=t.from||(f==="show"?{
        height:0,
        width:0,
        outerHeight:0,
        outerWidth:0
    }:e);
    r.to={
        height:e.height*o.y,
        width:e.width*o.x,
        outerHeight:e.outerHeight*o.y,
        outerWidth:e.outerWidth*o.x
        };
        
    r.fade&&(f==="show"&&(r.from.opacity=0,r.to.opacity=1),f==="hide"&&(r.from.opacity=1,r.to.opacity=0));
    u.effect(r)
    };
    
n.effects.effect.size=function(t,i){
    var f,l,u,r=n(this),w=["position","top","bottom","left","right","width","height","overflow","opacity"],a=["width","height","overflow"],v=["fontSize"],e=["borderTopWidth","borderBottomWidth","paddingTop","paddingBottom"],o=["borderLeftWidth","borderRightWidth","paddingLeft","paddingRight"],h=n.effects.setMode(r,t.mode||"effect"),y=t.restore||h!=="effect",c=t.scale||"both",b=t.origin||["middle","center"],k=r.css("position"),s=y?w:["position","top","bottom","left","right","overflow","opacity"],p={
        height:0,
        width:0,
        outerHeight:0,
        outerWidth:0
    };
    
    h==="show"&&r.show();
    f={
        height:r.height(),
        width:r.width(),
        outerHeight:r.outerHeight(),
        outerWidth:r.outerWidth()
        };
        
    t.mode==="toggle"&&h==="show"?(r.from=t.to||p,r.to=t.from||f):(r.from=t.from||(h==="show"?p:f),r.to=t.to||(h==="hide"?p:f));
    u={
        from:{
            y:r.from.height/f.height,
            x:r.from.width/f.width
            },
        to:{
            y:r.to.height/f.height,
            x:r.to.width/f.width
            }
        };
(c==="box"||c==="both")&&(u.from.y!==u.to.y&&(s=s.concat(e),r.from=n.effects.setTransition(r,e,u.from.y,r.from),r.to=n.effects.setTransition(r,e,u.to.y,r.to)),u.from.x!==u.to.x&&(s=s.concat(o),r.from=n.effects.setTransition(r,o,u.from.x,r.from),r.to=n.effects.setTransition(r,o,u.to.x,r.to)));
(c==="content"||c==="both")&&u.from.y!==u.to.y&&(s=s.concat(v).concat(a),r.from=n.effects.setTransition(r,v,u.from.y,r.from),r.to=n.effects.setTransition(r,v,u.to.y,r.to));
n.effects.save(r,s);
r.show();
n.effects.createWrapper(r);
r.css("overflow","hidden").css(r.from);
b&&(l=n.effects.getBaseline(b,f),r.from.top=(f.outerHeight-r.outerHeight())*l.y,r.from.left=(f.outerWidth-r.outerWidth())*l.x,r.to.top=(f.outerHeight-r.to.outerHeight)*l.y,r.to.left=(f.outerWidth-r.to.outerWidth)*l.x);
r.css(r.from);
(c==="content"||c==="both")&&(e=e.concat(["marginTop","marginBottom"]).concat(v),o=o.concat(["marginLeft","marginRight"]),a=w.concat(e).concat(o),r.find("*[width]").each(function(){
    var i=n(this),r={
        height:i.height(),
        width:i.width(),
        outerHeight:i.outerHeight(),
        outerWidth:i.outerWidth()
        };
        
    y&&n.effects.save(i,a);
    i.from={
        height:r.height*u.from.y,
        width:r.width*u.from.x,
        outerHeight:r.outerHeight*u.from.y,
        outerWidth:r.outerWidth*u.from.x
        };
        
    i.to={
        height:r.height*u.to.y,
        width:r.width*u.to.x,
        outerHeight:r.height*u.to.y,
        outerWidth:r.width*u.to.x
        };
        
    u.from.y!==u.to.y&&(i.from=n.effects.setTransition(i,e,u.from.y,i.from),i.to=n.effects.setTransition(i,e,u.to.y,i.to));
    u.from.x!==u.to.x&&(i.from=n.effects.setTransition(i,o,u.from.x,i.from),i.to=n.effects.setTransition(i,o,u.to.x,i.to));
    i.css(i.from);
    i.animate(i.to,t.duration,t.easing,function(){
        y&&n.effects.restore(i,a)
        })
    }));
r.animate(r.to,{
    queue:!1,
    duration:t.duration,
    easing:t.easing,
    complete:function(){
        r.to.opacity===0&&r.css("opacity",r.from.opacity);
        h==="hide"&&r.hide();
        n.effects.restore(r,s);
        y||(k==="static"?r.css({
            position:"relative",
            top:r.to.top,
            left:r.to.left
            }):n.each(["top","left"],function(n,t){
            r.css(t,function(t,i){
                var f=parseInt(i,10),u=n?r.to.left:r.to.top;
                return i==="auto"?u+"px":f+u+"px"
                })
            }));
        n.effects.removeWrapper(r);
        i()
        }
    })
}
}(jQuery),function(n){
    n.effects.effect.shake=function(t,i){
        var r=n(this),v=["position","top","bottom","left","right","height","width"],k=n.effects.setMode(r,t.mode||"effect"),f=t.direction||"left",o=t.distance||20,y=t.times||3,p=y*2+1,u=Math.round(t.duration/p),s=f==="up"||f==="down"?"top":"left",h=f==="up"||f==="left",c={},l={},w={},a,e=r.queue(),b=e.length;
        for(n.effects.save(r,v),r.show(),n.effects.createWrapper(r),c[s]=(h?"-=":"+=")+o,l[s]=(h?"+=":"-=")+o*2,w[s]=(h?"-=":"+=")+o*2,r.animate(c,u,t.easing),a=1;a<y;a++)r.animate(l,u,t.easing).animate(w,u,t.easing);
        r.animate(l,u,t.easing).animate(c,u/2,t.easing).queue(function(){
            k==="hide"&&r.hide();
            n.effects.restore(r,v);
            n.effects.removeWrapper(r);
            i()
            });
        b>1&&e.splice.apply(e,[1,0].concat(e.splice(b,p+1)));
        r.dequeue()
        }
    }(jQuery),function(n){
    n.effects.effect.slide=function(t,i){
        var r=n(this),s=["position","top","bottom","left","right","width","height"],h=n.effects.setMode(r,t.mode||"show"),c=h==="show",f=t.direction||"left",e=f==="up"||f==="down"?"top":"left",o=f==="up"||f==="left",u,l={};
        
        n.effects.save(r,s);
        r.show();
        u=t.distance||r[e==="top"?"outerHeight":"outerWidth"](!0);
        n.effects.createWrapper(r).css({
            overflow:"hidden"
        });
        c&&r.css(e,o?isNaN(u)?"-"+u:-u:u);
        l[e]=(c?o?"+=":"-=":o?"-=":"+=")+u;
        r.animate(l,{
            queue:!1,
            duration:t.duration,
            easing:t.easing,
            complete:function(){
                h==="hide"&&r.hide();
                n.effects.restore(r,s);
                n.effects.removeWrapper(r);
                i()
                }
            })
    }
}(jQuery),function(n){
    n.effects.effect.transfer=function(t,i){
        var u=n(this),r=n(t.to),f=r.css("position")==="fixed",e=n("body"),o=f?e.scrollTop():0,s=f?e.scrollLeft():0,h=r.offset(),l={
            top:h.top-o,
            left:h.left-s,
            height:r.innerHeight(),
            width:r.innerWidth()
            },c=u.offset(),a=n("<div class='ui-effects-transfer'><\/div>").appendTo(document.body).addClass(t.className).css({
            top:c.top-o,
            left:c.left-s,
            height:u.innerHeight(),
            width:u.innerWidth(),
            position:f?"fixed":"absolute"
            }).animate(l,t.duration,t.easing,function(){
            a.remove();
            i()
            })
        }
    }(jQuery);
jQuery(function(n){
    n.datepicker.regional["en-GB"]={
        closeText:"Done",
        prevText:"Prev",
        nextText:"Next",
        currentText:"Today",
        monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],
        monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
        dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
        dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],
        dayNamesMin:["Su","Mo","Tu","We","Th","Fr","Sa"],
        weekHeader:"Wk",
        dateFormat:"dd/mm/yy",
        firstDay:1,
        isRTL:!1,
        showMonthAfterYear:!1,
        yearSuffix:""
    };
    
    n.datepicker.regional.fr={
        closeText:"Fermer",
        prevText:"&#x3c;Préc",
        nextText:"Suiv&#x3e;",
        currentText:"Aujourd'hui",
        monthNames:["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"],
        monthNamesShort:["Jan","Fev","Mar","Avr","Mai","Jun","Jul","Aou","Sep","Oct","Nov","Dec"],
        dayNames:["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"],
        dayNamesShort:["Dim","Lun","Mar","Mer","Jeu","Ven","Sam"],
        dayNamesMin:["Di","Lu","Ma","Me","Je","Ve","Sa"],
        weekHeader:"Sm",
        dateFormat:"dd-mm-yy",
        firstDay:1,
        isRTL:!1,
        showMonthAfterYear:!1,
        yearSuffix:""
    };
    
    n.datepicker.regional.de={
        closeText:"schlieÃŸen",
        prevText:"&#x3c;zurÃ¼ck",
        nextText:"Vor&#x3e;",
        currentText:"heute",
        monthNames:["Januar","Februar","MÃ¤rz","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"],
        monthNamesShort:["Jan","Feb","MÃ¤r","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Dez"],
        dayNames:["Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag"],
        dayNamesShort:["So","Mo","Di","Mi","Do","Fr","Sa"],
        dayNamesMin:["So","Mo","Di","Mi","Do","Fr","Sa"],
        weekHeader:"KW",
        dateFormat:"dd.mm.yy",
        firstDay:1,
        isRTL:!1,
        showMonthAfterYear:!1,
        yearSuffix:""
    };
    
    n.datepicker.regional.es={
        closeText:"Cerrar",
        prevText:"&#x3c;Ant",
        nextText:"Sig&#x3e;",
        currentText:"Hoy",
        monthNames:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        monthNamesShort:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],
        dayNames:["Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado"],
        dayNamesShort:["Dom","Lun","Mar","Mi&eacute;","Juv","Vie","S&aacute;b"],
        dayNamesMin:["Do","Lu","Ma","Mi","Ju","Vi","S&aacute;"],
        weekHeader:"Sm",
        dateFormat:"dd/mm/yy",
        firstDay:1,
        isRTL:!1,
        showMonthAfterYear:!1,
        yearSuffix:""
    };
    
    n.datepicker.regional.ru={
        closeText:"Закрыть",
        prevText:"&#x3c;Пред",
        nextText:"След&#x3e;",
        currentText:"Сегодня",
        monthNames:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
        monthNamesShort:["Янв","Фев","Мар","Апр","Май","Июн","Июл","Авг","Сен","Окт","Ноя","Дек"],
        dayNames:["воскресенье","понедельник","вторник","среда","четверг","пятница","суббота"],
        dayNamesShort:["вск","пнд","втр","срд","чтв","птн","сбт"],
        dayNamesMin:["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],
        weekHeader:"Нед",
        dateFormat:"dd.mm.yy",
        firstDay:1,
        isRTL:!1,
        showMonthAfterYear:!1,
        yearSuffix:""
    };
    
    n.datepicker.regional["pt-BR"]={
        closeText:"Fechar",
        prevText:"&#x3c;Anterior",
        nextText:"Pr&oacute;ximo&#x3e;",
        currentText:"Hoje",
        monthNames:["Janeiro","Fevereiro","Mar&ccedil;o","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
        monthNamesShort:["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
        dayNames:["Domingo","Segunda-feira","Ter&ccedil;a-feira","Quarta-feira","Quinta-feira","Sexta-feira","S&aacute;bado"],
        dayNamesShort:["Dom","Seg","Ter","Qua","Qui","Sex","S&aacute;b"],
        dayNamesMin:["Dom","Seg","Ter","Qua","Qui","Sex","S&aacute;b"],
        weekHeader:"Sm",
        dateFormat:"dd/mm/yy",
        firstDay:0,
        isRTL:!1,
        showMonthAfterYear:!1,
        yearSuffix:""
    }
}),function(n){
    function i(n,t){
        for(var i=window,r=(n||"").split(".");i&&r.length;)i=i[r.shift()];
        return typeof i=="function"?i:(t.push(n),Function.constructor.apply(null,t))
        }
        function u(n){
        return n==="GET"||n==="POST"
        }
        function o(n,t){
        u(t)||n.setRequestHeader("X-HTTP-Method-Override",t)
        }
        function f(t,i,r){
        var f,u;
        r.indexOf("application/x-javascript")===-1&&(f=(t.getAttribute("data-ajax-mode")||"").toUpperCase(),u=t.getAttribute("data-ajax-popup")||undefined,u&&InventoryDashboard.Helpers.Popups.createPopup(n(t).attr("data-ajax-update")),n(t.getAttribute("data-ajax-update")).each(function(t,r){
            var u;
            switch(f){
                case"BEFORE":
                    u=r.firstChild;
                    n("<div />").html(i).contents().each(function(){
                    r.insertBefore(this,u)
                    });
                break;
                case"AFTER":
                    n("<div />").html(i).contents().each(function(){
                    r.appendChild(this)
                    });
                break;
                default:
                    n(r).html(i);
                    n.validator.unobtrusive.parse(r)
                    }
                }),u&&(InventoryDashboard.Helpers.Popups.repositionPopup(),InventoryDashboard.Helpers.Popups.currentPopup().find("form :input:visible:enabled:first").focus()))
    }
    function r(t,r){
    var e;
    n.extend(r,{
        type:t.getAttribute("data-ajax-method")||undefined,
        cache:!1,
        url:t.getAttribute("data-ajax-url")||undefined,
        beforeSend:function(n){
            return o(n,e),i(t.getAttribute("data-ajax-begin"),["xhr"]).apply(this,arguments)
            },
        complete:function(){
            i(t.getAttribute("data-ajax-complete"),["xhr","status"]).apply(this,arguments)
            },
        success:function(n,r,u){
            f(t,n,u.getResponseHeader("Content-Type")||"text/html");
            i(t.getAttribute("data-ajax-success"),["data","status","xhr"]).apply(this,arguments)
            },
        error:function(){
            i(t.getAttribute("data-ajax-failure"),["xhr","status","error"]).apply(this,arguments)
            }
        });
r.data.push({
    name:"X-Requested-With",
    value:"XMLHttpRequest"
});
e=r.type.toUpperCase();
u(e)||(r.type="POST",r.data.push({
    name:"X-HTTP-Method-Override",
    value:e
}));
n.ajax(r)
}
function s(t){
    var i=n(t).data(e);
    return!i||!i.validate||i.validate()
    }
    var t="unobtrusiveAjaxClick",e="unobtrusiveValidation";
n(document).on("click","a[data-ajax=true]",function(t){
    var f=this,e=n(this).attr("data-ajax-confirm"),i,u;
    return e?(i=n(this).attr("data-ajax-confirm-button"),i||(i=$s.labels.Yes_do_it),u=n("#generic-confirmation"),u.length||(u=n('<div id="generic-confirmation" style="display: none"><\/div>').appendTo(n("body"))),u.html("<p>"+e+"<\/p>"),n("#generic-confirmation").dialog({
        modal:!0,
        resizable:!1,
        position:{
            of:window,
            my:"center bottom",
            at:"center center"
        },
        buttons:[{
            text:i,
            click:function(){
                r(f,{
                    url:f.href,
                    cache:!1,
                    data:[]
                });
                n(this).dialog("close");
                n(this).remove()
                }
            },{
        text:$s.labels.No,
        click:function(){
            n(this).dialog("close");
            n(this).remove()
            }
        }]
    })):(t.preventDefault(),r(this,{
    url:this.href,
    type:"GET",
    data:[]
})),!1
});
n(document).on("click","form[data-ajax=true] input[type=image]",function(i){
    var r=i.target.name,u=n(i.target),f=u.parents("form")[0],e=u.offset();
    n(f).data(t,[{
        name:r+".x",
        value:Math.round(i.pageX-e.left)
        },{
        name:r+".y",
        value:Math.round(i.pageY-e.top)
        }]);
    setTimeout(function(){
        n(f).removeData(t)
        },0)
    });
n(document).on("click","form[data-ajax=true] :submit",function(i){
    var r=i.target.name,u=n(i.target).parents("form")[0];
    n(u).data(t,r?[{
        name:r,
        value:i.target.value
        }]:[]);
    setTimeout(function(){
        n(u).removeData(t)
        },0)
    });
n(document).on("submit","form[data-ajax=true]",function(i){
    var u=n(this).data(t)||[];
    (i.preventDefault(),s(this))&&r(this,{
        url:this.action,
        type:this.method||"GET",
        data:u.concat(n(this).serializeArray())
        })
    });
n(document).on("click","a[data-ajax-delete=true]",function(t){
    var e=this,s=n(this).attr("data-ajax-confirm"),o=n(this).attr("data-ajax-confirm-button"),u;
    return s?(o||(o=$s.labels.Yes_delete_it),u=n("#delete-confirmation"),u.length||(u=n('<div id="delete-confirmation" style="display: none"><\/div>').appendTo(n("body"))),u.html("<p>"+s+"<\/p>"),n("#delete-confirmation").dialog({
        modal:!0,
        resizable:!1,
        position:{
            of:window,
            my:"center bottom",
            at:"center center"
        },
        buttons:[{
            text:o,
            click:function(){
                n.ajax({
                    url:e.href,
                    type:"POST",
                    cache:!1,
                    data:[{
                        name:"X-HTTP-Method-Override",
                        value:"DELETE"
                    }],
                    success:function(n,t,r){
                        f(e,n,r.getResponseHeader("Content-Type")||"text/html");
                        i(e.getAttribute("data-ajax-success"),["data","status","xhr"]).apply(this,arguments)
                        }
                    });
            n(this).dialog("close")
            }
        },{
        text:$s.labels.No,
        click:function(){
            n(this).dialog("close")
            }
        }]
    })):(t.preventDefault(),r(this,{
    url:this.href,
    data:[]
})),!1
})
}(jQuery),function(n){
    n.extend(n.fn,{
        validate:function(t){
            var i,r;
            if(!this.length){
                t&&t.debug&&window.console&&console.warn("nothing selected, can't validate, returning nothing");
                return
            }
            return(i=n.data(this[0],"validator"),i)?i:(this.attr("novalidate","novalidate"),i=new n.validator(t,this[0]),n.data(this[0],"validator",i),i.settings.onsubmit&&(r=this.find("input, button"),r.filter(".cancel").click(function(){
                i.cancelSubmit=!0
                }),i.settings.submitHandler&&r.filter(":submit").click(function(){
                i.submitButton=this
                }),this.submit(function(t){
                function r(){
                    if(i.settings.submitHandler){
                        if(i.submitButton)var t=n("<input type='hidden'/>").attr("name",i.submitButton.name).val(i.submitButton.value).appendTo(i.currentForm);
                        return i.settings.submitHandler.call(i,i.currentForm),i.submitButton&&t.remove(),!1
                        }
                        return!0
                    }
                    return(i.settings.debug&&t.preventDefault(),i.cancelSubmit)?(i.cancelSubmit=!1,r()):i.form()?i.pendingRequest?(i.formSubmitted=!0,!1):r():(i.focusInvalid(),!1)
                })),i)
            },
        valid:function(){
            if(n(this[0]).is("form"))return this.validate().form();
            var t=!0,i=n(this[0].form).validate();
            return this.each(function(){
                t&=i.element(this)
                }),t
            },
        removeAttrs:function(t){
            var i={},r=this;
            return n.each(t.split(/\s/),function(n,t){
                i[t]=r.attr(t);
                r.removeAttr(t)
                }),i
            },
        rules:function(t,i){
            var r=this[0],o,u,h;
            if(t){
                var e=n.data(r.form,"validator").settings,s=e.rules,f=n.validator.staticRules(r);
                switch(t){
                    case"add":
                        n.extend(f,n.validator.normalizeRule(i));
                        s[r.name]=f;
                        i.messages&&(e.messages[r.name]=n.extend(e.messages[r.name],i.messages));
                        break;
                    case"remove":
                        return i?(o={},n.each(i.split(/\s/),function(n,t){
                        o[t]=f[t];
                        delete f[t]
                    }),o):(delete s[r.name],f)
                        }
                    }
            return u=n.validator.normalizeRules(n.extend({},n.validator.metadataRules(r),n.validator.classRules(r),n.validator.attributeRules(r),n.validator.staticRules(r)),r),u.required&&(h=u.required,delete u.required,u=n.extend({
            required:h
        },u)),u
        }
    });
n.extend(n.expr[":"],{
    blank:function(t){
        return!n.trim(""+t.value)
        },
    filled:function(t){
        return!!n.trim(""+t.value)
        },
    unchecked:function(n){
        return!n.checked
        }
    });
n.validator=function(t,i){
    this.settings=n.extend(!0,{},n.validator.defaults,t);
    this.currentForm=i;
    this.init()
    };
    
n.validator.format=function(t,i){
    return arguments.length==1?function(){
        var i=n.makeArray(arguments);
        return i.unshift(t),n.validator.format.apply(this,i)
        }:(arguments.length>2&&i.constructor!=Array&&(i=n.makeArray(arguments).slice(1)),i.constructor!=Array&&(i=[i]),n.each(i,function(n,i){
        t=t.replace(new RegExp("\\{"+n+"\\}","g"),i)
        }),t)
    };
    
n.extend(n.validator,{
    defaults:{
        messages:{},
        groups:{},
        rules:{},
        errorClass:"error",
        validClass:"valid",
        errorElement:"label",
        focusInvalid:!0,
        errorContainer:n([]),
        errorLabelContainer:n([]),
        onsubmit:!0,
        ignore:"",
        ignoreTitle:!1,
        onfocusin:function(n){
            this.lastActive=n;
            this.settings.focusCleanup&&!this.blockFocusCleanup&&(this.settings.unhighlight&&this.settings.unhighlight.call(this,n,this.settings.errorClass,this.settings.validClass),this.addWrapper(this.errorsFor(n)).hide())
            },
        onfocusout:function(n){
            !this.checkable(n)&&(n.name in this.submitted||!this.optional(n))&&this.element(n)
            },
        onkeyup:function(n){
            (n.name in this.submitted||n==this.lastElement)&&this.element(n)
            },
        onclick:function(n){
            n.name in this.submitted?this.element(n):n.parentNode.name in this.submitted&&this.element(n.parentNode)
            },
        highlight:function(t,i,r){
            t.type==="radio"?this.findByName(t.name).addClass(i).removeClass(r):n(t).addClass(i).removeClass(r)
            },
        unhighlight:function(t,i,r){
            t.type==="radio"?this.findByName(t.name).removeClass(i).addClass(r):n(t).removeClass(i).addClass(r)
            }
        },
setDefaults:function(t){
    n.extend(n.validator.defaults,t)
    },
messages:{
    required:"This field is required.",
    remote:"Please fix this field.",
    email:"Please enter a valid email address.",
    url:"Please enter a valid URL.",
    date:"Please enter a valid date.",
    dateISO:"Please enter a valid date (ISO).",
    number:"Please enter a valid number.",
    digits:"Please enter only digits.",
    creditcard:"Please enter a valid credit card number.",
    equalTo:"Please enter the same value again.",
    accept:"Please enter a value with a valid extension.",
    maxlength:n.validator.format("Please enter no more than {0} characters."),
    minlength:n.validator.format("Please enter at least {0} characters."),
    rangelength:n.validator.format("Please enter a value between {0} and {1} characters long."),
    range:n.validator.format("Please enter a value between {0} and {1}."),
    max:n.validator.format("Please enter a value less than or equal to {0}."),
    min:n.validator.format("Please enter a value greater than or equal to {0}.")
    },
autoCreateRanges:!1,
prototype:{
    init:function(){
        function r(t){
            var i=n.data(this[0].form,"validator"),r="on"+t.type.replace(/^validate/,"");
            i.settings[r]&&i.settings[r].call(i,this[0],t)
            }
            var i,t;
        this.labelContainer=n(this.settings.errorLabelContainer);
        this.errorContext=this.labelContainer.length&&this.labelContainer||n(this.currentForm);
        this.containers=n(this.settings.errorContainer).add(this.settings.errorLabelContainer);
        this.submitted={};
        
        this.valueCache={};
        
        this.pendingRequest=0;
        this.pending={};
        
        this.invalid={};
        
        this.reset();
        i=this.groups={};
        
        n.each(this.settings.groups,function(t,r){
            n.each(r.split(/\s/),function(n,r){
                i[r]=t
                })
            });
        t=this.settings.rules;
        n.each(t,function(i,r){
            t[i]=n.validator.normalizeRule(r)
            });
        n(this.currentForm).validateDelegate("[type='text'], [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'] ","focusin focusout keyup",r).validateDelegate("[type='radio'], [type='checkbox'], select, option","click",r);
        this.settings.invalidHandler&&n(this.currentForm).bind("invalid-form.validate",this.settings.invalidHandler)
        },
    form:function(){
        return this.checkForm(),n.extend(this.submitted,this.errorMap),this.invalid=n.extend({},this.errorMap),this.valid()||n(this.currentForm).triggerHandler("invalid-form",[this]),this.showErrors(),this.valid()
        },
    checkForm:function(){
        this.prepareForm();
        for(var n=0,t=this.currentElements=this.elements();t[n];n++)this.check(t[n]);
        return this.valid()
        },
    element:function(t){
        t=this.validationTargetFor(this.clean(t));
        this.lastElement=t;
        this.prepareElement(t);
        this.currentElements=n(t);
        var i=this.check(t);
        return i?delete this.invalid[t.name]:this.invalid[t.name]=!0,this.numberOfInvalids()||(this.toHide=this.toHide.add(this.containers)),this.showErrors(),i
        },
    showErrors:function(t){
        if(t){
            n.extend(this.errorMap,t);
            this.errorList=[];
            for(var i in t)this.errorList.push({
                message:t[i],
                element:this.findByName(i)[0]
                });this.successList=n.grep(this.successList,function(n){
                return!(n.name in t)
                })
            }
            this.settings.showErrors?this.settings.showErrors.call(this,this.errorMap,this.errorList):this.defaultShowErrors()
        },
    resetForm:function(){
        n.fn.resetForm&&n(this.currentForm).resetForm();
        this.submitted={};
        
        this.lastElement=null;
        this.prepareForm();
        this.hideErrors();
        this.elements().removeClass(this.settings.errorClass)
        },
    numberOfInvalids:function(){
        return this.objectLength(this.invalid)
        },
    objectLength:function(n){
        var t=0;
        for(var i in n)t++;return t
        },
    hideErrors:function(){
        this.addWrapper(this.toHide).hide()
        },
    valid:function(){
        return this.size()==0
        },
    size:function(){
        return this.errorList.length
        },
    focusInvalid:function(){
        if(this.settings.focusInvalid)try{
            n(this.findLastActive()||this.errorList.length&&this.errorList[0].element||[]).filter(":visible").focus().trigger("focusin")
            }catch(t){}
        },
findLastActive:function(){
    var t=this.lastActive;
    return t&&n.grep(this.errorList,function(n){
        return n.element.name==t.name
        }).length==1&&t
    },
elements:function(){
    var t=this,i={};
    
    return n(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function(){
        return(!this.name&&t.settings.debug&&window.console&&console.error("%o has no name assigned",this),this.name in i||!t.objectLength(n(this).rules()))?!1:(i[this.name]=!0,!0)
        })
    },
clean:function(t){
    return n(t)[0]
    },
errors:function(){
    return n(this.settings.errorElement+"."+this.settings.errorClass,this.errorContext)
    },
reset:function(){
    this.successList=[];
    this.errorList=[];
    this.errorMap={};
    
    this.toShow=n([]);
    this.toHide=n([]);
    this.currentElements=n([])
    },
prepareForm:function(){
    this.reset();
    this.toHide=this.errors().add(this.containers)
    },
prepareElement:function(n){
    this.reset();
    this.toHide=this.errorsFor(n)
    },
check:function(t){
    var i,r,u,f,e;
    t=this.validationTargetFor(this.clean(t));
    i=n(t).rules();
    r=!1;
    for(u in i){
        f={
            method:u,
            parameters:i[u]
            };
            
        try{
            if(e=n.validator.methods[u].call(this,t.value.replace(/\r/g,""),t,f.parameters),e=="dependency-mismatch"){
                r=!0;
                continue
            }
            if(r=!1,e=="pending"){
                this.toHide=this.toHide.not(this.errorsFor(t));
                return
            }
            if(!e)return this.formatAndAdd(t,f),!1
                }catch(o){
            this.settings.debug&&window.console&&console.log("exception occured when checking element "+t.id+", check the '"+f.method+"' method",o);
            throw o;
        }
    }
    if(!r)return this.objectLength(i)&&this.successList.push(t),!0
    },
customMetaMessage:function(t,i){
    if(n.metadata){
        var r=this.settings.meta?n(t).metadata()[this.settings.meta]:n(t).metadata();
        return r&&r.messages&&r.messages[i]
        }
    },
customMessage:function(n,t){
    var i=this.settings.messages[n];
    return i&&(i.constructor==String?i:i[t])
    },
findDefined:function(){
    for(var n=0;n<arguments.length;n++)if(arguments[n]!==undefined)return arguments[n];return undefined
    },
defaultMessage:function(t,i){
    return this.findDefined(this.customMessage(t.name,i),this.customMetaMessage(t,i),!this.settings.ignoreTitle&&t.title||undefined,n.validator.messages[i],"<strong>Warning: No message defined for "+t.name+"<\/strong>")
    },
formatAndAdd:function(n,t){
    var i=this.defaultMessage(n,t.method),r=/\$?\{(\d+)\}/g;
    typeof i=="function"?i=i.call(this,t.parameters,n):r.test(i)&&(i=jQuery.format(i.replace(r,"{$1}"),t.parameters));
    this.errorList.push({
        message:i,
        element:n
    });
    this.errorMap[n.name]=i;
    this.submitted[n.name]=i
    },
addWrapper:function(n){
    return this.settings.wrapper&&(n=n.add(n.parent(this.settings.wrapper))),n
    },
defaultShowErrors:function(){
    for(var t,i,n=0;this.errorList[n];n++)t=this.errorList[n],this.settings.highlight&&this.settings.highlight.call(this,t.element,this.settings.errorClass,this.settings.validClass),this.showLabel(t.element,t.message);
    if(this.errorList.length&&(this.toShow=this.toShow.add(this.containers)),this.settings.success)for(n=0;this.successList[n];n++)this.showLabel(this.successList[n]);
    if(this.settings.unhighlight)for(n=0,i=this.validElements();i[n];n++)this.settings.unhighlight.call(this,i[n],this.settings.errorClass,this.settings.validClass);
    this.toHide=this.toHide.not(this.toShow);
    this.hideErrors();
    this.addWrapper(this.toShow).show()
    },
validElements:function(){
    return this.currentElements.not(this.invalidElements())
    },
invalidElements:function(){
    return n(this.errorList).map(function(){
        return this.element
        })
    },
showLabel:function(t,i){
    var r=this.errorsFor(t);
    r.length?(r.removeClass(this.settings.validClass).addClass(this.settings.errorClass),r.attr("generated")&&r.html(i)):(r=n("<"+this.settings.errorElement+"/>").attr({
        "for":this.idOrName(t),
        generated:!0
        }).addClass(this.settings.errorClass).html(i||""),this.settings.wrapper&&(r=r.hide().show().wrap("<"+this.settings.wrapper+"/>").parent()),this.labelContainer.append(r).length||(this.settings.errorPlacement?this.settings.errorPlacement(r,n(t)):r.insertAfter(t)));
    !i&&this.settings.success&&(r.text(""),typeof this.settings.success=="string"?r.addClass(this.settings.success):this.settings.success(r));
    this.toShow=this.toShow.add(r)
    },
errorsFor:function(t){
    var i=this.idOrName(t);
    return this.errors().filter(function(){
        return n(this).attr("for")==i
        })
    },
idOrName:function(n){
    return this.groups[n.name]||(this.checkable(n)?n.name:n.id||n.name)
    },
validationTargetFor:function(n){
    return this.checkable(n)&&(n=this.findByName(n.name).not(this.settings.ignore)[0]),n
    },
checkable:function(n){
    return/radio|checkbox/i.test(n.type)
    },
findByName:function(t){
    var i=this.currentForm;
    return n(document.getElementsByName(t)).map(function(n,r){
        return r.form==i&&r.name==t&&r||null
        })
    },
getLength:function(t,i){
    switch(i.nodeName.toLowerCase()){
        case"select":
            return n("option:selected",i).length;
        case"input":
            if(this.checkable(i))return this.findByName(i.name).filter(":checked").length
            }
            return t.length
    },
depend:function(n,t){
    return this.dependTypes[typeof n]?this.dependTypes[typeof n](n,t):!0
    },
dependTypes:{
    boolean:function(n){
        return n
        },
    string:function(t,i){
        return!!n(t,i.form).length
        },
    "function":function(n,t){
        return n(t)
        }
    },
optional:function(t){
    return!n.validator.methods.required.call(this,n.trim(t.value),t)&&"dependency-mismatch"
    },
startRequest:function(n){
    this.pending[n.name]||(this.pendingRequest++,this.pending[n.name]=!0)
    },
stopRequest:function(t,i){
    this.pendingRequest--;
    this.pendingRequest<0&&(this.pendingRequest=0);
    delete this.pending[t.name];
    i&&this.pendingRequest==0&&this.formSubmitted&&this.form()?(n(this.currentForm).submit(),this.formSubmitted=!1):!i&&this.pendingRequest==0&&this.formSubmitted&&(n(this.currentForm).triggerHandler("invalid-form",[this]),this.formSubmitted=!1)
    },
previousValue:function(t){
    return n.data(t,"previousValue")||n.data(t,"previousValue",{
        old:null,
        valid:!0,
        message:this.defaultMessage(t,"remote")
        })
    }
},
classRuleSettings:{
    required:{
        required:!0
        },
    email:{
        email:!0
        },
    url:{
        url:!0
        },
    date:{
        date:!0
        },
    dateISO:{
        dateISO:!0
        },
    dateDE:{
        dateDE:!0
        },
    number:{
        number:!0
        },
    numberDE:{
        numberDE:!0
        },
    digits:{
        digits:!0
        },
    creditcard:{
        creditcard:!0
        }
    },
addClassRules:function(t,i){
    t.constructor==String?this.classRuleSettings[t]=i:n.extend(this.classRuleSettings,t)
    },
classRules:function(t){
    var i={},r=n(t).attr("class");
    return r&&n.each(r.split(" "),function(){
        this in n.validator.classRuleSettings&&n.extend(i,n.validator.classRuleSettings[this])
        }),i
    },
attributeRules:function(t){
    var r={},u=n(t),i,f;
    for(i in n.validator.methods)f=i==="required"&&typeof n.fn.prop=="function"?u.prop(i):u.attr(i),f?r[i]=f:u[0].getAttribute("type")===i&&(r[i]=!0);return r.maxlength&&/-1|2147483647|524288/.test(r.maxlength)&&delete r.maxlength,r
    },
metadataRules:function(t){
    if(!n.metadata)return{};
        
    var i=n.data(t.form,"validator").settings.meta;
    return i?n(t).metadata()[i]:n(t).metadata()
    },
staticRules:function(t){
    var i={},r=n.data(t.form,"validator");
    return r.settings.rules&&(i=n.validator.normalizeRule(r.settings.rules[t.name])||{}),i
    },
normalizeRules:function(t,i){
    return n.each(t,function(r,u){
        if(u===!1){
            delete t[r];
            return
        }
        if(u.param||u.depends){
            var f=!0;
            switch(typeof u.depends){
                case"string":
                    f=!!n(u.depends,i.form).length;
                    break;
                case"function":
                    f=u.depends.call(i,i)
                    }
                    f?t[r]=u.param!==undefined?u.param:!0:delete t[r]
        }
    }),n.each(t,function(r,u){
    t[r]=n.isFunction(u)?u(i):u
    }),n.each(["minlength","maxlength","min","max"],function(){
    t[this]&&(t[this]=Number(t[this]))
    }),n.each(["rangelength","range"],function(){
    t[this]&&(t[this]=[Number(t[this][0]),Number(t[this][1])])
    }),n.validator.autoCreateRanges&&(t.min&&t.max&&(t.range=[t.min,t.max],delete t.min,delete t.max),t.minlength&&t.maxlength&&(t.rangelength=[t.minlength,t.maxlength],delete t.minlength,delete t.maxlength)),t.messages&&delete t.messages,t
},
normalizeRule:function(t){
    if(typeof t=="string"){
        var i={};
        
        n.each(t.split(/\s/),function(){
            i[this]=!0
            });
        t=i
        }
        return t
    },
addMethod:function(t,i,r){
    n.validator.methods[t]=i;
    n.validator.messages[t]=r!=undefined?r:n.validator.messages[t];
    i.length<3&&n.validator.addClassRules(t,n.validator.normalizeRule(t))
    },
methods:{
    required:function(t,i,r){
        if(!this.depend(r,i))return"dependency-mismatch";
        switch(i.nodeName.toLowerCase()){
            case"select":
                var u=n(i).val();
                return u&&u.length>0;
            case"input":
                if(this.checkable(i))return this.getLength(t,i)>0;default:
                return n.trim(t).length>0
                }
            },
remote:function(t,i,r){
    var f,u,e;
    return this.optional(i)?"dependency-mismatch":(f=this.previousValue(i),this.settings.messages[i.name]||(this.settings.messages[i.name]={}),f.originalMessage=this.settings.messages[i.name].remote,this.settings.messages[i.name].remote=f.message,r=typeof r=="string"&&{
        url:r
    }||r,this.pending[i.name])?"pending":f.old===t?f.valid:(f.old=t,u=this,this.startRequest(i),e={},e[i.name]=t,n.ajax(n.extend(!0,{
        url:r,
        mode:"abort",
        port:"validate"+i.name,
        dataType:"json",
        data:e,
        success:function(r){
            var e,h,s,o;
            u.settings.messages[i.name].remote=f.originalMessage;
            e=r===!0;
            e?(h=u.formSubmitted,u.prepareElement(i),u.formSubmitted=h,u.successList.push(i),u.showErrors()):(s={},o=r||u.defaultMessage(i,"remote"),s[i.name]=f.message=n.isFunction(o)?o(t):o,u.showErrors(s));
            f.valid=e;
            u.stopRequest(i,e)
            }
        },r)),"pending")
},
minlength:function(t,i,r){
    return this.optional(i)||this.getLength(n.trim(t),i)>=r
    },
maxlength:function(t,i,r){
    return this.optional(i)||this.getLength(n.trim(t),i)<=r
    },
rangelength:function(t,i,r){
    var u=this.getLength(n.trim(t),i);
    return this.optional(i)||u>=r[0]&&u<=r[1]
    },
min:function(n,t,i){
    return this.optional(t)||n>=i
    },
max:function(n,t,i){
    return this.optional(t)||n<=i
    },
range:function(n,t,i){
    return this.optional(t)||n>=i[0]&&n<=i[1]
    },
email:function(n,t){
    return this.optional(t)||/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(n)
    },
url:function(n,t){
    return this.optional(t)||/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(n)}
,date:function(n,t){return this.optional(t)||!/Invalid|NaN/.test(new Date(n))}
,dateISO:function(n,t){return this.optional(t)||/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(n)}
,number:function(n,t){return this.optional(t)||/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(n)}
,digits:function(n,t){return this.optional(t)||/^\d+$/.test(n)}
,creditcard:function(n,t){var r,e,i;if(this.optional(t))return"dependency-mismatch";if(/[^0-9 -]+/.test(n))return!1;var f=0,i=0,u=!1;for(n=n.replace(/\D/g,""),r=n.length-1;r>=0;r--)e=n.charAt(r),i=parseInt(e,10),u&&(i*=2)>9&&(i-=9),f+=i,u=!u;return f%10==0}
,accept:function(n,t,i){return i=typeof i=="string"?i.replace(/,/g,"|"):"png|jpe?g|gif",this.optional(t)||n.match(new RegExp(".("+i+")$","i"))}
,equalTo:function(t,i,r){var u=n(r).unbind(".validate-equalTo").bind("blur.validate-equalTo",function(){n(i).valid()});return t==u.val()}}});n.format=n.validator.format}(jQuery),function(n){var t={},i;n.ajaxPrefilter?n.ajaxPrefilter(function(n,i,r){var u=n.port;n.mode=="abort"&&(t[u]&&t[u].abort(),t[u]=r)}):(i=n.ajax,n.ajax=function(r){var f=("mode"in r?r:n.ajaxSettings).mode,u=("port"in r?r:n.ajaxSettings).port;return f=="abort"?(t[u]&&t[u].abort(),t[u]=i.apply(this,arguments)):i.apply(this,arguments)})}(jQuery),function(n){jQuery.event.special.focusin||jQuery.event.special.focusout||!document.addEventListener||n.each({focus:"focusin"
    ,blur:"focusout"},function(t,i){function r(t){return t=n.event.fix(t),t.type=i,n.event.dispatch.call(this,t)}n.event.special[i]={setup:function(){this.addEventListener(t,r,!0)}
    ,teardown:function(){this.removeEventListener(t,r,!0)}
    ,handler:function(t){return arguments[0]=n.event.fix(t),arguments[0].type=i,n.event.handle.apply(this,arguments)}}});n.extend(n.fn,{validateDelegate:function(t,i,r){return this.bind(i,function(i){var u=n(i.target);if(u.is(t))return r.apply(u,arguments)})}})}(jQuery),function(n){function i(n,t,i){n.rules[t]=i;n.message&&(n.messages[t]=n.message)}function h(n){return n.replace(/^\s+|\s+$/g,"").split(/\s*,\s*/g)}function f(n){return n.replace(/([!"#$%&'()*+,.\/:;<=>?@\[\\\]\^`{|}~])/g,"\\$1")
    }
    function e(n){
    return n.substr(0,n.lastIndexOf(".")+1)
    }
    function o(n,t){
    return n.indexOf("*.")===0&&(n=n.replace("*.",t)),n
    }
    function c(t,i){
    var r=n(this).find("[data-valmsg-for='"+i[0].name+"']"),f=r.attr("data-valmsg-replace"),e=f?f!==!1:null,o=i[0].name,u=i[0];
    n(u).attr("type")=="hidden"&&n(u).attr("data-pos-id")&&(u="#"+n(u).attr("data-pos-id"));
    r.removeClass("field-validation-valid").addClass("field-validation-error");
    r.show();
    r.position({
        my:"left top",
        at:"left bottom",
        of:u
    });
    r.hide();
    r.html('<a href="#"><\/a>');
    r.children("a").click(function(t){
        var i=n(this).parent();
        return i&&(i.addClass("field-validation-valid").removeClass("field-validation-error"),i.empty()),t.preventDefault(),!1
        });
    t.data("unobtrusiveContainer",r);
    e?(r.show(),t.removeClass("input-validation-error").appendTo(r)):t.hide()
    }
    function l(t,i){
    var u=n(this).find("[data-valmsg-summary=true]"),r=u.find("ul");
    r&&r.length&&i.errorList.length&&(r.empty(),u.addClass("validation-summary-errors").removeClass("validation-summary-valid"),n.each(i.errorList,function(){
        n("<li />").html(this.message).appendTo(r)
        }))
    }
    function a(n){
    var t=n.data("unobtrusiveContainer"),i=Boolean(t.attr("data-valmsg-replace"));
    t&&(t.addClass("field-validation-valid").removeClass("field-validation-error"),n.removeData("unobtrusiveContainer"),i&&t.empty())
    }
    function v(){
    var t=n(this);
    t.data("validator").resetForm();
    t.find(".validation-summary-errors").addClass("validation-summary-valid").removeClass("validation-summary-errors");
    t.find(".field-validation-error").addClass("field-validation-valid").removeClass("field-validation-error").removeData("unobtrusiveContainer").find(">*").removeData("unobtrusiveContainer")
    }
    function s(t){
    var i=n(t),r=i.data(u),f=n.proxy(v,t);
    return r||(r={
        options:{
            errorClass:"input-validation-error",
            errorElement:"span",
            errorPlacement:n.proxy(c,t),
            invalidHandler:n.proxy(l,t),
            messages:{},
            rules:{},
            success:n.proxy(a,t),
            ignore:[]
        },
        attachValidation:function(){
            i.unbind("reset."+u,f).bind("reset."+u,f).validate(this.options)
            },
        validate:function(){
            return i.validate(),i.valid()
            }
        },i.data(u,r)),r
}
var r=n.validator,t,u="unobtrusiveValidation";
r.unobtrusive={
    adapters:[],
    parseElement:function(t,i){
        var u=n(t),f=u.parents("form")[0],r,e,o;
        f&&(r=s(f),r.options.rules[t.name]=e={},r.options.messages[t.name]=o={},n.each(this.adapters,function(){
            var i="data-val-"+this.name,r=u.attr(i),s={};
            
            r!==undefined&&(i+="-",n.each(this.params,function(){
                s[this]=u.attr(i+this)
                }),this.adapt({
                element:t,
                form:f,
                message:r,
                params:s,
                rules:e,
                messages:o
            }))
            }),n.extend(e,{
            __dummy__:!0
            }),i||r.attachValidation())
        },
    parse:function(t){
        var i=n(t).parents("form").andSelf().add(n(t).find("form")).filter("form");
        n(t).find(":input[data-val=true]").each(function(){
            r.unobtrusive.parseElement(this,!0)
            });
        i.each(function(){
            var n=s(this);
            n&&n.attachValidation()
            })
        }
    };

t=r.unobtrusive.adapters;
t.add=function(n,t,i){
    return i||(i=t,t=[]),this.push({
        name:n,
        params:t,
        adapt:i
    }),this
    };
    
t.addBool=function(n,t){
    return this.add(n,function(r){
        i(r,t||n,!0)
        })
    };
    
t.addMinMax=function(n,t,r,u,f,e){
    return this.add(n,[f||"min",e||"max"],function(n){
        var f=n.params.min,e=n.params.max;
        f&&e?i(n,u,[f,e]):f?i(n,t,f):e&&i(n,r,e)
        })
    };
    
t.addSingleVal=function(n,t,r){
    return this.add(n,[t||"val"],function(u){
        i(u,r||n,u.params[t])
        })
    };
    
r.addMethod("__dummy__",function(){
    return!0
    });
r.addMethod("regex",function(n,t,i){
    var r;
    return this.optional(t)?!0:(r=new RegExp(i).exec(n),r&&r.index===0&&r[0].length===n.length)
    });
t.addSingleVal("accept","exts").addSingleVal("regex","pattern");
t.addBool("creditcard").addBool("date").addBool("digits").addBool("email").addBool("number").addBool("url");
t.addMinMax("length","minlength","maxlength","rangelength").addMinMax("range","min","max","range");
t.add("equalto",["other"],function(t){
    var r=e(t.element.name),u=t.params.other,s=o(u,r),h=n(t.form).find(":input[name='"+f(s)+"']")[0];
    i(t,"equalTo",h)
    });
t.add("required",function(n){
    (n.element.tagName.toUpperCase()!=="INPUT"||n.element.type.toUpperCase()!=="CHECKBOX")&&i(n,"required",!0)
    });
t.add("remote",["url","type","additionalfields"],function(t){
    var r={
        url:t.params.url,
        type:t.params.type||"GET",
        data:{}
},u=e(t.element.name);
    n.each(h(t.params.additionalfields||t.element.name),function(i,e){
    var s=o(e,u);
    r.data[s]=function(){
        return n(t.form).find(":input[name='"+f(s)+"']").val()
        }
    });
i(t,"remote",r)
});
n(function(){
    r.unobtrusive.parse(document)
    })
}(jQuery);
qq=qq||{};
    
qq.extend=function(n,t){
    for(var i in t)n[i]=t[i]
        };
        
qq.indexOf=function(n,t,i){
    if(n.indexOf)return n.indexOf(t,i);
    i=i||0;
    var r=n.length;
    for(i<0&&(i+=r);i<r;i++)if(i in n&&n[i]===t)return i;return-1
    };
    
qq.getUniqueId=function(){
    var n=0;
    return function(){
        return n++
        }
    }();
qq.attach=function(n,t,i){
    n.addEventListener?n.addEventListener(t,i,!1):n.attachEvent&&n.attachEvent("on"+t,i)
    };
    
qq.detach=function(n,t,i){
    n.removeEventListener?n.removeEventListener(t,i,!1):n.attachEvent&&n.detachEvent("on"+t,i)
    };
    
qq.preventDefault=function(n){
    n.preventDefault?n.preventDefault():n.returnValue=!1
    };
    
qq.insertBefore=function(n,t){
    t.parentNode.insertBefore(n,t)
    };
    
qq.remove=function(n){
    n.parentNode.removeChild(n)
    };
    
qq.contains=function(n,t){
    return n==t?!0:n.contains?n.contains(t):!!(t.compareDocumentPosition(n)&8)
    };
    
qq.toElement=function(){
    var n=document.createElement("div");
    return function(t){
        n.innerHTML=t;
        var i=n.firstChild;
        return n.removeChild(i),i
        }
    }();
qq.css=function(n,t){
    t.opacity!=null&&typeof n.style.opacity!="string"&&typeof n.filters!="undefined"&&(t.filter="alpha(opacity="+Math.round(100*t.opacity)+")");
    qq.extend(n.style,t)
    };
    
qq.hasClass=function(n,t){
    var i=new RegExp("(^| )"+t+"( |$)");
    return i.test(n.className)
    };
    
qq.addClass=function(n,t){
    qq.hasClass(n,t)||(n.className+=" "+t)
    };
    
qq.removeClass=function(n,t){
    var i=new RegExp("(^| )"+t+"( |$)");
    n.className=n.className.replace(i," ").replace(/^\s+|\s+$/g,"")
    };
    
qq.setText=function(n,t){
    n.innerText=t;
    n.textContent=t
    };
    
qq.children=function(n){
    for(var i=[],t=n.firstChild;t;)t.nodeType==1&&i.push(t),t=t.nextSibling;
    return i
    };
    
qq.getByClass=function(n,t){
    var i;
    if(n.querySelectorAll)return n.querySelectorAll("."+t);
    var u=[],r=n.getElementsByTagName("*"),f=r.length;
    for(i=0;i<f;i++)qq.hasClass(r[i],t)&&u.push(r[i]);
    return u
    };
    
qq.obj2url=function(n,t,i){
    var u=[],f="&",e=function(n,i){
        var r=t?/\[\]$/.test(t)?t:t+"["+i+"]":i;
        r!="undefined"&&i!="undefined"&&u.push(typeof n=="object"?qq.obj2url(n,r,!0):Object.prototype.toString.call(n)==="[object Function]"?encodeURIComponent(r)+"="+encodeURIComponent(n()):encodeURIComponent(r)+"="+encodeURIComponent(n))
        },o,r;
    if(!i&&t)f=/\?/.test(t)?/\?$/.test(t)?"":"&":"?",u.push(t),u.push(qq.obj2url(n));
    else if(Object.prototype.toString.call(n)==="[object Array]"&&typeof n!="undefined")for(r=0,o=n.length;r<o;++r)e(n[r],r);
    else if(typeof n!="undefined"&&n!==null&&typeof n=="object")for(r in n)e(n[r],r);else u.push(encodeURIComponent(t)+"="+encodeURIComponent(n));
    return u.join(f).replace(/^&/,"").replace(/%20/g,"+")
    };
    
qq=qq||{};
    
qq.FileUploaderBasic=function(n){
    this._options={
        debug:!1,
        action:"/server/upload",
        params:{},
        button:null,
        multiple:!0,
        maxConnections:3,
        allowedExtensions:[],
        sizeLimit:0,
        minSizeLimit:0,
        onSubmit:function(){},
        onProgress:function(){},
        onComplete:function(){},
        onCancel:function(){},
        messages:{
            typeError:"{file} has an invalid extension. Only files with an extension of {extensions} are allowed.",
            sizeError:"{file} is too large, maximum file size is {sizeLimit}.",
            minSizeError:"{file} is too small, minimum file size is {minSizeLimit}.",
            emptyError:"{file} is empty, please select the file again.",
            onLeave:"The files are being uploaded, if you leave now the upload will be cancelled."
        },
        showMessage:function(n){
            alert(n)
            }
        };
    
qq.extend(this._options,n);
    this._filesInProgress=0;
    this._handler=this._createUploadHandler();
    this._options.button&&(this._button=this._createUploadButton(this._options.button));
    this._preventLeaveInProgress()
    };
    
qq.FileUploaderBasic.prototype={
    setParams:function(n){
        this._options.params=n
        },
    getInProgress:function(){
        return this._filesInProgress
        },
    _createUploadButton:function(n){
        var t=this;
        return new qq.UploadButton({
            element:n,
            multiple:this._options.multiple&&qq.UploadHandlerXhr.isSupported(),
            onChange:function(n){
                t._onInputChange(n)
                }
            })
    },
_createUploadHandler:function(){
    var n=this,t;
    return t=qq.UploadHandlerXhr.isSupported()?"UploadHandlerXhr":"UploadHandlerForm",new qq[t]({
        debug:this._options.debug,
        action:this._options.action,
        maxConnections:this._options.maxConnections,
        onProgress:function(t,i,r,u){
            n._onProgress(t,i,r,u);
            n._options.onProgress(t,i,r,u)
            },
        onComplete:function(t,i,r){
            n._onComplete(t,i,r);
            n._options.onComplete(t,i,r)
            },
        onCancel:function(t,i){
            n._onCancel(t,i);
            n._options.onCancel(t,i)
            }
        })
},
_preventLeaveInProgress:function(){
    var n=this;
    qq.attach(window,"beforeunload",function(t){
        if(n._filesInProgress){
            var t=t||window.event;
            return t.returnValue=n._options.messages.onLeave,n._options.messages.onLeave
            }
        })
},
_onSubmit:function(){
    this._filesInProgress++
},
_onProgress:function(){},
_onComplete:function(n,t,i){
    this._filesInProgress--;
    i.error&&this._options.showMessage(i.error)
    },
_onCancel:function(){
    this._filesInProgress--
},
_onInputChange:function(n){
    this._handler instanceof qq.UploadHandlerXhr?this._uploadFileList(n.files):this._validateFile(n)&&this._uploadFile(n);
    this._button.reset()
    },
_uploadFileList:function(n){
    for(var t=0;t<n.length;t++)if(!this._validateFile(n[t]))return;for(t=0;t<n.length;t++)this._uploadFile(n[t])
        },
_uploadFile:function(n){
    var t=this._handler.add(n),i=this._handler.getName(t);
    this._options.onSubmit(t,i)!==!1&&(this._onSubmit(t,i),this._handler.upload(t,this._options.params))
    },
_validateFile:function(n){
    var t,i;
    if(n.value?t=n.value.replace(/.*(\/|\\)/,""):(t=n.fileName!=null?n.fileName:n.name,i=n.fileSize!=null?n.fileSize:n.size),this._isAllowedExtension(t)){
        if(i===0)return this._error("emptyError",t),!1;
        if(i&&this._options.sizeLimit&&i>this._options.sizeLimit)return this._error("sizeError",t),!1;
        if(i&&i<this._options.minSizeLimit)return this._error("minSizeError",t),!1
            }else return this._error("typeError",t),!1;
    return!0
    },
_error:function(n,t){
    function i(n,t){
        r=r.replace(n,t)
        }
        var r=this._options.messages[n];
    i("{file}",this._formatFileName(t));
    i("{extensions}",this._options.allowedExtensions.join(", "));
    i("{sizeLimit}",this._formatSize(this._options.sizeLimit));
    i("{minSizeLimit}",this._formatSize(this._options.minSizeLimit));
    this._options.showMessage(r)
    },
_formatFileName:function(n){
    return n.length>33&&(n=n.slice(0,19)+"..."+n.slice(-13)),n
    },
_isAllowedExtension:function(n){
    var r=-1!==n.indexOf(".")?n.replace(/.*[.]/,"").toLowerCase():"",i=this._options.allowedExtensions,t;
    if(!i.length)return!0;
    for(t=0;t<i.length;t++)if(i[t].toLowerCase()==r)return!0;return!1
    },
_formatSize:function(n){
    var t=-1;
    do n=n/1024,t++;while(n>99);
    return Math.max(n,.1).toFixed(1)+["kB","MB","GB","TB","PB","EB"][t]
    }
};

qq.FileUploader=function(n){
    qq.FileUploaderBasic.apply(this,arguments);
    qq.extend(this._options,{
        element:null,
        listElement:null,
        template:'<div class="qq-uploader"><div class="qq-upload-drop-area"><span>Drop files here to upload<\/span><\/div><div class="qq-upload-button">Upload a file<\/div><ul class="qq-upload-list"><\/ul><\/div>',
        fileTemplate:'<li><span class="qq-upload-file"><\/span><span class="qq-upload-spinner"><\/span><span class="qq-upload-size"><\/span><a class="qq-upload-cancel" href="#">Cancel<\/a><span class="qq-upload-failed-text">Failed<\/span><\/li>',
        classes:{
            button:"qq-upload-button",
            drop:"qq-upload-drop-area",
            dropActive:"qq-upload-drop-area-active",
            list:"qq-upload-list",
            file:"qq-upload-file",
            spinner:"qq-upload-spinner",
            size:"qq-upload-size",
            cancel:"qq-upload-cancel",
            success:"qq-upload-success",
            fail:"qq-upload-fail"
        }
    });
qq.extend(this._options,n);
    this._element=this._options.element;
    this._element.innerHTML=this._options.template;
    this._listElement=this._options.listElement||this._find(this._element,"list");
    this._classes=this._options.classes;
    this._button=this._createUploadButton(this._find(this._element,"button"));
    this._bindCancelEvent();
    this._setupDragDrop()
    };
    
qq.extend(qq.FileUploader.prototype,qq.FileUploaderBasic.prototype);
qq.extend(qq.FileUploader.prototype,{
    _find:function(n,t){
        var i=qq.getByClass(n,this._options.classes[t])[0];
        if(!i)throw new Error("element not found "+t);
        return i
        },
    _setupDragDrop:function(){
        var t=this,n=this._find(this._element,"drop"),i=new qq.UploadDropZone({
            element:n,
            onEnter:function(i){
                qq.addClass(n,t._classes.dropActive);
                i.stopPropagation()
                },
            onLeave:function(n){
                n.stopPropagation()
                },
            onLeaveNotDescendants:function(){
                qq.removeClass(n,t._classes.dropActive)
                },
            onDrop:function(i){
                n.style.display="none";
                qq.removeClass(n,t._classes.dropActive);
                t._uploadFileList(i.dataTransfer.files)
                }
            });
    n.style.display="none";
    qq.attach(document,"dragenter",function(t){
        i._isValidFileDrag(t)&&(n.style.display="block")
        });
    qq.attach(document,"dragleave",function(t){
        if(i._isValidFileDrag(t)){
            var r=document.elementFromPoint(t.clientX,t.clientY);
            r&&r.nodeName!="HTML"||(n.style.display="none")
            }
        })
},
_onSubmit:function(n,t){
    qq.FileUploaderBasic.prototype._onSubmit.apply(this,arguments);
    this._addToList(n,t)
    },
_onProgress:function(n,t,i,r){
    var f,u,e;
    qq.FileUploaderBasic.prototype._onProgress.apply(this,arguments);
    f=this._getItemByFileId(n);
    u=this._find(f,"size");
    u.style.display="inline";
    e=i!=r?Math.round(i/r*100)+"% from "+this._formatSize(r):this._formatSize(r);
    qq.setText(u,e)
    },
_onComplete:function(n,t,i){
    qq.FileUploaderBasic.prototype._onComplete.apply(this,arguments);
    var r=this._getItemByFileId(n);
    qq.remove(this._find(r,"cancel"));
    qq.remove(this._find(r,"spinner"));
    i.success?qq.addClass(r,this._classes.success):qq.addClass(r,this._classes.fail)
    },
_addToList:function(n,t){
    var i=qq.toElement(this._options.fileTemplate),r;
    i.qqFileId=n;
    r=this._find(i,"file");
    qq.setText(r,this._formatFileName(t));
    this._find(i,"size").style.display="none";
    this._listElement.appendChild(i)
    },
_getItemByFileId:function(n){
    for(var t=this._listElement.firstChild;t;){
        if(t.qqFileId==n)return t;
        t=t.nextSibling
        }
    },
_bindCancelEvent:function(){
    var n=this,t=this._listElement;
    qq.attach(t,"click",function(t){
        var i,r;
        t=t||window.event;
        i=t.target||t.srcElement;
        qq.hasClass(i,n._classes.cancel)&&(qq.preventDefault(t),r=i.parentNode,n._handler.cancel(r.qqFileId),qq.remove(r))
        })
    }
});
qq.UploadDropZone=function(n){
    this._options={
        element:null,
        onEnter:function(){},
        onLeave:function(){},
        onLeaveNotDescendants:function(){},
        onDrop:function(){}
    };
    
qq.extend(this._options,n);
    this._element=this._options.element;
    this._disableDropOutside();
    this._attachEvents()
    };
    
qq.UploadDropZone.prototype={
    _disableDropOutside:function(){
        qq.UploadDropZone.dropOutsideDisabled||(qq.attach(document,"dragover",function(n){
            n.dataTransfer&&(n.dataTransfer.dropEffect="none",n.preventDefault())
            }),qq.UploadDropZone.dropOutsideDisabled=!0)
        },
    _attachEvents:function(){
        var n=this;
        qq.attach(n._element,"dragover",function(t){
            if(n._isValidFileDrag(t)){
                var i=t.dataTransfer.effectAllowed;
                t.dataTransfer.dropEffect=i=="move"||i=="linkMove"?"move":"copy";
                t.stopPropagation();
                t.preventDefault()
                }
            });
    qq.attach(n._element,"dragenter",function(t){
        if(n._isValidFileDrag(t))n._options.onEnter(t)
            });
    qq.attach(n._element,"dragleave",function(t){
        if(n._isValidFileDrag(t)){
            n._options.onLeave(t);
            var i=document.elementFromPoint(t.clientX,t.clientY);
            if(!qq.contains(this,i))n._options.onLeaveNotDescendants(t)
                }
            });
qq.attach(n._element,"drop",function(t){
    if(n._isValidFileDrag(t)){
        t.preventDefault();
        n._options.onDrop(t)
        }
    })
},
_isValidFileDrag:function(n){
    var t=n.dataTransfer,i=navigator.userAgent.indexOf("AppleWebKit")>-1;
    return t&&t.effectAllowed!="none"&&(t.files||!i&&t.types.contains&&t.types.contains("Files"))
    }
};

qq.UploadButton=function(n){
    this._options={
        element:null,
        multiple:!1,
        name:"file",
        onChange:function(){},
        hoverClass:"qq-upload-button-hover",
        focusClass:"qq-upload-button-focus"
    };
    
    qq.extend(this._options,n);
    this._element=this._options.element;
    qq.css(this._element,{
        position:"relative",
        overflow:"hidden",
        direction:"ltr"
    });
    this._input=this._createInput()
    };
    
qq.UploadButton.prototype={
    getInput:function(){
        return this._input
        },
    reset:function(){
        this._input.parentNode&&qq.remove(this._input);
        qq.removeClass(this._element,this._options.focusClass);
        this._input=this._createInput()
        },
    _createInput:function(){
        var n=document.createElement("input"),t;
        return this._options.multiple&&n.setAttribute("multiple","multiple"),n.setAttribute("type","file"),n.setAttribute("name",this._options.name),qq.css(n,{
            position:"absolute",
            right:0,
            top:0,
            fontFamily:"Arial",
            fontSize:"18px",
            margin:0,
            padding:0,
            cursor:"pointer",
            opacity:0
        }),this._element.appendChild(n),t=this,qq.attach(n,"change",function(){
            t._options.onChange(n)
            }),qq.attach(n,"mouseover",function(){
            qq.addClass(t._element,t._options.hoverClass)
            }),qq.attach(n,"mouseout",function(){
            qq.removeClass(t._element,t._options.hoverClass)
            }),qq.attach(n,"focus",function(){
            qq.addClass(t._element,t._options.focusClass)
            }),qq.attach(n,"blur",function(){
            qq.removeClass(t._element,t._options.focusClass)
            }),window.attachEvent&&n.setAttribute("tabIndex","-1"),n
        }
    };

qq.UploadHandlerAbstract=function(n){
    this._options={
        debug:!1,
        action:"/upload.php",
        maxConnections:999,
        onProgress:function(){},
        onComplete:function(){},
        onCancel:function(){}
    };
    
qq.extend(this._options,n);
    this._queue=[];
    this._params=[]
    };
    
qq.UploadHandlerAbstract.prototype={
    log:function(n){
        this._options.debug&&window.console&&console.log("[uploader] "+n)
        },
    add:function(){},
    upload:function(n,t){
        var r=this._queue.push(n),i={};
        
        qq.extend(i,t);
        this._params[n]=i;
        r<=this._options.maxConnections&&this._upload(n,this._params[n])
        },
    cancel:function(n){
        this._cancel(n);
        this._dequeue(n)
        },
    cancelAll:function(){
        for(var n=0;n<this._queue.length;n++)this._cancel(this._queue[n]);
        this._queue=[]
        },
    getName:function(){},
    getSize:function(){},
    getQueue:function(){
        return this._queue
        },
    _upload:function(){},
    _cancel:function(){},
    _dequeue:function(n){
        var r=qq.indexOf(this._queue,n),t,i;
        this._queue.splice(r,1);
        t=this._options.maxConnections;
        this._queue.length>=t&&r<t&&(i=this._queue[t-1],this._upload(i,this._params[i]))
        }
    };

qq.UploadHandlerForm=function(){
    qq.UploadHandlerAbstract.apply(this,arguments);
    this._inputs={}
};

qq.extend(qq.UploadHandlerForm.prototype,qq.UploadHandlerAbstract.prototype);
qq.extend(qq.UploadHandlerForm.prototype,{
    add:function(n){
        n.setAttribute("name","qqfile");
        var t="qq-upload-handler-iframe"+qq.getUniqueId();
        return this._inputs[t]=n,n.parentNode&&qq.remove(n),t
        },
    getName:function(n){
        return this._inputs[n].value.replace(/.*(\/|\\)/,"")
        },
    _cancel:function(n){
        this._options.onCancel(n,this.getName(n));
        delete this._inputs[n];
        var t=document.getElementById(n);
        t&&(t.setAttribute("src","javascript:false;"),qq.remove(t))
        },
    _upload:function(n,t){
        var f=this._inputs[n],i;
        if(!f)throw new Error("file with passed id was not added, or already uploaded or cancelled");
        var e=this.getName(n),r=this._createIframe(n),u=this._createForm(r,t);
        return u.appendChild(f),i=this,this._attachLoadEvent(r,function(){
            i.log("iframe loaded");
            var t=i._getIframeContentJSON(r);
            i._options.onComplete(n,e,t);
            i._dequeue(n);
            delete i._inputs[n];
            setTimeout(function(){
                qq.remove(r)
                },1)
            }),u.submit(),qq.remove(u),n
        },
    _attachLoadEvent:function(n,t){
        qq.attach(n,"load",function(){
            n.parentNode&&(n.contentDocument&&n.contentDocument.body&&n.contentDocument.body.innerHTML=="false"||t())
            })
        },
    _getIframeContentJSON:function(iframe){
        var doc=iframe.contentDocument?iframe.contentDocument:iframe.contentWindow.document,response;
        this.log("converting iframe's innerHTML to JSON");
        this.log("innerHTML = "+doc.body.innerHTML);
        try{
            response=eval("("+doc.body.innerHTML+")")
            }catch(err){
            response={}
        }
        return response
    },
_createIframe:function(n){
    var t=qq.toElement('<iframe src="javascript:false;" name="'+n+'" />');
    return t.setAttribute("id",n),t.style.display="none",document.body.appendChild(t),t
    },
_createForm:function(n,t){
    var i=qq.toElement('<form method="post" enctype="multipart/form-data"><\/form>'),r=qq.obj2url(t,this._options.action);
    return i.setAttribute("action",r),i.setAttribute("target",n.name),i.style.display="none",document.body.appendChild(i),i
    }
});
qq.UploadHandlerXhr=function(){
    qq.UploadHandlerAbstract.apply(this,arguments);
    this._files=[];
    this._xhrs=[];
    this._loaded=[]
    };
    
qq.UploadHandlerXhr.isSupported=function(){
    var n=document.createElement("input");
    return n.type="file","multiple"in n&&typeof File!="undefined"&&typeof(new XMLHttpRequest).upload!="undefined"
    };
    
qq.extend(qq.UploadHandlerXhr.prototype,qq.UploadHandlerAbstract.prototype);
qq.extend(qq.UploadHandlerXhr.prototype,{
    add:function(n){
        if(!(n instanceof File))throw new Error("Passed obj in not a File (in qq.UploadHandlerXhr)");
        return this._files.push(n)-1
        },
    getName:function(n){
        var t=this._files[n];
        return t.fileName!=null?t.fileName:t.name
        },
    getSize:function(n){
        var t=this._files[n];
        return t.fileSize!=null?t.fileSize:t.size
        },
    getLoaded:function(n){
        return this._loaded[n]||0
        },
    _upload:function(n,t){
        var e=this._files[n],u=this.getName(n),o=this.getSize(n),i,r,f;
        this._loaded[n]=0;
        i=this._xhrs[n]=new XMLHttpRequest;
        r=this;
        i.upload.onprogress=function(t){
            if(t.lengthComputable){
                r._loaded[n]=t.loaded;
                r._options.onProgress(n,u,t.loaded,t.total)
                }
            };
        
    i.onreadystatechange=function(){
        i.readyState==4&&r._onComplete(n,i)
        };
        
    t=t||{};
    
    t.qqfile=u;
    f=qq.obj2url(t,this._options.action);
    i.open("POST",f,!0);
    i.setRequestHeader("X-Requested-With","XMLHttpRequest");
    i.setRequestHeader("X-File-Name",encodeURIComponent(u));
    i.setRequestHeader("Content-Type","multipart/form-data");
    i.send(e)
    },
_onComplete:function(id,xhr){
    var name,size,response;
    if(this._files[id]){
        name=this.getName(id);
        size=this.getSize(id);
        this._options.onProgress(id,name,size,size);
        if(xhr.status==200){
            this.log("xhr - server response received");
            this.log("responseText = "+xhr.responseText);
            try{
                response=eval("("+xhr.responseText+")")
                }catch(err){
                response={}
            }
            this._options.onComplete(id,name,response)
        }else this._options.onComplete(id,name,{});
    this._files[id]=null;
    this._xhrs[id]=null;
    this._dequeue(id)
    }
},
_cancel:function(n){
    this._options.onCancel(n,this.getName(n));
    this._files[n]=null;
    this._xhrs[n]&&(this._xhrs[n].abort(),this._xhrs[n]=null)
    }
}),function($,n){
    function h(n){
        return typeof n=="string"
        }
        function e(n){
        var t=w.call(arguments,1);
        return function(){
            return n.apply(this,t.concat(w.call(arguments)))
            }
        }
    function st(n){
    return n.replace(/^[^#]*#?(.*)$/,"$1")
    }
    function ht(n){
    return n.replace(/(?:^[^?#]*\?([^#]*).*$)?.*/,"$1")
    }
    function ut(e,s,c,a,v){
    var b,y,w,k,d;
    return a!==t?(w=c.match(e?/^([^#]*)\#?(.*)$/:/^([^#?]*)\??([^#]*)(#?.*)/),d=w[3]||"",v===2&&h(a)?y=a.replace(e?it:tt,""):(k=i(w[2]),a=h(a)?i[e?r:u](a):a,y=v===2?a:v===1?$.extend({},a,k):$.extend({},k,a),y=o(y),e&&(y=y.replace(rt,l))),b=w[1]+(e?"#":y||!w[1]?"?":"")+y+d):b=s(c!==t?c:n[p][f]),b
    }
    function ft(n,f,e){
    return f===t||typeof f=="boolean"?(e=f,f=o[n?r:u]()):f=h(f)?f.replace(n?it:tt,""):f,i(f,e)
    }
    function et(n,i,r,u){
    return h(r)||typeof r=="object"||(u=r,r=i,i=t),this.each(function(){
        var f=$(this),t=i||d()[(this.nodeName||"").toLowerCase()]||"",e=t&&f.attr(t)||"";
        f.attr(t,o[n](e,r,u))
        })
    }
    var t,w=Array.prototype.slice,l=decodeURIComponent,o=$.param,s,i,a,v=$.bbq=$.bbq||{},b,k,d,g=$.event.special,nt="hashchange",u="querystring",r="fragment",y="elemUrlAttr",p="location",f="href",c="src",tt=/^.*\?|#.*$/g,it=/^.*\#/,rt,ot={};

o[u]=e(ut,0,ht);
o[r]=s=e(ut,1,st);
s.noEscape=function(n){
    n=n||"";
    var t=$.map(n.split(""),encodeURIComponent);
    rt=new RegExp(t.join("|"),"g")
    };
    
s.noEscape(",/");
$.deparam=i=function(n,i){
    var r={},u={
        "true":!0,
        "false":!1,
        "null":null
    };
    
    return $.each(n.replace(/\+/g," ").split("&"),function(n,f){
        var v=f.split("="),s=l(v[0]),e,a=r,c=0,o=s.split("]["),h=o.length-1;
        if(/\[/.test(o[0])&&/\]$/.test(o[h])?(o[h]=o[h].replace(/\]$/,""),o=o.shift().split("[").concat(o),h=o.length-1):h=0,v.length===2)if(e=l(v[1]),i&&(e=e&&!isNaN(e)?+e:e==="undefined"?t:u[e]!==t?u[e]:e),h)for(;c<=h;c++)s=o[c]===""?a.length:o[c],a=a[s]=c<h?a[s]||(o[c+1]&&isNaN(o[c+1])?{}:[]):e;else $.isArray(r[s])?r[s].push(e):r[s]=r[s]!==t?[r[s],e]:e;else s&&(r[s]=i?t:"")
            }),r
    };
    
i[u]=e(ft,0);
i[r]=a=e(ft,1);
$[y]||($[y]=function(n){
    return $.extend(ot,n)
    })({
    a:f,
    base:f,
    iframe:c,
    img:c,
    input:c,
    form:"action",
    link:f,
    script:c
});
d=$[y];
$.fn[u]=e(et,u);
$.fn[r]=e(et,r);
v.pushState=b=function(i,r){
    h(i)&&/^#/.test(i)&&r===t&&(r=2);
    var u=i!==t,e=s(n[p][f],u?i:{},u?r:2);
    n[p][f]=e+(/#/.test(e)?"":"#")
    };
    
v.getState=k=function(n,i){
    return n===t||typeof n=="boolean"?a(n):a(i)[n]
    };
    
v.removeState=function(n){
    var i={};
    
    n!==t&&(i=k(),$.each($.isArray(n)?n:arguments,function(n,t){
        delete i[t]
    }));
    b(i,2)
    };
    
g[nt]=$.extend(g[nt],{
    add:function(n){
        function f(n){
            var f=n[r]=s();
            n.getState=function(n,r){
                return n===t||typeof n=="boolean"?i(f,n):i(f,r)[n]
                };
                
            u.apply(this,arguments)
            }
            var u;
        if($.isFunction(n))return u=n,f;
        u=n.handler;
        n.handler=f
        }
    })
}(jQuery,this),function($,n){
    function o(t){
        return t=t||n[r][u],t.replace(/^[^#]*#?(.*)$/,"$1")
        }
        var i,f=$.event.special,r="location",t="hashchange",u="href",s=document.documentMode,e="on"+t in n;
    $[t+"Delay"]=100;
    f[t]=$.extend(f[t],{
        setup:function(){
            if(e)return!1;
            $(i.start)
            },
        teardown:function(){
            if(e)return!1;
            $(i.stop)
            }
        });
i=function(){
    function c(){
        e=s=function(n){
            return n
            }
        }
    var f={},i,h,e,s;
return f.start=function(){
    if(!i){
        var f=o();
        e||c(),function h(){
            var l=o(),c=s(f);
            l!==f?(e(f=l,c),$(n).trigger(t)):c!==f&&(n[r][u]=n[r][u].replace(/#.*/,"")+"#"+c);
            i=setTimeout(h,$[t+"Delay"])
            }()
        }
    },f.stop=function(){
    h||(i&&clearTimeout(i),i=0)
    },f
}()
}(jQuery,this),function(n){
    function t(n){
        var t=k.call(arguments,1);
        return function(){
            return n.apply(this,t.concat(k.call(arguments)))
            }
        }
    function v(n,t){
    return this.filter(":"+n+(t?"("+t+")":""))
    }
    function y(n,t,i,r){
    var u=r[3]||g()[(t.nodeName||"").toLowerCase()]||"";
    return u?!!n(t.getAttribute(u)):b
    }
    var p,w=!0,b=!1,i=window.location,k=Array.prototype.slice,d=i.href.match(/^((https?:\/\/.*?\/)?[^#]*)#?.*$/),u=d[1]+"#",rt=d[2],g,nt,tt,f,it,e,o="elemUrlAttr",s="href",r="src",h="urlInternal",c="urlExternal",l="urlFragment",a,ut={};

n.isUrlInternal=f=function(n){
    return!n||e(n)?p:a.test(n)?w:/^(?:https?:)?\/\//i.test(n)?b:/^[a-z\d.-]+:/i.test(n)?p:w
    };
    
n.isUrlExternal=it=function(n){
    var t=f(n);
    return typeof t=="boolean"?!t:t
    };
    
n.isUrlFragment=e=function(t){
    var i=(t||"").match(/^([^#]?)([^#]*#).*$/);
    return!!i&&(i[2]==="#"||t.indexOf(u)===0||(i[1]==="/"?rt+i[2]===u:!/^https?:\/\//i.test(t)&&n('<a href="'+t+'"/>')[0].href.indexOf(u)===0))
    };
    
n.fn[h]=t(v,h);
n.fn[c]=t(v,c);
n.fn[l]=t(v,l);
n.expr[":"][h]=t(y,f);
n.expr[":"][c]=t(y,it);
n.expr[":"][l]=t(y,e);
n[o]||(n[o]=function(t){
    return n.extend(ut,t)
    })({
    a:s,
    base:s,
    iframe:r,
    img:r,
    input:r,
    form:"action",
    link:s,
    script:r
});
g=n[o];
n.urlInternalHost=nt=function(n){
    n=n?"(?:(?:"+Array.prototype.join.call(arguments,"|")+")\\.)?":"";
    var t=new RegExp("^"+n+"(.*)","i"),r="^(?:"+i.protocol+")?//"+i.hostname.replace(t,n+"$1").replace(/\\?\./g,"\\.")+(i.port?":"+i.port:"")+"/";
    return tt(r)
    };
    
n.urlInternalRegExp=tt=function(n){
    return n&&(a=typeof n=="string"?new RegExp(n,"i"):n),a
    };
    
nt("www")
}(jQuery),function(n){
    var u=function(){
        var tt='<div class="colpick"><div class="colpick_color"><div class="colpick_color_overlay1"><div class="colpick_color_overlay2"><div class="colpick_selector_outer"><div class="colpick_selector_inner"><\/div><\/div><\/div><\/div><\/div><div class="colpick_hue"><div class="colpick_hue_arrs"><div class="colpick_hue_larr"><\/div><div class="colpick_hue_rarr"><\/div><\/div><\/div><div class="colpick_new_color"><\/div><div class="colpick_current_color"><\/div><div class="colpick_hex_field"><div class="colpick_field_letter">#<\/div><input type="text" maxlength="6" size="6" /><\/div><div class="colpick_rgb_r colpick_field"><div class="colpick_field_letter">R<\/div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"><\/div><div class="colpick_field_darr"><\/div><\/div><\/div><div class="colpick_rgb_g colpick_field"><div class="colpick_field_letter">G<\/div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"><\/div><div class="colpick_field_darr"><\/div><\/div><\/div><div class="colpick_rgb_b colpick_field"><div class="colpick_field_letter">B<\/div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"><\/div><div class="colpick_field_darr"><\/div><\/div><\/div><div class="colpick_hsb_h colpick_field"><div class="colpick_field_letter">H<\/div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"><\/div><div class="colpick_field_darr"><\/div><\/div><\/div><div class="colpick_hsb_s colpick_field"><div class="colpick_field_letter">S<\/div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"><\/div><div class="colpick_field_darr"><\/div><\/div><\/div><div class="colpick_hsb_b colpick_field"><div class="colpick_field_letter">B<\/div><input type="text" maxlength="3" size="3" /><div class="colpick_field_arrs"><div class="colpick_field_uarr"><\/div><div class="colpick_field_darr"><\/div><\/div><\/div><div class="colpick_submit"><\/div><\/div>',it={
            showEvent:"click",
            onShow:function(){},
            onBeforeShow:function(){},
            onHide:function(){},
            onChange:function(){},
            onSubmit:function(){},
            colorScheme:"light",
            color:"3289c7",
            livePreview:!0,
            flat:!1,
            layout:"full",
            submit:1,
            submitText:"OK",
            height:156
        },u=function(t,r){
            var u=i(t);
            n(r).data("colpick").fields.eq(1).val(u.r).end().eq(2).val(u.g).end().eq(3).val(u.b).end()
            },s=function(t,i){
            n(i).data("colpick").fields.eq(4).val(Math.round(t.h)).end().eq(5).val(Math.round(t.s)).end().eq(6).val(Math.round(t.b)).end()
            },e=function(i,r){
            n(r).data("colpick").fields.eq(0).val(t(i))
            },h=function(i,r){
            n(r).data("colpick").selector.css("backgroundColor","#"+t({
                h:i.h,
                s:100,
                b:100
            }));
            n(r).data("colpick").selectorIndic.css({
                left:parseInt(n(r).data("colpick").height*i.s/100,10),
                top:parseInt(n(r).data("colpick").height*(100-i.b)/100,10)
                })
            },c=function(t,i){
            n(i).data("colpick").hue.css("top",parseInt(n(i).data("colpick").height-n(i).data("colpick").height*t.h/360,10))
            },a=function(i,r){
            n(r).data("colpick").currentColor.css("backgroundColor","#"+t(i))
            },l=function(i,r){
            n(r).data("colpick").newColor.css("backgroundColor","#"+t(i))
            },o=function(){
            var o=n(this).parent().parent(),a;
            this.parentNode.className.indexOf("_hex")>0?(o.data("colpick").color=a=f(lt(this.value)),u(a,o.get(0)),s(a,o.get(0))):this.parentNode.className.indexOf("_hsb")>0?(o.data("colpick").color=a=v({
                h:parseInt(o.data("colpick").fields.eq(4).val(),10),
                s:parseInt(o.data("colpick").fields.eq(5).val(),10),
                b:parseInt(o.data("colpick").fields.eq(6).val(),10)
                }),u(a,o.get(0)),e(a,o.get(0))):(o.data("colpick").color=a=r(ct({
                r:parseInt(o.data("colpick").fields.eq(1).val(),10),
                g:parseInt(o.data("colpick").fields.eq(2).val(),10),
                b:parseInt(o.data("colpick").fields.eq(3).val(),10)
                })),e(a,o.get(0)),s(a,o.get(0)));
            h(a,o.get(0));
            c(a,o.get(0));
            l(a,o.get(0));
            o.data("colpick").onChange.apply(o.parent(),[a,t(a),i(a)])
            },rt=function(){
            n(this).parent().removeClass("colpick_focus")
            },ut=function(){
            n(this).parent().parent().data("colpick").fields.parent().removeClass("colpick_focus");
            n(this).parent().addClass("colpick_focus")
            },ft=function(t){
            t.preventDefault?t.preventDefault():t.returnValue=!1;
            var i=n(this).parent().find("input").focus(),r={
                el:n(this).parent().addClass("colpick_slider"),
                max:this.parentNode.className.indexOf("_hsb_h")>0?360:this.parentNode.className.indexOf("_hsb")>0?100:255,
                y:t.pageY,
                field:i,
                val:parseInt(i.val(),10),
                preview:n(this).parent().parent().data("colpick").livePreview
                };
                
            n(document).mouseup(r,p);
            n(document).mousemove(r,y)
            },y=function(n){
            return n.data.field.val(Math.max(0,Math.min(n.data.max,parseInt(n.data.val-n.pageY+n.data.y,10)))),n.data.preview&&o.apply(n.data.field.get(0),[!0]),!1
            },p=function(t){
            return o.apply(t.data.field.get(0),[!0]),t.data.el.removeClass("colpick_slider").find("input").focus(),n(document).off("mouseup",p),n(document).off("mousemove",y),!1
            },et=function(t){
            t.preventDefault?t.preventDefault():t.returnValue=!1;
            var i={
                cal:n(this).parent(),
                y:n(this).offset().top
                };
                
            i.preview=i.cal.data("colpick").livePreview;
            n(document).mouseup(i,b);
            n(document).mousemove(i,w);
            o.apply(i.cal.data("colpick").fields.eq(4).val(parseInt(360*(i.cal.data("colpick").height-(t.pageY-i.y))/i.cal.data("colpick").height,10)).get(0),[i.preview])
            },w=function(n){
            return o.apply(n.data.cal.data("colpick").fields.eq(4).val(parseInt(360*(n.data.cal.data("colpick").height-Math.max(0,Math.min(n.data.cal.data("colpick").height,n.pageY-n.data.y)))/n.data.cal.data("colpick").height,10)).get(0),[n.data.preview]),!1
            },b=function(t){
            return u(t.data.cal.data("colpick").color,t.data.cal.get(0)),e(t.data.cal.data("colpick").color,t.data.cal.get(0)),n(document).off("mouseup",b),n(document).off("mousemove",w),!1
            },ot=function(t){
            t.preventDefault?t.preventDefault():t.returnValue=!1;
            var i={
                cal:n(this).parent(),
                pos:n(this).offset()
                };
                
            i.preview=i.cal.data("colpick").livePreview;
            n(document).mouseup(i,d);
            n(document).mousemove(i,k);
            o.apply(i.cal.data("colpick").fields.eq(6).val(parseInt(100*(i.cal.data("colpick").height-(t.pageY-i.pos.top))/i.cal.data("colpick").height,10)).end().eq(5).val(parseInt(100*(t.pageX-i.pos.left)/i.cal.data("colpick").height,10)).get(0),[i.preview])
            },k=function(n){
            return o.apply(n.data.cal.data("colpick").fields.eq(6).val(parseInt(100*(n.data.cal.data("colpick").height-Math.max(0,Math.min(n.data.cal.data("colpick").height,n.pageY-n.data.pos.top)))/n.data.cal.data("colpick").height,10)).end().eq(5).val(parseInt(100*Math.max(0,Math.min(n.data.cal.data("colpick").height,n.pageX-n.data.pos.left))/n.data.cal.data("colpick").height,10)).get(0),[n.data.preview]),!1
            },d=function(t){
            return u(t.data.cal.data("colpick").color,t.data.cal.get(0)),e(t.data.cal.data("colpick").color,t.data.cal.get(0)),n(document).off("mouseup",d),n(document).off("mousemove",k),!1
            },st=function(){
            var r=n(this).parent(),u=r.data("colpick").color;
            r.data("colpick").origColor=u;
            a(u,r.get(0));
            r.data("colpick").onSubmit(u,t(u),i(u),r.data("colpick").el)
            },g=function(){
            var t=n("#"+n(this).data("colpickId"));
            t.data("colpick").onBeforeShow.apply(this,[t.get(0)]);
            var r=n(this).offset(),f=r.top+this.offsetHeight,i=r.left,u=ht();
            i+346>u.l+u.w&&(i-=346);
            t.css({
                left:i+"px",
                top:f+"px"
                });
            t.data("colpick").onShow.apply(this,[t.get(0)])!=!1&&t.show();
            n("html").mousedown({
                cal:t
            },nt);
            t.mousedown(function(n){
                n.stopPropagation()
                })
            },nt=function(t){
            t.data.cal.data("colpick").onHide.apply(this,[t.data.cal.get(0)])!=!1&&t.data.cal.hide();
            n("html").off("mousedown",nt)
            },ht=function(){
            var n=document.compatMode=="CSS1Compat";
            return{
                l:window.pageXOffset||(n?document.documentElement.scrollLeft:document.body.scrollLeft),
                w:window.innerWidth||(n?document.documentElement.clientWidth:document.body.clientWidth)
                }
            },v=function(n){
        return{
            h:Math.min(360,Math.max(0,n.h)),
            s:Math.min(100,Math.max(0,n.s)),
            b:Math.min(100,Math.max(0,n.b))
            }
        },ct=function(n){
    return{
        r:Math.min(255,Math.max(0,n.r)),
        g:Math.min(255,Math.max(0,n.g)),
        b:Math.min(255,Math.max(0,n.b))
        }
    },lt=function(n){
    var r=6-n.length,t,i;
    if(r>0){
        for(t=[],i=0;i<r;i++)t.push("0");
        t.push(n);
        n=t.join("")
        }
        return n
    },at=function(){
    var t=n(this).parent(),i=t.data("colpick").origColor;
    t.data("colpick").color=i;
    u(i,t.get(0));
    e(i,t.get(0));
    s(i,t.get(0));
    h(i,t.get(0));
    c(i,t.get(0));
    l(i,t.get(0))
    };
    
return{
    init:function(t){
        if(t=n.extend({},it,t||{}),typeof t.color=="string")t.color=f(t.color);
        else if(t.color.r!=undefined&&t.color.g!=undefined&&t.color.b!=undefined)t.color=r(t.color);
        else if(t.color.h!=undefined&&t.color.s!=undefined&&t.color.b!=undefined)t.color=v(t.color);else return this;
        return this.each(function(){
            var i,y,r,f,w;
            if(!n(this).data("colpickId")){
                i=n.extend({},t);
                i.origColor=t.color;
                y="collorpicker_"+parseInt(Math.random()*1e3);
                n(this).data("colpickId",y);
                r=n(tt).attr("id",y);
                r.addClass("colpick_"+i.layout+(i.submit?"":" colpick_"+i.layout+"_ns"));
                i.colorScheme!="light"&&r.addClass("colpick_"+i.colorScheme);
                r.find("div.colpick_submit").html(i.submitText).click(st);
                i.fields=r.find("input").change(o).blur(rt).focus(ut);
                r.find("div.colpick_field_arrs").mousedown(ft).end().find("div.colpick_current_color").click(at);
                i.selector=r.find("div.colpick_color").mousedown(ot);
                i.selectorIndic=i.selector.find("div.colpick_selector_outer");
                i.el=this;
                i.hue=r.find("div.colpick_hue_arrs");
                huebar=i.hue.parent();
                var b=navigator.userAgent.toLowerCase(),p=navigator.appName==="Microsoft Internet Explorer",k=p?parseFloat(b.match(/msie ([0-9]{1,}[\.0-9]{0,})/)[1]):0,d=p&&k<10,v=["#ff0000","#ff0080","#ff00ff","#8000ff","#0000ff","#0080ff","#00ffff","#00ff80","#00ff00","#80ff00","#ffff00","#ff8000","#ff0000"];
                if(d)for(f=0;f<=11;f++)w=n("<div><\/div>").attr("style","height:8.333333%; filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr="+v[f]+", endColorstr="+v[f+1]+'); -ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='+v[f]+", endColorstr="+v[f+1]+')";'),huebar.append(w);else stopList=v.join(","),huebar.attr("style","background:-webkit-linear-gradient(top center,"+stopList+"); background:-moz-linear-gradient(top center,"+stopList+"); background:linear-gradient(to bottom,"+stopList+"); "),huebar.css({
                    background:"linear-gradient(to bottom,"+stopList+")"
                    }),huebar.css({
                    background:"-moz-linear-gradient(top,"+stopList+")"
                    });
                if(r.find("div.colpick_hue").mousedown(et),i.newColor=r.find("div.colpick_new_color"),i.currentColor=r.find("div.colpick_current_color"),r.data("colpick",i),u(i.color,r.get(0)),s(i.color,r.get(0)),e(i.color,r.get(0)),c(i.color,r.get(0)),h(i.color,r.get(0)),a(i.color,r.get(0)),l(i.color,r.get(0)),i.flat)r.appendTo(this).show(),r.css({
                    position:"relative",
                    display:"block"
                });
                else{
                    r.appendTo(document.body);
                    n(this).on(i.showEvent,g);
                    r.css({
                        position:"absolute"
                    })
                    }
                }
        })
},
showPicker:function(){
    return this.each(function(){
        n(this).data("colpickId")&&g.apply(this)
        })
    },
hidePicker:function(){
    return this.each(function(){
        n(this).data("colpickId")&&n("#"+n(this).data("colpickId")).hide()
        })
    },
setColor:function(o,y){
    if(y=typeof y=="undefined"?1:y,typeof o=="string")o=f(o);
    else if(o.r!=undefined&&o.g!=undefined&&o.b!=undefined)o=r(o);
    else if(o.h!=undefined&&o.s!=undefined&&o.b!=undefined)o=v(o);else return this;
    return this.each(function(){
        if(n(this).data("colpickId")){
            var r=n("#"+n(this).data("colpickId"));
            r.data("colpick").color=o;
            r.data("colpick").origColor=o;
            u(o,r.get(0));
            s(o,r.get(0));
            e(o,r.get(0));
            c(o,r.get(0));
            h(o,r.get(0));
            l(o,r.get(0));
            r.data("colpick").onChange.apply(r.parent(),[o,t(o),i(o),1]);
            y&&a(o,r.get(0))
            }
        })
}
}
}(),e=function(n){
    var n=parseInt(n.indexOf("#")>-1?n.substring(1):n,16);
    return{
        r:n>>16,
        g:(n&65280)>>8,
        b:n&255
        }
    },f=function(n){
    return r(e(n))
    },r=function(n){
    var t={
        h:0,
        s:0,
        b:0
    },u=Math.min(n.r,n.g,n.b),i=Math.max(n.r,n.g,n.b),r=i-u;
    return t.b=i,t.s=i!=0?255*r/i:0,t.h=t.s!=0?n.r==i?(n.g-n.b)/r:n.g==i?2+(n.b-n.r)/r:4+(n.r-n.g)/r:-1,t.h*=60,t.h<0&&(t.h+=360),t.s*=100/255,t.b*=100/255,t
    },i=function(n){
    var t={},u=Math.round(n.h),o=Math.round(n.s*255/100),e=Math.round(n.b*255/100);
    if(o==0)t.r=t.g=t.b=e;
    else{
        var i=e,r=(255-o)*e/255,f=(i-r)*(u%60)/60;
        u==360&&(u=0);
        u<60?(t.r=i,t.b=r,t.g=r+f):u<120?(t.g=i,t.b=r,t.r=i-f):u<180?(t.g=i,t.r=r,t.b=r+f):u<240?(t.b=i,t.r=r,t.g=i-f):u<300?(t.b=i,t.g=r,t.r=r+f):u<360?(t.r=i,t.g=r,t.b=i-f):(t.r=0,t.g=0,t.b=0)
        }
        return{
        r:Math.round(t.r),
        g:Math.round(t.g),
        b:Math.round(t.b)
        }
    },o=function(t){
    var i=[t.r.toString(16),t.g.toString(16),t.b.toString(16)];
    return n.each(i,function(n,t){
        t.length==1&&(i[n]="0"+t)
        }),i.join("")
    },t=function(n){
    return o(i(n))
    };
    
n.fn.extend({
    colpick:u.init,
    colpickHide:u.hidePicker,
    colpickShow:u.showPicker,
    colpickSetColor:u.setColor
    });
n.extend({
    colpickRgbToHex:o,
    colpickRgbToHsb:r,
    colpickHsbToHex:t,
    colpickHsbToRgb:i,
    colpickHexToHsb:f,
    colpickHexToRgb:e
})
}(jQuery),function(n){
    typeof define=="function"&&define.amd?define(["jquery"],n):n(typeof jQuery!="undefined"?jQuery:window.Zepto)
    }(function(n){
    "use strict";
    function u(t){
        var i=t.data;
        t.isDefaultPrevented()||(t.preventDefault(),n(t.target).ajaxSubmit(i))
        }
        function f(t){
        var r=t.target,u=n(r),f,i,e;
        if(!u.is("[type=submit],[type=image]")){
            if(f=u.closest("[type=submit]"),f.length===0)return;
            r=f[0]
            }
            i=this;
        i.clk=r;
        r.type=="image"&&(t.offsetX!==undefined?(i.clk_x=t.offsetX,i.clk_y=t.offsetY):typeof n.fn.offset=="function"?(e=u.offset(),i.clk_x=t.pageX-e.left,i.clk_y=t.pageY-e.top):(i.clk_x=t.pageX-r.offsetLeft,i.clk_y=t.pageY-r.offsetTop));
        setTimeout(function(){
            i.clk=i.clk_x=i.clk_y=null
            },100)
        }
        function t(){
        if(n.fn.ajaxSubmit.debug){
            var t="[jquery.form] "+Array.prototype.join.call(arguments,"");
            window.console&&window.console.log?window.console.log(t):window.opera&&window.opera.postError&&window.opera.postError(t)
            }
        }
    var i={},r;
i.fileapi=n("<input type='file'/>").get(0).files!==undefined;
    i.formdata=window.FormData!==undefined;
    r=!!n.fn.prop;
    n.fn.attr2=function(){
    if(!r)return this.attr.apply(this,arguments);
    var n=this.prop.apply(this,arguments);
    return n&&n.jquery||typeof n=="string"?n:this.attr.apply(this,arguments)
    };
    
n.fn.ajaxSubmit=function(u){
    function ot(t){
        for(var r=n.param(t,u.traditional).split("&"),o=r.length,e=[],f,i=0;i<o;i++)r[i]=r[i].replace(/\+/g," "),f=r[i].split("="),e.push([decodeURIComponent(f[0]),decodeURIComponent(f[1])]);
        return e
        }
        function st(t){
        for(var f,r,s,o=new FormData,i=0;i<t.length;i++)o.append(t[i].name,t[i].value);
        if(u.extraData)for(f=ot(u.extraData),i=0;i<f.length;i++)f[i]&&o.append(f[i][0],f[i][1]);
        return u.data=null,r=n.extend(!0,{},n.ajaxSettings,u,{
            contentType:!1,
            processData:!1,
            cache:!1,
            type:e||"POST"
            }),u.uploadProgress&&(r.xhr=function(){
            var t=n.ajaxSettings.xhr();
            return t.upload&&t.upload.addEventListener("progress",function(n){
                var t=0,i=n.loaded||n.position,r=n.total;
                n.lengthComputable&&(t=Math.ceil(i/r*100));
                u.uploadProgress(n,i,r,t)
                },!1),t
            }),r.data=null,s=r.beforeSend,r.beforeSend=function(n,t){
            t.data=u.formData?u.formData:o;
            s&&s.call(this,n,t)
            },n.ajax(r)
        }
        function ft(i){
        function ot(n){
            var i=null;
            try{
                n.contentWindow&&(i=n.contentWindow.document)
                }catch(r){
                t("cannot get iframe.contentWindow document: "+r)
                }
                if(i)return i;
            try{
                i=n.contentDocument?n.contentDocument:n.document
                }catch(r){
                t("cannot get iframe.contentDocument: "+r);
                i=n.document
                }
                return i
            }
            function st(){
            function h(){
                try{
                    var n=ot(a).readyState;
                    t("state = "+n);
                    n&&n.toLowerCase()=="uninitialized"&&setTimeout(h,50)
                    }catch(i){
                    t("Server abort: ",i," (",i.name,")");
                    b(tt);
                    g&&clearTimeout(g);
                    g=undefined
                    }
                }
            var u=f.attr2("target"),s=f.attr2("action"),r,i,c;
        l.setAttribute("target",d);
        (!e||/post/i.test(e))&&l.setAttribute("method","POST");
        s!=o.url&&l.setAttribute("action",o.url);
        o.skipEncodingOverride||e&&!/post/i.test(e)||f.attr({
            encoding:"multipart/form-data",
            enctype:"multipart/form-data"
        });
        o.timeout&&(g=setTimeout(function(){
            rt=!0;
            b(ut)
            },o.timeout));
        r=[];
        try{
            if(o.extraData)for(i in o.extraData)o.extraData.hasOwnProperty(i)&&(n.isPlainObject(o.extraData[i])&&o.extraData[i].hasOwnProperty("name")&&o.extraData[i].hasOwnProperty("value")?r.push(n('<input type="hidden" name="'+o.extraData[i].name+'">').val(o.extraData[i].value).appendTo(l)[0]):r.push(n('<input type="hidden" name="'+i+'">').val(o.extraData[i]).appendTo(l)[0]));o.iframeTarget||v.appendTo("body");
            a.attachEvent?a.attachEvent("onload",b):a.addEventListener("load",b,!1);
            setTimeout(h,15);
            try{
                l.submit()
                }catch(y){
                c=document.createElement("form").submit;
                c.apply(l)
                }
            }finally{
        l.setAttribute("action",s);
        u?l.setAttribute("target",u):f.removeAttr("target");
        n(r).remove()
        }
    }
function b(i){
    var r,u,w,f,k,d,e,c,l;
    if(!s.aborted&&!lt){
        if(h=ot(a),h||(t("cannot access response document"),i=tt),i===ut&&s){
            s.abort("timeout");
            y.reject(s,"timeout");
            return
        }
        if(i==tt&&s){
            s.abort("server abort");
            y.reject(s,"error","server abort");
            return
        }
        if(h&&h.location.href!=o.iframeSrc||rt){
            a.detachEvent?a.detachEvent("onload",b):a.removeEventListener("load",b,!1);
            r="success";
            try{
                if(rt)throw"timeout";
                if(w=o.dataType=="xml"||h.XMLDocument||n.isXMLDoc(h),t("isXml="+w),!w&&window.opera&&(h.body===null||!h.body.innerHTML)&&--ct){
                    t("requeing onLoad callback, DOM not available");
                    setTimeout(b,250);
                    return
                }
                f=h.body?h.body:h.documentElement;
                s.responseText=f?f.innerHTML:null;
                s.responseXML=h.XMLDocument?h.XMLDocument:h;
                w&&(o.dataType="xml");
                s.getResponseHeader=function(n){
                    var t={
                        "content-type":o.dataType
                        };
                        
                    return t[n.toLowerCase()]
                    };
                    
                f&&(s.status=Number(f.getAttribute("status"))||s.status,s.statusText=f.getAttribute("statusText")||s.statusText);
                k=(o.dataType||"").toLowerCase();
                d=/(json|script|text)/.test(k);
                d||o.textarea?(e=h.getElementsByTagName("textarea")[0],e?(s.responseText=e.value,s.status=Number(e.getAttribute("status"))||s.status,s.statusText=e.getAttribute("statusText")||s.statusText):d&&(c=h.getElementsByTagName("pre")[0],l=h.getElementsByTagName("body")[0],c?s.responseText=c.textContent?c.textContent:c.innerText:l&&(s.responseText=l.textContent?l.textContent:l.innerText))):k=="xml"&&!s.responseXML&&s.responseText&&(s.responseXML=at(s.responseText));
                try{
                    ht=yt(s,k,o)
                    }catch(nt){
                    r="parsererror";
                    s.error=u=nt||r
                    }
                }catch(nt){
            t("error caught: ",nt);
            r="error";
            s.error=u=nt||r
            }
            s.aborted&&(t("upload aborted"),r=null);
        s.status&&(r=s.status>=200&&s.status<300||s.status===304?"success":"error");
        r==="success"?(o.success&&o.success.call(o.context,ht,"success",s),y.resolve(s.responseText,"success",s),p&&n.event.trigger("ajaxSuccess",[s,o])):r&&(u===undefined&&(u=s.statusText),o.error&&o.error.call(o.context,s,r,u),y.reject(s,"error",u),p&&n.event.trigger("ajaxError",[s,o,u]));
        p&&n.event.trigger("ajaxComplete",[s,o]);
        p&&!--n.active&&n.event.trigger("ajaxStop");
        o.complete&&o.complete.call(o.context,s,r);
        lt=!0;
        o.timeout&&clearTimeout(g);
        setTimeout(function(){
            o.iframeTarget?v.attr("src",o.iframeSrc):v.remove();
            s.responseXML=null
            },100)
        }
    }
}
var l=f[0],it,nt,o,p,d,v,a,s,k,w,rt,g,y=n.Deferred(),ut,tt,ft,et,ht,h,ct,lt;
if(y.abort=function(n){
    s.abort(n)
    },i)for(nt=0;nt<c.length;nt++)it=n(c[nt]),r?it.prop("disabled",!1):it.removeAttr("disabled");
if(o=n.extend(!0,{},n.ajaxSettings,u),o.context=o.context||o,d="jqFormIO"+(new Date).getTime(),o.iframeTarget?(v=n(o.iframeTarget),w=v.attr2("name"),w?d=w:v.attr2("name",d)):(v=n('<iframe name="'+d+'" src="'+o.iframeSrc+'" />'),v.css({
    position:"absolute",
    top:"-1000px",
    left:"-1000px"
})),a=v[0],s={
    aborted:0,
    responseText:null,
    responseXML:null,
    status:0,
    statusText:"n/a",
    getAllResponseHeaders:function(){},
    getResponseHeader:function(){},
    setRequestHeader:function(){},
    abort:function(i){
        var r=i==="timeout"?"timeout":"aborted";
        t("aborting upload... "+r);
        this.aborted=1;
        try{
            a.contentWindow.document.execCommand&&a.contentWindow.document.execCommand("Stop")
            }catch(u){}
        v.attr("src",o.iframeSrc);
        s.error=r;
        o.error&&o.error.call(o.context,s,r,i);
        p&&n.event.trigger("ajaxError",[s,o,r]);
        o.complete&&o.complete.call(o.context,s,r)
        }
    },p=o.global,p&&0==n.active++&&n.event.trigger("ajaxStart"),p&&n.event.trigger("ajaxSend",[s,o]),o.beforeSend&&o.beforeSend.call(o.context,s,o)===!1)return o.global&&n.active--,y.reject(),y;
if(s.aborted)return y.reject(),y;
k=l.clk;
k&&(w=k.name,w&&!k.disabled&&(o.extraData=o.extraData||{},o.extraData[w]=k.value,k.type=="image"&&(o.extraData[w+".x"]=l.clk_x,o.extraData[w+".y"]=l.clk_y)));
ut=1;
tt=2;
ft=n("meta[name=csrf-token]").attr("content");
et=n("meta[name=csrf-param]").attr("content");
et&&ft&&(o.extraData=o.extraData||{},o.extraData[et]=ft);
o.forceSync?st():setTimeout(st,10);
ct=50;
var at=n.parseXML||function(n,t){
    return window.ActiveXObject?(t=new ActiveXObject("Microsoft.XMLDOM"),t.async="false",t.loadXML(n)):t=(new DOMParser).parseFromString(n,"text/xml"),t&&t.documentElement&&t.documentElement.nodeName!="parsererror"?t:null
    },vt=n.parseJSON||function(s){
    return window.eval("("+s+")")
    },yt=function(t,i,r){
    var f=t.getResponseHeader("content-type")||"",e=i==="xml"||!i&&f.indexOf("xml")>=0,u=e?t.responseXML:t.responseText;
    return e&&u.documentElement.nodeName==="parsererror"&&n.error&&n.error("parsererror"),r&&r.dataFilter&&(u=r.dataFilter(u,i)),typeof u=="string"&&(i==="json"||!i&&f.indexOf("json")>=0?u=vt(u):(i==="script"||!i&&f.indexOf("javascript")>=0)&&n.globalEval(u)),u
    };
    
return y
}
var e,b,o,f,a,v,c,y,s,l,h,d,g,nt,ut,p,w;
if(!this.length)return t("ajaxSubmit: skipping submit process - no element selected"),this;
if(f=this,typeof u=="function"?u={
    success:u
}:u===undefined&&(u={}),e=u.type||this.attr2("method"),b=u.url||this.attr2("action"),o=typeof b=="string"?n.trim(b):"",o=o||window.location.href||"",o&&(o=(o.match(/^([^#]+)/)||[])[1]),u=n.extend(!0,{
    url:o,
    success:n.ajaxSettings.success,
    type:e||n.ajaxSettings.type,
    iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"
    },u),a={},this.trigger("form-pre-serialize",[this,u,a]),a.veto)return t("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),this;
if(u.beforeSerialize&&u.beforeSerialize(this,u)===!1)return t("ajaxSubmit: submit aborted via beforeSerialize callback"),this;
if(v=u.traditional,v===undefined&&(v=n.ajaxSettings.traditional),c=[],s=this.formToArray(u.semantic,c),u.data&&(u.extraData=u.data,y=n.param(u.data,v)),u.beforeSubmit&&u.beforeSubmit(s,this,u)===!1)return t("ajaxSubmit: submit aborted via beforeSubmit callback"),this;
if(this.trigger("form-submit-validate",[s,this,u,a]),a.veto)return t("ajaxSubmit: submit vetoed via form-submit-validate trigger"),this;
l=n.param(s,v);
y&&(l=l?l+"&"+y:y);
u.type.toUpperCase()=="GET"?(u.url+=(u.url.indexOf("?")>=0?"&":"?")+l,u.data=null):u.data=l;
h=[];
u.resetForm&&h.push(function(){
    f.resetForm()
    });
u.clearForm&&h.push(function(){
    f.clearForm(u.includeHidden)
    });
!u.dataType&&u.target?(d=u.success||function(){},h.push(function(t){
    var i=u.replaceTarget?"replaceWith":"html";
    n(u.target)[i](t).each(d,arguments)
    })):u.success&&h.push(u.success);
u.success=function(n,t,i){
    for(var e=u.context||this,r=0,o=h.length;r<o;r++)h[r].apply(e,[n,t,i||f,f])
        };
        
u.error&&(g=u.error,u.error=function(n,t,i){
    var r=u.context||this;
    g.apply(r,[n,t,i,f])
    });
u.complete&&(nt=u.complete,u.complete=function(n,t){
    var i=u.context||this;
    nt.apply(i,[n,t,f])
    });
var et=n("input[type=file]:enabled",this).filter(function(){
    return n(this).val()!==""
    }),tt=et.length>0,it="multipart/form-data",rt=f.attr("enctype")==it||f.attr("encoding")==it,k=i.fileapi&&i.formdata;
for(t("fileAPI :"+k),ut=(tt||rt)&&!k,u.iframe!==!1&&(u.iframe||ut)?u.closeKeepAlive?n.get(u.closeKeepAlive,function(){
    p=ft(s)
    }):p=ft(s):p=(tt||rt)&&k?st(s):n.ajax(u),f.removeData("jqxhr").data("jqxhr",p),w=0;w<c.length;w++)c[w]=null;
return this.trigger("form-submit-notify",[this,u]),this
};

n.fn.ajaxForm=function(i){
    if(i=i||{},i.delegation=i.delegation&&n.isFunction(n.fn.on),!i.delegation&&this.length===0){
        var r={
            s:this.selector,
            c:this.context
            };
            
        return!n.isReady&&r.s?(t("DOM not ready, queuing ajaxForm"),n(function(){
            n(r.s,r.c).ajaxForm(i)
            }),this):(t("terminating; zero elements found by selector"+(n.isReady?"":" (DOM not ready)")),this)
        }
        if(i.delegation){
        n(document).off("submit.form-plugin",this.selector,u).off("click.form-plugin",this.selector,f).on("submit.form-plugin",this.selector,i,u).on("click.form-plugin",this.selector,i,f);
        return this
        }
        return this.ajaxFormUnbind().bind("submit.form-plugin",i,u).bind("click.form-plugin",i,f)
    };
    
n.fn.ajaxFormUnbind=function(){
    return this.unbind("submit.form-plugin click.form-plugin")
    };
    
n.fn.formToArray=function(t,r){
    var o=[],e,c,l,s,f,h,u,p,w,a,y,v;
    if(this.length===0||(e=this[0],c=t?e.getElementsByTagName("*"):e.elements,!c))return o;
    for(l=0,p=c.length;l<p;l++)if(u=c[l],f=u.name,f&&!u.disabled){
        if(t&&e.clk&&u.type=="image"){
            e.clk==u&&(o.push({
                name:f,
                value:n(u).val(),
                type:u.type
                }),o.push({
                name:f+".x",
                value:e.clk_x
                },{
                name:f+".y",
                value:e.clk_y
                }));
            continue
        }
        if(h=n.fieldValue(u,!0),h&&h.constructor==Array)for(r&&r.push(u),s=0,w=h.length;s<w;s++)o.push({
            name:f,
            value:h[s]
            });
        else if(i.fileapi&&u.type=="file")if(r&&r.push(u),a=u.files,a.length)for(s=0;s<a.length;s++)o.push({
            name:f,
            value:a[s],
            type:u.type
            });else o.push({
            name:f,
            value:"",
            type:u.type
            });else h!==null&&typeof h!="undefined"&&(r&&r.push(u),o.push({
            name:f,
            value:h,
            type:u.type,
            required:u.required
            }))
        }
        return!t&&e.clk&&(y=n(e.clk),v=y[0],f=v.name,f&&!v.disabled&&v.type=="image"&&(o.push({
        name:f,
        value:y.val()
        }),o.push({
        name:f+".x",
        value:e.clk_x
        },{
        name:f+".y",
        value:e.clk_y
        }))),o
    };
    
n.fn.formSerialize=function(t){
    return n.param(this.formToArray(t))
    };
    
n.fn.fieldSerialize=function(t){
    var i=[];
    return this.each(function(){
        var f=this.name,r,u,e;
        if(f)if(r=n.fieldValue(this,t),r&&r.constructor==Array)for(u=0,e=r.length;u<e;u++)i.push({
            name:f,
            value:r[u]
            });else r!==null&&typeof r!="undefined"&&i.push({
            name:this.name,
            value:r
        })
        }),n.param(i)
    };
    
n.fn.fieldValue=function(t){
    for(var f,i,r=[],u=0,e=this.length;u<e;u++)(f=this[u],i=n.fieldValue(f,t),i!==null&&typeof i!="undefined"&&(i.constructor!=Array||i.length))&&(i.constructor==Array?n.merge(r,i):r.push(i));
    return r
    };
    
n.fieldValue=function(t,i){
    var a=t.name,u=t.type,h=t.tagName.toLowerCase(),e,o,r,f;
    if(i===undefined&&(i=!0),i&&(!a||t.disabled||u=="reset"||u=="button"||(u=="checkbox"||u=="radio")&&!t.checked||(u=="submit"||u=="image")&&t.form&&t.form.clk!=t||h=="select"&&t.selectedIndex==-1))return null;
    if(h=="select"){
        if(e=t.selectedIndex,e<0)return null;
        var c=[],l=t.options,s=u=="select-one",v=s?e+1:l.length;
        for(o=s?e:0;o<v;o++)if(r=l[o],r.selected){
            if(f=r.value,f||(f=r.attributes&&r.attributes.value&&!r.attributes.value.specified?r.text:r.value),s)return f;
            c.push(f)
            }
            return c
        }
        return n(t).val()
    };
    
n.fn.clearForm=function(t){
    return this.each(function(){
        n("input,select,textarea",this).clearFields(t)
        })
    };
    
n.fn.clearFields=n.fn.clearInputs=function(t){
    var i=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;
    return this.each(function(){
        var r=this.type,u=this.tagName.toLowerCase();
        i.test(r)||u=="textarea"?this.value="":r=="checkbox"||r=="radio"?this.checked=!1:u=="select"?this.selectedIndex=-1:r=="file"?/MSIE/.test(navigator.userAgent)?n(this).replaceWith(n(this).clone(!0)):n(this).val(""):t&&(t===!0&&/hidden/.test(r)||typeof t=="string"&&n(this).is(t))&&(this.value="")
        })
    };
    
n.fn.resetForm=function(){
    return this.each(function(){
        typeof this.reset!="function"&&(typeof this.reset!="object"||this.reset.nodeType)||this.reset()
        })
    };
    
n.fn.enable=function(n){
    return n===undefined&&(n=!0),this.each(function(){
        this.disabled=!n
        })
    };
    
n.fn.selected=function(t){
    return t===undefined&&(t=!0),this.each(function(){
        var r=this.type,i;
        r=="checkbox"||r=="radio"?this.checked=t:this.tagName.toLowerCase()=="option"&&(i=n(this).parent("select"),t&&i[0]&&i[0].type=="select-one"&&i.find("option").selected(!1),this.selected=t)
        })
    };
    
n.fn.ajaxSubmit.debug=!1
}),function(n){
    var t=/["\\\x00-\x1f\x7f-\x9f]/g,i={
        "\b":"\\b",
        "\t":"\\t",
        "\n":"\\n",
        "\f":"\\f",
        "\r":"\\r",
        '"':'\\"',
        "\\":"\\\\"
    };
    
    n.toJSON=typeof JSON=="object"&&JSON.stringify?JSON.stringify:function(t){
        var i,l,c,a,y,v,u;
        if(t===null)return"null";
        if(i=typeof t,i==="undefined")return undefined;
        if(i==="number"||i==="boolean")return""+t;
        if(i==="string")return n.quoteString(t);
        if(i==="object"){
            if(typeof t.toJSON=="function")return n.toJSON(t.toJSON());
            if(t.constructor===Date){
                var f=t.getUTCMonth()+1,e=t.getUTCDate(),p=t.getUTCFullYear(),o=t.getUTCHours(),s=t.getUTCMinutes(),h=t.getUTCSeconds(),r=t.getUTCMilliseconds();
                return f<10&&(f="0"+f),e<10&&(e="0"+e),o<10&&(o="0"+o),s<10&&(s="0"+s),h<10&&(h="0"+h),r<100&&(r="0"+r),r<10&&(r="0"+r),'"'+p+"-"+f+"-"+e+"T"+o+":"+s+":"+h+"."+r+'Z"'
                }
                if(t.constructor===Array){
                for(l=[],c=0;c<t.length;c++)l.push(n.toJSON(t[c])||"null");
                return"["+l.join(",")+"]"
                }
                v=[];
            for(u in t){
                if(i=typeof u,i==="number")a='"'+u+'"';
                else if(i==="string")a=n.quoteString(u);else continue;
                (i=typeof t[u],i!=="function"&&i!=="undefined")&&(y=n.toJSON(t[u]),v.push(a+":"+y))
                }
                return"{"+v.join(",")+"}"
            }
        };
    
n.evalJSON=typeof JSON=="object"&&JSON.parse?JSON.parse:function(src){
    return eval("("+src+")")
    };
    
n.secureEvalJSON=typeof JSON=="object"&&JSON.parse?JSON.parse:function(src){
    var filtered=src.replace(/\\["\\\/bfnrtu]/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,"]").replace(/(?:^|:|,)(?:\s*\[)+/g,"");
    if(/^[\],:{}\s]*$/.test(filtered))return eval("("+src+")");
    throw new SyntaxError("Error parsing JSON, source is not valid.");
};

n.quoteString=function(n){
    return n.match(t)?'"'+n.replace(t,function(n){
        var t=i[n];
        return typeof t=="string"?t:(t=n.charCodeAt(),"\\u00"+Math.floor(t/16).toString(16)+(t%16).toString(16))
        })+'"':'"'+n+'"'
    }
}(jQuery),function(n){
    n.fn.kpimultiselector=function(t){
        function a(){
            n(i.categories).each(function(){
                var t=this.CategoryID,r;
                n('<h4 data-cat-id="'+t+'" class="down-arrow"><a href="#" title="'+$s.labels.Add_all+'">+<\/a>'+this.CategoryName+"<\/h4>").appendTo(u).click(function(){
                    var t=n(this).attr("data-cat-id");
                    u.find("> div").not("div[data-cat-id="+t+"]").slideUp();
                    u.find("div[data-cat-id="+t+"]").slideToggle();
                    u.find("> h4").not(this).removeClass("up-arrow").addClass("down-arrow");
                    n(this).toggleClass("down-arrow").toggleClass("up-arrow")
                    });
                r=n('<div data-cat-id="'+t+'" style="display: none;"><\/div>').appendTo(u);
                n(i.kpis).each(function(){
                    if(this.KPICategoryID===t){
                        var n='<p data-title="'+this.KPIName+'" data-kpi-id="'+this.KPIID+'"><i style="background-position:'+this.SmallPos+'" class="kpi-icon-small"><\/i>';
                        n+=this.KPIDescription?"<b>"+this.KPIName+"<span>"+this.KPIDescription+"<\/span><\/b>":'<b style="line-height:46px">'+this.KPIName+"<\/b>";
                        n+="<\/p>";
                        r.append(n)
                        }
                    })
            });
        u.find("p").click(function(t){
            return h(n(this)),t.preventDefault(),!1
            });
        u.find("h4 > a").click(function(t){
            var i=n(this).parent().attr("data-cat-id");
            return u.find("div[data-cat-id="+i+"] > p").each(function(){
                h(n(this))
                }),t.preventDefault(),!1
            })
        }
        function v(t){
        var r=n("#dvSearchList");
        r.empty();
        t.length>1?(n(i.kpis).each(function(){
            var i=e.find("p[data-kpi-id="+this.KPIID+"]"),n;
            this.KPIName.slice(0,t.length).toLowerCase()!==t.toLowerCase()||i.length||(n='<p data-title="'+this.KPIName+'" data-kpi-id="'+this.KPIID+'"><i style="background-position:'+this.SmallPos+'" class="kpi-icon-small"><\/i>',n+=this.KPIDescription?"<b>"+this.KPIName+"<span>"+this.KPIDescription+"<\/span><\/b>":'<b style="line-height:46px">'+this.KPIName+"<\/b>",n+="<\/p>",r.append(n))
            }),r.find("p").click(function(t){
            var i=n(this),r=i.attr("data-kpi-id");
            return i.hide(),u.find("p[data-kpi-id="+r+"]").hide(),h(i),t.preventDefault(),!1
            }),r[0].children.length<=0&&r.append("<i>"+$s.labels.No_KPIs_found+"<\/i>"),r.show()):r.hide()
        }
        function h(n){
        n.length&&e.find("p[data-kpi-id="+n.attr("data-kpi-id")+"]").length<=0&&(n.hide(),e.append('<p data-kpi-id="'+n.attr("data-kpi-id")+'"><i class="kpi-icon-small" style="'+n.find(" > i").attr("style")+'"><\/i><b>'+n.attr("data-title")+'<\/b><a href="#">X<\/a><\/p>'),f.find("#txtSearch").val(""),e.sortable("refresh"))
        }
        function y(){
        if(i.kpiIDs.length>0){
            var t=i.kpiIDs.split(",");
            n.each(t,function(n,t){
                var i=u.find("p[data-kpi-id="+t+"]");
                h(i)
                })
            }
        }
    function p(){
    r.data("state")==="closed"&&(n("div[data-selector=true]").hide().data("state","closed"),n("a[data-selector=true]").removeClass("selected"),r.fadeIn(300).data("state","open"),b(),u.scrollTop(0),o.addClass("selected"),i.onOpen())
    }
    function c(){
    if(r.data("state")==="open"){
        var t=0;
        r.fadeOut(300).data("state","closed");
        o.removeClass("selected");
        i.kpiIDs="";
        e.find("p").each(function(){
            var r=n(this).attr("data-kpi-id");
            i.kpiIDs+=r+",";
            t++
        });
        i.onClose(i.kpiIDs,t)
        }
    }
function w(){
    r.data("state")==="open"?c():p()
    }
    function b(){
    var n=o;
    i.positionTo!==undefined&&(n=i.positionTo);
    r.position({
        my:"left top",
        at:"left bottom",
        of:n,
        offset:"0px 0px",
        collision:"fit"
    })
    }
    var o=jQuery(this),i,r,f,u,s,e,l;
if(o.length!=null&&o.length>0){
    i=jQuery.extend({
        appendTo:"body",
        onClose:function(){},
        onOpen:function(){},
        onInit:function(){}
    },t);
o.attr("data-selector","true");
r=n('<div class="ui-kpi-multi-selector" data-selector="true"><\/div>');
f=n('<div class="ui-kpi-multi-selector-left"><\/div>').appendTo(r);
f.append('<div class="ui-kpi-multi-selector-search"><input id="txtSearch" type="text" placeholder="'+$s.labels.Type_to_search+'" value="" class="textbox" /><div id="dvSearchList" style="display:none" class="ui-kpi-multi-selector-results ui-kpi-multi-selector-results-big"><\/div><\/div><p class="description">'+$s.labels.Or_select_a_KPI_from_the_list_below+":<\/p>");
f.find("#txtSearch").keyup(function(){
    v(n(this).val())
    });
f.find("#dvSearchList, #txtSearch").hover(function(){
    var t=f.find("#txtSearch").val();
    (!n(this).is("#txtSearch")||t.length>0)&&f.find("#dvSearchList").stop().css("opacity","1").css("overflow","auto").show()
    },function(){
    f.find("#dvSearchList").hide()
    });
u=n('<div id="dvKPIsAccordion" class="ui-kpi-multi-selector-results ui-kpi-multi-selector-results-big"><\/div>').appendTo(f);
s=n('<div class="ui-kpi-multi-selector-right"><\/div>').appendTo(r);
s.append("<h3>"+$s.labels.Selected_KPIs+'<\/h3><p class="description">'+$s.labels.Add_and_sort_your_KPIs_in_the_list_below_before_adding+"<\/p>");
e=n('<div id="dvSelectedKPIs" class="ui-kpi-multi-selector-results"><\/div>').appendTo(s);
e.on("click","p > a",function(t){
    var i=n(this).parent();
    return u.find("p[data-kpi-id="+i.attr("data-kpi-id")+"]").show(),i.remove(),f.find("#txtSearch").val(""),t.preventDefault(),!1
    });
e.sortable({
    cursor:"move"
});
s.append('<div style="padding-top:20px;height:50px;"><a id="btnDone" class="button-green" href="#">'+$s.labels.Done+'<\/a><a id="btnClear" class="button-grey cancel" href="#">'+$s.labels.clear+"<\/a><\/div>");
r.append('<div class="clear"><\/div>');
s.find("#btnClear").click(function(t){
    return e.find("p").each(function(){
        var t=n(this);
        u.find("p[data-kpi-id="+t.attr("data-kpi-id")+"]").show();
        t.remove()
        }),f.find("#txtSearch").val(""),t.preventDefault(),!1
    });
s.find("#btnDone").click(function(n){
    return c(),f.find("#txtSearch").val(""),n.preventDefault(),!1
    });
a();
l=0;
i.kpiIDs&&y();
i.onInit(e.find("p").length);
jQuery(this).click(function(){
    return w(),!1
    });
r.data("state","closed");
jQuery(i.appendTo).append(r);
jQuery(document).click(function(){
    r.is(":visible")&&c()
    });
r.click(function(){
    return!1
    }).hide()
}
return this
}
}(jQuery),function(n){
    n.fn.kpiselector=function(t){
        function h(){
            var t=s.val(),r;
            u.empty();
            n(i.data).each(function(){
                var r=this.KPIName?this.KPIName.toLowerCase():"",n;
                t=t?t.toLowerCase():"";
                r.indexOf(t)!==-1&&(n="",i.isUsers?n='<a data-kpi-id="'+this.KPIID+'" data-kpi-name="'+this.KPIName+'" data-kpi-large-pos=""><i style="background-position:0px 0px; background-image:url('+this.LargePos+')" class="kpi-icon-small"><\/i><b>'+this.KPIName+"<span>"+this.KPIDescription+"<\/span><\/b><\/a>":(n='<a data-kpi-id="'+this.KPIID+'" data-kpi-name="'+this.KPIName+'" data-kpi-large-pos="'+this.LargePos+'" ><i style="background-position:'+this.SmallPos+'" class="kpi-icon-small"><\/i>',this.KPIDescription?(n+="<b>"+this.KPIName,n+="<span>"+this.KPIDescription+"<\/span><\/b>"):n+='<b style="line-height:46px">'+this.KPIName+"<\/b>",n+="<\/a>"),u.append(n))
                });
            u.find("a").length!=null?u.find("a").click(function(){
                var t=n(this);
                i.onSelect(Number(t.attr("data-kpi-id")),t.attr("data-kpi-name"),t.find("i").css("background-position"),t.attr("data-kpi-large-pos"));
                return o(),!1
                }):(r='<b style="line-height:46px;font-style:italic;">'+i.noneFoundLabel+"<\/b>",u.append(r))
            }
            function c(){
            r.data("state")==="closed"&&(n("div[data-selector=true]").hide().data("state","closed"),n("a[data-selector=true]").removeClass("selected"),r.fadeIn(300).data("state","open"),a(),u.scrollTop(0),f.addClass("selected"),i.onOpen())
            }
            function o(){
            r.data("state")==="open"&&(r.fadeOut(300).data("state","closed"),f.removeClass("selected"),i.onClose())
            }
            function l(){
            r.data("state")==="open"?o():c()
            }
            function a(){
            var n=f;
            i.positionTo!==undefined&&(n=i.positionTo);
            r.position({
                my:"left top",
                at:"left bottom",
                of:n,
                offset:"0px 0px",
                collision:"fit"
            })
            }
            var f=jQuery(this),i,e;
        if(f.length!=null&&f.length>0){
            i=jQuery.extend({
                appendTo:"body",
                noneFoundLabel:$s.labels.No_KPIs_found,
                isUsers:!1,
                onClose:function(){},
                onOpen:function(){},
                onSelect:function(){},
                onInit:function(){}
            },t);
        f.attr("data-selector","true");
        var r=n('<div class="ui-kpiselector" data-selector="true"><\/div>'),s=n('<input type="text" placeholder="'+$s.labels.Type_to_search+'" />').appendTo(r),u=n('<div class="ui-kpiselector-list"><\/div>').appendTo(r);
        if(s.keyup(function(){
            h()
            }),h(),e=u.find("a[data-kpi-id="+i.kpiID+"]"),e.length)i.onInit(Number(e.attr("data-kpi-id")),e.attr("data-kpi-name"),e.find("i").css("background-position"),e.attr("data-kpi-large-pos"));else i.onInit("","- "+$s.labels.Optional+" -","0px 100px","");
        jQuery(this).click(function(){
            return l(),!1
            });
        r.data("state","closed");
        jQuery(i.appendTo).append(r);
        jQuery(document).click(function(){
            r.is(":visible")&&o()
            });
        r.click(function(){
            return!1
            }).hide()
        }
        return this
    }
}(jQuery),function(n){
    n.fn.multiselector=function(t){
        function l(t,r){
            if(i.isGroup){
                var f=n(this).attr("data-item-group-id"),u=n("li[data-group-id="+f+"]");
                t[0].checked?u.find("ol input:checkbox").not(t).is(":checked")||u.children(":checkbox").prop("checked",!1):u.children(":checkbox").prop("checked",!0)
                }
                r&&t.prop("checked",!t[0].checked)
            }
            function v(t){
            var i=t;
            t instanceof Array||(i=t.split(","));
            n.each(i,function(n,t){
                var i=f.find("input[value="+t+"]");
                i.prop("checked",!0);
                o.push(i.attr("data-item-name"))
                })
            }
            function a(n){
            n.length==1?u.attr("title",n.join(" | ")).html(n.length.toString()+" "+i.labelSingular):n.length>0?u.attr("title",n.join(" | ")).html(n.length.toString()+" "+i.labelPlural):i.allWhenEmpty?u.attr("title",i.labelAll).html(i.labelAll):u.attr("title","0 "+i.labelPlural).html("0 "+i.labelPlural)
            }
            function y(){
            r.data("state")==="closed"&&(w(),n("div[data-selector=true]").hide().data("state","closed"),n("a[data-selector=true]").removeClass("selected"),r.fadeIn(300).data("state","open"),f.scrollTop(0),u.addClass("selected"),i.onOpen())
            }
            function s(){
            r.data("state")==="open"&&(r.fadeOut(300).data("state","closed"),u.removeClass("selected"))
            }
            function p(){
            r.data("state")==="open"?s():y()
            }
            function w(){
            var t=u,i=t.offset(),f="left",n=i.left,e=jQuery(window).width()-n-t.outerWidth();
            n>e&&(f="right",n=e);
            r.parent().css(f,n).css("top",i.top+t.outerHeight())
            }
            var u=jQuery(this),i,o;
        if(u.length!=null&&u.length>0){
            i=jQuery.extend({
                allWhenEmpty:!0,
                doneButtonText:$s.labels.Done,
                clearButtonText:$s.labels.clear,
                isGroup:!1,
                appendTo:"body",
                onClose:function(){},
                onOpen:function(){},
                onDone:function(){}
            },t);
        u.attr("data-selector","true");
        var r=n('<div class="ui-multiselector" style="display: block;" data-selector="true"><\/div>'),f=n('<ul class="ui-widget-content"><\/ul>').appendTo(r),e=0,h=f;
        n(i.data).each(function(){
            var t;
            if(i.isGroup&&this.groupNo!==e){
                e=this.groupNo;
                var r=n('<li class="ui-corner-all" data-group-id="'+this.groupNo+'"><\/li>').appendTo(f),o=n('<input type="checkbox" value="'+this.groupNo+'" data-item-name="'+this.groupName+'" data-group="true" />').appendTo(r),u=n("<label>"+this.groupName+"<\/label>").appendTo(r);
                h=n("<ol>").appendTo(r);
                r.hover(function(){
                    jQuery(this).addClass("hover")
                    },function(){
                    jQuery(this).removeClass("hover")
                    });
                u.click(function(){
                    var t=n(this).parent().children(":checkbox")[0];
                    n(this).parent().find(":checkbox").prop("checked",!t.checked)
                    });
                r.children(":checkbox").click(function(t){
                    t.stopPropagation();
                    var i=n(this)[0];
                    n(this).parent().find(":checkbox").prop("checked",i.checked)
                    })
                }
                t=n('<li class="ui-corner-all"><\/li>').appendTo(h);
            i.isGroup&&t.attr("data-item-group-id",e);
            t.append('<input type="checkbox" value="'+this.itemId+'" data-item-name="'+this.itemName+'"/>');
            t.append("<span>"+this.itemName+"<\/span>");
            t.hover(function(){
                jQuery(this).addClass("hover")
                },function(){
                jQuery(this).removeClass("hover")
                }).click(function(){
                l(n(this).children(":checkbox"),!0)
                });
            t.children(":checkbox").click(function(t){
                t.stopPropagation();
                l(n(this),!1)
                })
            });
        o=[];
        i.itemIds&&(v(i.itemIds),a(o));
        var c=n('<div class="ui-buttons">').appendTo(r),b=jQuery('<button class="button-green">'+i.doneButtonText+"<\/button>").click(function(){
            var t=[],r=[];
            i.isGroup?n(f).find("li[data-item-group-id]").find(":checked").each(function(){
                t.push(n(this).val());
                r.push(n(this).attr("data-item-name"))
                }):n(f).find(":checked").each(function(){
                t.push(n(this).val());
                r.push(n(this).attr("data-item-name"))
                });
            a(r);
            t=t.length<=0?null:t.join();
            i.onDone(t);
            s()
            }).appendTo(c),k=jQuery('<button class="button-grey">'+i.clearButtonText+"<\/button>").click(function(){
            n(f).find(":checked").prop("checked",!1)
            }).appendTo(c);
        n(this).click(function(){
            return p(),!1
            });
        r.data("state","closed");
        n(i.appendTo).append(r);
        r.wrap('<div class="ui-multiselectorcontain"><\/div>');
        n(document).click(function(){
            r.is(":visible")&&s()
            });
        r.click(function(){
            return!1
            }).hide()
        }
        return this
    }
}(jQuery),function(n,t,i){
    (function(n){
        typeof define=="function"&&define.amd?define(["jquery"],n):jQuery&&!jQuery.fn.sparkline&&n(jQuery)
        })(function(r){
        "use strict";
        var c={},tt,u,e,s,l,o,v,it,rt,y,pt,ut,ft,et,h,ot,st,a,p,ht,ct,lt,w,b,k,at,vt,yt,d,g,nt,f,wt=0;
        tt=function(){
            return{
                common:{
                    type:"line",
                    lineColor:"#00f",
                    fillColor:"#cdf",
                    defaultPixelsPerValue:3,
                    width:"auto",
                    height:"auto",
                    composite:!1,
                    tagValuesAttribute:"values",
                    tagOptionsPrefix:"spark",
                    enableTagOptions:!1,
                    enableHighlight:!0,
                    highlightLighten:1.4,
                    tooltipSkipNull:!0,
                    tooltipPrefix:"",
                    tooltipSuffix:"",
                    disableHiddenCheck:!1,
                    numberFormatter:!1,
                    numberDigitGroupCount:3,
                    numberDigitGroupSep:",",
                    numberDecimalMark:".",
                    disableTooltips:!1,
                    disableInteraction:!1
                    },
                line:{
                    spotColor:"#f80",
                    highlightSpotColor:"#5f5",
                    highlightLineColor:"#f22",
                    spotRadius:1.5,
                    minSpotColor:"#f80",
                    maxSpotColor:"#f80",
                    lineWidth:1,
                    normalRangeMin:i,
                    normalRangeMax:i,
                    normalRangeColor:"#ccc",
                    drawNormalOnTop:!1,
                    chartRangeMin:i,
                    chartRangeMax:i,
                    chartRangeMinX:i,
                    chartRangeMaxX:i,
                    tooltipFormat:new e('<span style="color: {{color}}">&#9679;<\/span> {{prefix}}{{y}}{{suffix}}')
                    },
                bar:{
                    barColor:"#3366cc",
                    negBarColor:"#f44",
                    stackedBarColor:["#3366cc","#dc3912","#ff9900","#109618","#66aa00","#dd4477","#0099c6","#990099"],
                    zeroColor:i,
                    nullColor:i,
                    zeroAxis:!0,
                    barWidth:4,
                    barSpacing:1,
                    chartRangeMax:i,
                    chartRangeMin:i,
                    chartRangeClip:!1,
                    colorMap:i,
                    tooltipFormat:new e('<span style="color: {{color}}">&#9679;<\/span> {{prefix}}{{value}}{{suffix}}')
                    },
                tristate:{
                    barWidth:4,
                    barSpacing:1,
                    posBarColor:"#6f6",
                    negBarColor:"#f44",
                    zeroBarColor:"#999",
                    colorMap:{},
                    tooltipFormat:new e('<span style="color: {{color}}">&#9679;<\/span> {{value:map}}'),
                    tooltipValueLookups:{
                        map:{
                            "-1":"Loss",
                            "0":"Draw",
                            "1":"Win"
                        }
                    }
                },
        discrete:{
            lineHeight:"auto",
            thresholdColor:i,
            thresholdValue:0,
            chartRangeMax:i,
            chartRangeMin:i,
            chartRangeClip:!1,
            tooltipFormat:new e("{{prefix}}{{value}}{{suffix}}")
            },
        bullet:{
            targetColor:"#f33",
            targetWidth:3,
            performanceColor:"#33f",
            rangeColors:["#d3dafe","#a8b6ff","#7f94ff"],
            base:i,
            tooltipFormat:new e("{{fieldkey:fields}} - {{value}}"),
            tooltipValueLookups:{
                fields:{
                    r:"Range",
                    p:"Performance",
                    t:"Target"
                }
            }
        },
    pie:{
        offset:0,
        sliceColors:["#3366cc","#dc3912","#ff9900","#109618","#66aa00","#dd4477","#0099c6","#990099"],
        borderWidth:0,
        borderColor:"#000",
        tooltipFormat:new e('<span style="color: {{color}}">&#9679;<\/span> {{value}} ({{percent.1}}%)')
        },
    box:{
        raw:!1,
        boxLineColor:"#000",
        boxFillColor:"#cdf",
        whiskerColor:"#000",
        outlierLineColor:"#333",
        outlierFillColor:"#fff",
        medianColor:"#f00",
        showOutliers:!0,
        outlierIQR:1.5,
        spotRadius:1.5,
        target:i,
        targetColor:"#4a2",
        chartRangeMax:i,
        chartRangeMin:i,
        tooltipFormat:new e("{{field:fields}}: {{value}}"),
        tooltipFormatFieldlistKey:"field",
        tooltipValueLookups:{
            fields:{
                lq:"Lower Quartile",
                med:"Median",
                uq:"Upper Quartile",
                lo:"Left Outlier",
                ro:"Right Outlier",
                lw:"Left Whisker",
                rw:"Right Whisker"
            }
        }
    }
}
};

at='.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}';
u=function(){
    var n,t;
    return n=function(){
        this.init.apply(this,arguments)
        },arguments.length>1?(arguments[0]?(n.prototype=r.extend(new arguments[0],arguments[arguments.length-1]),n._super=arguments[0].prototype):n.prototype=arguments[arguments.length-1],arguments.length>2&&(t=Array.prototype.slice.call(arguments,1,-1),t.unshift(n.prototype),r.extend.apply(r,t))):n.prototype=arguments[0],n.prototype.cls=n,n
    };
    
r.SPFormatClass=e=u({
    fre:/\{\{([\w.]+?)(:(.+?))?\}\}/g,
    precre:/(\w+)\.(\d+)/,
    init:function(n,t){
        this.format=n;
        this.fclass=t
        },
    render:function(n,t,r){
        var h=this,c=n,e,o,f,u,s;
        return this.format.replace(this.fre,function(){
            var n;
            return(o=arguments[1],f=arguments[3],e=h.precre.exec(o),e?(s=e[2],o=e[1]):s=!1,u=c[o],u===i)?"":f&&t&&t[f]?(n=t[f],n.get?t[f].get(u)||u:t[f][u]||u):(rt(u)&&(u=r.get("numberFormatter")?r.get("numberFormatter")(u):et(u,s,r.get("numberDigitGroupCount"),r.get("numberDigitGroupSep"),r.get("numberDecimalMark"))),u)
            })
        }
    });
r.spformat=function(n,t){
    return new e(n,t)
    };
    
s=function(n,t,i){
    return n<t?t:n>i?i:n
    };
    
l=function(n,i){
    var r;
    return i===2?(r=t.floor(n.length/2),n.length%2?n[r]:(n[r-1]+n[r])/2):n.length%2?(r=(n.length*i+i)/4,r%1?(n[t.floor(r)]+n[t.floor(r)-1])/2:n[r-1]):(r=(n.length*i+2)/4,r%1?(n[t.floor(r)]+n[t.floor(r)-1])/2:n[r-1])
    };
    
o=function(n){
    var t;
    switch(n){
        case"undefined":
            n=i;
            break;
        case"null":
            n=null;
            break;
        case"true":
            n=!0;
            break;
        case"false":
            n=!1;
            break;
        default:
            t=parseFloat(n);
            n==t&&(n=t)
            }
            return n
    };
    
v=function(n){
    for(var i=[],t=n.length;t--;)i[t]=o(n[t]);
    return i
    };
    
it=function(n,t){
    for(var u=[],i=0,r=n.length;i<r;i++)n[i]!==t&&u.push(n[i]);
    return u
    };
    
rt=function(n){
    return!isNaN(parseFloat(n))&&isFinite(n)
    };
    
et=function(n,t,i,u,f){
    var e,o;
    for(n=(t===!1?parseFloat(n).toString():n.toFixed(t)).split(""),e=(e=r.inArray(".",n))<0?n.length:e,e<n.length&&(n[e]=f),o=e-i;o>0;o-=i)n.splice(o,0,u);
    return n.join("")
    };
    
y=function(n,t,i){
    for(var r=t.length;r--;)if((!i||t[r]!==null)&&t[r]!==n)return!1;return!0
    };
    
pt=function(n){
    for(var i=0,t=n.length;t--;)i+=typeof n[t]=="number"?n[t]:0;
    return i
    };
    
ft=function(n){
    return r.isArray(n)?n:[n]
    };
    
ut=function(t){
    var i;
    n.createStyleSheet?n.createStyleSheet().cssText=t:(i=n.createElement("style"),i.type="text/css",n.getElementsByTagName("head")[0].appendChild(i),i[typeof n.body.style.WebkitAppearance=="string"?"innerText":"innerHTML"]=t)
    };
    
r.fn.simpledraw=function(t,u,f,e){
    var o,s,h;
    if(f&&(o=this.data("_jqs_vcanvas")))return o;
    if(r.fn.sparkline.canvas===!1)return!1;
    if(r.fn.sparkline.canvas===i)if(h=n.createElement("canvas"),!(h.getContext&&h.getContext("2d")))if(n.namespaces&&!n.namespaces.v)n.namespaces.add("v","urn:schemas-microsoft-com:vml","#default#VML"),r.fn.sparkline.canvas=function(n,t,i){
        return new nt(n,t,i)
        };else return r.fn.sparkline.canvas=!1,!1;else r.fn.sparkline.canvas=function(n,t,i,r){
        return new g(n,t,i,r)
        };
        
    return t===i&&(t=r(this).innerWidth()),u===i&&(u=r(this).innerHeight()),o=r.fn.sparkline.canvas(t,u,this,e),s=r(this).data("_jqs_mhandler"),s&&s.registerCanvas(o),o
    };
    
r.fn.cleardraw=function(){
    var n=this.data("_jqs_vcanvas");
    n&&n.reset()
    };
    
r.RangeMapClass=h=u({
    init:function(n){
        var i,t,r=[];
        for(i in n)n.hasOwnProperty(i)&&typeof i=="string"&&i.indexOf(":")>-1&&(t=i.split(":"),t[0]=t[0].length===0?-Infinity:parseFloat(t[0]),t[1]=t[1].length===0?Infinity:parseFloat(t[1]),t[2]=n[i],r.push(t));this.map=n;
        this.rangelist=r||!1
        },
    get:function(n){
        var r=this.rangelist,u,t,f;
        if((f=this.map[n])!==i)return f;
        if(r)for(u=r.length;u--;)if(t=r[u],t[0]<=n&&t[1]>=n)return t[2];return i
        }
    });
r.range_map=function(n){
    return new h(n)
    };
    
ot=u({
    init:function(n,t){
        var i=r(n);
        this.$el=i;
        this.options=t;
        this.currentPageX=0;
        this.currentPageY=0;
        this.el=n;
        this.splist=[];
        this.tooltip=null;
        this.over=!1;
        this.displayTooltips=!t.get("disableTooltips");
        this.highlightEnabled=!t.get("disableHighlight")
        },
    registerSparkline:function(n){
        this.splist.push(n);
        this.over&&this.updateDisplay()
        },
    registerCanvas:function(n){
        var t=r(n.canvas);
        this.canvas=n;
        this.$canvas=t;
        t.mouseenter(r.proxy(this.mouseenter,this));
        t.mouseleave(r.proxy(this.mouseleave,this));
        t.click(r.proxy(this.mouseclick,this))
        },
    reset:function(n){
        this.splist=[];
        this.tooltip&&n&&(this.tooltip.remove(),this.tooltip=i)
        },
    mouseclick:function(n){
        var t=r.Event("sparklineClick");
        t.originalEvent=n;
        t.sparklines=this.splist;
        this.$el.trigger(t)
        },
    mouseenter:function(t){
        r(n.body).unbind("mousemove.jqs");
        r(n.body).bind("mousemove.jqs",r.proxy(this.mousemove,this));
        this.over=!0;
        this.currentPageX=t.pageX;
        this.currentPageY=t.pageY;
        this.currentEl=t.target;
        !this.tooltip&&this.displayTooltips&&(this.tooltip=new st(this.options),this.tooltip.updatePosition(t.pageX,t.pageY));
        this.updateDisplay()
        },
    mouseleave:function(){
        r(n.body).unbind("mousemove.jqs");
        var i=this.splist,e=i.length,u=!1,f,t;
        for(this.over=!1,this.currentEl=null,this.tooltip&&(this.tooltip.remove(),this.tooltip=null),t=0;t<e;t++)f=i[t],f.clearRegionHighlight()&&(u=!0);
        u&&this.canvas.render()
        },
    mousemove:function(n){
        this.currentPageX=n.pageX;
        this.currentPageY=n.pageY;
        this.currentEl=n.target;
        this.tooltip&&this.tooltip.updatePosition(n.pageX,n.pageY);
        this.updateDisplay()
        },
    updateDisplay:function(){
        var i=this.splist,o=i.length,s=!1,h=this.$canvas.offset(),c=this.currentPageX-h.left,l=this.currentPageY-h.top,u,t,n,f,e;
        if(this.over){
            for(n=0;n<o;n++)t=i[n],f=t.setRegionHighlight(this.currentEl,c,l),f&&(s=!0);
            if(s){
                if(e=r.Event("sparklineRegionChange"),e.sparklines=this.splist,this.$el.trigger(e),this.tooltip){
                    for(u="",n=0;n<o;n++)t=i[n],u+=t.getCurrentRegionTooltip();
                    this.tooltip.setContent(u)
                    }
                    this.disableHighlight||this.canvas.render()
                }
                f===null&&this.mouseleave()
            }
        }
});
st=u({
    sizeStyle:"position: static !important;display: block !important;visibility: hidden !important;float: left !important;",
    init:function(t){
        var u=t.get("tooltipClassname","jqstooltip"),f=this.sizeStyle,i;
        this.container=t.get("tooltipContainer")||n.body;
        this.tooltipOffsetX=t.get("tooltipOffsetX",10);
        this.tooltipOffsetY=t.get("tooltipOffsetY",12);
        r("#jqssizetip").remove();
        r("#jqstooltip").remove();
        this.sizetip=r("<div/>",{
            id:"jqssizetip",
            style:f,
            "class":u
        });
        this.tooltip=r("<div/>",{
            id:"jqstooltip",
            "class":u
        }).appendTo(this.container);
        i=this.tooltip.offset();
        this.offsetLeft=i.left;
        this.offsetTop=i.top;
        this.hidden=!0;
        r(window).unbind("resize.jqs scroll.jqs");
        r(window).bind("resize.jqs scroll.jqs",r.proxy(this.updateWindowDims,this));
        this.updateWindowDims()
        },
    updateWindowDims:function(){
        this.scrollTop=r(window).scrollTop();
        this.scrollLeft=r(window).scrollLeft();
        this.scrollRight=this.scrollLeft+r(window).width();
        this.updatePosition()
        },
    getSize:function(n){
        this.sizetip.html(n).appendTo(this.container);
        this.width=this.sizetip.width()+1;
        this.height=this.sizetip.height();
        this.sizetip.remove()
        },
    setContent:function(n){
        if(!n){
            this.tooltip.css("visibility","hidden");
            this.hidden=!0;
            return
        }
        this.getSize(n);
        this.tooltip.html(n).css({
            width:this.width,
            height:this.height,
            visibility:"visible"
        });
        this.hidden&&(this.hidden=!1,this.updatePosition())
        },
    updatePosition:function(n,t){
        if(n===i){
            if(this.mousex===i)return;
            n=this.mousex-this.offsetLeft;
            t=this.mousey-this.offsetTop
            }else this.mousex=n=n-this.offsetLeft,this.mousey=t=t-this.offsetTop;
        this.height&&this.width&&!this.hidden&&(t-=this.height+this.tooltipOffsetY,n+=this.tooltipOffsetX,t<this.scrollTop&&(t=this.scrollTop),n<this.scrollLeft?n=this.scrollLeft:n+this.width>this.scrollRight&&(n=this.scrollRight-this.width),this.tooltip.css({
            left:n,
            top:t
        }))
        },
    remove:function(){
        this.tooltip.remove();
        this.sizetip.remove();
        this.sizetip=this.tooltip=i;
        r(window).unbind("resize.jqs scroll.jqs")
        }
    });
vt=function(){
    ut(at)
    };
    
r(vt);
f=[];
r.fn.sparkline=function(t,u){
    return this.each(function(){
        var e=new r.fn.sparkline.options(this,u),h=r(this),s,o;
        if(s=function(){
            var s,a,c,f,u,l,o;
            if(t==="html"||t===i?(o=this.getAttribute(e.get("tagValuesAttribute")),(o===i||o===null)&&(o=h.html()),s=o.replace(/(^\s*<!--)|(-->\s*$)|\s+/g,"").split(",")):s=t,a=e.get("width")==="auto"?s.length*e.get("defaultPixelsPerValue"):e.get("width"),e.get("height")==="auto"?e.get("composite")&&r.data(this,"_jqs_vcanvas")||(f=n.createElement("span"),f.innerHTML="a",h.html(f),c=r(f).innerHeight()||r(f).height(),r(f).remove(),f=null):c=e.get("height"),e.get("disableInteraction")?u=!1:(u=r.data(this,"_jqs_mhandler"),u?e.get("composite")||u.reset():(u=new ot(this,e),r.data(this,"_jqs_mhandler",u))),e.get("composite")&&!r.data(this,"_jqs_vcanvas")){
                r.data(this,"_jqs_errnotify")||(alert("Attempted to attach a composite sparkline to an element with no existing sparkline"),r.data(this,"_jqs_errnotify",!0));
                return
            }
            l=new r.fn.sparkline[e.get("type")](this,s,e,a,c);
            l.render();
            u&&u.registerSparkline(l)
            },r(this).html()&&!e.get("disableHiddenCheck")&&r(this).is(":hidden")||!r(this).parents("body").length){
            if(!e.get("composite")&&r.data(this,"_jqs_pending"))for(o=f.length;o;o--)f[o-1][0]==this&&f.splice(o-1,1);
            f.push([this,s]);
            r.data(this,"_jqs_pending",!0)
            }else s.call(this)
            })
    };
    
r.fn.sparkline.defaults=tt();
r.sparkline_display_visible=function(){
    for(var t,i=[],n=0,u=f.length;n<u;n++)t=f[n][0],r(t).is(":visible")&&!r(t).parents().is(":hidden")?(f[n][1].call(t),r.data(f[n][0],"_jqs_pending",!1),i.push(n)):r(t).closest("html").length||r.data(t,"_jqs_pending")||(r.data(f[n][0],"_jqs_pending",!1),i.push(n));
    for(n=i.length;n;n--)f.splice(i[n-1],1)
        };
        
r.fn.sparkline.options=u({
    init:function(n,t){
        var e,i,u,f;
        this.userOptions=t=t||{};
        
        this.tag=n;
        this.tagValCache={};
        
        i=r.fn.sparkline.defaults;
        u=i.common;
        this.tagOptionsPrefix=t.enableTagOptions&&(t.tagOptionsPrefix||u.tagOptionsPrefix);
        f=this.getTagSetting("type");
        e=f===c?i[t.type||u.type]:i[f];
        this.mergedOptions=r.extend({},u,e,t)
        },
    getTagSetting:function(n){
        var u=this.tagOptionsPrefix,t,r,f,e;
        if(u===!1||u===i)return c;
        if(this.tagValCache.hasOwnProperty(n))t=this.tagValCache.key;
        else{
            if(t=this.tag.getAttribute(u+n),t===i||t===null)t=c;
            else if(t.substr(0,1)==="[")for(t=t.substr(1,t.length-2).split(","),r=t.length;r--;)t[r]=o(t[r].replace(/(^\s*)|(\s*$)/g,""));
            else if(t.substr(0,1)==="{")for(f=t.substr(1,t.length-2).split(","),t={},r=f.length;r--;)e=f[r].split(":",2),t[e[0].replace(/(^\s*)|(\s*$)/g,"")]=o(e[1].replace(/(^\s*)|(\s*$)/g,""));else t=o(t);
            this.tagValCache.key=t
            }
            return t
        },
    get:function(n,t){
        var r=this.getTagSetting(n),u;
        return r!==c?r:(u=this.mergedOptions[n])===i?t:u
        }
    });
r.fn.sparkline._base=u({
    disabled:!1,
    init:function(n,t,u,f,e){
        this.el=n;
        this.$el=r(n);
        this.values=t;
        this.options=u;
        this.width=f;
        this.height=e;
        this.currentRegion=i
        },
    initTarget:function(){
        var n=!this.options.get("disableInteraction");
        (this.target=this.$el.simpledraw(this.width,this.height,this.options.get("composite"),n))?(this.canvasWidth=this.target.pixelWidth,this.canvasHeight=this.target.pixelHeight):this.disabled=!0
        },
    render:function(){
        return this.disabled?(this.el.innerHTML="",!1):!0
        },
    getRegion:function(){},
    setRegionHighlight:function(n,t,r){
        var f=this.currentRegion,e=!this.options.get("disableHighlight"),u;
        return t>this.canvasWidth||r>this.canvasHeight||t<0||r<0?null:(u=this.getRegion(n,t,r),f!==u)?(f!==i&&e&&this.removeHighlight(),this.currentRegion=u,u!==i&&e&&this.renderHighlight(),!0):!1
        },
    clearRegionHighlight:function(){
        return this.currentRegion!==i?(this.removeHighlight(),this.currentRegion=i,!0):!1
        },
    renderHighlight:function(){
        this.changeHighlight(!0)
        },
    removeHighlight:function(){
        this.changeHighlight(!1)
        },
    changeHighlight:function(){},
    getCurrentRegionTooltip:function(){
        var t=this.options,y="",h=[],n,o,p,w,b,u,c,l,a,k,v,s,d,f;
        if(this.currentRegion===i)return"";
        if(n=this.getCurrentRegionFields(),v=t.get("tooltipFormatter"),v)return v(this,t,n);
        if(t.get("tooltipChartTitle")&&(y+='<div class="jqs jqstitle">'+t.get("tooltipChartTitle")+"<\/div>\n"),o=this.options.get("tooltipFormat"),!o)return"";
        if(r.isArray(o)||(o=[o]),r.isArray(n)||(n=[n]),c=this.options.get("tooltipFormatFieldlist"),l=this.options.get("tooltipFormatFieldlistKey"),c&&l){
            for(a=[],u=n.length;u--;)k=n[u][l],(f=r.inArray(k,c))!=-1&&(a[f]=n[u]);
            n=a
            }
            for(p=o.length,d=n.length,u=0;u<p;u++)for(s=o[u],typeof s=="string"&&(s=new e(s)),w=s.fclass||"jqsfield",f=0;f<d;f++)n[f].isNull&&t.get("tooltipSkipNull")||(r.extend(n[f],{
            prefix:t.get("tooltipPrefix"),
            suffix:t.get("tooltipSuffix")
            }),b=s.render(n[f],t.get("tooltipValueLookups"),t),h.push('<div class="'+w+'">'+b+"<\/div>"));
        return h.length?y+h.join("\n"):""
        },
    getCurrentRegionFields:function(){},
    calcHighlightColor:function(n,i){
        var e=i.get("highlightColor"),o=i.get("highlightLighten"),u,h,f,r;
        if(e)return e;
        if(o&&(u=/^#([0-9a-f])([0-9a-f])([0-9a-f])$/i.exec(n)||/^#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i.exec(n),u)){
            for(f=[],h=n.length===4?16:1,r=0;r<3;r++)f[r]=s(t.round(parseInt(u[r+1],16)*h*o),0,255);
            return"rgb("+f.join(",")+")"
            }
            return n
        }
    });
a={
    changeHighlight:function(n){
        var i=this.currentRegion,f=this.target,u=this.regionShapes[i],t;
        u&&(t=this.renderRegion(i,n),r.isArray(t)||r.isArray(u)?(f.replaceWithShapes(u,t),this.regionShapes[i]=r.map(t,function(n){
            return n.id
            })):(f.replaceWithShape(u,t),this.regionShapes[i]=t.id))
        },
    render:function(){
        var e=this.values,o=this.target,u=this.regionShapes,n,f,t,i;
        if(this.cls._super.render.call(this)){
            for(t=e.length;t--;)if(n=this.renderRegion(t),n)if(r.isArray(n)){
                for(f=[],i=n.length;i--;)n[i].append(),f.push(n[i].id);
                u[t]=f
                }else n.append(),u[t]=n.id;else u[t]=null;o.render()
            }
        }
};

r.fn.sparkline.line=p=u(r.fn.sparkline._base,{
    type:"line",
    init:function(n,t,i,r,u){
        p._super.init.call(this,n,t,i,r,u);
        this.vertices=[];
        this.regionMap=[];
        this.xvalues=[];
        this.yvalues=[];
        this.yminmax=[];
        this.hightlightSpotId=null;
        this.lastShapeId=null;
        this.initTarget()
        },
    getRegion:function(n,t){
        for(var u=this.regionMap,r=u.length;r--;)if(u[r]!==null&&t>=u[r][0]&&t<=u[r][1])return u[r][2];return i
        },
    getCurrentRegionFields:function(){
        var n=this.currentRegion;
        return{
            isNull:this.yvalues[n]===null,
            x:this.xvalues[n],
            y:this.yvalues[n],
            color:this.options.get("lineColor"),
            fillColor:this.options.get("fillColor"),
            offset:n
        }
    },
renderHighlight:function(){
    var h=this.currentRegion,t=this.target,n=this.vertices[h],r=this.options,e=r.get("spotRadius"),o=r.get("highlightSpotColor"),s=r.get("highlightLineColor"),u,f;
    n&&(e&&o&&(u=t.drawCircle(n[0],n[1],e,i,o),this.highlightSpotId=u.id,t.insertAfterShape(this.lastShapeId,u)),s&&(f=t.drawLine(n[0],this.canvasTop,n[0],this.canvasTop+this.canvasHeight,s),this.highlightLineId=f.id,t.insertAfterShape(this.lastShapeId,f)))
    },
removeHighlight:function(){
    var n=this.target;
    this.highlightSpotId&&(n.removeShapeId(this.highlightSpotId),this.highlightSpotId=null);
    this.highlightLineId&&(n.removeShapeId(this.highlightLineId),this.highlightLineId=null)
    },
scanValues:function(){
    for(var i=this.values,c=i.length,r=this.xvalues,e=this.yvalues,u=this.yminmax,f,s,h,o,n=0;n<c;n++)f=i[n],s=typeof i[n]=="string",h=typeof i[n]=="object"&&i[n]instanceof Array,o=s&&i[n].split(":"),s&&o.length===2?(r.push(Number(o[0])),e.push(Number(o[1])),u.push(Number(o[1]))):h?(r.push(f[0]),e.push(f[1]),u.push(f[1])):(r.push(n),i[n]===null||i[n]==="null"?e.push(null):(e.push(Number(f)),u.push(Number(f))));
    this.options.get("xvalues")&&(r=this.options.get("xvalues"));
    this.maxy=this.maxyorg=t.max.apply(t,u);
    this.miny=this.minyorg=t.min.apply(t,u);
    this.maxx=t.max.apply(t,r);
    this.minx=t.min.apply(t,r);
    this.xvalues=r;
    this.yvalues=e;
    this.yminmax=u
    },
processRangeOptions:function(){
    var n=this.options,t=n.get("normalRangeMin"),r=n.get("normalRangeMax");
    t!==i&&(t<this.miny&&(this.miny=t),r>this.maxy&&(this.maxy=r));
    n.get("chartRangeMin")!==i&&(n.get("chartRangeClip")||n.get("chartRangeMin")<this.miny)&&(this.miny=n.get("chartRangeMin"));
    n.get("chartRangeMax")!==i&&(n.get("chartRangeClip")||n.get("chartRangeMax")>this.maxy)&&(this.maxy=n.get("chartRangeMax"));
    n.get("chartRangeMinX")!==i&&(n.get("chartRangeClipX")||n.get("chartRangeMinX")<this.minx)&&(this.minx=n.get("chartRangeMinX"));
    n.get("chartRangeMaxX")!==i&&(n.get("chartRangeClipX")||n.get("chartRangeMaxX")>this.maxx)&&(this.maxx=n.get("chartRangeMaxX"))
    },
drawNormalRange:function(n,r,u,f,e){
    var s=this.options.get("normalRangeMin"),o=this.options.get("normalRangeMax"),h=r+t.round(u-u*((o-this.miny)/e)),c=t.round(u*(o-s)/e);
    this.target.drawRect(n,h,f,c,i,this.options.get("normalRangeColor")).append()
    },
render:function(){
    var n=this.options,v=this.target,c=this.canvasWidth,o=this.canvasHeight,at=this.vertices,f=n.get("spotRadius"),pt=this.regionMap,b,y,k,l,a,ht,e,ut,g,d,vt,tt,yt,ct,ft,et,ot,st,nt,it,rt,lt,w,s,u;
    if(p._super.render.call(this)&&(this.scanValues(),this.processRangeOptions(),w=this.xvalues,s=this.yvalues,this.yminmax.length&&!(this.yvalues.length<2))){
        for(l=a=0,b=this.maxx-this.minx==0?1:this.maxx-this.minx,y=this.maxy-this.miny==0?1:this.maxy-this.miny,k=this.yvalues.length-1,f&&(c<f*4||o<f*4)&&(f=0),f&&(rt=n.get("highlightSpotColor")&&!n.get("disableInteraction"),(rt||n.get("minSpotColor")||n.get("spotColor")&&s[k]===this.miny)&&(o-=t.ceil(f)),(rt||n.get("maxSpotColor")||n.get("spotColor")&&s[k]===this.maxy)&&(o-=t.ceil(f),l+=t.ceil(f)),(rt||(n.get("minSpotColor")||n.get("maxSpotColor"))&&(s[0]===this.miny||s[0]===this.maxy))&&(a+=t.ceil(f),c-=t.ceil(f)),(rt||n.get("spotColor")||n.get("minSpotColor")||n.get("maxSpotColor")&&(s[k]===this.miny||s[k]===this.maxy))&&(c-=t.ceil(f))),o--,n.get("normalRangeMin")===i||n.get("drawNormalOnTop")||this.drawNormalRange(a,l,o,c,y),e=[],ut=[e],ct=ft=null,et=s.length,u=0;u<et;u++)g=w[u],vt=w[u+1],d=s[u],tt=a+t.round((g-this.minx)*(c/b)),yt=u<et-1?a+t.round((vt-this.minx)*(c/b)):c,ft=tt+(yt-tt)/2,pt[u]=[ct||0,ft,u],ct=ft,d===null?u&&(s[u-1]!==null&&(e=[],ut.push(e)),at.push(null)):(d<this.miny&&(d=this.miny),d>this.maxy&&(d=this.maxy),e.length||e.push([tt,l+o]),ht=[tt,l+t.round(o-o*((d-this.miny)/y))],e.push(ht),at.push(ht));
        for(ot=[],st=[],nt=ut.length,u=0;u<nt;u++)e=ut[u],e.length&&(n.get("fillColor")&&(e.push([e[e.length-1][0],l+o]),st.push(e.slice(0)),e.pop()),e.length>2&&(e[0]=[e[0][0],e[1][1]]),ot.push(e));
        for(nt=st.length,u=0;u<nt;u++)v.drawShape(st[u],n.get("fillColor"),n.get("fillColor")).append();
        for(n.get("normalRangeMin")!==i&&n.get("drawNormalOnTop")&&this.drawNormalRange(a,l,o,c,y),nt=ot.length,u=0;u<nt;u++)v.drawShape(ot[u],n.get("lineColor"),i,n.get("lineWidth")).append();
        if(f&&n.get("valueSpots"))for(it=n.get("valueSpots"),it.get===i&&(it=new h(it)),u=0;u<et;u++)lt=it.get(s[u]),lt&&v.drawCircle(a+t.round((w[u]-this.minx)*(c/b)),l+t.round(o-o*((s[u]-this.miny)/y)),f,i,lt).append();
        f&&n.get("spotColor")&&s[k]!==null&&v.drawCircle(a+t.round((w[w.length-1]-this.minx)*(c/b)),l+t.round(o-o*((s[k]-this.miny)/y)),f,i,n.get("spotColor")).append();
        this.maxy!==this.minyorg&&(f&&n.get("minSpotColor")&&(g=w[r.inArray(this.minyorg,s)],v.drawCircle(a+t.round((g-this.minx)*(c/b)),l+t.round(o-o*((this.minyorg-this.miny)/y)),f,i,n.get("minSpotColor")).append()),f&&n.get("maxSpotColor")&&(g=w[r.inArray(this.maxyorg,s)],v.drawCircle(a+t.round((g-this.minx)*(c/b)),l+t.round(o-o*((this.maxyorg-this.miny)/y)),f,i,n.get("maxSpotColor")).append()));
        this.lastShapeId=v.getLastShapeId();
        this.canvasTop=l;
        v.render()
        }
    }
});
r.fn.sparkline.bar=ht=u(r.fn.sparkline._base,a,{
    type:"bar",
    init:function(n,u,f,e,c){
        var ct=parseInt(f.get("barWidth"),10),lt=parseInt(f.get("barSpacing"),10),dt=f.get("chartRangeMin"),gt=f.get("chartRangeMax"),at=f.get("chartRangeClip"),nt=Infinity,d=-Infinity,vt,yt,pt,tt,b,a,rt,wt,ut,ft,y,p,bt,kt,w,et,g,ni,ti,l,k,ii,ot,st;
        for(ht._super.init.call(this,n,u,f,e,c),a=0,rt=u.length;a<rt;a++)l=u[a],vt=typeof l=="string"&&l.indexOf(":")>-1,(vt||r.isArray(l))&&(w=!0,vt&&(l=u[a]=v(l.split(":"))),l=it(l,null),yt=t.min.apply(t,l),pt=t.max.apply(t,l),yt<nt&&(nt=yt),pt>d&&(d=pt));
        for(this.stacked=w,this.regionShapes={},this.barWidth=ct,this.barSpacing=lt,this.totalBarWidth=ct+lt,this.width=e=u.length*ct+(u.length-1)*lt,this.initTarget(),at&&(bt=dt===i?-Infinity:dt,kt=gt===i?Infinity:gt),b=[],tt=w?[]:b,ot=[],st=[],a=0,rt=u.length;a<rt;a++)if(w)for(et=u[a],u[a]=ti=[],ot[a]=0,tt[a]=st[a]=0,g=0,ni=et.length;g<ni;g++)l=ti[g]=at?s(et[g],bt,kt):et[g],l!==null&&(l>0&&(ot[a]+=l),nt<0&&d>0?l<0?st[a]+=t.abs(l):tt[a]+=l:tt[a]+=t.abs(l-(l<0?d:nt)),b.push(l));else l=at?s(u[a],bt,kt):u[a],l=u[a]=o(l),l!==null&&b.push(l);this.max=p=t.max.apply(t,b);
        this.min=y=t.min.apply(t,b);
        this.stackMax=d=w?t.max.apply(t,ot):p;
        this.stackMin=nt=w?t.min.apply(t,b):y;
        f.get("chartRangeMin")!==i&&(f.get("chartRangeClip")||f.get("chartRangeMin")<y)&&(y=f.get("chartRangeMin"));
        f.get("chartRangeMax")!==i&&(f.get("chartRangeClip")||f.get("chartRangeMax")>p)&&(p=f.get("chartRangeMax"));
        this.zeroAxis=ut=f.get("zeroAxis",!0);
        ft=y<=0&&p>=0&&ut?0:ut==!1?y:y>0?y:p;
        this.xaxisOffset=ft;
        wt=w?t.max.apply(t,tt)+t.max.apply(t,st):p-y;
        this.canvasHeightEf=ut&&y<0?this.canvasHeight-2:this.canvasHeight-1;
        y<ft?(ii=w&&p>=0?d:p,k=(ii-ft)/wt*this.canvasHeight,k!==t.ceil(k)&&(this.canvasHeightEf-=2,k=t.ceil(k))):k=this.canvasHeight;
        this.yoffset=k;
        r.isArray(f.get("colorMap"))?(this.colorMapByIndex=f.get("colorMap"),this.colorMapByValue=null):(this.colorMapByIndex=null,this.colorMapByValue=f.get("colorMap"),this.colorMapByValue&&this.colorMapByValue.get===i&&(this.colorMapByValue=new h(this.colorMapByValue)));
        this.range=wt
        },
    getRegion:function(n,r){
        var u=t.floor(r/this.totalBarWidth);
        return u<0||u>=this.values.length?i:u
        },
    getCurrentRegionFields:function(){
        for(var i=this.currentRegion,r=ft(this.values[i]),u=[],n,t=r.length;t--;)n=r[t],u.push({
            isNull:n===null,
            value:n,
            color:this.calcColor(t,n,i),
            offset:i
        });
        return u
        },
    calcColor:function(n,t,u){
        var o=this.colorMapByIndex,s=this.colorMapByValue,e=this.options,f,h;
        return f=this.stacked?e.get("stackedBarColor"):t<0?e.get("negBarColor"):e.get("barColor"),t===0&&e.get("zeroColor")!==i&&(f=e.get("zeroColor")),s&&(h=s.get(t))?f=h:o&&o.length>u&&(f=o[u]),r.isArray(f)?f[n%f.length]:f
        },
    renderRegion:function(n,u){
        var f=this.values[n],h=this.options,c=this.xaxisOffset,p=[],b=this.range,rt=this.stacked,k=this.target,d=n*this.totalBarWidth,ut=this.canvasHeightEf,o=this.yoffset,l,a,e,g,w,v,nt,s,tt,it;
        if(f=r.isArray(f)?f:[f],nt=f.length,s=f[0],g=y(null,f),it=y(c,f,!0),g)return h.get("nullColor")?(e=u?h.get("nullColor"):this.calcHighlightColor(h.get("nullColor"),h),l=o>0?o-1:o,k.drawRect(d,l,this.barWidth-1,0,e,e)):i;
        for(w=o,v=0;v<nt;v++){
            if(s=f[v],rt&&s===c){
                if(!it||tt)continue;
                tt=!0
                }
                a=b>0?t.floor(ut*(t.abs(s-c)/b))+1:1;
            s<c||s===c&&o===0?(l=w,w+=a):(l=o-a,o-=a);
            e=this.calcColor(v,s,n);
            u&&(e=this.calcHighlightColor(e,h));
            p.push(k.drawRect(d,l,this.barWidth-1,a-1,e,e))
            }
            return p.length===1?p[0]:p
        }
    });
r.fn.sparkline.tristate=ct=u(r.fn.sparkline._base,a,{
    type:"tristate",
    init:function(n,t,u,f,e){
        var o=parseInt(u.get("barWidth"),10),s=parseInt(u.get("barSpacing"),10);
        ct._super.init.call(this,n,t,u,f,e);
        this.regionShapes={};
        
        this.barWidth=o;
        this.barSpacing=s;
        this.totalBarWidth=o+s;
        this.values=r.map(t,Number);
        this.width=f=t.length*o+(t.length-1)*s;
        r.isArray(u.get("colorMap"))?(this.colorMapByIndex=u.get("colorMap"),this.colorMapByValue=null):(this.colorMapByIndex=null,this.colorMapByValue=u.get("colorMap"),this.colorMapByValue&&this.colorMapByValue.get===i&&(this.colorMapByValue=new h(this.colorMapByValue)));
        this.initTarget()
        },
    getRegion:function(n,i){
        return t.floor(i/this.totalBarWidth)
        },
    getCurrentRegionFields:function(){
        var n=this.currentRegion;
        return{
            isNull:this.values[n]===i,
            value:this.values[n],
            color:this.calcColor(this.values[n],n),
            offset:n
        }
    },
calcColor:function(n,t){
    var u=this.values,i=this.options,r=this.colorMapByIndex,f=this.colorMapByValue,e;
    return f&&(e=f.get(n))?e:r&&r.length>t?r[t]:u[t]<0?i.get("negBarColor"):u[t]>0?i.get("posBarColor"):i.get("zeroBarColor")
    },
renderRegion:function(n,i){
    var o=this.values,l=this.options,s=this.target,h,f,u,c,e,r;
    if(h=s.pixelHeight,u=t.round(h/2),c=n*this.totalBarWidth,o[n]<0?(e=u,f=u-1):o[n]>0?(e=0,f=u-1):(e=u-1,f=2),r=this.calcColor(o[n],n),r!==null)return i&&(r=this.calcHighlightColor(r,l)),s.drawRect(c,e,this.barWidth-1,f-1,r,r)
        }
    });
r.fn.sparkline.discrete=lt=u(r.fn.sparkline._base,a,{
    type:"discrete",
    init:function(n,u,f,e,o){
        lt._super.init.call(this,n,u,f,e,o);
        this.regionShapes={};
        
        this.values=u=r.map(u,Number);
        this.min=t.min.apply(t,u);
        this.max=t.max.apply(t,u);
        this.range=this.max-this.min;
        this.width=e=f.get("width")==="auto"?u.length*2:this.width;
        this.interval=t.floor(e/u.length);
        this.itemWidth=e/u.length;
        f.get("chartRangeMin")!==i&&(f.get("chartRangeClip")||f.get("chartRangeMin")<this.min)&&(this.min=f.get("chartRangeMin"));
        f.get("chartRangeMax")!==i&&(f.get("chartRangeClip")||f.get("chartRangeMax")>this.max)&&(this.max=f.get("chartRangeMax"));
        this.initTarget();
        this.target&&(this.lineHeight=f.get("lineHeight")==="auto"?t.round(this.canvasHeight*.3):f.get("lineHeight"))
        },
    getRegion:function(n,i){
        return t.floor(i/this.itemWidth)
        },
    getCurrentRegionFields:function(){
        var n=this.currentRegion;
        return{
            isNull:this.values[n]===i,
            value:this.values[n],
            offset:n
        }
    },
renderRegion:function(n,i){
    var a=this.values,r=this.options,h=this.min,v=this.max,y=this.range,p=this.interval,w=this.target,b=this.canvasHeight,c=this.lineHeight,l=b-c,f,e,u,o;
    return e=s(a[n],h,v),o=n*p,f=t.round(l-l*((e-h)/y)),u=r.get("thresholdColor")&&e<r.get("thresholdValue")?r.get("thresholdColor"):r.get("lineColor"),i&&(u=this.calcHighlightColor(u,r)),w.drawLine(o,f,o,f+c,u)
    }
});
r.fn.sparkline.bullet=w=u(r.fn.sparkline._base,{
    type:"bullet",
    init:function(n,r,u,f,e){
        var s,h,o;
        w._super.init.call(this,n,r,u,f,e);
        this.values=r=v(r);
        o=r.slice();
        o[0]=o[0]===null?o[2]:o[0];
        o[1]=r[1]===null?o[2]:o[1];
        s=t.min.apply(t,r);
        h=t.max.apply(t,r);
        s=u.get("base")===i?s<0?s:0:u.get("base");
        this.min=s;
        this.max=h;
        this.range=h-s;
        this.shapes={};
        
        this.valueShapes={};
        
        this.regiondata={};
        
        this.width=f=u.get("width")==="auto"?"4.0em":f;
        this.target=this.$el.simpledraw(f,e,u.get("composite"));
        r.length||(this.disabled=!0);
        this.initTarget()
        },
    getRegion:function(n,t,r){
        var u=this.target.getShapeAt(n,t,r);
        return u!==i&&this.shapes[u]!==i?this.shapes[u]:i
        },
    getCurrentRegionFields:function(){
        var n=this.currentRegion;
        return{
            fieldkey:n.substr(0,1),
            value:this.values[n.substr(1)],
            region:n
        }
    },
changeHighlight:function(n){
    var i=this.currentRegion,r=this.valueShapes[i],t;
    delete this.shapes[r];
    switch(i.substr(0,1)){
        case"r":
            t=this.renderRange(i.substr(1),n);
            break;
        case"p":
            t=this.renderPerformance(n);
            break;
        case"t":
            t=this.renderTarget(n)
            }
            this.valueShapes[i]=t.id;
    this.shapes[t.id]=i;
    this.target.replaceWithShape(r,t)
    },
renderRange:function(n,i){
    var u=this.values[n],f=t.round(this.canvasWidth*((u-this.min)/this.range)),r=this.options.get("rangeColors")[n-2];
    return i&&(r=this.calcHighlightColor(r,this.options)),this.target.drawRect(0,0,f-1,this.canvasHeight-1,r,r)
    },
renderPerformance:function(n){
    var r=this.values[1],u=t.round(this.canvasWidth*((r-this.min)/this.range)),i=this.options.get("performanceColor");
    return n&&(i=this.calcHighlightColor(i,this.options)),this.target.drawRect(0,t.round(this.canvasHeight*.3),u-1,t.round(this.canvasHeight*.4)-1,i,i)
    },
renderTarget:function(n){
    var u=this.values[0],f=t.round(this.canvasWidth*((u-this.min)/this.range)-this.options.get("targetWidth")/2),r=t.round(this.canvasHeight*.1),e=this.canvasHeight-r*2,i=this.options.get("targetColor");
    return n&&(i=this.calcHighlightColor(i,this.options)),this.target.drawRect(f,r,this.options.get("targetWidth")-1,e-1,i,i)
    },
render:function(){
    var i=this.values.length,r=this.target,t,n;
    if(w._super.render.call(this)){
        for(t=2;t<i;t++)n=this.renderRange(t).append(),this.shapes[n.id]="r"+t,this.valueShapes["r"+t]=n.id;
        this.values[1]!==null&&(n=this.renderPerformance().append(),this.shapes[n.id]="p1",this.valueShapes.p1=n.id);
        this.values[0]!==null&&(n=this.renderTarget().append(),this.shapes[n.id]="t0",this.valueShapes.t0=n.id);
        r.render()
        }
    }
});
r.fn.sparkline.pie=b=u(r.fn.sparkline._base,{
    type:"pie",
    init:function(n,i,u,f,e){
        var s=0,o;
        if(b._super.init.call(this,n,i,u,f,e),this.shapes={},this.valueShapes={},this.values=i=r.map(i,Number),u.get("width")==="auto"&&(this.width=this.height),i.length>0)for(o=i.length;o--;)s+=i[o];
        this.total=s;
        this.initTarget();
        this.radius=t.floor(t.min(this.canvasWidth,this.canvasHeight)/2)
        },
    getRegion:function(n,t,r){
        var u=this.target.getShapeAt(n,t,r);
        return u!==i&&this.shapes[u]!==i?this.shapes[u]:i
        },
    getCurrentRegionFields:function(){
        var n=this.currentRegion;
        return{
            isNull:this.values[n]===i,
            value:this.values[n],
            percent:this.values[n]/this.total*100,
            color:this.options.get("sliceColors")[n%this.options.get("sliceColors").length],
            offset:n
        }
    },
changeHighlight:function(n){
    var t=this.currentRegion,i=this.renderSlice(t,n),r=this.valueShapes[t];
    delete this.shapes[r];
    this.target.replaceWithShape(r,i);
    this.valueShapes[t]=i.id;
    this.shapes[i.id]=t
    },
renderSlice:function(n,r){
    for(var p=this.target,f=this.options,h=this.radius,w=f.get("borderWidth"),c=f.get("offset"),b=2*t.PI,l=this.values,a=this.total,e=c?2*t.PI*(c/360):0,v,o,s,y=l.length,u=0;u<y;u++){
        if(v=e,o=e,a>0&&(o=e+b*(l[u]/a)),n===u)return s=f.get("sliceColors")[u%f.get("sliceColors").length],r&&(s=this.calcHighlightColor(s,f)),p.drawPieSlice(h,h,h-w,v,o,i,s);
        e=o
        }
    },
render:function(){
    var e=this.target,o=this.values,s=this.options,r=this.radius,u=s.get("borderWidth"),f,n;
    if(b._super.render.call(this)){
        for(u&&e.drawCircle(r,r,t.floor(r-u/2),s.get("borderColor"),i,u).append(),n=o.length;n--;)o[n]&&(f=this.renderSlice(n).append(),this.valueShapes[n]=f.id,this.shapes[f.id]=n);
        e.render()
        }
    }
});
r.fn.sparkline.box=k=u(r.fn.sparkline._base,{
    type:"box",
    init:function(n,t,i,u,f){
        k._super.init.call(this,n,t,i,u,f);
        this.values=r.map(t,Number);
        this.width=i.get("width")==="auto"?"4.0em":u;
        this.initTarget();
        this.values.length||(this.disabled=1)
        },
    getRegion:function(){
        return 1
        },
    getCurrentRegionFields:function(){
        var n=[{
            field:"lq",
            value:this.quartiles[0]
            },{
            field:"med",
            value:this.quartiles[1]
            },{
            field:"uq",
            value:this.quartiles[2]
            }];
        return this.loutlier!==i&&n.push({
            field:"lo",
            value:this.loutlier
            }),this.routlier!==i&&n.push({
            field:"ro",
            value:this.routlier
            }),this.lwhisker!==i&&n.push({
            field:"lw",
            value:this.lwhisker
            }),this.rwhisker!==i&&n.push({
            field:"rw",
            value:this.rwhisker
            }),n
        },
    render:function(){
        var s=this.target,r=this.values,g=r.length,n=this.options,nt=this.canvasWidth,u=this.canvasHeight,e=n.get("chartRangeMin")===i?t.min.apply(t,r):n.get("chartRangeMin"),it=n.get("chartRangeMax")===i?t.max.apply(t,r):n.get("chartRangeMax"),o=0,h,w,tt,a,p,v,c,b,y,d,f;
        if(k._super.render.call(this)){
            if(n.get("raw"))n.get("showOutliers")&&r.length>5?(w=r[0],h=r[1],a=r[2],p=r[3],v=r[4],c=r[5],b=r[6]):(h=r[0],a=r[1],p=r[2],v=r[3],c=r[4]);
            else if(r.sort(function(n,t){
                return n-t
                }),a=l(r,1),p=l(r,2),v=l(r,3),tt=v-a,n.get("showOutliers")){
                for(h=c=i,y=0;y<g;y++)h===i&&r[y]>a-tt*n.get("outlierIQR")&&(h=r[y]),r[y]<v+tt*n.get("outlierIQR")&&(c=r[y]);
                w=r[0];
                b=r[g-1]
                }else h=r[0],c=r[g-1];
            this.quartiles=[a,p,v];
            this.lwhisker=h;
            this.rwhisker=c;
            this.loutlier=w;
            this.routlier=b;
            f=nt/(it-e+1);
            n.get("showOutliers")&&(o=t.ceil(n.get("spotRadius")),nt-=2*t.ceil(n.get("spotRadius")),f=nt/(it-e+1),w<h&&s.drawCircle((w-e)*f+o,u/2,n.get("spotRadius"),n.get("outlierLineColor"),n.get("outlierFillColor")).append(),b>c&&s.drawCircle((b-e)*f+o,u/2,n.get("spotRadius"),n.get("outlierLineColor"),n.get("outlierFillColor")).append());
            s.drawRect(t.round((a-e)*f+o),t.round(u*.1),t.round((v-a)*f),t.round(u*.8),n.get("boxLineColor"),n.get("boxFillColor")).append();
            s.drawLine(t.round((h-e)*f+o),t.round(u/2),t.round((a-e)*f+o),t.round(u/2),n.get("lineColor")).append();
            s.drawLine(t.round((h-e)*f+o),t.round(u/4),t.round((h-e)*f+o),t.round(u-u/4),n.get("whiskerColor")).append();
            s.drawLine(t.round((c-e)*f+o),t.round(u/2),t.round((v-e)*f+o),t.round(u/2),n.get("lineColor")).append();
            s.drawLine(t.round((c-e)*f+o),t.round(u/4),t.round((c-e)*f+o),t.round(u-u/4),n.get("whiskerColor")).append();
            s.drawLine(t.round((p-e)*f+o),t.round(u*.1),t.round((p-e)*f+o),t.round(u*.9),n.get("medianColor")).append();
            n.get("target")&&(d=t.ceil(n.get("spotRadius")),s.drawLine(t.round((n.get("target")-e)*f+o),t.round(u/2-d),t.round((n.get("target")-e)*f+o),t.round(u/2+d),n.get("targetColor")).append(),s.drawLine(t.round((n.get("target")-e)*f+o-d),t.round(u/2),t.round((n.get("target")-e)*f+o+d),t.round(u/2),n.get("targetColor")).append());
            s.render()
            }
        }
});
yt=u({
    init:function(n,t,i,r){
        this.target=n;
        this.id=t;
        this.type=i;
        this.args=r
        },
    append:function(){
        return this.target.appendShape(this),this
        }
    });
d=u({
    _pxregex:/(\d+)(px)?\s*$/i,
    init:function(n,t,i){
        n&&(this.width=n,this.height=t,this.target=i,this.lastShapeId=null,i[0]&&(i=i[0]),r.data(i,"_jqs_vcanvas",this))
        },
    drawLine:function(n,t,i,r,u,f){
        return this.drawShape([[n,t],[i,r]],u,f)
        },
    drawShape:function(n,t,i,r){
        return this._genShape("Shape",[n,t,i,r])
        },
    drawCircle:function(n,t,i,r,u,f){
        return this._genShape("Circle",[n,t,i,r,u,f])
        },
    drawPieSlice:function(n,t,i,r,u,f,e){
        return this._genShape("PieSlice",[n,t,i,r,u,f,e])
        },
    drawRect:function(n,t,i,r,u,f){
        return this._genShape("Rect",[n,t,i,r,u,f])
        },
    getElement:function(){
        return this.canvas
        },
    getLastShapeId:function(){
        return this.lastShapeId
        },
    reset:function(){
        alert("reset not implemented")
        },
    _insert:function(n,t){
        r(t).html(n)
        },
    _calculatePixelDims:function(n,t,i){
        var u;
        u=this._pxregex.exec(t);
        this.pixelHeight=u?u[1]:r(i).height();
        u=this._pxregex.exec(n);
        this.pixelWidth=u?u[1]:r(i).width()
        },
    _genShape:function(n,t){
        var i=wt++;
        return t.unshift(i),new yt(this,i,n,t)
        },
    appendShape:function(){
        alert("appendShape not implemented")
        },
    replaceWithShape:function(){
        alert("replaceWithShape not implemented")
        },
    insertAfterShape:function(){
        alert("insertAfterShape not implemented")
        },
    removeShapeId:function(){
        alert("removeShapeId not implemented")
        },
    getShapeAt:function(){
        alert("getShapeAt not implemented")
        },
    render:function(){
        alert("render not implemented")
        }
    });
g=u(d,{
    init:function(t,u,f,e){
        g._super.init.call(this,t,u,f);
        this.canvas=n.createElement("canvas");
        f[0]&&(f=f[0]);
        r.data(f,"_jqs_vcanvas",this);
        r(this.canvas).css({
            display:"inline-block",
            width:t,
            height:u,
            verticalAlign:"top"
        });
        this._insert(this.canvas,f);
        this._calculatePixelDims(t,u,this.canvas);
        this.canvas.width=this.pixelWidth;
        this.canvas.height=this.pixelHeight;
        this.interact=e;
        this.shapes={};
        
        this.shapeseq=[];
        this.currentTargetShapeId=i;
        r(this.canvas).css({
            width:this.pixelWidth,
            height:this.pixelHeight
            })
        },
    _getContext:function(n,t,r){
        var u=this.canvas.getContext("2d");
        return n!==i&&(u.strokeStyle=n),u.lineWidth=r===i?1:r,t!==i&&(u.fillStyle=t),u
        },
    reset:function(){
        var n=this._getContext();
        n.clearRect(0,0,this.pixelWidth,this.pixelHeight);
        this.shapes={};
        
        this.shapeseq=[];
        this.currentTargetShapeId=i
        },
    _drawShape:function(n,t,r,u,f){
        var e=this._getContext(r,u,f),o,s;
        for(e.beginPath(),e.moveTo(t[0][0]+.5,t[0][1]+.5),o=1,s=t.length;o<s;o++)e.lineTo(t[o][0]+.5,t[o][1]+.5);
        r!==i&&e.stroke();
        u!==i&&e.fill();
        this.targetX!==i&&this.targetY!==i&&e.isPointInPath(this.targetX,this.targetY)&&(this.currentTargetShapeId=n)
        },
    _drawCircle:function(n,r,u,f,e,o,s){
        var h=this._getContext(e,o,s);
        h.beginPath();
        h.arc(r,u,f,0,2*t.PI,!1);
        this.targetX!==i&&this.targetY!==i&&h.isPointInPath(this.targetX,this.targetY)&&(this.currentTargetShapeId=n);
        e!==i&&h.stroke();
        o!==i&&h.fill()
        },
    _drawPieSlice:function(n,t,r,u,f,e,o,s){
        var h=this._getContext(o,s);
        h.beginPath();
        h.moveTo(t,r);
        h.arc(t,r,u,f,e,!1);
        h.lineTo(t,r);
        h.closePath();
        o!==i&&h.stroke();
        s&&h.fill();
        this.targetX!==i&&this.targetY!==i&&h.isPointInPath(this.targetX,this.targetY)&&(this.currentTargetShapeId=n)
        },
    _drawRect:function(n,t,i,r,u,f,e){
        return this._drawShape(n,[[t,i],[t+r,i],[t+r,i+u],[t,i+u],[t,i]],f,e)
        },
    appendShape:function(n){
        return this.shapes[n.id]=n,this.shapeseq.push(n.id),this.lastShapeId=n.id,n.id
        },
    replaceWithShape:function(n,t){
        var r=this.shapeseq,i;
        for(this.shapes[t.id]=t,i=r.length;i--;)r[i]==n&&(r[i]=t.id);
        delete this.shapes[n]
    },
    replaceWithShapes:function(n,t){
        for(var r=this.shapeseq,f={},u,e,i=n.length;i--;)f[n[i]]=!0;
        for(i=r.length;i--;)u=r[i],f[u]&&(r.splice(i,1),delete this.shapes[u],e=i);
        for(i=t.length;i--;)r.splice(e,0,t[i].id),this.shapes[t[i].id]=t[i]
            },
    insertAfterShape:function(n,t){
        for(var r=this.shapeseq,i=r.length;i--;)if(r[i]===n){
            r.splice(i+1,0,t.id);
            this.shapes[t.id]=t;
            return
        }
        },
removeShapeId:function(n){
    for(var i=this.shapeseq,t=i.length;t--;)if(i[t]===n){
        i.splice(t,1);
        break
    }
    delete this.shapes[n]
},
getShapeAt:function(n,t,i){
    return this.targetX=t,this.targetY=i,this.render(),this.currentTargetShapeId
    },
render:function(){
    var i=this.shapeseq,u=this.shapes,f=i.length,e=this._getContext(),r,t,n;
    for(e.clearRect(0,0,this.pixelWidth,this.pixelHeight),n=0;n<f;n++)r=i[n],t=u[r],this["_draw"+t.type].apply(this,t.args);
    this.interact||(this.shapes={},this.shapeseq=[])
    }
});
nt=u(d,{
    init:function(t,i,u){
        var f;
        nt._super.init.call(this,t,i,u);
        u[0]&&(u=u[0]);
        r.data(u,"_jqs_vcanvas",this);
        this.canvas=n.createElement("span");
        r(this.canvas).css({
            display:"inline-block",
            position:"relative",
            overflow:"hidden",
            width:t,
            height:i,
            margin:"0px",
            padding:"0px",
            verticalAlign:"top"
        });
        this._insert(this.canvas,u);
        this._calculatePixelDims(t,i,this.canvas);
        this.canvas.width=this.pixelWidth;
        this.canvas.height=this.pixelHeight;
        f='<v:group coordorigin="0 0" coordsize="'+this.pixelWidth+" "+this.pixelHeight+'" style="position:absolute;top:0;left:0;width:'+this.pixelWidth+"px;height="+this.pixelHeight+'px;"><\/v:group>';
        this.canvas.insertAdjacentHTML("beforeEnd",f);
        this.group=r(this.canvas).children()[0];
        this.rendered=!1;
        this.prerender=""
        },
    _drawShape:function(n,t,r,u,f){
        for(var e=[],s,h,c,l,o=0,a=t.length;o<a;o++)e[o]=""+t[o][0]+","+t[o][1];
        return s=e.splice(0,1),f=f===i?1:f,h=r===i?' stroked="false" ':' strokeWeight="'+f+'px" strokeColor="'+r+'" ',c=u===i?' filled="false"':' fillColor="'+u+'" filled="true" ',l=e[0]===e[e.length-1]?"x ":"",'<v:shape coordorigin="0 0" coordsize="'+this.pixelWidth+" "+this.pixelHeight+'"  id="jqsshape'+n+'" '+h+c+' style="position:absolute;left:0px;top:0px;height:'+this.pixelHeight+"px;width:"+this.pixelWidth+'px;padding:0px;margin:0px;"  path="m '+s+" l "+e.join(", ")+" "+l+'e"> <\/v:shape>'
        },
    _drawCircle:function(n,t,r,u,f,e,o){
        var s,h;
        return t-=u,r-=u,s=f===i?' stroked="false" ':' strokeWeight="'+o+'px" strokeColor="'+f+'" ',h=e===i?' filled="false"':' fillColor="'+e+'" filled="true" ','<v:oval  id="jqsshape'+n+'" '+s+h+' style="position:absolute;top:'+r+"px; left:"+t+"px; width:"+u*2+"px; height:"+u*2+'px"><\/v:oval>'
        },
    _drawPieSlice:function(n,r,u,f,e,o,s,h){
        var y,c,l,a,v,p,w;
        if(e===o)return"";
        if(o-e==2*t.PI&&(e=0,o=2*t.PI),c=r+t.round(t.cos(e)*f),l=u+t.round(t.sin(e)*f),a=r+t.round(t.cos(o)*f),v=u+t.round(t.sin(o)*f),c===a&&l===v){
            if(o-e<t.PI)return"";
            c=a=r+f;
            l=v=u
            }
            return c===a&&l===v&&o-e<t.PI?"":(y=[r-f,u-f,r+f,u+f,c,l,a,v],p=s===i?' stroked="false" ':' strokeWeight="1px" strokeColor="'+s+'" ',w=h===i?' filled="false"':' fillColor="'+h+'" filled="true" ','<v:shape coordorigin="0 0" coordsize="'+this.pixelWidth+" "+this.pixelHeight+'"  id="jqsshape'+n+'" '+p+w+' style="position:absolute;left:0px;top:0px;height:'+this.pixelHeight+"px;width:"+this.pixelWidth+'px;padding:0px;margin:0px;"  path="m '+r+","+u+" wa "+y.join(", ")+' x e"> <\/v:shape>')
        },
    _drawRect:function(n,t,i,r,u,f,e){
        return this._drawShape(n,[[t,i],[t,i+u],[t+r,i+u],[t+r,i],[t,i]],f,e)
        },
    reset:function(){
        this.group.innerHTML=""
        },
    appendShape:function(n){
        var t=this["_draw"+n.type].apply(this,n.args);
        return this.rendered?this.group.insertAdjacentHTML("beforeEnd",t):this.prerender+=t,this.lastShapeId=n.id,n.id
        },
    replaceWithShape:function(n,t){
        var i=r("#jqsshape"+n),u=this["_draw"+t.type].apply(this,t.args);
        i[0].outerHTML=u
        },
    replaceWithShapes:function(n,t){
        for(var f=r("#jqsshape"+n[0]),u="",e=t.length,i=0;i<e;i++)u+=this["_draw"+t[i].type].apply(this,t[i].args);
        for(f[0].outerHTML=u,i=1;i<n.length;i++)r("#jqsshape"+n[i]).remove()
            },
    insertAfterShape:function(n,t){
        var i=r("#jqsshape"+n),u=this["_draw"+t.type].apply(this,t.args);
        i[0].insertAdjacentHTML("afterEnd",u)
        },
    removeShapeId:function(n){
        var t=r("#jqsshape"+n);
        this.group.removeChild(t[0])
        },
    getShapeAt:function(n){
        return n.id.substr(8)
        },
    render:function(){
        this.rendered||(this.group.innerHTML=this.prerender,this.rendered=!0)
        }
    })
})
}(document,Math),function(n){
    function d(n,t,i){
        switch(arguments.length){
            case 2:
                return n!=null?n:t;
            case 3:
                return n!=null?n:t!=null?t:i;
            default:
                throw new Error("Implement me");
        }
    }
    function lt(){
    return{
        empty:!1,
        unusedTokens:[],
        unusedInput:[],
        overflow:-2,
        charsLeftOver:0,
        nullInput:!1,
        invalidMonth:null,
        invalidFormat:!1,
        userInvalidated:!1,
        iso:!1
        }
    }
function g(n,i){
    function u(){
        t.suppressDeprecationWarnings===!1&&typeof console!="undefined"&&console.warn&&console.warn("Deprecation warning: "+n)
        }
        var r=!0;
    return l(function(){
        return r&&(u(),r=!1),i.apply(this,arguments)
        },i)
    }
    function vi(n,t){
    return function(i){
        return r(n.call(this,i),t)
        }
    }
function ou(n,t){
    return function(i){
        return this.lang().ordinal(n.call(this,i),t)
        }
    }
function yi(){}
function at(n){
    gi(n);
    l(this,n)
    }
    function vt(n){
    var t=wi(n),i=t.year||0,r=t.quarter||0,u=t.month||0,f=t.week||0,e=t.day||0,o=t.hour||0,s=t.minute||0,h=t.second||0,c=t.millisecond||0;
    this._milliseconds=+c+h*1e3+s*6e4+o*36e5;
    this._days=+e+f*7;
    this._months=+u+r*3+i*12;
    this._data={};
    
    this._bubble()
    }
    function l(n,t){
    for(var i in t)t.hasOwnProperty(i)&&(n[i]=t[i]);return t.hasOwnProperty("toString")&&(n.toString=t.toString),t.hasOwnProperty("valueOf")&&(n.valueOf=t.valueOf),n
    }
    function su(n){
    var i={};
    
    for(var t in n)n.hasOwnProperty(t)&&ri.hasOwnProperty(t)&&(i[t]=n[t]);return i
    }
    function w(n){
    return n<0?Math.ceil(n):Math.floor(n)
    }
    function r(n,t,i){
    for(var r=""+Math.abs(n),u=n>=0;r.length<t;)r="0"+r;
    return(u?i?"+":"":"-")+r
    }
    function yt(n,i,r,u){
    var o=i._milliseconds,f=i._days,e=i._months;
    u=u==null?!0:u;
    o&&n._d.setTime(+n._d+o*r);
    f&&or(n,"Date",ti(n,"Date")+f*r);
    e&&er(n,ti(n,"Month")+e*r);
    u&&t.updateOffset(n,f||e)
    }
    function ft(n){
    return Object.prototype.toString.call(n)==="[object Array]"
    }
    function hu(n){
    return Object.prototype.toString.call(n)==="[object Date]"||n instanceof Date
    }
    function pi(n,t,r){
    for(var e=Math.min(n.length,t.length),o=Math.abs(n.length-t.length),f=0,u=0;u<e;u++)(r&&n[u]!==t[u]||!r&&i(n[u])!==i(t[u]))&&f++;
    return f+o
    }
    function a(n){
    if(n){
        var t=n.toLowerCase().replace(/(.)s$/,"$1");
        n=fu[n]||eu[t]||t
        }
        return n
    }
    function wi(n){
    var r={},t;
    for(var i in n)n.hasOwnProperty(i)&&(t=a(i),t&&(r[t]=n[i]));return r
    }
    function cu(i){
    var r,u;
    if(i.indexOf("week")===0)r=7,u="day";
    else if(i.indexOf("month")===0)r=12,u="month";else return;
    t[i]=function(f,e){
        var o,s,c=t.fn._lang[i],h=[];
        if(typeof f=="number"&&(e=f,f=n),s=function(n){
            var i=t().utc().set(u,n);
            return c.call(t.fn._lang,i,f||"")
            },e!=null)return s(e);
        for(o=0;o<r;o++)h.push(s(o));
        return h
        }
    }
function i(n){
    var t=+n,i=0;
    return t!==0&&isFinite(t)&&(i=t>=0?Math.floor(t):Math.ceil(t)),i
    }
    function pt(n,t){
    return new Date(Date.UTC(n,t+1,0)).getUTCDate()
    }
    function bi(n,i,r){
    return k(t([n,11,31+i-r]),i,r).week
    }
    function ki(n){
    return di(n)?366:365
    }
    function di(n){
    return n%4==0&&n%100!=0||n%400==0
    }
    function gi(n){
    var t;
    n._a&&n._pf.overflow===-2&&(t=n._a[s]<0||n._a[s]>11?s:n._a[e]<1||n._a[e]>pt(n._a[o],n._a[s])?e:n._a[h]<0||n._a[h]>23?h:n._a[nt]<0||n._a[nt]>59?nt:n._a[tt]<0||n._a[tt]>59?tt:n._a[it]<0||n._a[it]>999?it:-1,n._pf._overflowDayOfYear&&(t<o||t>e)&&(t=e),n._pf.overflow=t)
    }
    function nr(n){
    return n._isValid==null&&(n._isValid=!isNaN(n._d.getTime())&&n._pf.overflow<0&&!n._pf.empty&&!n._pf.invalidMonth&&!n._pf.nullInput&&!n._pf.invalidFormat&&!n._pf.userInvalidated,n._strict&&(n._isValid=n._isValid&&n._pf.charsLeftOver===0&&n._pf.unusedTokens.length===0)),n._isValid
    }
    function wt(n){
    return n?n.toLowerCase().replace("_","-"):n
    }
    function bt(n,i){
    return i._isUTC?t(n).zone(i._offset||0):t(n).local()
    }
    function lu(n,t){
    return t.abbr=n,y[n]||(y[n]=new yi),y[n].set(t),y[n]
    }
    function au(n){
    delete y[n]
}
function f(n){
    var f=0,r,u,i,e,o=function(n){
        if(!y[n]&&ui)try{
            require("./lang/"+n)
            }catch(t){}
            return y[n]
        };
        
    if(!n)return t.fn._lang;
    if(!ft(n)){
        if(u=o(n),u)return u;
        n=[n]
        }while(f<n.length){
        for(e=wt(n[f]).split("-"),r=e.length,i=wt(n[f+1]),i=i?i.split("-"):null;r>0;){
            if(u=o(e.slice(0,r).join("-")),u)return u;
            if(i&&i.length>=r&&pi(e,i,!0)>=r-1)break;
            r--
        }
        f++
    }
    return t.fn._lang
    }
    function vu(n){
    return n.match(/\[[\s\S]/)?n.replace(/^\[|\]$/g,""):n.replace(/\\/g,"")
    }
    function yu(n){
    for(var i=n.match(fi),t=0,r=i.length;t<r;t++)i[t]=c[i[t]]?c[i[t]]:vu(i[t]);
    return function(u){
        var f="";
        for(t=0;t<r;t++)f+=i[t]instanceof Function?i[t].call(u,n):i[t];
        return f
        }
    }
function kt(n,t){
    return n.isValid()?(t=tr(t,n.lang()),ct[t]||(ct[t]=yu(t)),ct[t](n)):n.lang().invalidDate()
    }
    function tr(n,t){
    function r(n){
        return t.longDateFormat(n)||n
        }
        var i=5;
    for(ut.lastIndex=0;i>=0&&ut.test(n);)n=n.replace(ut,r),ut.lastIndex=0,i-=1;
    return n
    }
    function pu(n,t){
    var i=t._strict;
    switch(n){
        case"Q":
            return oi;
        case"DDDD":
            return hi;
        case"YYYY":case"GGGG":case"gggg":
            return i?nu:yr;
        case"Y":case"G":case"g":
            return iu;
        case"YYYYYY":case"YYYYY":case"GGGGG":case"ggggg":
            return i?tu:pr;
        case"S":
            if(i)return oi;case"SS":
            if(i)return si;case"SSS":
            if(i)return hi;case"DDD":
            return vr;
        case"MMM":case"MMMM":case"dd":case"ddd":case"dddd":
            return br;
        case"a":case"A":
            return f(t._l)._meridiemParse;
        case"X":
            return dr;
        case"Z":case"ZZ":
            return et;
        case"T":
            return kr;
        case"SSSS":
            return wr;
        case"MM":case"DD":case"YY":case"GG":case"gg":case"HH":case"hh":case"mm":case"ss":case"ww":case"WW":
            return i?si:ei;
        case"M":case"D":case"d":case"H":case"h":case"m":case"s":case"w":case"W":case"e":case"E":
            return ei;
        case"Do":
            return gr;
        default:
            return new RegExp(nf(gu(n.replace("\\","")),"i"))
            }
        }
function ir(n){
    n=n||"";
    var r=n.match(et)||[],f=r[r.length-1]||[],t=(f+"").match(uu)||["-",0,0],u=+(t[1]*60)+i(t[2]);
    return t[0]==="+"?-u:u
    }
    function wu(n,r,u){
    var l,c=u._a;
    switch(n){
        case"Q":
            r!=null&&(c[s]=(i(r)-1)*3);
            break;
        case"M":case"MM":
            r!=null&&(c[s]=i(r)-1);
            break;
        case"MMM":case"MMMM":
            l=f(u._l).monthsParse(r);
            l!=null?c[s]=l:u._pf.invalidMonth=r;
            break;
        case"D":case"DD":
            r!=null&&(c[e]=i(r));
            break;
        case"Do":
            r!=null&&(c[e]=i(parseInt(r,10)));
            break;
        case"DDD":case"DDDD":
            r!=null&&(u._dayOfYear=i(r));
            break;
        case"YY":
            c[o]=t.parseTwoDigitYear(r);
            break;
        case"YYYY":case"YYYYY":case"YYYYYY":
            c[o]=i(r);
            break;
        case"a":case"A":
            u._isPm=f(u._l).isPM(r);
            break;
        case"H":case"HH":case"h":case"hh":
            c[h]=i(r);
            break;
        case"m":case"mm":
            c[nt]=i(r);
            break;
        case"s":case"ss":
            c[tt]=i(r);
            break;
        case"S":case"SS":case"SSS":case"SSSS":
            c[it]=i(("0."+r)*1e3);
            break;
        case"X":
            u._d=new Date(parseFloat(r)*1e3);
            break;
        case"Z":case"ZZ":
            u._useUTC=!0;
            u._tzm=ir(r);
            break;
        case"dd":case"ddd":case"dddd":
            l=f(u._l).weekdaysParse(r);
            l!=null?(u._w=u._w||{},u._w.d=l):u._pf.invalidWeekday=r;
            break;
        case"w":case"ww":case"W":case"WW":case"d":case"e":case"E":
            n=n.substr(0,1);
        case"gggg":case"GGGG":case"GGGGG":
            n=n.substr(0,2);
            r&&(u._w=u._w||{},u._w[n]=i(r));
            break;
        case"gg":case"GG":
            u._w=u._w||{};
            
            u._w[n]=t.parseTwoDigitYear(r)
            }
        }
function bu(n){
    var i,h,e,u,r,s,c,l;
    i=n._w;
    i.GG!=null||i.W!=null||i.E!=null?(r=1,s=4,h=d(i.GG,n._a[o],k(t(),1,4).year),e=d(i.W,1),u=d(i.E,1)):(l=f(n._l),r=l._week.dow,s=l._week.doy,h=d(i.gg,n._a[o],k(t(),r,s).year),e=d(i.w,1),i.d!=null?(u=i.d,u<r&&++e):u=i.e!=null?i.e+r:r);
    c=hf(h,e,u,s,r);
    n._a[o]=c.year;
    n._dayOfYear=c.dayOfYear
    }
    function dt(n){
    var t,i,r=[],u,f;
    if(!n._d){
        for(u=du(n),n._w&&n._a[e]==null&&n._a[s]==null&&bu(n),n._dayOfYear&&(f=d(n._a[o],u[o]),n._dayOfYear>ki(f)&&(n._pf._overflowDayOfYear=!0),i=ni(f,0,n._dayOfYear),n._a[s]=i.getUTCMonth(),n._a[e]=i.getUTCDate()),t=0;t<3&&n._a[t]==null;++t)n._a[t]=r[t]=u[t];
        for(;t<7;t++)n._a[t]=r[t]=n._a[t]==null?t===2?1:0:n._a[t];
        n._d=(n._useUTC?ni:ff).apply(null,r);
        n._tzm!=null&&n._d.setUTCMinutes(n._d.getUTCMinutes()+n._tzm)
        }
    }
function ku(n){
    var t;
    n._d||(t=wi(n._i),n._a=[t.year,t.month,t.day,t.hour,t.minute,t.second,t.millisecond],dt(n))
    }
    function du(n){
    var t=new Date;
    return n._useUTC?[t.getUTCFullYear(),t.getUTCMonth(),t.getUTCDate()]:[t.getFullYear(),t.getMonth(),t.getDate()]
    }
    function gt(n){
    if(n._f===t.ISO_8601){
        rr(n);
        return
    }
    n._a=[];
    n._pf.empty=!0;
    for(var a=f(n._l),i=""+n._i,r,u,s,v=i.length,l=0,o=tr(n._f,a).match(fi)||[],e=0;e<o.length;e++)u=o[e],r=(i.match(pu(u,n))||[])[0],r&&(s=i.substr(0,i.indexOf(r)),s.length>0&&n._pf.unusedInput.push(s),i=i.slice(i.indexOf(r)+r.length),l+=r.length),c[u]?(r?n._pf.empty=!1:n._pf.unusedTokens.push(u),wu(u,r,n)):n._strict&&!r&&n._pf.unusedTokens.push(u);
    n._pf.charsLeftOver=v-l;
    i.length>0&&n._pf.unusedInput.push(i);
    n._isPm&&n._a[h]<12&&(n._a[h]+=12);
    n._isPm===!1&&n._a[h]===12&&(n._a[h]=0);
    dt(n);
    gi(n)
    }
    function gu(n){
    return n.replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g,function(n,t,i,r,u){
        return t||i||r||u
        })
    }
    function nf(n){
    return n.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&")
    }
    function tf(n){
    var t,f,u,r,i;
    if(n._f.length===0){
        n._pf.invalidFormat=!0;
        n._d=new Date(NaN);
        return
    }
    for(r=0;r<n._f.length;r++)(i=0,t=l({},n),t._pf=lt(),t._f=n._f[r],gt(t),nr(t))&&(i+=t._pf.charsLeftOver,i+=t._pf.unusedTokens.length*10,t._pf.score=i,(u==null||i<u)&&(u=i,f=t));
    l(n,f||t)
    }
    function rr(n){
    var t,i,r=n._i,u=ru.exec(r);
    if(u){
        for(n._pf.iso=!0,t=0,i=ot.length;t<i;t++)if(ot[t][1].exec(r)){
            n._f=ot[t][0]+(u[6]||" ");
            break
        }
        for(t=0,i=st.length;t<i;t++)if(st[t][1].exec(r)){
            n._f+=st[t][0];
            break
        }
        r.match(et)&&(n._f+="Z");
        gt(n)
        }else n._isValid=!1
        }
        function rf(n){
    rr(n);
    n._isValid===!1&&(delete n._isValid,t.createFromInputFallback(n))
    }
    function uf(i){
    var r=i._i,u=cr.exec(r);
    r===n?i._d=new Date:u?i._d=new Date(+u[1]):typeof r=="string"?rf(i):ft(r)?(i._a=r.slice(0),dt(i)):hu(r)?i._d=new Date(+r):typeof r=="object"?ku(i):typeof r=="number"?i._d=new Date(r):t.createFromInputFallback(i)
    }
    function ff(n,t,i,r,u,f,e){
    var o=new Date(n,t,i,r,u,f,e);
    return n<1970&&o.setFullYear(n),o
    }
    function ni(n){
    var t=new Date(Date.UTC.apply(null,arguments));
    return n<1970&&t.setUTCFullYear(n),t
    }
    function ef(n,t){
    if(typeof n=="string")if(isNaN(n)){
        if(n=t.weekdaysParse(n),typeof n!="number")return null
            }else n=parseInt(n,10);
    return n
    }
    function of(n,t,i,r,u){
    return u.relativeTime(t||1,!!i,n,r)
    }
    function sf(n,t,i){
    var o=b(Math.abs(n)/1e3),u=b(o/60),f=b(u/60),r=b(f/24),s=b(r/365),e=o<p.s&&["s",o]||u===1&&["m"]||u<p.m&&["mm",u]||f===1&&["h"]||f<p.h&&["hh",f]||r===1&&["d"]||r<=p.dd&&["dd",r]||r<=p.dm&&["M"]||r<p.dy&&["MM",b(r/30)]||s===1&&["y"]||["yy",s];
    return e[2]=t,e[3]=n>0,e[4]=i,of.apply({},e)
    }
    function k(n,i,r){
    var e=r-i,u=r-n.day(),f;
    return u>e&&(u-=7),u<e-7&&(u+=7),f=t(n).add("d",u),{
        week:Math.ceil(f.dayOfYear()/7),
        year:f.year()
        }
    }
function hf(n,t,i,r,u){
    var f=ni(n,0,1).getUTCDay(),o,e;
    return f=f===0?7:f,i=i!=null?i:u,o=u-f+(f>r?7:0)-(f<u?7:0),e=7*(t-1)+(i-u)+o+1,{
        year:e>0?n:n-1,
        dayOfYear:e>0?e:ki(n-1)+e
        }
    }
function ur(i){
    var r=i._i,u=i._f;
    return r===null||u===n&&r===""?t.invalid({
        nullInput:!0
        }):(typeof r=="string"&&(i._i=r=f().preparse(r)),t.isMoment(r)?(i=su(r),i._d=new Date(+r._d)):u?ft(u)?tf(i):gt(i):uf(i),new at(i))
    }
    function fr(n,i){
    var u,r;
    if(i.length===1&&ft(i[0])&&(i=i[0]),!i.length)return t();
    for(u=i[0],r=1;r<i.length;++r)i[r][n](u)&&(u=i[r]);
    return u
    }
    function er(n,t){
    var i;
    return typeof t=="string"&&(t=n.lang().monthsParse(t),typeof t!="number")?n:(i=Math.min(n.date(),pt(n.year(),t)),n._d["set"+(n._isUTC?"UTC":"")+"Month"](t,i),n)
    }
    function ti(n,t){
    return n._d["get"+(n._isUTC?"UTC":"")+t]()
    }
    function or(n,t,i){
    return t==="Month"?er(n,i):n._d["set"+(n._isUTC?"UTC":"")+t](i)
    }
    function v(n,i){
    return function(r){
        return r!=null?(or(this,n,r),t.updateOffset(this,i),this):ti(this,n)
        }
    }
function cf(n){
    t.duration.fn[n]=function(){
        return this._data[n]
        }
    }
function sr(n,i){
    t.duration.fn["as"+n]=function(){
        return+this/i
        }
    }
function hr(n){
    typeof ender=="undefined"&&(ii=rt.moment,rt.moment=n?g("Accessing Moment through the global scope is deprecated, and will be removed in an upcoming release.",t):t)
    }
    for(var t,rt=typeof global!="undefined"?global:this,ii,b=Math.round,u,o=0,s=1,e=2,h=3,nt=4,tt=5,it=6,y={},ri={
    _isAMomentObject:null,
    _i:null,
    _f:null,
    _l:null,
    _strict:null,
    _tzm:null,
    _isUTC:null,
    _offset:null,
    _pf:null,
    _lang:null
},ui=typeof module!="undefined"&&module.exports,cr=/^\/?Date\((\-?\d+)/i,lr=/(\-)?(?:(\d*)\.)?(\d+)\:(\d+)(?:\:(\d+)\.?(\d{3})?)?/,ar=/^(-)?P(?:(?:([0-9,.]*)Y)?(?:([0-9,.]*)M)?(?:([0-9,.]*)D)?(?:T(?:([0-9,.]*)H)?(?:([0-9,.]*)M)?(?:([0-9,.]*)S)?)?|([0-9,.]*)W)$/,fi=/(\[[^\[]*\])|(\\)?(Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Q|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|mm?|ss?|S{1,4}|X|zz?|ZZ?|.)/g,ut=/(\[[^\[]*\])|(\\)?(LT|LL?L?L?|l{1,4})/g,ei=/\d\d?/,vr=/\d{1,3}/,yr=/\d{1,4}/,pr=/[+\-]?\d{1,6}/,wr=/\d+/,br=/[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i,et=/Z|[\+\-]\d\d:?\d\d/gi,kr=/T/i,dr=/[\+\-]?\d+(\.\d{1,3})?/,gr=/\d{1,2}/,oi=/\d/,si=/\d\d/,hi=/\d{3}/,nu=/\d{4}/,tu=/[+-]?\d{6}/,iu=/[+-]?\d+/,ru=/^\s*(?:[+-]\d{6}|\d{4})-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,ot=[["YYYYYY-MM-DD",/[+-]\d{6}-\d{2}-\d{2}/],["YYYY-MM-DD",/\d{4}-\d{2}-\d{2}/],["GGGG-[W]WW-E",/\d{4}-W\d{2}-\d/],["GGGG-[W]WW",/\d{4}-W\d{2}/],["YYYY-DDD",/\d{4}-\d{3}/]],st=[["HH:mm:ss.SSSS",/(T| )\d\d:\d\d:\d\d\.\d+/],["HH:mm:ss",/(T| )\d\d:\d\d:\d\d/],["HH:mm",/(T| )\d\d:\d\d/],["HH",/(T| )\d\d/]],uu=/([\+\-]|\d\d)/gi,lf="Date|Hours|Minutes|Seconds|Milliseconds".split("|"),ht={
    Milliseconds:1,
    Seconds:1e3,
    Minutes:6e4,
    Hours:36e5,
    Days:864e5,
    Months:2592e6,
    Years:31536e6
},fu={
    ms:"millisecond",
    s:"second",
    m:"minute",
    h:"hour",
    d:"day",
    D:"date",
    w:"week",
    W:"isoWeek",
    M:"month",
    Q:"quarter",
    y:"year",
    DDD:"dayOfYear",
    e:"weekday",
    E:"isoWeekday",
    gg:"weekYear",
    GG:"isoWeekYear"
},eu={
    dayofyear:"dayOfYear",
    isoweekday:"isoWeekday",
    isoweek:"isoWeek",
    weekyear:"weekYear",
    isoweekyear:"isoWeekYear"
},ct={},p={
    s:45,
    m:45,
    h:22,
    dd:25,
    dm:45,
    dy:345
},ci="DDD w W M D d".split(" "),li="M D H h m s w W".split(" "),c={
    M:function(){
        return this.month()+1
        },
    MMM:function(n){
        return this.lang().monthsShort(this,n)
        },
    MMMM:function(n){
        return this.lang().months(this,n)
        },
    D:function(){
        return this.date()
        },
    DDD:function(){
        return this.dayOfYear()
        },
    d:function(){
        return this.day()
        },
    dd:function(n){
        return this.lang().weekdaysMin(this,n)
        },
    ddd:function(n){
        return this.lang().weekdaysShort(this,n)
        },
    dddd:function(n){
        return this.lang().weekdays(this,n)
        },
    w:function(){
        return this.week()
        },
    W:function(){
        return this.isoWeek()
        },
    YY:function(){
        return r(this.year()%100,2)
        },
    YYYY:function(){
        return r(this.year(),4)
        },
    YYYYY:function(){
        return r(this.year(),5)
        },
    YYYYYY:function(){
        var n=this.year(),t=n>=0?"+":"-";
        return t+r(Math.abs(n),6)
        },
    gg:function(){
        return r(this.weekYear()%100,2)
        },
    gggg:function(){
        return r(this.weekYear(),4)
        },
    ggggg:function(){
        return r(this.weekYear(),5)
        },
    GG:function(){
        return r(this.isoWeekYear()%100,2)
        },
    GGGG:function(){
        return r(this.isoWeekYear(),4)
        },
    GGGGG:function(){
        return r(this.isoWeekYear(),5)
        },
    e:function(){
        return this.weekday()
        },
    E:function(){
        return this.isoWeekday()
        },
    a:function(){
        return this.lang().meridiem(this.hours(),this.minutes(),!0)
        },
    A:function(){
        return this.lang().meridiem(this.hours(),this.minutes(),!1)
        },
    H:function(){
        return this.hours()
        },
    h:function(){
        return this.hours()%12||12
        },
    m:function(){
        return this.minutes()
        },
    s:function(){
        return this.seconds()
        },
    S:function(){
        return i(this.milliseconds()/100)
        },
    SS:function(){
        return r(i(this.milliseconds()/10),2)
        },
    SSS:function(){
        return r(this.milliseconds(),3)
        },
    SSSS:function(){
        return r(this.milliseconds(),3)
        },
    Z:function(){
        var n=-this.zone(),t="+";
        return n<0&&(n=-n,t="-"),t+r(i(n/60),2)+":"+r(i(n)%60,2)
        },
    ZZ:function(){
        var n=-this.zone(),t="+";
        return n<0&&(n=-n,t="-"),t+r(i(n/60),2)+r(i(n)%60,2)
        },
    z:function(){
        return this.zoneAbbr()
        },
    zz:function(){
        return this.zoneName()
        },
    X:function(){
        return this.unix()
        },
    Q:function(){
        return this.quarter()
        }
    },ai=["months","monthsShort","weekdays","weekdaysShort","weekdaysMin"];ci.length;)u=ci.pop(),c[u+"o"]=ou(c[u],u);
while(li.length)u=li.pop(),c[u+u]=vi(c[u],2);
for(c.DDDD=vi(c.DDD,3),l(yi.prototype,{
    set:function(n){
        var t;
        for(var i in n)t=n[i],typeof t=="function"?this[i]=t:this["_"+i]=t
            },
    _months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
    months:function(n){
        return this._months[n.month()]
        },
    _monthsShort:"Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
    monthsShort:function(n){
        return this._monthsShort[n.month()]
        },
    monthsParse:function(n){
        var i,r,u;
        for(this._monthsParse||(this._monthsParse=[]),i=0;i<12;i++)if(this._monthsParse[i]||(r=t.utc([2e3,i]),u="^"+this.months(r,"")+"|^"+this.monthsShort(r,""),this._monthsParse[i]=new RegExp(u.replace(".",""),"i")),this._monthsParse[i].test(n))return i
            },
    _weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
    weekdays:function(n){
        return this._weekdays[n.day()]
        },
    _weekdaysShort:"Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
    weekdaysShort:function(n){
        return this._weekdaysShort[n.day()]
        },
    _weekdaysMin:"Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
    weekdaysMin:function(n){
        return this._weekdaysMin[n.day()]
        },
    weekdaysParse:function(n){
        var i,r,u;
        for(this._weekdaysParse||(this._weekdaysParse=[]),i=0;i<7;i++)if(this._weekdaysParse[i]||(r=t([2e3,1]).day(i),u="^"+this.weekdays(r,"")+"|^"+this.weekdaysShort(r,"")+"|^"+this.weekdaysMin(r,""),this._weekdaysParse[i]=new RegExp(u.replace(".",""),"i")),this._weekdaysParse[i].test(n))return i
            },
    _longDateFormat:{
        LT:"h:mm A",
        L:"MM/DD/YYYY",
        LL:"MMMM D YYYY",
        LLL:"MMMM D YYYY LT",
        LLLL:"dddd, MMMM D YYYY LT"
    },
    longDateFormat:function(n){
        var t=this._longDateFormat[n];
        return!t&&this._longDateFormat[n.toUpperCase()]&&(t=this._longDateFormat[n.toUpperCase()].replace(/MMMM|MM|DD|dddd/g,function(n){
            return n.slice(1)
            }),this._longDateFormat[n]=t),t
        },
    isPM:function(n){
        return(n+"").toLowerCase().charAt(0)==="p"
        },
    _meridiemParse:/[ap]\.?m?\.?/i,
    meridiem:function(n,t,i){
        return n>11?i?"pm":"PM":i?"am":"AM"
        },
    _calendar:{
        sameDay:"[Today at] LT",
        nextDay:"[Tomorrow at] LT",
        nextWeek:"dddd [at] LT",
        lastDay:"[Yesterday at] LT",
        lastWeek:"[Last] dddd [at] LT",
        sameElse:"L"
    },
    calendar:function(n,t){
        var i=this._calendar[n];
        return typeof i=="function"?i.apply(t):i
        },
    _relativeTime:{
        future:"in %s",
        past:"%s ago",
        s:"a few seconds",
        m:"a minute",
        mm:"%d minutes",
        h:"an hour",
        hh:"%d hours",
        d:"a day",
        dd:"%d days",
        M:"a month",
        MM:"%d months",
        y:"a year",
        yy:"%d years"
    },
    relativeTime:function(n,t,i,r){
        var u=this._relativeTime[i];
        return typeof u=="function"?u(n,t,i,r):u.replace(/%d/i,n)
        },
    pastFuture:function(n,t){
        var i=this._relativeTime[n>0?"future":"past"];
        return typeof i=="function"?i(t):i.replace(/%s/i,t)
        },
    ordinal:function(n){
        return this._ordinal.replace("%d",n)
        },
    _ordinal:"%d",
    preparse:function(n){
        return n
        },
    postformat:function(n){
        return n
        },
    week:function(n){
        return k(n,this._week.dow,this._week.doy).week
        },
    _week:{
        dow:0,
        doy:6
    },
    _invalidDate:"Invalid date",
    invalidDate:function(){
        return this._invalidDate
        }
    }),t=function(t,i,r,u){
    var f;
    return typeof r=="boolean"&&(u=r,r=n),f={},f._isAMomentObject=!0,f._i=t,f._f=i,f._l=r,f._strict=u,f._isUTC=!1,f._pf=lt(),ur(f)
    },t.suppressDeprecationWarnings=!1,t.createFromInputFallback=g("moment construction falls back to js Date. This is discouraged and will be removed in upcoming major release. Please refer to https://github.com/moment/moment/issues/1407 for more info.",function(n){
    n._d=new Date(n._i)
    }),t.min=function(){
    var n=[].slice.call(arguments,0);
    return fr("isBefore",n)
    },t.max=function(){
    var n=[].slice.call(arguments,0);
    return fr("isAfter",n)
    },t.utc=function(t,i,r,u){
    var f;
    return typeof r=="boolean"&&(u=r,r=n),f={},f._isAMomentObject=!0,f._useUTC=!0,f._isUTC=!0,f._l=r,f._i=t,f._f=i,f._strict=u,f._pf=lt(),ur(f).utc()
    },t.unix=function(n){
    return t(n*1e3)
    },t.duration=function(n,r){
    var s=n,u=null,f,c,o;
    return t.isDuration(n)?s={
        ms:n._milliseconds,
        d:n._days,
        M:n._months
        }:typeof n=="number"?(s={},r?s[r]=n:s.milliseconds=n):(u=lr.exec(n))?(f=u[1]==="-"?-1:1,s={
        y:0,
        d:i(u[e])*f,
        h:i(u[h])*f,
        m:i(u[nt])*f,
        s:i(u[tt])*f,
        ms:i(u[it])*f
        }):!(u=ar.exec(n))||(f=u[1]==="-"?-1:1,o=function(n){
        var t=n&&parseFloat(n.replace(",","."));
        return(isNaN(t)?0:t)*f
        },s={
        y:o(u[2]),
        M:o(u[3]),
        d:o(u[4]),
        h:o(u[5]),
        m:o(u[6]),
        s:o(u[7]),
        w:o(u[8])
        }),c=new vt(s),t.isDuration(n)&&n.hasOwnProperty("_lang")&&(c._lang=n._lang),c
    },t.version="2.7.0",t.defaultFormat="YYYY-MM-DDTHH:mm:ssZ",t.ISO_8601=function(){},t.momentProperties=ri,t.updateOffset=function(){},t.relativeTimeThreshold=function(t,i){
    return p[t]===n?!1:(p[t]=i,!0)
    },t.lang=function(n,i){
    var r;
    return n?(i?lu(wt(n),i):i===null?(au(n),n="en"):y[n]||f(n),r=t.duration.fn._lang=t.fn._lang=f(n),r._abbr):t.fn._lang._abbr
    },t.langData=function(n){
    return n&&n._lang&&n._lang._abbr&&(n=n._lang._abbr),f(n)
    },t.isMoment=function(n){
    return n instanceof at||n!=null&&n.hasOwnProperty("_isAMomentObject")
    },t.isDuration=function(n){
    return n instanceof vt
    },u=ai.length-1;u>=0;--u)cu(ai[u]);
t.normalizeUnits=function(n){
    return a(n)
    };
    
t.invalid=function(n){
    var i=t.utc(NaN);
    return n!=null?l(i._pf,n):i._pf.userInvalidated=!0,i
    };
    
t.parseZone=function(){
    return t.apply(null,arguments).parseZone()
    };
    
t.parseTwoDigitYear=function(n){
    return i(n)+(i(n)>68?1900:2e3)
    };
    
l(t.fn=at.prototype,{
    clone:function(){
        return t(this)
        },
    valueOf:function(){
        return+this._d+(this._offset||0)*6e4
        },
    unix:function(){
        return Math.floor(+this/1e3)
        },
    toString:function(){
        return this.clone().lang("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")
        },
    toDate:function(){
        return this._offset?new Date(+this):this._d
        },
    toISOString:function(){
        var n=t(this).utc();
        return 0<n.year()&&n.year()<=9999?kt(n,"YYYY-MM-DD[T]HH:mm:ss.SSS[Z]"):kt(n,"YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]")
        },
    toArray:function(){
        var n=this;
        return[n.year(),n.month(),n.date(),n.hours(),n.minutes(),n.seconds(),n.milliseconds()]
        },
    isValid:function(){
        return nr(this)
        },
    isDSTShifted:function(){
        return this._a?this.isValid()&&pi(this._a,(this._isUTC?t.utc(this._a):t(this._a)).toArray())>0:!1
        },
    parsingFlags:function(){
        return l({},this._pf)
        },
    invalidAt:function(){
        return this._pf.overflow
        },
    utc:function(){
        return this.zone(0)
        },
    local:function(){
        return this.zone(0),this._isUTC=!1,this
        },
    format:function(n){
        var i=kt(this,n||t.defaultFormat);
        return this.lang().postformat(i)
        },
    add:function(n,i){
        var r;
        return r=typeof n=="string"&&typeof i=="string"?t.duration(isNaN(+i)?+n:+i,isNaN(+i)?i:n):typeof n=="string"?t.duration(+i,n):t.duration(n,i),yt(this,r,1),this
        },
    subtract:function(n,i){
        var r;
        return r=typeof n=="string"&&typeof i=="string"?t.duration(isNaN(+i)?+n:+i,isNaN(+i)?i:n):typeof n=="string"?t.duration(+i,n):t.duration(n,i),yt(this,r,-1),this
        },
    diff:function(n,i,r){
        var f=bt(n,this),o=(this.zone()-f.zone())*6e4,u,e;
        return i=a(i),i==="year"||i==="month"?(u=(this.daysInMonth()+f.daysInMonth())*432e5,e=(this.year()-f.year())*12+(this.month()-f.month()),e+=(this-t(this).startOf("month")-(f-t(f).startOf("month")))/u,e-=(this.zone()-t(this).startOf("month").zone()-(f.zone()-t(f).startOf("month").zone()))*6e4/u,i==="year"&&(e=e/12)):(u=this-f,e=i==="second"?u/1e3:i==="minute"?u/6e4:i==="hour"?u/36e5:i==="day"?(u-o)/864e5:i==="week"?(u-o)/6048e5:u),r?e:w(e)
        },
    from:function(n,i){
        return t.duration(this.diff(n)).lang(this.lang()._abbr).humanize(!i)
        },
    fromNow:function(n){
        return this.from(t(),n)
        },
    calendar:function(n){
        var r=n||t(),u=bt(r,this).startOf("day"),i=this.diff(u,"days",!0),f=i<-6?"sameElse":i<-1?"lastWeek":i<0?"lastDay":i<1?"sameDay":i<2?"nextDay":i<7?"nextWeek":"sameElse";
        return this.format(this.lang().calendar(f,this))
        },
    isLeapYear:function(){
        return di(this.year())
        },
    isDST:function(){
        return this.zone()<this.clone().month(0).zone()||this.zone()<this.clone().month(5).zone()
        },
    day:function(n){
        var t=this._isUTC?this._d.getUTCDay():this._d.getDay();
        return n!=null?(n=ef(n,this.lang()),this.add({
            d:n-t
            })):t
        },
    month:v("Month",!0),
    startOf:function(n){
        n=a(n);
        switch(n){
            case"year":
                this.month(0);
            case"quarter":case"month":
                this.date(1);
            case"week":case"isoWeek":case"day":
                this.hours(0);
            case"hour":
                this.minutes(0);
            case"minute":
                this.seconds(0);
            case"second":
                this.milliseconds(0)
                }
                return n==="week"?this.weekday(0):n==="isoWeek"&&this.isoWeekday(1),n==="quarter"&&this.month(Math.floor(this.month()/3)*3),this
        },
    endOf:function(n){
        return n=a(n),this.startOf(n).add(n==="isoWeek"?"week":n,1).subtract("ms",1)
        },
    isAfter:function(n,i){
        return i=typeof i!="undefined"?i:"millisecond",+this.clone().startOf(i)>+t(n).startOf(i)
        },
    isBefore:function(n,i){
        return i=typeof i!="undefined"?i:"millisecond",+this.clone().startOf(i)<+t(n).startOf(i)
        },
    isSame:function(n,t){
        return t=t||"ms",+this.clone().startOf(t)==+bt(n,this).startOf(t)
        },
    min:g("moment().min is deprecated, use moment.min instead. https://github.com/moment/moment/issues/1548",function(n){
        return n=t.apply(null,arguments),n<this?this:n
        }),
    max:g("moment().max is deprecated, use moment.max instead. https://github.com/moment/moment/issues/1548",function(n){
        return n=t.apply(null,arguments),n>this?this:n
        }),
    zone:function(n,i){
        var r=this._offset||0;
        if(n!=null)typeof n=="string"&&(n=ir(n)),Math.abs(n)<16&&(n=n*60),this._offset=n,this._isUTC=!0,r!==n&&(!i||this._changeInProgress?yt(this,t.duration(r-n,"m"),1,!1):this._changeInProgress||(this._changeInProgress=!0,t.updateOffset(this,!0),this._changeInProgress=null));else return this._isUTC?r:this._d.getTimezoneOffset();
        return this
        },
    zoneAbbr:function(){
        return this._isUTC?"UTC":""
        },
    zoneName:function(){
        return this._isUTC?"Coordinated Universal Time":""
        },
    parseZone:function(){
        return this._tzm?this.zone(this._tzm):typeof this._i=="string"&&this.zone(this._i),this
        },
    hasAlignedHourOffset:function(n){
        return n=n?t(n).zone():0,(this.zone()-n)%60==0
        },
    daysInMonth:function(){
        return pt(this.year(),this.month())
        },
    dayOfYear:function(n){
        var i=b((t(this).startOf("day")-t(this).startOf("year"))/864e5)+1;
        return n==null?i:this.add("d",n-i)
        },
    quarter:function(n){
        return n==null?Math.ceil((this.month()+1)/3):this.month((n-1)*3+this.month()%3)
        },
    weekYear:function(n){
        var t=k(this,this.lang()._week.dow,this.lang()._week.doy).year;
        return n==null?t:this.add("y",n-t)
        },
    isoWeekYear:function(n){
        var t=k(this,1,4).year;
        return n==null?t:this.add("y",n-t)
        },
    week:function(n){
        var t=this.lang().week(this);
        return n==null?t:this.add("d",(n-t)*7)
        },
    isoWeek:function(n){
        var t=k(this,1,4).week;
        return n==null?t:this.add("d",(n-t)*7)
        },
    weekday:function(n){
        var t=(this.day()+7-this.lang()._week.dow)%7;
        return n==null?t:this.add("d",n-t)
        },
    isoWeekday:function(n){
        return n==null?this.day()||7:this.day(this.day()%7?n:n-7)
        },
    isoWeeksInYear:function(){
        return bi(this.year(),1,4)
        },
    weeksInYear:function(){
        var n=this._lang._week;
        return bi(this.year(),n.dow,n.doy)
        },
    get:function(n){
        return n=a(n),this[n]()
        },
    set:function(n,t){
        return n=a(n),typeof this[n]=="function"&&this[n](t),this
        },
    lang:function(t){
        return t===n?this._lang:(this._lang=f(t),this)
        }
    });
t.fn.millisecond=t.fn.milliseconds=v("Milliseconds",!1);
t.fn.second=t.fn.seconds=v("Seconds",!1);
t.fn.minute=t.fn.minutes=v("Minutes",!1);
t.fn.hour=t.fn.hours=v("Hours",!0);
t.fn.date=v("Date",!0);
t.fn.dates=g("dates accessor is deprecated. Use date instead.",v("Date",!0));
t.fn.year=v("FullYear",!0);
t.fn.years=g("years accessor is deprecated. Use year instead.",v("FullYear",!0));
t.fn.days=t.fn.day;
t.fn.months=t.fn.month;
t.fn.weeks=t.fn.week;
t.fn.isoWeeks=t.fn.isoWeek;
t.fn.quarters=t.fn.quarter;
t.fn.toJSON=t.fn.toISOString;
l(t.duration.fn=vt.prototype,{
    _bubble:function(){
        var e=this._milliseconds,t=this._days,i=this._months,n=this._data,r,u,f,o;
        n.milliseconds=e%1e3;
        r=w(e/1e3);
        n.seconds=r%60;
        u=w(r/60);
        n.minutes=u%60;
        f=w(u/60);
        n.hours=f%24;
        t+=w(f/24);
        n.days=t%30;
        i+=w(t/30);
        n.months=i%12;
        o=w(i/12);
        n.years=o
        },
    weeks:function(){
        return w(this.days()/7)
        },
    valueOf:function(){
        return this._milliseconds+this._days*864e5+this._months%12*2592e6+i(this._months/12)*31536e6
        },
    humanize:function(n){
        var i=+this,t=sf(i,!n,this.lang());
        return n&&(t=this.lang().pastFuture(i,t)),this.lang().postformat(t)
        },
    add:function(n,i){
        var r=t.duration(n,i);
        return this._milliseconds+=r._milliseconds,this._days+=r._days,this._months+=r._months,this._bubble(),this
        },
    subtract:function(n,i){
        var r=t.duration(n,i);
        return this._milliseconds-=r._milliseconds,this._days-=r._days,this._months-=r._months,this._bubble(),this
        },
    get:function(n){
        return n=a(n),this[n.toLowerCase()+"s"]()
        },
    as:function(n){
        return n=a(n),this["as"+n.charAt(0).toUpperCase()+n.slice(1)+"s"]()
        },
    lang:t.fn.lang,
    toIsoString:function(){
        var r=Math.abs(this.years()),u=Math.abs(this.months()),f=Math.abs(this.days()),n=Math.abs(this.hours()),t=Math.abs(this.minutes()),i=Math.abs(this.seconds()+this.milliseconds()/1e3);
        return this.asSeconds()?(this.asSeconds()<0?"-":"")+"P"+(r?r+"Y":"")+(u?u+"M":"")+(f?f+"D":"")+(n||t||i?"T":"")+(n?n+"H":"")+(t?t+"M":"")+(i?i+"S":""):"P0D"
        }
    });
for(u in ht)ht.hasOwnProperty(u)&&(sr(u,ht[u]),cf(u.toLowerCase()));sr("Weeks",6048e5);
t.duration.fn.asMonths=function(){
    return(+this-this.years()*31536e6)/2592e6+this.years()*12
    };
    
t.lang("en",{
    ordinal:function(n){
        var t=n%10,r=i(n%100/10)===1?"th":t===1?"st":t===2?"nd":t===3?"rd":"th";
        return n+r
        }
    }),function(n){
    n(t)
    }(function(n){
    return n.lang("ar-ma",{
        months:"يناير_فبراير_مارس_أبريل_ماي_يونيو_يوليوز_غشت_شتنبر_أكتوبر_نونبر_دجنبر".split("_"),
        monthsShort:"يناير_فبراير_مارس_أبريل_ماي_يونيو_يوليوز_غشت_شتنبر_أكتوبر_نونبر_دجنبر".split("_"),
        weekdays:"الأحد_الإتنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
        weekdaysShort:"احد_اتنين_ثلاثاء_اربعاء_خميس_جمعة_سبت".split("_"),
        weekdaysMin:"ح_ن_ث_ر_خ_ج_س".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[اليوم على الساعة] LT",
            nextDay:"[غدا على الساعة] LT",
            nextWeek:"dddd [على الساعة] LT",
            lastDay:"[أمس على الساعة] LT",
            lastWeek:"dddd [على الساعة] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"في %s",
            past:"منذ %s",
            s:"ثوان",
            m:"دقيقة",
            mm:"%d دقائق",
            h:"ساعة",
            hh:"%d ساعات",
            d:"يوم",
            dd:"%d أيام",
            M:"شهر",
            MM:"%d أشهر",
            y:"سنة",
            yy:"%d سنوات"
        },
        week:{
            dow:6,
            doy:12
        }
    })
}),function(n){
    n(t)
    }(function(n){
    var t={
        "1":"١",
        "2":"٢",
        "3":"٣",
        "4":"٤",
        "5":"٥",
        "6":"٦",
        "7":"٧",
        "8":"٨",
        "9":"٩",
        "0":"٠"
    },i={
        "١":"1",
        "٢":"2",
        "٣":"3",
        "٤":"4",
        "٥":"5",
        "٦":"6",
        "٧":"7",
        "٨":"8",
        "٩":"9",
        "٠":"0"
    };
    
    return n.lang("ar-sa",{
        months:"يناير_فبراير_مارس_أبريل_مايو_يونيو_يوليو_أغسطس_سبتمبر_أكتوبر_نوفمبر_ديسمبر".split("_"),
        monthsShort:"يناير_فبراير_مارس_أبريل_مايو_يونيو_يوليو_أغسطس_سبتمبر_أكتوبر_نوفمبر_ديسمبر".split("_"),
        weekdays:"الأحد_الإثنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
        weekdaysShort:"أحد_إثنين_ثلاثاء_أربعاء_خميس_جمعة_سبت".split("_"),
        weekdaysMin:"ح_ن_ث_ر_خ_ج_س".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        meridiem:function(n){
            return n<12?"ص":"م"
            },
        calendar:{
            sameDay:"[اليوم على الساعة] LT",
            nextDay:"[غدا على الساعة] LT",
            nextWeek:"dddd [على الساعة] LT",
            lastDay:"[أمس على الساعة] LT",
            lastWeek:"dddd [على الساعة] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"في %s",
            past:"منذ %s",
            s:"ثوان",
            m:"دقيقة",
            mm:"%d دقائق",
            h:"ساعة",
            hh:"%d ساعات",
            d:"يوم",
            dd:"%d أيام",
            M:"شهر",
            MM:"%d أشهر",
            y:"سنة",
            yy:"%d سنوات"
        },
        preparse:function(n){
            return n.replace(/[۰-۹]/g,function(n){
                return i[n]
                }).replace(/،/g,",")
            },
        postformat:function(n){
            return n.replace(/\d/g,function(n){
                return t[n]
                }).replace(/,/g,"،")
            },
        week:{
            dow:6,
            doy:12
        }
    })
}),function(n){
    n(t)
    }(function(n){
    var t={
        "1":"١",
        "2":"٢",
        "3":"٣",
        "4":"٤",
        "5":"٥",
        "6":"٦",
        "7":"٧",
        "8":"٨",
        "9":"٩",
        "0":"٠"
    },i={
        "١":"1",
        "٢":"2",
        "٣":"3",
        "٤":"4",
        "٥":"5",
        "٦":"6",
        "٧":"7",
        "٨":"8",
        "٩":"9",
        "٠":"0"
    };
    
    return n.lang("ar",{
        months:"يناير/ كانون الثاني_فبراير/ شباط_مارس/ آذار_أبريل/ نيسان_مايو/ أيار_يونيو/ حزيران_يوليو/ تموز_أغسطس/ آب_سبتمبر/ أيلول_أكتوبر/ تشرين الأول_نوفمبر/ تشرين الثاني_ديسمبر/ كانون الأول".split("_"),
        monthsShort:"يناير/ كانون الثاني_فبراير/ شباط_مارس/ آذار_أبريل/ نيسان_مايو/ أيار_يونيو/ حزيران_يوليو/ تموز_أغسطس/ آب_سبتمبر/ أيلول_أكتوبر/ تشرين الأول_نوفمبر/ تشرين الثاني_ديسمبر/ كانون الأول".split("_"),
        weekdays:"الأحد_الإثنين_الثلاثاء_الأربعاء_الخميس_الجمعة_السبت".split("_"),
        weekdaysShort:"أحد_إثنين_ثلاثاء_أربعاء_خميس_جمعة_سبت".split("_"),
        weekdaysMin:"ح_ن_ث_ر_خ_ج_س".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        meridiem:function(n){
            return n<12?"ص":"م"
            },
        calendar:{
            sameDay:"[اليوم على الساعة] LT",
            nextDay:"[غدا على الساعة] LT",
            nextWeek:"dddd [على الساعة] LT",
            lastDay:"[أمس على الساعة] LT",
            lastWeek:"dddd [على الساعة] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"في %s",
            past:"منذ %s",
            s:"ثوان",
            m:"دقيقة",
            mm:"%d دقائق",
            h:"ساعة",
            hh:"%d ساعات",
            d:"يوم",
            dd:"%d أيام",
            M:"شهر",
            MM:"%d أشهر",
            y:"سنة",
            yy:"%d سنوات"
        },
        preparse:function(n){
            return n.replace(/[۰-۹]/g,function(n){
                return i[n]
                }).replace(/،/g,",")
            },
        postformat:function(n){
            return n.replace(/\d/g,function(n){
                return t[n]
                }).replace(/,/g,"،")
            },
        week:{
            dow:6,
            doy:12
        }
    })
}),function(n){
    n(t)
    }(function(n){
    var t={
        1:"-inci",
        5:"-inci",
        8:"-inci",
        70:"-inci",
        80:"-inci",
        2:"-nci",
        7:"-nci",
        20:"-nci",
        50:"-nci",
        3:"-üncü",
        4:"-üncü",
        100:"-üncü",
        6:"-ncı",
        9:"-uncu",
        10:"-uncu",
        30:"-uncu",
        60:"-ıncı",
        90:"-ıncı"
    };
    
    return n.lang("az",{
        months:"yanvar_fevral_mart_aprel_may_iyun_iyul_avqust_sentyabr_oktyabr_noyabr_dekabr".split("_"),
        monthsShort:"yan_fev_mar_apr_may_iyn_iyl_avq_sen_okt_noy_dek".split("_"),
        weekdays:"Bazar_Bazar ertəsi_Çərşənbə axşamı_Çərşənbə_Cümə axşamı_Cümə_Şənbə".split("_"),
        weekdaysShort:"Baz_BzE_ÇAx_Çər_CAx_Cüm_Şən".split("_"),
        weekdaysMin:"Bz_BE_ÇA_Çə_CA_Cü_Şə".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD.MM.YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[bugün saat] LT",
            nextDay:"[sabah saat] LT",
            nextWeek:"[gələn həftə] dddd [saat] LT",
            lastDay:"[dünən] LT",
            lastWeek:"[keçən həftə] dddd [saat] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s sonra",
            past:"%s əvvəl",
            s:"birneçə saniyyə",
            m:"bir dəqiqə",
            mm:"%d dəqiqə",
            h:"bir saat",
            hh:"%d saat",
            d:"bir gün",
            dd:"%d gün",
            M:"bir ay",
            MM:"%d ay",
            y:"bir il",
            yy:"%d il"
        },
        meridiem:function(n){
            return n<4?"gecə":n<12?"səhər":n<17?"gündüz":"axşam"
            },
        ordinal:function(n){
            if(n===0)return n+"-ıncı";
            var i=n%10,r=n%100-i,u=n>=100?100:null;
            return n+(t[i]||t[r]||t[u])
            },
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("bg",{
        months:"януари_февруари_март_април_май_юни_юли_август_септември_октомври_ноември_декември".split("_"),
        monthsShort:"янр_фев_мар_апр_май_юни_юли_авг_сеп_окт_ное_дек".split("_"),
        weekdays:"неделя_понеделник_вторник_сряда_четвъртък_петък_събота".split("_"),
        weekdaysShort:"нед_пон_вто_сря_чет_пет_съб".split("_"),
        weekdaysMin:"нд_пн_вт_ср_чт_пт_сб".split("_"),
        longDateFormat:{
            LT:"H:mm",
            L:"D.MM.YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Днес в] LT",
            nextDay:"[Утре в] LT",
            nextWeek:"dddd [в] LT",
            lastDay:"[Вчера в] LT",
            lastWeek:function(){
                switch(this.day()){
                    case 0:case 3:case 6:
                        return"[В изминалата] dddd [в] LT";
                    case 1:case 2:case 4:case 5:
                        return"[В изминалия] dddd [в] LT"
                        }
                    },
        sameElse:"L"
    },
    relativeTime:{
        future:"след %s",
        past:"преди %s",
        s:"няколко секунди",
        m:"минута",
        mm:"%d минути",
        h:"час",
        hh:"%d часа",
        d:"ден",
        dd:"%d дни",
        M:"месец",
        MM:"%d месеца",
        y:"година",
        yy:"%d години"
    },
    ordinal:function(n){
        var t=n%10,i=n%100;
        return n===0?n+"-ев":i===0?n+"-ен":i>10&&i<20?n+"-ти":t===1?n+"-ви":t===2?n+"-ри":t===7||t===8?n+"-ми":n+"-ти"
        },
    week:{
        dow:1,
        doy:7
    }
    })
}),function(n){
    n(t)
    }(function(n){
    var t={
        "1":"১",
        "2":"২",
        "3":"৩",
        "4":"৪",
        "5":"৫",
        "6":"৬",
        "7":"৭",
        "8":"৮",
        "9":"৯",
        "0":"০"
    },i={
        "১":"1",
        "২":"2",
        "৩":"3",
        "৪":"4",
        "৫":"5",
        "৬":"6",
        "৭":"7",
        "৮":"8",
        "৯":"9",
        "০":"0"
    };
    
    return n.lang("bn",{
        months:"জানুয়ারী_ফেবুয়ারী_মার্চ_এপ্রিল_মে_জুন_জুলাই_অগাস্ট_সেপ্টেম্বর_অক্টোবর_নভেম্বর_ডিসেম্বর".split("_"),
        monthsShort:"জানু_ফেব_মার্চ_এপর_মে_জুন_জুল_অগ_সেপ্ট_অক্টো_নভ_ডিসেম্".split("_"),
        weekdays:"রবিবার_সোমবার_মঙ্গলবার_বুধবার_বৃহস্পত্তিবার_শুক্রুবার_শনিবার".split("_"),
        weekdaysShort:"রবি_সোম_মঙ্গল_বুধ_বৃহস্পত্তি_শুক্রু_শনি".split("_"),
        weekdaysMin:"রব_সম_মঙ্গ_বু_ব্রিহ_শু_শনি".split("_"),
        longDateFormat:{
            LT:"A h:mm সময়",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY, LT",
            LLLL:"dddd, D MMMM YYYY, LT"
        },
        calendar:{
            sameDay:"[আজ] LT",
            nextDay:"[আগামীকাল] LT",
            nextWeek:"dddd, LT",
            lastDay:"[গতকাল] LT",
            lastWeek:"[গত] dddd, LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s পরে",
            past:"%s আগে",
            s:"কএক সেকেন্ড",
            m:"এক মিনিট",
            mm:"%d মিনিট",
            h:"এক ঘন্টা",
            hh:"%d ঘন্টা",
            d:"এক দিন",
            dd:"%d দিন",
            M:"এক মাস",
            MM:"%d মাস",
            y:"এক বছর",
            yy:"%d বছর"
        },
        preparse:function(n){
            return n.replace(/[১২৩৪৫৬৭৮৯০]/g,function(n){
                return i[n]
                })
            },
        postformat:function(n){
            return n.replace(/\d/g,function(n){
                return t[n]
                })
            },
        meridiem:function(n){
            return n<4?"রাত":n<10?"শকাল":n<17?"দুপুর":n<20?"বিকেল":"রাত"
            },
        week:{
            dow:0,
            doy:6
        }
    })
}),function(n){
    n(t)
    }(function(t){
    function i(n,t,i){
        return n+" "+f({
            mm:"munutenn",
            MM:"miz",
            dd:"devezh"
        }
        [i],n)
        }
        function u(n){
        switch(r(n)){
            case 1:case 3:case 4:case 5:case 9:
                return n+" bloaz";
            default:
                return n+" vloaz"
                }
            }
    function r(n){
    return n>9?r(n%10):n
    }
    function f(n,t){
    return t===2?e(n):n
    }
    function e(t){
    var i={
        m:"v",
        b:"v",
        d:"z"
    };
    
    return i[t.charAt(0)]===n?t:i[t.charAt(0)]+t.substring(1)
    }
    return t.lang("br",{
    months:"Genver_C'hwevrer_Meurzh_Ebrel_Mae_Mezheven_Gouere_Eost_Gwengolo_Here_Du_Kerzu".split("_"),
    monthsShort:"Gen_C'hwe_Meu_Ebr_Mae_Eve_Gou_Eos_Gwe_Her_Du_Ker".split("_"),
    weekdays:"Sul_Lun_Meurzh_Merc'her_Yaou_Gwener_Sadorn".split("_"),
    weekdaysShort:"Sul_Lun_Meu_Mer_Yao_Gwe_Sad".split("_"),
    weekdaysMin:"Su_Lu_Me_Mer_Ya_Gw_Sa".split("_"),
    longDateFormat:{
        LT:"h[e]mm A",
        L:"DD/MM/YYYY",
        LL:"D [a viz] MMMM YYYY",
        LLL:"D [a viz] MMMM YYYY LT",
        LLLL:"dddd, D [a viz] MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[Hiziv da] LT",
        nextDay:"[Warc'hoazh da] LT",
        nextWeek:"dddd [da] LT",
        lastDay:"[Dec'h da] LT",
        lastWeek:"dddd [paset da] LT",
        sameElse:"L"
    },
    relativeTime:{
        future:"a-benn %s",
        past:"%s 'zo",
        s:"un nebeud segondennoù",
        m:"ur vunutenn",
        mm:i,
        h:"un eur",
        hh:"%d eur",
        d:"un devezh",
        dd:i,
        M:"ur miz",
        MM:i,
        y:"ur bloaz",
        yy:u
    },
    ordinal:function(n){
        var t=n===1?"añ":"vet";
        return n+t
        },
    week:{
        dow:1,
        doy:4
    }
})
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i){
        var r=n+" ";
        switch(i){
            case"m":
                return t?"jedna minuta":"jedne minute";
            case"mm":
                return r+(n===1?"minuta":n===2||n===3||n===4?"minute":"minuta");
            case"h":
                return t?"jedan sat":"jednog sata";
            case"hh":
                return r+(n===1?"sat":n===2||n===3||n===4?"sata":"sati");
            case"dd":
                return r+(n===1?"dan":"dana");
            case"MM":
                return r+(n===1?"mjesec":n===2||n===3||n===4?"mjeseca":"mjeseci");
            case"yy":
                return r+(n===1?"godina":n===2||n===3||n===4?"godine":"godina")
                }
            }
    return n.lang("bs",{
    months:"januar_februar_mart_april_maj_juni_juli_avgust_septembar_oktobar_novembar_decembar".split("_"),
    monthsShort:"jan._feb._mar._apr._maj._jun._jul._avg._sep._okt._nov._dec.".split("_"),
    weekdays:"nedjelja_ponedjeljak_utorak_srijeda_četvrtak_petak_subota".split("_"),
    weekdaysShort:"ned._pon._uto._sri._čet._pet._sub.".split("_"),
    weekdaysMin:"ne_po_ut_sr_če_pe_su".split("_"),
    longDateFormat:{
        LT:"H:mm",
        L:"DD. MM. YYYY",
        LL:"D. MMMM YYYY",
        LLL:"D. MMMM YYYY LT",
        LLLL:"dddd, D. MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[danas u] LT",
        nextDay:"[sutra u] LT",
        nextWeek:function(){
            switch(this.day()){
                case 0:
                    return"[u] [nedjelju] [u] LT";
                case 3:
                    return"[u] [srijedu] [u] LT";
                case 6:
                    return"[u] [subotu] [u] LT";
                case 1:case 2:case 4:case 5:
                    return"[u] dddd [u] LT"
                    }
                },
    lastDay:"[jučer u] LT",
    lastWeek:function(){
        switch(this.day()){
            case 0:case 3:
                return"[prošlu] dddd [u] LT";
            case 6:
                return"[prošle] [subote] [u] LT";
            case 1:case 2:case 4:case 5:
                return"[prošli] dddd [u] LT"
                }
            },
sameElse:"L"
},
relativeTime:{
    future:"za %s",
    past:"prije %s",
    s:"par sekundi",
    m:t,
    mm:t,
    h:t,
    hh:t,
    d:"dan",
    dd:t,
    M:"mjesec",
    MM:t,
    y:"godinu",
    yy:t
},
ordinal:"%d.",
week:{
    dow:1,
    doy:7
}
})
}),function(n){
    n(t)
    }(function(n){
    return n.lang("ca",{
        months:"gener_febrer_març_abril_maig_juny_juliol_agost_setembre_octubre_novembre_desembre".split("_"),
        monthsShort:"gen._febr._mar._abr._mai._jun._jul._ag._set._oct._nov._des.".split("_"),
        weekdays:"diumenge_dilluns_dimarts_dimecres_dijous_divendres_dissabte".split("_"),
        weekdaysShort:"dg._dl._dt._dc._dj._dv._ds.".split("_"),
        weekdaysMin:"Dg_Dl_Dt_Dc_Dj_Dv_Ds".split("_"),
        longDateFormat:{
            LT:"H:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:function(){
                return"[avui a "+(this.hours()!==1?"les":"la")+"] LT"
                },
            nextDay:function(){
                return"[demà a "+(this.hours()!==1?"les":"la")+"] LT"
                },
            nextWeek:function(){
                return"dddd [a "+(this.hours()!==1?"les":"la")+"] LT"
                },
            lastDay:function(){
                return"[ahir a "+(this.hours()!==1?"les":"la")+"] LT"
                },
            lastWeek:function(){
                return"[el] dddd [passat a "+(this.hours()!==1?"les":"la")+"] LT"
                },
            sameElse:"L"
        },
        relativeTime:{
            future:"en %s",
            past:"fa %s",
            s:"uns segons",
            m:"un minut",
            mm:"%d minuts",
            h:"una hora",
            hh:"%d hores",
            d:"un dia",
            dd:"%d dies",
            M:"un mes",
            MM:"%d mesos",
            y:"un any",
            yy:"%d anys"
        },
        ordinal:"%dº",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function i(n){
        return n>1&&n<5&&~~(n/10)!=1
        }
        function t(n,t,r,u){
        var f=n+" ";
        switch(r){
            case"s":
                return t||u?"pár sekund":"pár sekundami";
            case"m":
                return t?"minuta":u?"minutu":"minutou";
            case"mm":
                return t||u?f+(i(n)?"minuty":"minut"):f+"minutami";
            case"h":
                return t?"hodina":u?"hodinu":"hodinou";
            case"hh":
                return t||u?f+(i(n)?"hodiny":"hodin"):f+"hodinami";
            case"d":
                return t||u?"den":"dnem";
            case"dd":
                return t||u?f+(i(n)?"dny":"dní"):f+"dny";
            case"M":
                return t||u?"měsíc":"měsícem";
            case"MM":
                return t||u?f+(i(n)?"měsíce":"měsíců"):f+"měsíci";
            case"y":
                return t||u?"rok":"rokem";
            case"yy":
                return t||u?f+(i(n)?"roky":"let"):f+"lety"
                }
            }
    var r="leden_únor_březen_duben_květen_červen_červenec_srpen_září_říjen_listopad_prosinec".split("_"),u="led_úno_bře_dub_kvě_čvn_čvc_srp_zář_říj_lis_pro".split("_");
    return n.lang("cs",{
    months:r,
    monthsShort:u,
    monthsParse:function(n,t){
        for(var r=[],i=0;i<12;i++)r[i]=new RegExp("^"+n[i]+"$|^"+t[i]+"$","i");
        return r
        }(r,u),
    weekdays:"neděle_pondělí_úterý_středa_čtvrtek_pátek_sobota".split("_"),
    weekdaysShort:"ne_po_út_st_čt_pá_so".split("_"),
    weekdaysMin:"ne_po_út_st_čt_pá_so".split("_"),
    longDateFormat:{
        LT:"H.mm",
        L:"DD. MM. YYYY",
        LL:"D. MMMM YYYY",
        LLL:"D. MMMM YYYY LT",
        LLLL:"dddd D. MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[dnes v] LT",
        nextDay:"[zítra v] LT",
        nextWeek:function(){
            switch(this.day()){
                case 0:
                    return"[v neděli v] LT";
                case 1:case 2:
                    return"[v] dddd [v] LT";
                case 3:
                    return"[ve středu v] LT";
                case 4:
                    return"[ve čtvrtek v] LT";
                case 5:
                    return"[v pátek v] LT";
                case 6:
                    return"[v sobotu v] LT"
                    }
                },
    lastDay:"[včera v] LT",
    lastWeek:function(){
        switch(this.day()){
            case 0:
                return"[minulou neděli v] LT";
            case 1:case 2:
                return"[minulé] dddd [v] LT";
            case 3:
                return"[minulou středu v] LT";
            case 4:case 5:
                return"[minulý] dddd [v] LT";
            case 6:
                return"[minulou sobotu v] LT"
                }
            },
sameElse:"L"
},
relativeTime:{
    future:"za %s",
    past:"před %s",
    s:t,
    m:t,
    mm:t,
    h:t,
    hh:t,
    d:t,
    dd:t,
    M:t,
    MM:t,
    y:t,
    yy:t
},
ordinal:"%d.",
week:{
    dow:1,
    doy:4
}
})
}),function(n){
    n(t)
    }(function(n){
    return n.lang("cv",{
        months:"кăрлач_нарăс_пуш_ака_май_çĕртме_утă_çурла_авăн_юпа_чӳк_раштав".split("_"),
        monthsShort:"кăр_нар_пуш_ака_май_çĕр_утă_çур_ав_юпа_чӳк_раш".split("_"),
        weekdays:"вырсарникун_тунтикун_ытларикун_юнкун_кĕçнерникун_эрнекун_шăматкун".split("_"),
        weekdaysShort:"выр_тун_ытл_юн_кĕç_эрн_шăм".split("_"),
        weekdaysMin:"вр_тн_ыт_юн_кç_эр_шм".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD-MM-YYYY",
            LL:"YYYY [çулхи] MMMM [уйăхĕн] D[-мĕшĕ]",
            LLL:"YYYY [çулхи] MMMM [уйăхĕн] D[-мĕшĕ], LT",
            LLLL:"dddd, YYYY [çулхи] MMMM [уйăхĕн] D[-мĕшĕ], LT"
        },
        calendar:{
            sameDay:"[Паян] LT [сехетре]",
            nextDay:"[Ыран] LT [сехетре]",
            lastDay:"[Ĕнер] LT [сехетре]",
            nextWeek:"[Çитес] dddd LT [сехетре]",
            lastWeek:"[Иртнĕ] dddd LT [сехетре]",
            sameElse:"L"
        },
        relativeTime:{
            future:function(n){
                var t=/сехет$/i.exec(n)?"рен":/çул$/i.exec(n)?"тан":"ран";
                return n+t
                },
            past:"%s каялла",
            s:"пĕр-ик çеккунт",
            m:"пĕр минут",
            mm:"%d минут",
            h:"пĕр сехет",
            hh:"%d сехет",
            d:"пĕр кун",
            dd:"%d кун",
            M:"пĕр уйăх",
            MM:"%d уйăх",
            y:"пĕр çул",
            yy:"%d çул"
        },
        ordinal:"%d-мĕш",
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("cy",{
        months:"Ionawr_Chwefror_Mawrth_Ebrill_Mai_Mehefin_Gorffennaf_Awst_Medi_Hydref_Tachwedd_Rhagfyr".split("_"),
        monthsShort:"Ion_Chwe_Maw_Ebr_Mai_Meh_Gor_Aws_Med_Hyd_Tach_Rhag".split("_"),
        weekdays:"Dydd Sul_Dydd Llun_Dydd Mawrth_Dydd Mercher_Dydd Iau_Dydd Gwener_Dydd Sadwrn".split("_"),
        weekdaysShort:"Sul_Llun_Maw_Mer_Iau_Gwe_Sad".split("_"),
        weekdaysMin:"Su_Ll_Ma_Me_Ia_Gw_Sa".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Heddiw am] LT",
            nextDay:"[Yfory am] LT",
            nextWeek:"dddd [am] LT",
            lastDay:"[Ddoe am] LT",
            lastWeek:"dddd [diwethaf am] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"mewn %s",
            past:"%s yn ôl",
            s:"ychydig eiliadau",
            m:"munud",
            mm:"%d munud",
            h:"awr",
            hh:"%d awr",
            d:"diwrnod",
            dd:"%d diwrnod",
            M:"mis",
            MM:"%d mis",
            y:"blwyddyn",
            yy:"%d flynedd"
        },
        ordinal:function(n){
            var t=n,i="";
            return t>20?i=t===40||t===50||t===60||t===80||t===100?"fed":"ain":t>0&&(i=["","af","il","ydd","ydd","ed","ed","ed","fed","fed","fed","eg","fed","eg","eg","fed","eg","eg","fed","eg","fed"][t]),n+i
            },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("da",{
        months:"januar_februar_marts_april_maj_juni_juli_august_september_oktober_november_december".split("_"),
        monthsShort:"jan_feb_mar_apr_maj_jun_jul_aug_sep_okt_nov_dec".split("_"),
        weekdays:"søndag_mandag_tirsdag_onsdag_torsdag_fredag_lørdag".split("_"),
        weekdaysShort:"søn_man_tir_ons_tor_fre_lør".split("_"),
        weekdaysMin:"sø_ma_ti_on_to_fr_lø".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D. MMMM YYYY",
            LLL:"D. MMMM YYYY LT",
            LLLL:"dddd [d.] D. MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[I dag kl.] LT",
            nextDay:"[I morgen kl.] LT",
            nextWeek:"dddd [kl.] LT",
            lastDay:"[I går kl.] LT",
            lastWeek:"[sidste] dddd [kl] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"om %s",
            past:"%s siden",
            s:"få sekunder",
            m:"et minut",
            mm:"%d minutter",
            h:"en time",
            hh:"%d timer",
            d:"en dag",
            dd:"%d dage",
            M:"en måned",
            MM:"%d måneder",
            y:"et år",
            yy:"%d år"
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i){
        var r={
            m:["eine Minute","einer Minute"],
            h:["eine Stunde","einer Stunde"],
            d:["ein Tag","einem Tag"],
            dd:[n+" Tage",n+" Tagen"],
            M:["ein Monat","einem Monat"],
            MM:[n+" Monate",n+" Monaten"],
            y:["ein Jahr","einem Jahr"],
            yy:[n+" Jahre",n+" Jahren"]
            };
            
        return t?r[i][0]:r[i][1]
        }
        return n.lang("de-at",{
        months:"Jänner_Februar_März_April_Mai_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
        monthsShort:"Jän._Febr._Mrz._Apr._Mai_Jun._Jul._Aug._Sept._Okt._Nov._Dez.".split("_"),
        weekdays:"Sonntag_Montag_Dienstag_Mittwoch_Donnerstag_Freitag_Samstag".split("_"),
        weekdaysShort:"So._Mo._Di._Mi._Do._Fr._Sa.".split("_"),
        weekdaysMin:"So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
        longDateFormat:{
            LT:"HH:mm [Uhr]",
            L:"DD.MM.YYYY",
            LL:"D. MMMM YYYY",
            LLL:"D. MMMM YYYY LT",
            LLLL:"dddd, D. MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Heute um] LT",
            sameElse:"L",
            nextDay:"[Morgen um] LT",
            nextWeek:"dddd [um] LT",
            lastDay:"[Gestern um] LT",
            lastWeek:"[letzten] dddd [um] LT"
        },
        relativeTime:{
            future:"in %s",
            past:"vor %s",
            s:"ein paar Sekunden",
            m:t,
            mm:"%d Minuten",
            h:t,
            hh:"%d Stunden",
            d:t,
            dd:t,
            M:t,
            MM:t,
            y:t,
            yy:t
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i){
        var r={
            m:["eine Minute","einer Minute"],
            h:["eine Stunde","einer Stunde"],
            d:["ein Tag","einem Tag"],
            dd:[n+" Tage",n+" Tagen"],
            M:["ein Monat","einem Monat"],
            MM:[n+" Monate",n+" Monaten"],
            y:["ein Jahr","einem Jahr"],
            yy:[n+" Jahre",n+" Jahren"]
            };
            
        return t?r[i][0]:r[i][1]
        }
        return n.lang("de",{
        months:"Januar_Februar_März_April_Mai_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
        monthsShort:"Jan._Febr._Mrz._Apr._Mai_Jun._Jul._Aug._Sept._Okt._Nov._Dez.".split("_"),
        weekdays:"Sonntag_Montag_Dienstag_Mittwoch_Donnerstag_Freitag_Samstag".split("_"),
        weekdaysShort:"So._Mo._Di._Mi._Do._Fr._Sa.".split("_"),
        weekdaysMin:"So_Mo_Di_Mi_Do_Fr_Sa".split("_"),
        longDateFormat:{
            LT:"HH:mm [Uhr]",
            L:"DD.MM.YYYY",
            LL:"D. MMMM YYYY",
            LLL:"D. MMMM YYYY LT",
            LLLL:"dddd, D. MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Heute um] LT",
            sameElse:"L",
            nextDay:"[Morgen um] LT",
            nextWeek:"dddd [um] LT",
            lastDay:"[Gestern um] LT",
            lastWeek:"[letzten] dddd [um] LT"
        },
        relativeTime:{
            future:"in %s",
            past:"vor %s",
            s:"ein paar Sekunden",
            m:t,
            mm:"%d Minuten",
            h:t,
            hh:"%d Stunden",
            d:t,
            dd:t,
            M:t,
            MM:t,
            y:t,
            yy:t
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("el",{
        monthsNominativeEl:"Ιανουάριος_Φεβρουάριος_Μάρτιος_Απρίλιος_Μάιος_Ιούνιος_Ιούλιος_Αύγουστος_Σεπτέμβριος_Οκτώβριος_Νοέμβριος_Δεκέμβριος".split("_"),
        monthsGenitiveEl:"Ιανουαρίου_Φεβρουαρίου_Μαρτίου_Απριλίου_Μαΐου_Ιουνίου_Ιουλίου_Αυγούστου_Σεπτεμβρίου_Οκτωβρίου_Νοεμβρίου_Δεκεμβρίου".split("_"),
        months:function(n,t){
            return/D/.test(t.substring(0,t.indexOf("MMMM")))?this._monthsGenitiveEl[n.month()]:this._monthsNominativeEl[n.month()]
            },
        monthsShort:"Ιαν_Φεβ_Μαρ_Απρ_Μαϊ_Ιουν_Ιουλ_Αυγ_Σεπ_Οκτ_Νοε_Δεκ".split("_"),
        weekdays:"Κυριακή_Δευτέρα_Τρίτη_Τετάρτη_Πέμπτη_Παρασκευή_Σάββατο".split("_"),
        weekdaysShort:"Κυρ_Δευ_Τρι_Τετ_Πεμ_Παρ_Σαβ".split("_"),
        weekdaysMin:"Κυ_Δε_Τρ_Τε_Πε_Πα_Σα".split("_"),
        meridiem:function(n,t,i){
            return n>11?i?"μμ":"ΜΜ":i?"πμ":"ΠΜ"
            },
        longDateFormat:{
            LT:"h:mm A",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendarEl:{
            sameDay:"[Σήμερα {}] LT",
            nextDay:"[Αύριο {}] LT",
            nextWeek:"dddd [{}] LT",
            lastDay:"[Χθες {}] LT",
            lastWeek:function(){
                switch(this.day()){
                    case 6:
                        return"[το προηγούμενο] dddd [{}] LT";
                    default:
                        return"[την προηγούμενη] dddd [{}] LT"
                        }
                    },
        sameElse:"L"
    },
    calendar:function(n,t){
        var i=this._calendarEl[n],r=t&&t.hours();
        return typeof i=="function"&&(i=i.apply(t)),i.replace("{}",r%12==1?"στη":"στις")
        },
    relativeTime:{
        future:"σε %s",
        past:"%s πριν",
        s:"δευτερόλεπτα",
        m:"ένα λεπτό",
        mm:"%d λεπτά",
        h:"μία ώρα",
        hh:"%d ώρες",
        d:"μία μέρα",
        dd:"%d μέρες",
        M:"ένας μήνας",
        MM:"%d μήνες",
        y:"ένας χρόνος",
        yy:"%d χρόνια"
    },
    ordinal:function(n){
        return n+"η"
        },
    week:{
        dow:1,
        doy:4
    }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("en-au",{
        months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
        monthsShort:"Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
        weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
        weekdaysShort:"Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
        weekdaysMin:"Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
        longDateFormat:{
            LT:"h:mm A",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Today at] LT",
            nextDay:"[Tomorrow at] LT",
            nextWeek:"dddd [at] LT",
            lastDay:"[Yesterday at] LT",
            lastWeek:"[Last] dddd [at] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"in %s",
            past:"%s ago",
            s:"a few seconds",
            m:"a minute",
            mm:"%d minutes",
            h:"an hour",
            hh:"%d hours",
            d:"a day",
            dd:"%d days",
            M:"a month",
            MM:"%d months",
            y:"a year",
            yy:"%d years"
        },
        ordinal:function(n){
            var t=n%10,i=~~(n%100/10)==1?"th":t===1?"st":t===2?"nd":t===3?"rd":"th";
            return n+i
            },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("en-ca",{
        months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
        monthsShort:"Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
        weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
        weekdaysShort:"Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
        weekdaysMin:"Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
        longDateFormat:{
            LT:"h:mm A",
            L:"YYYY-MM-DD",
            LL:"D MMMM, YYYY",
            LLL:"D MMMM, YYYY LT",
            LLLL:"dddd, D MMMM, YYYY LT"
        },
        calendar:{
            sameDay:"[Today at] LT",
            nextDay:"[Tomorrow at] LT",
            nextWeek:"dddd [at] LT",
            lastDay:"[Yesterday at] LT",
            lastWeek:"[Last] dddd [at] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"in %s",
            past:"%s ago",
            s:"a few seconds",
            m:"a minute",
            mm:"%d minutes",
            h:"an hour",
            hh:"%d hours",
            d:"a day",
            dd:"%d days",
            M:"a month",
            MM:"%d months",
            y:"a year",
            yy:"%d years"
        },
        ordinal:function(n){
            var t=n%10,i=~~(n%100/10)==1?"th":t===1?"st":t===2?"nd":t===3?"rd":"th";
            return n+i
            }
        })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("en-gb",{
        months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
        monthsShort:"Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
        weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
        weekdaysShort:"Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
        weekdaysMin:"Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Today at] LT",
            nextDay:"[Tomorrow at] LT",
            nextWeek:"dddd [at] LT",
            lastDay:"[Yesterday at] LT",
            lastWeek:"[Last] dddd [at] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"in %s",
            past:"%s ago",
            s:"a few seconds",
            m:"a minute",
            mm:"%d minutes",
            h:"an hour",
            hh:"%d hours",
            d:"a day",
            dd:"%d days",
            M:"a month",
            MM:"%d months",
            y:"a year",
            yy:"%d years"
        },
        ordinal:function(n){
            var t=n%10,i=~~(n%100/10)==1?"th":t===1?"st":t===2?"nd":t===3?"rd":"th";
            return n+i
            },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("eo",{
        months:"januaro_februaro_marto_aprilo_majo_junio_julio_aŭgusto_septembro_oktobro_novembro_decembro".split("_"),
        monthsShort:"jan_feb_mar_apr_maj_jun_jul_aŭg_sep_okt_nov_dec".split("_"),
        weekdays:"Dimanĉo_Lundo_Mardo_Merkredo_Ĵaŭdo_Vendredo_Sabato".split("_"),
        weekdaysShort:"Dim_Lun_Mard_Merk_Ĵaŭ_Ven_Sab".split("_"),
        weekdaysMin:"Di_Lu_Ma_Me_Ĵa_Ve_Sa".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"YYYY-MM-DD",
            LL:"D[-an de] MMMM, YYYY",
            LLL:"D[-an de] MMMM, YYYY LT",
            LLLL:"dddd, [la] D[-an de] MMMM, YYYY LT"
        },
        meridiem:function(n,t,i){
            return n>11?i?"p.t.m.":"P.T.M.":i?"a.t.m.":"A.T.M."
            },
        calendar:{
            sameDay:"[Hodiaŭ je] LT",
            nextDay:"[Morgaŭ je] LT",
            nextWeek:"dddd [je] LT",
            lastDay:"[Hieraŭ je] LT",
            lastWeek:"[pasinta] dddd [je] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"je %s",
            past:"antaŭ %s",
            s:"sekundoj",
            m:"minuto",
            mm:"%d minutoj",
            h:"horo",
            hh:"%d horoj",
            d:"tago",
            dd:"%d tagoj",
            M:"monato",
            MM:"%d monatoj",
            y:"jaro",
            yy:"%d jaroj"
        },
        ordinal:"%da",
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    var t="ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.".split("_"),i="ene_feb_mar_abr_may_jun_jul_ago_sep_oct_nov_dic".split("_");
    return n.lang("es",{
        months:"enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre".split("_"),
        monthsShort:function(n,r){
            return/-MMM-/.test(r)?i[n.month()]:t[n.month()]
            },
        weekdays:"domingo_lunes_martes_miércoles_jueves_viernes_sábado".split("_"),
        weekdaysShort:"dom._lun._mar._mié._jue._vie._sáb.".split("_"),
        weekdaysMin:"Do_Lu_Ma_Mi_Ju_Vi_Sá".split("_"),
        longDateFormat:{
            LT:"H:mm",
            L:"DD/MM/YYYY",
            LL:"D [de] MMMM [del] YYYY",
            LLL:"D [de] MMMM [del] YYYY LT",
            LLLL:"dddd, D [de] MMMM [del] YYYY LT"
        },
        calendar:{
            sameDay:function(){
                return"[hoy a la"+(this.hours()!==1?"s":"")+"] LT"
                },
            nextDay:function(){
                return"[mañana a la"+(this.hours()!==1?"s":"")+"] LT"
                },
            nextWeek:function(){
                return"dddd [a la"+(this.hours()!==1?"s":"")+"] LT"
                },
            lastDay:function(){
                return"[ayer a la"+(this.hours()!==1?"s":"")+"] LT"
                },
            lastWeek:function(){
                return"[el] dddd [pasado a la"+(this.hours()!==1?"s":"")+"] LT"
                },
            sameElse:"L"
        },
        relativeTime:{
            future:"en %s",
            past:"hace %s",
            s:"unos segundos",
            m:"un minuto",
            mm:"%d minutos",
            h:"una hora",
            hh:"%d horas",
            d:"un día",
            dd:"%d días",
            M:"un mes",
            MM:"%d meses",
            y:"un año",
            yy:"%d años"
        },
        ordinal:"%dº",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i,r){
        var u={
            s:["mõne sekundi","mõni sekund","paar sekundit"],
            m:["ühe minuti","üks minut"],
            mm:[n+" minuti",n+" minutit"],
            h:["ühe tunni","tund aega","üks tund"],
            hh:[n+" tunni",n+" tundi"],
            d:["ühe päeva","üks päev"],
            M:["kuu aja","kuu aega","üks kuu"],
            MM:[n+" kuu",n+" kuud"],
            y:["ühe aasta","aasta","üks aasta"],
            yy:[n+" aasta",n+" aastat"]
            };
            
        return t?u[i][2]?u[i][2]:u[i][1]:r?u[i][0]:u[i][1]
        }
        return n.lang("et",{
        months:"jaanuar_veebruar_märts_aprill_mai_juuni_juuli_august_september_oktoober_november_detsember".split("_"),
        monthsShort:"jaan_veebr_märts_apr_mai_juuni_juuli_aug_sept_okt_nov_dets".split("_"),
        weekdays:"pühapäev_esmaspäev_teisipäev_kolmapäev_neljapäev_reede_laupäev".split("_"),
        weekdaysShort:"P_E_T_K_N_R_L".split("_"),
        weekdaysMin:"P_E_T_K_N_R_L".split("_"),
        longDateFormat:{
            LT:"H:mm",
            L:"DD.MM.YYYY",
            LL:"D. MMMM YYYY",
            LLL:"D. MMMM YYYY LT",
            LLLL:"dddd, D. MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Täna,] LT",
            nextDay:"[Homme,] LT",
            nextWeek:"[Järgmine] dddd LT",
            lastDay:"[Eile,] LT",
            lastWeek:"[Eelmine] dddd LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s pärast",
            past:"%s tagasi",
            s:t,
            m:t,
            mm:t,
            h:t,
            hh:t,
            d:t,
            dd:"%d päeva",
            M:t,
            MM:t,
            y:t,
            yy:t
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("eu",{
        months:"urtarrila_otsaila_martxoa_apirila_maiatza_ekaina_uztaila_abuztua_iraila_urria_azaroa_abendua".split("_"),
        monthsShort:"urt._ots._mar._api._mai._eka._uzt._abu._ira._urr._aza._abe.".split("_"),
        weekdays:"igandea_astelehena_asteartea_asteazkena_osteguna_ostirala_larunbata".split("_"),
        weekdaysShort:"ig._al._ar._az._og._ol._lr.".split("_"),
        weekdaysMin:"ig_al_ar_az_og_ol_lr".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"YYYY-MM-DD",
            LL:"YYYY[ko] MMMM[ren] D[a]",
            LLL:"YYYY[ko] MMMM[ren] D[a] LT",
            LLLL:"dddd, YYYY[ko] MMMM[ren] D[a] LT",
            l:"YYYY-M-D",
            ll:"YYYY[ko] MMM D[a]",
            lll:"YYYY[ko] MMM D[a] LT",
            llll:"ddd, YYYY[ko] MMM D[a] LT"
        },
        calendar:{
            sameDay:"[gaur] LT[etan]",
            nextDay:"[bihar] LT[etan]",
            nextWeek:"dddd LT[etan]",
            lastDay:"[atzo] LT[etan]",
            lastWeek:"[aurreko] dddd LT[etan]",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s barru",
            past:"duela %s",
            s:"segundo batzuk",
            m:"minutu bat",
            mm:"%d minutu",
            h:"ordu bat",
            hh:"%d ordu",
            d:"egun bat",
            dd:"%d egun",
            M:"hilabete bat",
            MM:"%d hilabete",
            y:"urte bat",
            yy:"%d urte"
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    var t={
        "1":"۱",
        "2":"۲",
        "3":"۳",
        "4":"۴",
        "5":"۵",
        "6":"۶",
        "7":"۷",
        "8":"۸",
        "9":"۹",
        "0":"۰"
    },i={
        "۱":"1",
        "۲":"2",
        "۳":"3",
        "۴":"4",
        "۵":"5",
        "۶":"6",
        "۷":"7",
        "۸":"8",
        "۹":"9",
        "۰":"0"
    };
    
    return n.lang("fa",{
        months:"ژانویه_فوریه_مارس_آوریل_مه_ژوئن_ژوئیه_اوت_سپتامبر_اکتبر_نوامبر_دسامبر".split("_"),
        monthsShort:"ژانویه_فوریه_مارس_آوریل_مه_ژوئن_ژوئیه_اوت_سپتامبر_اکتبر_نوامبر_دسامبر".split("_"),
        weekdays:"یک‌شنبه_دوشنبه_سه‌شنبه_چهارشنبه_پنج‌شنبه_جمعه_شنبه".split("_"),
        weekdaysShort:"یک‌شنبه_دوشنبه_سه‌شنبه_چهارشنبه_پنج‌شنبه_جمعه_شنبه".split("_"),
        weekdaysMin:"ی_د_س_چ_پ_ج_ش".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        meridiem:function(n){
            return n<12?"قبل از ظهر":"بعد از ظهر"
            },
        calendar:{
            sameDay:"[امروز ساعت] LT",
            nextDay:"[فردا ساعت] LT",
            nextWeek:"dddd [ساعت] LT",
            lastDay:"[دیروز ساعت] LT",
            lastWeek:"dddd [پیش] [ساعت] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"در %s",
            past:"%s پیش",
            s:"چندین ثانیه",
            m:"یک دقیقه",
            mm:"%d دقیقه",
            h:"یک ساعت",
            hh:"%d ساعت",
            d:"یک روز",
            dd:"%d روز",
            M:"یک ماه",
            MM:"%d ماه",
            y:"یک سال",
            yy:"%d سال"
        },
        preparse:function(n){
            return n.replace(/[۰-۹]/g,function(n){
                return i[n]
                }).replace(/،/g,",")
            },
        postformat:function(n){
            return n.replace(/\d/g,function(n){
                return t[n]
                }).replace(/,/g,"،")
            },
        ordinal:"%dم",
        week:{
            dow:6,
            doy:12
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i,r){
        var f="";
        switch(i){
            case"s":
                return r?"muutaman sekunnin":"muutama sekunti";
            case"m":
                return r?"minuutin":"minuutti";
            case"mm":
                f=r?"minuutin":"minuuttia";
                break;
            case"h":
                return r?"tunnin":"tunti";
            case"hh":
                f=r?"tunnin":"tuntia";
                break;
            case"d":
                return r?"päivän":"päivä";
            case"dd":
                f=r?"päivän":"päivää";
                break;
            case"M":
                return r?"kuukauden":"kuukausi";
            case"MM":
                f=r?"kuukauden":"kuukautta";
                break;
            case"y":
                return r?"vuoden":"vuosi";
            case"yy":
                f=r?"vuoden":"vuotta"
                }
                return u(n,r)+" "+f
        }
        function u(n,t){
        return n<10?t?r[n]:i[n]:n
        }
        var i="nolla yksi kaksi kolme neljä viisi kuusi seitsemän kahdeksan yhdeksän".split(" "),r=["nolla","yhden","kahden","kolmen","neljän","viiden","kuuden",i[7],i[8],i[9]];
    return n.lang("fi",{
        months:"tammikuu_helmikuu_maaliskuu_huhtikuu_toukokuu_kesäkuu_heinäkuu_elokuu_syyskuu_lokakuu_marraskuu_joulukuu".split("_"),
        monthsShort:"tammi_helmi_maalis_huhti_touko_kesä_heinä_elo_syys_loka_marras_joulu".split("_"),
        weekdays:"sunnuntai_maanantai_tiistai_keskiviikko_torstai_perjantai_lauantai".split("_"),
        weekdaysShort:"su_ma_ti_ke_to_pe_la".split("_"),
        weekdaysMin:"su_ma_ti_ke_to_pe_la".split("_"),
        longDateFormat:{
            LT:"HH.mm",
            L:"DD.MM.YYYY",
            LL:"Do MMMM[ta] YYYY",
            LLL:"Do MMMM[ta] YYYY, [klo] LT",
            LLLL:"dddd, Do MMMM[ta] YYYY, [klo] LT",
            l:"D.M.YYYY",
            ll:"Do MMM YYYY",
            lll:"Do MMM YYYY, [klo] LT",
            llll:"ddd, Do MMM YYYY, [klo] LT"
        },
        calendar:{
            sameDay:"[tänään] [klo] LT",
            nextDay:"[huomenna] [klo] LT",
            nextWeek:"dddd [klo] LT",
            lastDay:"[eilen] [klo] LT",
            lastWeek:"[viime] dddd[na] [klo] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s päästä",
            past:"%s sitten",
            s:t,
            m:t,
            mm:t,
            h:t,
            hh:t,
            d:t,
            dd:t,
            M:t,
            MM:t,
            y:t,
            yy:t
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("fo",{
        months:"januar_februar_mars_apríl_mai_juni_juli_august_september_oktober_november_desember".split("_"),
        monthsShort:"jan_feb_mar_apr_mai_jun_jul_aug_sep_okt_nov_des".split("_"),
        weekdays:"sunnudagur_mánadagur_týsdagur_mikudagur_hósdagur_fríggjadagur_leygardagur".split("_"),
        weekdaysShort:"sun_mán_týs_mik_hós_frí_ley".split("_"),
        weekdaysMin:"su_má_tý_mi_hó_fr_le".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D. MMMM, YYYY LT"
        },
        calendar:{
            sameDay:"[Í dag kl.] LT",
            nextDay:"[Í morgin kl.] LT",
            nextWeek:"dddd [kl.] LT",
            lastDay:"[Í gjár kl.] LT",
            lastWeek:"[síðstu] dddd [kl] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"um %s",
            past:"%s síðani",
            s:"fá sekund",
            m:"ein minutt",
            mm:"%d minuttir",
            h:"ein tími",
            hh:"%d tímar",
            d:"ein dagur",
            dd:"%d dagar",
            M:"ein mánaði",
            MM:"%d mánaðir",
            y:"eitt ár",
            yy:"%d ár"
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("fr-ca",{
        months:"janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre".split("_"),
        monthsShort:"janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.".split("_"),
        weekdays:"dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi".split("_"),
        weekdaysShort:"dim._lun._mar._mer._jeu._ven._sam.".split("_"),
        weekdaysMin:"Di_Lu_Ma_Me_Je_Ve_Sa".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"YYYY-MM-DD",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Aujourd'hui à] LT",
            nextDay:"[Demain à] LT",
            nextWeek:"dddd [à] LT",
            lastDay:"[Hier à] LT",
            lastWeek:"dddd [dernier à] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"dans %s",
            past:"il y a %s",
            s:"quelques secondes",
            m:"une minute",
            mm:"%d minutes",
            h:"une heure",
            hh:"%d heures",
            d:"un jour",
            dd:"%d jours",
            M:"un mois",
            MM:"%d mois",
            y:"un an",
            yy:"%d ans"
        },
        ordinal:function(n){
            return n+(n===1?"er":"")
            }
        })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("fr",{
        months:"janvier_février_mars_avril_mai_juin_juillet_août_septembre_octobre_novembre_décembre".split("_"),
        monthsShort:"janv._févr._mars_avr._mai_juin_juil._août_sept._oct._nov._déc.".split("_"),
        weekdays:"dimanche_lundi_mardi_mercredi_jeudi_vendredi_samedi".split("_"),
        weekdaysShort:"dim._lun._mar._mer._jeu._ven._sam.".split("_"),
        weekdaysMin:"Di_Lu_Ma_Me_Je_Ve_Sa".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Aujourd'hui à] LT",
            nextDay:"[Demain à] LT",
            nextWeek:"dddd [à] LT",
            lastDay:"[Hier à] LT",
            lastWeek:"dddd [dernier à] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"dans %s",
            past:"il y a %s",
            s:"quelques secondes",
            m:"une minute",
            mm:"%d minutes",
            h:"une heure",
            hh:"%d heures",
            d:"un jour",
            dd:"%d jours",
            M:"un mois",
            MM:"%d mois",
            y:"un an",
            yy:"%d ans"
        },
        ordinal:function(n){
            return n+(n===1?"er":"")
            },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("gl",{
        months:"Xaneiro_Febreiro_Marzo_Abril_Maio_Xuño_Xullo_Agosto_Setembro_Outubro_Novembro_Decembro".split("_"),
        monthsShort:"Xan._Feb._Mar._Abr._Mai._Xuñ._Xul._Ago._Set._Out._Nov._Dec.".split("_"),
        weekdays:"Domingo_Luns_Martes_Mércores_Xoves_Venres_Sábado".split("_"),
        weekdaysShort:"Dom._Lun._Mar._Mér._Xov._Ven._Sáb.".split("_"),
        weekdaysMin:"Do_Lu_Ma_Mé_Xo_Ve_Sá".split("_"),
        longDateFormat:{
            LT:"H:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:function(){
                return"[hoxe "+(this.hours()!==1?"ás":"á")+"] LT"
                },
            nextDay:function(){
                return"[mañá "+(this.hours()!==1?"ás":"á")+"] LT"
                },
            nextWeek:function(){
                return"dddd ["+(this.hours()!==1?"ás":"a")+"] LT"
                },
            lastDay:function(){
                return"[onte "+(this.hours()!==1?"á":"a")+"] LT"
                },
            lastWeek:function(){
                return"[o] dddd [pasado "+(this.hours()!==1?"ás":"a")+"] LT"
                },
            sameElse:"L"
        },
        relativeTime:{
            future:function(n){
                return n==="uns segundos"?"nuns segundos":"en "+n
                },
            past:"hai %s",
            s:"uns segundos",
            m:"un minuto",
            mm:"%d minutos",
            h:"unha hora",
            hh:"%d horas",
            d:"un día",
            dd:"%d días",
            M:"un mes",
            MM:"%d meses",
            y:"un ano",
            yy:"%d anos"
        },
        ordinal:"%dº",
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("he",{
        months:"ינואר_פברואר_מרץ_אפריל_מאי_יוני_יולי_אוגוסט_ספטמבר_אוקטובר_נובמבר_דצמבר".split("_"),
        monthsShort:"ינו׳_פבר׳_מרץ_אפר׳_מאי_יוני_יולי_אוג׳_ספט׳_אוק׳_נוב׳_דצמ׳".split("_"),
        weekdays:"ראשון_שני_שלישי_רביעי_חמישי_שישי_שבת".split("_"),
        weekdaysShort:"א׳_ב׳_ג׳_ד׳_ה׳_ו׳_ש׳".split("_"),
        weekdaysMin:"א_ב_ג_ד_ה_ו_ש".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D [ב]MMMM YYYY",
            LLL:"D [ב]MMMM YYYY LT",
            LLLL:"dddd, D [ב]MMMM YYYY LT",
            l:"D/M/YYYY",
            ll:"D MMM YYYY",
            lll:"D MMM YYYY LT",
            llll:"ddd, D MMM YYYY LT"
        },
        calendar:{
            sameDay:"[היום ב־]LT",
            nextDay:"[מחר ב־]LT",
            nextWeek:"dddd [בשעה] LT",
            lastDay:"[אתמול ב־]LT",
            lastWeek:"[ביום] dddd [האחרון בשעה] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"בעוד %s",
            past:"לפני %s",
            s:"מספר שניות",
            m:"דקה",
            mm:"%d דקות",
            h:"שעה",
            hh:function(n){
                return n===2?"שעתיים":n+" שעות"
                },
            d:"יום",
            dd:function(n){
                return n===2?"יומיים":n+" ימים"
                },
            M:"חודש",
            MM:function(n){
                return n===2?"חודשיים":n+" חודשים"
                },
            y:"שנה",
            yy:function(n){
                return n===2?"שנתיים":n+" שנים"
                }
            }
    })
}),function(n){
    n(t)
    }(function(n){
    var t={
        "1":"१",
        "2":"२",
        "3":"३",
        "4":"४",
        "5":"५",
        "6":"६",
        "7":"७",
        "8":"८",
        "9":"९",
        "0":"०"
    },i={
        "१":"1",
        "२":"2",
        "३":"3",
        "४":"4",
        "५":"5",
        "६":"6",
        "७":"7",
        "८":"8",
        "९":"9",
        "०":"0"
    };
    
    return n.lang("hi",{
        months:"जनवरी_फ़रवरी_मार्च_अप्रैल_मई_जून_जुलाई_अगस्त_सितम्बर_अक्टूबर_नवम्बर_दिसम्बर".split("_"),
        monthsShort:"जन._फ़र._मार्च_अप्रै._मई_जून_जुल._अग._सित._अक्टू._नव._दिस.".split("_"),
        weekdays:"रविवार_सोमवार_मंगलवार_बुधवार_गुरूवार_शुक्रवार_शनिवार".split("_"),
        weekdaysShort:"रवि_सोम_मंगल_बुध_गुरू_शुक्र_शनि".split("_"),
        weekdaysMin:"र_सो_मं_बु_गु_शु_श".split("_"),
        longDateFormat:{
            LT:"A h:mm बजे",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY, LT",
            LLLL:"dddd, D MMMM YYYY, LT"
        },
        calendar:{
            sameDay:"[आज] LT",
            nextDay:"[कल] LT",
            nextWeek:"dddd, LT",
            lastDay:"[कल] LT",
            lastWeek:"[पिछले] dddd, LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s में",
            past:"%s पहले",
            s:"कुछ ही क्षण",
            m:"एक मिनट",
            mm:"%d मिनट",
            h:"एक घंटा",
            hh:"%d घंटे",
            d:"एक दिन",
            dd:"%d दिन",
            M:"एक महीने",
            MM:"%d महीने",
            y:"एक वर्ष",
            yy:"%d वर्ष"
        },
        preparse:function(n){
            return n.replace(/[१२३४५६७८९०]/g,function(n){
                return i[n]
                })
            },
        postformat:function(n){
            return n.replace(/\d/g,function(n){
                return t[n]
                })
            },
        meridiem:function(n){
            return n<4?"रात":n<10?"सुबह":n<17?"दोपहर":n<20?"शाम":"रात"
            },
        week:{
            dow:0,
            doy:6
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i){
        var r=n+" ";
        switch(i){
            case"m":
                return t?"jedna minuta":"jedne minute";
            case"mm":
                return r+(n===1?"minuta":n===2||n===3||n===4?"minute":"minuta");
            case"h":
                return t?"jedan sat":"jednog sata";
            case"hh":
                return r+(n===1?"sat":n===2||n===3||n===4?"sata":"sati");
            case"dd":
                return r+(n===1?"dan":"dana");
            case"MM":
                return r+(n===1?"mjesec":n===2||n===3||n===4?"mjeseca":"mjeseci");
            case"yy":
                return r+(n===1?"godina":n===2||n===3||n===4?"godine":"godina")
                }
            }
    return n.lang("hr",{
    months:"sječanj_veljača_ožujak_travanj_svibanj_lipanj_srpanj_kolovoz_rujan_listopad_studeni_prosinac".split("_"),
    monthsShort:"sje._vel._ožu._tra._svi._lip._srp._kol._ruj._lis._stu._pro.".split("_"),
    weekdays:"nedjelja_ponedjeljak_utorak_srijeda_četvrtak_petak_subota".split("_"),
    weekdaysShort:"ned._pon._uto._sri._čet._pet._sub.".split("_"),
    weekdaysMin:"ne_po_ut_sr_če_pe_su".split("_"),
    longDateFormat:{
        LT:"H:mm",
        L:"DD. MM. YYYY",
        LL:"D. MMMM YYYY",
        LLL:"D. MMMM YYYY LT",
        LLLL:"dddd, D. MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[danas u] LT",
        nextDay:"[sutra u] LT",
        nextWeek:function(){
            switch(this.day()){
                case 0:
                    return"[u] [nedjelju] [u] LT";
                case 3:
                    return"[u] [srijedu] [u] LT";
                case 6:
                    return"[u] [subotu] [u] LT";
                case 1:case 2:case 4:case 5:
                    return"[u] dddd [u] LT"
                    }
                },
    lastDay:"[jučer u] LT",
    lastWeek:function(){
        switch(this.day()){
            case 0:case 3:
                return"[prošlu] dddd [u] LT";
            case 6:
                return"[prošle] [subote] [u] LT";
            case 1:case 2:case 4:case 5:
                return"[prošli] dddd [u] LT"
                }
            },
sameElse:"L"
},
relativeTime:{
    future:"za %s",
    past:"prije %s",
    s:"par sekundi",
    m:t,
    mm:t,
    h:t,
    hh:t,
    d:"dan",
    dd:t,
    M:"mjesec",
    MM:t,
    y:"godinu",
    yy:t
},
ordinal:"%d.",
week:{
    dow:1,
    doy:7
}
})
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i,r){
        var u=n;
        switch(i){
            case"s":
                return r||t?"néhány másodperc":"néhány másodperce";
            case"m":
                return"egy"+(r||t?" perc":" perce");
            case"mm":
                return u+(r||t?" perc":" perce");
            case"h":
                return"egy"+(r||t?" óra":" órája");
            case"hh":
                return u+(r||t?" óra":" órája");
            case"d":
                return"egy"+(r||t?" nap":" napja");
            case"dd":
                return u+(r||t?" nap":" napja");
            case"M":
                return"egy"+(r||t?" hónap":" hónapja");
            case"MM":
                return u+(r||t?" hónap":" hónapja");
            case"y":
                return"egy"+(r||t?" év":" éve");
            case"yy":
                return u+(r||t?" év":" éve")
                }
                return""
        }
        function i(n){
        return(n?"":"[múlt] ")+"["+r[this.day()]+"] LT[-kor]"
        }
        var r="vasárnap hétfőn kedden szerdán csütörtökön pénteken szombaton".split(" ");
    return n.lang("hu",{
        months:"január_február_március_április_május_június_július_augusztus_szeptember_október_november_december".split("_"),
        monthsShort:"jan_feb_márc_ápr_máj_jún_júl_aug_szept_okt_nov_dec".split("_"),
        weekdays:"vasárnap_hétfő_kedd_szerda_csütörtök_péntek_szombat".split("_"),
        weekdaysShort:"vas_hét_kedd_sze_csüt_pén_szo".split("_"),
        weekdaysMin:"v_h_k_sze_cs_p_szo".split("_"),
        longDateFormat:{
            LT:"H:mm",
            L:"YYYY.MM.DD.",
            LL:"YYYY. MMMM D.",
            LLL:"YYYY. MMMM D., LT",
            LLLL:"YYYY. MMMM D., dddd LT"
        },
        meridiem:function(n,t,i){
            return n<12?i===!0?"de":"DE":i===!0?"du":"DU"
            },
        calendar:{
            sameDay:"[ma] LT[-kor]",
            nextDay:"[holnap] LT[-kor]",
            nextWeek:function(){
                return i.call(this,!0)
                },
            lastDay:"[tegnap] LT[-kor]",
            lastWeek:function(){
                return i.call(this,!1)
                },
            sameElse:"L"
        },
        relativeTime:{
            future:"%s múlva",
            past:"%s",
            s:t,
            m:t,
            mm:t,
            h:t,
            hh:t,
            d:t,
            dd:t,
            M:t,
            MM:t,
            y:t,
            yy:t
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function t(n,t){
        var i={
            nominative:"հունվար_փետրվար_մարտ_ապրիլ_մայիս_հունիս_հուլիս_օգոստոս_սեպտեմբեր_հոկտեմբեր_նոյեմբեր_դեկտեմբեր".split("_"),
            accusative:"հունվարի_փետրվարի_մարտի_ապրիլի_մայիսի_հունիսի_հուլիսի_օգոստոսի_սեպտեմբերի_հոկտեմբերի_նոյեմբերի_դեկտեմբերի".split("_")
            },r=/D[oD]?(\[[^\[\]]*\]|\s+)+MMMM?/.test(t)?"accusative":"nominative";
        return i[r][n.month()]
        }
        function i(n){
        var t="հնվ_փտր_մրտ_ապր_մյս_հնս_հլս_օգս_սպտ_հկտ_նմբ_դկտ".split("_");
        return t[n.month()]
        }
        function r(n){
        var t="կիրակի_երկուշաբթի_երեքշաբթի_չորեքշաբթի_հինգշաբթի_ուրբաթ_շաբաթ".split("_");
        return t[n.day()]
        }
        return n.lang("hy-am",{
        months:t,
        monthsShort:i,
        weekdays:r,
        weekdaysShort:"կրկ_երկ_երք_չրք_հնգ_ուրբ_շբթ".split("_"),
        weekdaysMin:"կրկ_երկ_երք_չրք_հնգ_ուրբ_շբթ".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD.MM.YYYY",
            LL:"D MMMM YYYY թ.",
            LLL:"D MMMM YYYY թ., LT",
            LLLL:"dddd, D MMMM YYYY թ., LT"
        },
        calendar:{
            sameDay:"[այսօր] LT",
            nextDay:"[վաղը] LT",
            lastDay:"[երեկ] LT",
            nextWeek:function(){
                return"dddd [օրը ժամը] LT"
                },
            lastWeek:function(){
                return"[անցած] dddd [օրը ժամը] LT"
                },
            sameElse:"L"
        },
        relativeTime:{
            future:"%s հետո",
            past:"%s առաջ",
            s:"մի քանի վայրկյան",
            m:"րոպե",
            mm:"%d րոպե",
            h:"ժամ",
            hh:"%d ժամ",
            d:"օր",
            dd:"%d օր",
            M:"ամիս",
            MM:"%d ամիս",
            y:"տարի",
            yy:"%d տարի"
        },
        meridiem:function(n){
            return n<4?"գիշերվա":n<12?"առավոտվա":n<17?"ցերեկվա":"երեկոյան"
            },
        ordinal:function(n,t){
            switch(t){
                case"DDD":case"w":case"W":case"DDDo":
                    return n===1?n+"-ին":n+"-րդ";
                default:
                    return n
                    }
                },
    week:{
        dow:1,
        doy:7
    }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("id",{
        months:"Januari_Februari_Maret_April_Mei_Juni_Juli_Agustus_September_Oktober_November_Desember".split("_"),
        monthsShort:"Jan_Feb_Mar_Apr_Mei_Jun_Jul_Ags_Sep_Okt_Nov_Des".split("_"),
        weekdays:"Minggu_Senin_Selasa_Rabu_Kamis_Jumat_Sabtu".split("_"),
        weekdaysShort:"Min_Sen_Sel_Rab_Kam_Jum_Sab".split("_"),
        weekdaysMin:"Mg_Sn_Sl_Rb_Km_Jm_Sb".split("_"),
        longDateFormat:{
            LT:"HH.mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY [pukul] LT",
            LLLL:"dddd, D MMMM YYYY [pukul] LT"
        },
        meridiem:function(n){
            return n<11?"pagi":n<15?"siang":n<19?"sore":"malam"
            },
        calendar:{
            sameDay:"[Hari ini pukul] LT",
            nextDay:"[Besok pukul] LT",
            nextWeek:"dddd [pukul] LT",
            lastDay:"[Kemarin pukul] LT",
            lastWeek:"dddd [lalu pukul] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"dalam %s",
            past:"%s yang lalu",
            s:"beberapa detik",
            m:"semenit",
            mm:"%d menit",
            h:"sejam",
            hh:"%d jam",
            d:"sehari",
            dd:"%d hari",
            M:"sebulan",
            MM:"%d bulan",
            y:"setahun",
            yy:"%d tahun"
        },
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function i(n){
        return n%100==11?!0:n%10==1?!1:!0
        }
        function t(n,t,r,u){
        var f=n+" ";
        switch(r){
            case"s":
                return t||u?"nokkrar sekúndur":"nokkrum sekúndum";
            case"m":
                return t?"mínúta":"mínútu";
            case"mm":
                return i(n)?f+(t||u?"mínútur":"mínútum"):t?f+"mínúta":f+"mínútu";
            case"hh":
                return i(n)?f+(t||u?"klukkustundir":"klukkustundum"):f+"klukkustund";
            case"d":
                return t?"dagur":u?"dag":"degi";
            case"dd":
                return i(n)?t?f+"dagar":f+(u?"daga":"dögum"):t?f+"dagur":f+(u?"dag":"degi");
            case"M":
                return t?"mánuður":u?"mánuð":"mánuði";
            case"MM":
                return i(n)?t?f+"mánuðir":f+(u?"mánuði":"mánuðum"):t?f+"mánuður":f+(u?"mánuð":"mánuði");
            case"y":
                return t||u?"ár":"ári";
            case"yy":
                return i(n)?f+(t||u?"ár":"árum"):f+(t||u?"ár":"ári")
                }
            }
    return n.lang("is",{
    months:"janúar_febrúar_mars_apríl_maí_júní_júlí_ágúst_september_október_nóvember_desember".split("_"),
    monthsShort:"jan_feb_mar_apr_maí_jún_júl_ágú_sep_okt_nóv_des".split("_"),
    weekdays:"sunnudagur_mánudagur_þriðjudagur_miðvikudagur_fimmtudagur_föstudagur_laugardagur".split("_"),
    weekdaysShort:"sun_mán_þri_mið_fim_fös_lau".split("_"),
    weekdaysMin:"Su_Má_Þr_Mi_Fi_Fö_La".split("_"),
    longDateFormat:{
        LT:"H:mm",
        L:"DD/MM/YYYY",
        LL:"D. MMMM YYYY",
        LLL:"D. MMMM YYYY [kl.] LT",
        LLLL:"dddd, D. MMMM YYYY [kl.] LT"
    },
    calendar:{
        sameDay:"[í dag kl.] LT",
        nextDay:"[á morgun kl.] LT",
        nextWeek:"dddd [kl.] LT",
        lastDay:"[í gær kl.] LT",
        lastWeek:"[síðasta] dddd [kl.] LT",
        sameElse:"L"
    },
    relativeTime:{
        future:"eftir %s",
        past:"fyrir %s síðan",
        s:t,
        m:t,
        mm:t,
        h:"klukkustund",
        hh:t,
        d:t,
        dd:t,
        M:t,
        MM:t,
        y:t,
        yy:t
    },
    ordinal:"%d.",
    week:{
        dow:1,
        doy:4
    }
})
}),function(n){
    n(t)
    }(function(n){
    return n.lang("it",{
        months:"gennaio_febbraio_marzo_aprile_maggio_giugno_luglio_agosto_settembre_ottobre_novembre_dicembre".split("_"),
        monthsShort:"gen_feb_mar_apr_mag_giu_lug_ago_set_ott_nov_dic".split("_"),
        weekdays:"Domenica_Lunedì_Martedì_Mercoledì_Giovedì_Venerdì_Sabato".split("_"),
        weekdaysShort:"Dom_Lun_Mar_Mer_Gio_Ven_Sab".split("_"),
        weekdaysMin:"D_L_Ma_Me_G_V_S".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Oggi alle] LT",
            nextDay:"[Domani alle] LT",
            nextWeek:"dddd [alle] LT",
            lastDay:"[Ieri alle] LT",
            lastWeek:"[lo scorso] dddd [alle] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:function(n){
                return(/^[0-9].+$/.test(n)?"tra":"in")+" "+n
                },
            past:"%s fa",
            s:"alcuni secondi",
            m:"un minuto",
            mm:"%d minuti",
            h:"un'ora",
            hh:"%d ore",
            d:"un giorno",
            dd:"%d giorni",
            M:"un mese",
            MM:"%d mesi",
            y:"un anno",
            yy:"%d anni"
        },
        ordinal:"%dº",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("ja",{
        months:"1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
        monthsShort:"1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
        weekdays:"日曜日_月曜日_火曜日_水曜日_木曜日_金曜日_土曜日".split("_"),
        weekdaysShort:"日_月_火_水_木_金_土".split("_"),
        weekdaysMin:"日_月_火_水_木_金_土".split("_"),
        longDateFormat:{
            LT:"Ah時m分",
            L:"YYYY/MM/DD",
            LL:"YYYY年M月D日",
            LLL:"YYYY年M月D日LT",
            LLLL:"YYYY年M月D日LT dddd"
        },
        meridiem:function(n){
            return n<12?"午前":"午後"
            },
        calendar:{
            sameDay:"[今日] LT",
            nextDay:"[明日] LT",
            nextWeek:"[来週]dddd LT",
            lastDay:"[昨日] LT",
            lastWeek:"[前週]dddd LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s後",
            past:"%s前",
            s:"数秒",
            m:"1分",
            mm:"%d分",
            h:"1時間",
            hh:"%d時間",
            d:"1日",
            dd:"%d日",
            M:"1ヶ月",
            MM:"%dヶ月",
            y:"1年",
            yy:"%d年"
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function t(n,t){
        var i={
            nominative:"იანვარი_თებერვალი_მარტი_აპრილი_მაისი_ივნისი_ივლისი_აგვისტო_სექტემბერი_ოქტომბერი_ნოემბერი_დეკემბერი".split("_"),
            accusative:"იანვარს_თებერვალს_მარტს_აპრილის_მაისს_ივნისს_ივლისს_აგვისტს_სექტემბერს_ოქტომბერს_ნოემბერს_დეკემბერს".split("_")
            },r=/D[oD] *MMMM?/.test(t)?"accusative":"nominative";
        return i[r][n.month()]
        }
        function i(n,t){
        var i={
            nominative:"კვირა_ორშაბათი_სამშაბათი_ოთხშაბათი_ხუთშაბათი_პარასკევი_შაბათი".split("_"),
            accusative:"კვირას_ორშაბათს_სამშაბათს_ოთხშაბათს_ხუთშაბათს_პარასკევს_შაბათს".split("_")
            },r=/(წინა|შემდეგ)/.test(t)?"accusative":"nominative";
        return i[r][n.day()]
        }
        return n.lang("ka",{
        months:t,
        monthsShort:"იან_თებ_მარ_აპრ_მაი_ივნ_ივლ_აგვ_სექ_ოქტ_ნოე_დეკ".split("_"),
        weekdays:i,
        weekdaysShort:"კვი_ორშ_სამ_ოთხ_ხუთ_პარ_შაბ".split("_"),
        weekdaysMin:"კვ_ორ_სა_ოთ_ხუ_პა_შა".split("_"),
        longDateFormat:{
            LT:"h:mm A",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[დღეს] LT[-ზე]",
            nextDay:"[ხვალ] LT[-ზე]",
            lastDay:"[გუშინ] LT[-ზე]",
            nextWeek:"[შემდეგ] dddd LT[-ზე]",
            lastWeek:"[წინა] dddd LT-ზე",
            sameElse:"L"
        },
        relativeTime:{
            future:function(n){
                return/(წამი|წუთი|საათი|წელი)/.test(n)?n.replace(/ი$/,"ში"):n+"ში"
                },
            past:function(n){
                return/(წამი|წუთი|საათი|დღე|თვე)/.test(n)?n.replace(/(ი|ე)$/,"ის წინ"):/წელი/.test(n)?n.replace(/წელი$/,"წლის წინ"):void 0
                },
            s:"რამდენიმე წამი",
            m:"წუთი",
            mm:"%d წუთი",
            h:"საათი",
            hh:"%d საათი",
            d:"დღე",
            dd:"%d დღე",
            M:"თვე",
            MM:"%d თვე",
            y:"წელი",
            yy:"%d წელი"
        },
        ordinal:function(n){
            return n===0?n:n===1?n+"-ლი":n<20||n<=100&&n%20==0||n%100==0?"მე-"+n:n+"-ე"
            },
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("km",{
        months:"មករា_កុម្ភៈ_មិនា_មេសា_ឧសភា_មិថុនា_កក្កដា_សីហា_កញ្ញា_តុលា_វិច្ឆិកា_ធ្នូ".split("_"),
        monthsShort:"មករា_កុម្ភៈ_មិនា_មេសា_ឧសភា_មិថុនា_កក្កដា_សីហា_កញ្ញា_តុលា_វិច្ឆិកា_ធ្នូ".split("_"),
        weekdays:"អាទិត្យ_ច័ន្ទ_អង្គារ_ពុធ_ព្រហស្បតិ៍_សុក្រ_សៅរ៍".split("_"),
        weekdaysShort:"អាទិត្យ_ច័ន្ទ_អង្គារ_ពុធ_ព្រហស្បតិ៍_សុក្រ_សៅរ៍".split("_"),
        weekdaysMin:"អាទិត្យ_ច័ន្ទ_អង្គារ_ពុធ_ព្រហស្បតិ៍_សុក្រ_សៅរ៍".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[ថ្ងៃនៈ ម៉ោង] LT",
            nextDay:"[ស្អែក ម៉ោង] LT",
            nextWeek:"dddd [ម៉ោង] LT",
            lastDay:"[ម្សិលមិញ ម៉ោង] LT",
            lastWeek:"dddd [សប្តាហ៍មុន] [ម៉ោង] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%sទៀត",
            past:"%sមុន",
            s:"ប៉ុន្មានវិនាទី",
            m:"មួយនាទី",
            mm:"%d នាទី",
            h:"មួយម៉ោង",
            hh:"%d ម៉ោង",
            d:"មួយថ្ងៃ",
            dd:"%d ថ្ងៃ",
            M:"មួយខែ",
            MM:"%d ខែ",
            y:"មួយឆ្នាំ",
            yy:"%d ឆ្នាំ"
        },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("ko",{
        months:"1월_2월_3월_4월_5월_6월_7월_8월_9월_10월_11월_12월".split("_"),
        monthsShort:"1월_2월_3월_4월_5월_6월_7월_8월_9월_10월_11월_12월".split("_"),
        weekdays:"일요일_월요일_화요일_수요일_목요일_금요일_토요일".split("_"),
        weekdaysShort:"일_월_화_수_목_금_토".split("_"),
        weekdaysMin:"일_월_화_수_목_금_토".split("_"),
        longDateFormat:{
            LT:"A h시 mm분",
            L:"YYYY.MM.DD",
            LL:"YYYY년 MMMM D일",
            LLL:"YYYY년 MMMM D일 LT",
            LLLL:"YYYY년 MMMM D일 dddd LT"
        },
        meridiem:function(n){
            return n<12?"오전":"오후"
            },
        calendar:{
            sameDay:"오늘 LT",
            nextDay:"내일 LT",
            nextWeek:"dddd LT",
            lastDay:"어제 LT",
            lastWeek:"지난주 dddd LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s 후",
            past:"%s 전",
            s:"몇초",
            ss:"%d초",
            m:"일분",
            mm:"%d분",
            h:"한시간",
            hh:"%d시간",
            d:"하루",
            dd:"%d일",
            M:"한달",
            MM:"%d달",
            y:"일년",
            yy:"%d년"
        },
        ordinal:"%d일",
        meridiemParse:/(오전|오후)/,
        isPM:function(n){
            return n==="오후"
            }
        })
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i){
        var r={
            m:["eng Minutt","enger Minutt"],
            h:["eng Stonn","enger Stonn"],
            d:["een Dag","engem Dag"],
            dd:[n+" Deeg",n+" Deeg"],
            M:["ee Mount","engem Mount"],
            MM:[n+" Méint",n+" Méint"],
            y:["ee Joer","engem Joer"],
            yy:[n+" Joer",n+" Joer"]
            };
            
        return t?r[i][0]:r[i][1]
        }
        function r(n){
        var t=n.substr(0,n.indexOf(" "));
        return i(t)?"a "+n:"an "+n
        }
        function u(n){
        var t=n.substr(0,n.indexOf(" "));
        return i(t)?"viru "+n:"virun "+n
        }
        function f(){
        var n=this.format("d");
        return e(n)?"[Leschte] dddd [um] LT":"[Leschten] dddd [um] LT"
        }
        function e(n){
        n=parseInt(n,10);
        switch(n){
            case 0:case 1:case 3:case 5:case 6:
                return!0;
            default:
                return!1
                }
            }
    function i(n){
    if(n=parseInt(n,10),isNaN(n))return!1;
    if(n<0)return!0;
    if(n<10)return 4<=n&&n<=7?!0:!1;
    if(n<100){
        var t=n%10,r=n/10;
        return t===0?i(r):i(t)
        }
        if(n<1e4){
        while(n>=10)n=n/10;
        return i(n)
        }
        return n=n/1e3,i(n)
    }
    return n.lang("lb",{
    months:"Januar_Februar_Mäerz_Abrëll_Mee_Juni_Juli_August_September_Oktober_November_Dezember".split("_"),
    monthsShort:"Jan._Febr._Mrz._Abr._Mee_Jun._Jul._Aug._Sept._Okt._Nov._Dez.".split("_"),
    weekdays:"Sonndeg_Méindeg_Dënschdeg_Mëttwoch_Donneschdeg_Freideg_Samschdeg".split("_"),
    weekdaysShort:"So._Mé._Dë._Më._Do._Fr._Sa.".split("_"),
    weekdaysMin:"So_Mé_Dë_Më_Do_Fr_Sa".split("_"),
    longDateFormat:{
        LT:"H:mm [Auer]",
        L:"DD.MM.YYYY",
        LL:"D. MMMM YYYY",
        LLL:"D. MMMM YYYY LT",
        LLLL:"dddd, D. MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[Haut um] LT",
        sameElse:"L",
        nextDay:"[Muer um] LT",
        nextWeek:"dddd [um] LT",
        lastDay:"[Gëschter um] LT",
        lastWeek:f
    },
    relativeTime:{
        future:r,
        past:u,
        s:"e puer Sekonnen",
        m:t,
        mm:"%d Minutten",
        h:t,
        hh:"%d Stonnen",
        d:t,
        dd:t,
        M:t,
        MM:t,
        y:t,
        yy:t
    },
    ordinal:"%d.",
    week:{
        dow:1,
        doy:4
    }
})
}),function(n){
    n(t)
    }(function(n){
    function o(n,t,i,r){
        return t?"kelios sekundės":r?"kelių sekundžių":"kelias sekundes"
        }
        function i(n,i,r,u){
        return i?t(r)[0]:u?t(r)[1]:t(r)[2]
        }
        function u(n){
        return n%10==0||n>10&&n<20
        }
        function t(n){
        return f[n].split("_")
        }
        function r(n,r,f,e){
        var o=n+" ";
        return n===1?o+i(n,r,f[0],e):r?o+(u(n)?t(f)[1]:t(f)[0]):e?o+t(f)[1]:o+(u(n)?t(f)[1]:t(f)[2])
        }
        function s(n,t){
        var r=t.indexOf("dddd HH:mm")===-1,i=e[n.day()];
        return r?i:i.substring(0,i.length-2)+"į"
        }
        var f={
        m:"minutė_minutės_minutę",
        mm:"minutės_minučių_minutes",
        h:"valanda_valandos_valandą",
        hh:"valandos_valandų_valandas",
        d:"diena_dienos_dieną",
        dd:"dienos_dienų_dienas",
        M:"mėnuo_mėnesio_mėnesį",
        MM:"mėnesiai_mėnesių_mėnesius",
        y:"metai_metų_metus",
        yy:"metai_metų_metus"
    },e="sekmadienis_pirmadienis_antradienis_trečiadienis_ketvirtadienis_penktadienis_šeštadienis".split("_");
    return n.lang("lt",{
        months:"sausio_vasario_kovo_balandžio_gegužės_biržėlio_liepos_rugpjūčio_rugsėjo_spalio_lapkričio_gruodžio".split("_"),
        monthsShort:"sau_vas_kov_bal_geg_bir_lie_rgp_rgs_spa_lap_grd".split("_"),
        weekdays:s,
        weekdaysShort:"Sek_Pir_Ant_Tre_Ket_Pen_Šeš".split("_"),
        weekdaysMin:"S_P_A_T_K_Pn_Š".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"YYYY-MM-DD",
            LL:"YYYY [m.] MMMM D [d.]",
            LLL:"YYYY [m.] MMMM D [d.], LT [val.]",
            LLLL:"YYYY [m.] MMMM D [d.], dddd, LT [val.]",
            l:"YYYY-MM-DD",
            ll:"YYYY [m.] MMMM D [d.]",
            lll:"YYYY [m.] MMMM D [d.], LT [val.]",
            llll:"YYYY [m.] MMMM D [d.], ddd, LT [val.]"
        },
        calendar:{
            sameDay:"[Šiandien] LT",
            nextDay:"[Rytoj] LT",
            nextWeek:"dddd LT",
            lastDay:"[Vakar] LT",
            lastWeek:"[Praėjusį] dddd LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"po %s",
            past:"prieš %s",
            s:o,
            m:i,
            mm:r,
            h:i,
            hh:r,
            d:i,
            dd:r,
            M:i,
            MM:r,
            y:i,
            yy:r
        },
        ordinal:function(n){
            return n+"-oji"
            },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function r(n,t,i){
        var r=n.split("_");
        return i?t%10==1&&t!==11?r[2]:r[3]:t%10==1&&t!==11?r[0]:r[1]
        }
        function t(n,t,u){
        return n+" "+r(i[u],n,t)
        }
        var i={
        mm:"minūti_minūtes_minūte_minūtes",
        hh:"stundu_stundas_stunda_stundas",
        dd:"dienu_dienas_diena_dienas",
        MM:"mēnesi_mēnešus_mēnesis_mēneši",
        yy:"gadu_gadus_gads_gadi"
    };
    
    return n.lang("lv",{
        months:"janvāris_februāris_marts_aprīlis_maijs_jūnijs_jūlijs_augusts_septembris_oktobris_novembris_decembris".split("_"),
        monthsShort:"jan_feb_mar_apr_mai_jūn_jūl_aug_sep_okt_nov_dec".split("_"),
        weekdays:"svētdiena_pirmdiena_otrdiena_trešdiena_ceturtdiena_piektdiena_sestdiena".split("_"),
        weekdaysShort:"Sv_P_O_T_C_Pk_S".split("_"),
        weekdaysMin:"Sv_P_O_T_C_Pk_S".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD.MM.YYYY",
            LL:"YYYY. [gada] D. MMMM",
            LLL:"YYYY. [gada] D. MMMM, LT",
            LLLL:"YYYY. [gada] D. MMMM, dddd, LT"
        },
        calendar:{
            sameDay:"[Šodien pulksten] LT",
            nextDay:"[Rīt pulksten] LT",
            nextWeek:"dddd [pulksten] LT",
            lastDay:"[Vakar pulksten] LT",
            lastWeek:"[Pagājušā] dddd [pulksten] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s vēlāk",
            past:"%s agrāk",
            s:"dažas sekundes",
            m:"minūti",
            mm:t,
            h:"stundu",
            hh:t,
            d:"dienu",
            dd:t,
            M:"mēnesi",
            MM:t,
            y:"gadu",
            yy:t
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("mk",{
        months:"јануари_февруари_март_април_мај_јуни_јули_август_септември_октомври_ноември_декември".split("_"),
        monthsShort:"јан_фев_мар_апр_мај_јун_јул_авг_сеп_окт_ное_дек".split("_"),
        weekdays:"недела_понеделник_вторник_среда_четврток_петок_сабота".split("_"),
        weekdaysShort:"нед_пон_вто_сре_чет_пет_саб".split("_"),
        weekdaysMin:"нe_пo_вт_ср_че_пе_сa".split("_"),
        longDateFormat:{
            LT:"H:mm",
            L:"D.MM.YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Денес во] LT",
            nextDay:"[Утре во] LT",
            nextWeek:"dddd [во] LT",
            lastDay:"[Вчера во] LT",
            lastWeek:function(){
                switch(this.day()){
                    case 0:case 3:case 6:
                        return"[Во изминатата] dddd [во] LT";
                    case 1:case 2:case 4:case 5:
                        return"[Во изминатиот] dddd [во] LT"
                        }
                    },
        sameElse:"L"
    },
    relativeTime:{
        future:"после %s",
        past:"пред %s",
        s:"неколку секунди",
        m:"минута",
        mm:"%d минути",
        h:"час",
        hh:"%d часа",
        d:"ден",
        dd:"%d дена",
        M:"месец",
        MM:"%d месеци",
        y:"година",
        yy:"%d години"
    },
    ordinal:function(n){
        var t=n%10,i=n%100;
        return n===0?n+"-ев":i===0?n+"-ен":i>10&&i<20?n+"-ти":t===1?n+"-ви":t===2?n+"-ри":t===7||t===8?n+"-ми":n+"-ти"
        },
    week:{
        dow:1,
        doy:7
    }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("ml",{
        months:"ജനുവരി_ഫെബ്രുവരി_മാർച്ച്_ഏപ്രിൽ_മേയ്_ജൂൺ_ജൂലൈ_ഓഗസ്റ്റ്_സെപ്റ്റംബർ_ഒക്ടോബർ_നവംബർ_ഡിസംബർ".split("_"),
        monthsShort:"ജനു._ഫെബ്രു._മാർ._ഏപ്രി._മേയ്_ജൂൺ_ജൂലൈ._ഓഗ._സെപ്റ്റ._ഒക്ടോ._നവം._ഡിസം.".split("_"),
        weekdays:"ഞായറാഴ്ച_തിങ്കളാഴ്ച_ചൊവ്വാഴ്ച_ബുധനാഴ്ച_വ്യാഴാഴ്ച_വെള്ളിയാഴ്ച_ശനിയാഴ്ച".split("_"),
        weekdaysShort:"ഞായർ_തിങ്കൾ_ചൊവ്വ_ബുധൻ_വ്യാഴം_വെള്ളി_ശനി".split("_"),
        weekdaysMin:"ഞാ_തി_ചൊ_ബു_വ്യാ_വെ_ശ".split("_"),
        longDateFormat:{
            LT:"A h:mm -നു",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY, LT",
            LLLL:"dddd, D MMMM YYYY, LT"
        },
        calendar:{
            sameDay:"[ഇന്ന്] LT",
            nextDay:"[നാളെ] LT",
            nextWeek:"dddd, LT",
            lastDay:"[ഇന്നലെ] LT",
            lastWeek:"[കഴിഞ്ഞ] dddd, LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s കഴിഞ്ഞ്",
            past:"%s മുൻപ്",
            s:"അൽപ നിമിഷങ്ങൾ",
            m:"ഒരു മിനിറ്റ്",
            mm:"%d മിനിറ്റ്",
            h:"ഒരു മണിക്കൂർ",
            hh:"%d മണിക്കൂർ",
            d:"ഒരു ദിവസം",
            dd:"%d ദിവസം",
            M:"ഒരു മാസം",
            MM:"%d മാസം",
            y:"ഒരു വർഷം",
            yy:"%d വർഷം"
        },
        meridiem:function(n){
            return n<4?"രാത്രി":n<12?"രാവിലെ":n<17?"ഉച്ച കഴിഞ്ഞ്":n<20?"വൈകുന്നേരം":"രാത്രി"
            }
        })
}),function(n){
    n(t)
    }(function(n){
    var t={
        "1":"१",
        "2":"२",
        "3":"३",
        "4":"४",
        "5":"५",
        "6":"६",
        "7":"७",
        "8":"८",
        "9":"९",
        "0":"०"
    },i={
        "१":"1",
        "२":"2",
        "३":"3",
        "४":"4",
        "५":"5",
        "६":"6",
        "७":"7",
        "८":"8",
        "९":"9",
        "०":"0"
    };
    
    return n.lang("mr",{
        months:"जानेवारी_फेब्रुवारी_मार्च_एप्रिल_मे_जून_जुलै_ऑगस्ट_सप्टेंबर_ऑक्टोबर_नोव्हेंबर_डिसेंबर".split("_"),
        monthsShort:"जाने._फेब्रु._मार्च._एप्रि._मे._जून._जुलै._ऑग._सप्टें._ऑक्टो._नोव्हें._डिसें.".split("_"),
        weekdays:"रविवार_सोमवार_मंगळवार_बुधवार_गुरूवार_शुक्रवार_शनिवार".split("_"),
        weekdaysShort:"रवि_सोम_मंगळ_बुध_गुरू_शुक्र_शनि".split("_"),
        weekdaysMin:"र_सो_मं_बु_गु_शु_श".split("_"),
        longDateFormat:{
            LT:"A h:mm वाजता",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY, LT",
            LLLL:"dddd, D MMMM YYYY, LT"
        },
        calendar:{
            sameDay:"[आज] LT",
            nextDay:"[उद्या] LT",
            nextWeek:"dddd, LT",
            lastDay:"[काल] LT",
            lastWeek:"[मागील] dddd, LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s नंतर",
            past:"%s पूर्वी",
            s:"सेकंद",
            m:"एक मिनिट",
            mm:"%d मिनिटे",
            h:"एक तास",
            hh:"%d तास",
            d:"एक दिवस",
            dd:"%d दिवस",
            M:"एक महिना",
            MM:"%d महिने",
            y:"एक वर्ष",
            yy:"%d वर्षे"
        },
        preparse:function(n){
            return n.replace(/[१२३४५६७८९०]/g,function(n){
                return i[n]
                })
            },
        postformat:function(n){
            return n.replace(/\d/g,function(n){
                return t[n]
                })
            },
        meridiem:function(n){
            return n<4?"रात्री":n<10?"सकाळी":n<17?"दुपारी":n<20?"सायंकाळी":"रात्री"
            },
        week:{
            dow:0,
            doy:6
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("ms-my",{
        months:"Januari_Februari_Mac_April_Mei_Jun_Julai_Ogos_September_Oktober_November_Disember".split("_"),
        monthsShort:"Jan_Feb_Mac_Apr_Mei_Jun_Jul_Ogs_Sep_Okt_Nov_Dis".split("_"),
        weekdays:"Ahad_Isnin_Selasa_Rabu_Khamis_Jumaat_Sabtu".split("_"),
        weekdaysShort:"Ahd_Isn_Sel_Rab_Kha_Jum_Sab".split("_"),
        weekdaysMin:"Ah_Is_Sl_Rb_Km_Jm_Sb".split("_"),
        longDateFormat:{
            LT:"HH.mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY [pukul] LT",
            LLLL:"dddd, D MMMM YYYY [pukul] LT"
        },
        meridiem:function(n){
            return n<11?"pagi":n<15?"tengahari":n<19?"petang":"malam"
            },
        calendar:{
            sameDay:"[Hari ini pukul] LT",
            nextDay:"[Esok pukul] LT",
            nextWeek:"dddd [pukul] LT",
            lastDay:"[Kelmarin pukul] LT",
            lastWeek:"dddd [lepas pukul] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"dalam %s",
            past:"%s yang lepas",
            s:"beberapa saat",
            m:"seminit",
            mm:"%d minit",
            h:"sejam",
            hh:"%d jam",
            d:"sehari",
            dd:"%d hari",
            M:"sebulan",
            MM:"%d bulan",
            y:"setahun",
            yy:"%d tahun"
        },
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("nb",{
        months:"januar_februar_mars_april_mai_juni_juli_august_september_oktober_november_desember".split("_"),
        monthsShort:"jan._feb._mars_april_mai_juni_juli_aug._sep._okt._nov._des.".split("_"),
        weekdays:"søndag_mandag_tirsdag_onsdag_torsdag_fredag_lørdag".split("_"),
        weekdaysShort:"sø._ma._ti._on._to._fr._lø.".split("_"),
        weekdaysMin:"sø_ma_ti_on_to_fr_lø".split("_"),
        longDateFormat:{
            LT:"H.mm",
            L:"DD.MM.YYYY",
            LL:"D. MMMM YYYY",
            LLL:"D. MMMM YYYY [kl.] LT",
            LLLL:"dddd D. MMMM YYYY [kl.] LT"
        },
        calendar:{
            sameDay:"[i dag kl.] LT",
            nextDay:"[i morgen kl.] LT",
            nextWeek:"dddd [kl.] LT",
            lastDay:"[i går kl.] LT",
            lastWeek:"[forrige] dddd [kl.] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"om %s",
            past:"for %s siden",
            s:"noen sekunder",
            m:"ett minutt",
            mm:"%d minutter",
            h:"en time",
            hh:"%d timer",
            d:"en dag",
            dd:"%d dager",
            M:"en måned",
            MM:"%d måneder",
            y:"ett år",
            yy:"%d år"
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    var t={
        "1":"१",
        "2":"२",
        "3":"३",
        "4":"४",
        "5":"५",
        "6":"६",
        "7":"७",
        "8":"८",
        "9":"९",
        "0":"०"
    },i={
        "१":"1",
        "२":"2",
        "३":"3",
        "४":"4",
        "५":"5",
        "६":"6",
        "७":"7",
        "८":"8",
        "९":"9",
        "०":"0"
    };
    
    return n.lang("ne",{
        months:"जनवरी_फेब्रुवरी_मार्च_अप्रिल_मई_जुन_जुलाई_अगष्ट_सेप्टेम्बर_अक्टोबर_नोभेम्बर_डिसेम्बर".split("_"),
        monthsShort:"जन._फेब्रु._मार्च_अप्रि._मई_जुन_जुलाई._अग._सेप्ट._अक्टो._नोभे._डिसे.".split("_"),
        weekdays:"आइतबार_सोमबार_मङ्गलबार_बुधबार_बिहिबार_शुक्रबार_शनिबार".split("_"),
        weekdaysShort:"आइत._सोम._मङ्गल._बुध._बिहि._शुक्र._शनि.".split("_"),
        weekdaysMin:"आइ._सो._मङ्_बु._बि._शु._श.".split("_"),
        longDateFormat:{
            LT:"Aको h:mm बजे",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY, LT",
            LLLL:"dddd, D MMMM YYYY, LT"
        },
        preparse:function(n){
            return n.replace(/[१२३४५६७८९०]/g,function(n){
                return i[n]
                })
            },
        postformat:function(n){
            return n.replace(/\d/g,function(n){
                return t[n]
                })
            },
        meridiem:function(n){
            return n<3?"राती":n<10?"बिहान":n<15?"दिउँसो":n<18?"बेलुका":n<20?"साँझ":"राती"
            },
        calendar:{
            sameDay:"[आज] LT",
            nextDay:"[भोली] LT",
            nextWeek:"[आउँदो] dddd[,] LT",
            lastDay:"[हिजो] LT",
            lastWeek:"[गएको] dddd[,] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%sमा",
            past:"%s अगाडी",
            s:"केही समय",
            m:"एक मिनेट",
            mm:"%d मिनेट",
            h:"एक घण्टा",
            hh:"%d घण्टा",
            d:"एक दिन",
            dd:"%d दिन",
            M:"एक महिना",
            MM:"%d महिना",
            y:"एक बर्ष",
            yy:"%d बर्ष"
        },
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    var t="jan._feb._mrt._apr._mei_jun._jul._aug._sep._okt._nov._dec.".split("_"),i="jan_feb_mrt_apr_mei_jun_jul_aug_sep_okt_nov_dec".split("_");
    return n.lang("nl",{
        months:"januari_februari_maart_april_mei_juni_juli_augustus_september_oktober_november_december".split("_"),
        monthsShort:function(n,r){
            return/-MMM-/.test(r)?i[n.month()]:t[n.month()]
            },
        weekdays:"zondag_maandag_dinsdag_woensdag_donderdag_vrijdag_zaterdag".split("_"),
        weekdaysShort:"zo._ma._di._wo._do._vr._za.".split("_"),
        weekdaysMin:"Zo_Ma_Di_Wo_Do_Vr_Za".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD-MM-YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[vandaag om] LT",
            nextDay:"[morgen om] LT",
            nextWeek:"dddd [om] LT",
            lastDay:"[gisteren om] LT",
            lastWeek:"[afgelopen] dddd [om] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"over %s",
            past:"%s geleden",
            s:"een paar seconden",
            m:"één minuut",
            mm:"%d minuten",
            h:"één uur",
            hh:"%d uur",
            d:"één dag",
            dd:"%d dagen",
            M:"één maand",
            MM:"%d maanden",
            y:"één jaar",
            yy:"%d jaar"
        },
        ordinal:function(n){
            return n+(n===1||n===8||n>=20?"ste":"de")
            },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("nn",{
        months:"januar_februar_mars_april_mai_juni_juli_august_september_oktober_november_desember".split("_"),
        monthsShort:"jan_feb_mar_apr_mai_jun_jul_aug_sep_okt_nov_des".split("_"),
        weekdays:"sundag_måndag_tysdag_onsdag_torsdag_fredag_laurdag".split("_"),
        weekdaysShort:"sun_mån_tys_ons_tor_fre_lau".split("_"),
        weekdaysMin:"su_må_ty_on_to_fr_lø".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD.MM.YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[I dag klokka] LT",
            nextDay:"[I morgon klokka] LT",
            nextWeek:"dddd [klokka] LT",
            lastDay:"[I går klokka] LT",
            lastWeek:"[Føregåande] dddd [klokka] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"om %s",
            past:"for %s sidan",
            s:"nokre sekund",
            m:"eit minutt",
            mm:"%d minutt",
            h:"ein time",
            hh:"%d timar",
            d:"ein dag",
            dd:"%d dagar",
            M:"ein månad",
            MM:"%d månader",
            y:"eit år",
            yy:"%d år"
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function i(n){
        return n%10<5&&n%10>1&&~~(n/10)%10!=1
        }
        function t(n,t,r){
        var u=n+" ";
        switch(r){
            case"m":
                return t?"minuta":"minutę";
            case"mm":
                return u+(i(n)?"minuty":"minut");
            case"h":
                return t?"godzina":"godzinę";
            case"hh":
                return u+(i(n)?"godziny":"godzin");
            case"MM":
                return u+(i(n)?"miesiące":"miesięcy");
            case"yy":
                return u+(i(n)?"lata":"lat")
                }
            }
    var r="styczeń_luty_marzec_kwiecień_maj_czerwiec_lipiec_sierpień_wrzesień_październik_listopad_grudzień".split("_"),u="stycznia_lutego_marca_kwietnia_maja_czerwca_lipca_sierpnia_września_października_listopada_grudnia".split("_");
    return n.lang("pl",{
    months:function(n,t){
        return/D MMMM/.test(t)?u[n.month()]:r[n.month()]
        },
    monthsShort:"sty_lut_mar_kwi_maj_cze_lip_sie_wrz_paź_lis_gru".split("_"),
    weekdays:"niedziela_poniedziałek_wtorek_środa_czwartek_piątek_sobota".split("_"),
    weekdaysShort:"nie_pon_wt_śr_czw_pt_sb".split("_"),
    weekdaysMin:"N_Pn_Wt_Śr_Cz_Pt_So".split("_"),
    longDateFormat:{
        LT:"HH:mm",
        L:"DD.MM.YYYY",
        LL:"D MMMM YYYY",
        LLL:"D MMMM YYYY LT",
        LLLL:"dddd, D MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[Dziś o] LT",
        nextDay:"[Jutro o] LT",
        nextWeek:"[W] dddd [o] LT",
        lastDay:"[Wczoraj o] LT",
        lastWeek:function(){
            switch(this.day()){
                case 0:
                    return"[W zeszłą niedzielę o] LT";
                case 3:
                    return"[W zeszłą środę o] LT";
                case 6:
                    return"[W zeszłą sobotę o] LT";
                default:
                    return"[W zeszły] dddd [o] LT"
                    }
                },
    sameElse:"L"
},
relativeTime:{
    future:"za %s",
    past:"%s temu",
    s:"kilka sekund",
    m:t,
    mm:t,
    h:t,
    hh:t,
    d:"1 dzień",
    dd:"%d dni",
    M:"miesiąc",
    MM:t,
    y:"rok",
    yy:t
},
ordinal:"%d.",
week:{
    dow:1,
    doy:4
}
})
}),function(n){
    n(t)
    }(function(n){
    return n.lang("pt-br",{
        months:"janeiro_fevereiro_março_abril_maio_junho_julho_agosto_setembro_outubro_novembro_dezembro".split("_"),
        monthsShort:"jan_fev_mar_abr_mai_jun_jul_ago_set_out_nov_dez".split("_"),
        weekdays:"domingo_segunda-feira_terça-feira_quarta-feira_quinta-feira_sexta-feira_sábado".split("_"),
        weekdaysShort:"dom_seg_ter_qua_qui_sex_sáb".split("_"),
        weekdaysMin:"dom_2ª_3ª_4ª_5ª_6ª_sáb".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D [de] MMMM [de] YYYY",
            LLL:"D [de] MMMM [de] YYYY [às] LT",
            LLLL:"dddd, D [de] MMMM [de] YYYY [às] LT"
        },
        calendar:{
            sameDay:"[Hoje às] LT",
            nextDay:"[Amanhã às] LT",
            nextWeek:"dddd [às] LT",
            lastDay:"[Ontem às] LT",
            lastWeek:function(){
                return this.day()===0||this.day()===6?"[Último] dddd [às] LT":"[Última] dddd [às] LT"
                },
            sameElse:"L"
        },
        relativeTime:{
            future:"em %s",
            past:"%s atrás",
            s:"segundos",
            m:"um minuto",
            mm:"%d minutos",
            h:"uma hora",
            hh:"%d horas",
            d:"um dia",
            dd:"%d dias",
            M:"um mês",
            MM:"%d meses",
            y:"um ano",
            yy:"%d anos"
        },
        ordinal:"%dº"
    })
    }),function(n){
    n(t)
    }(function(n){
    return n.lang("pt",{
        months:"janeiro_fevereiro_março_abril_maio_junho_julho_agosto_setembro_outubro_novembro_dezembro".split("_"),
        monthsShort:"jan_fev_mar_abr_mai_jun_jul_ago_set_out_nov_dez".split("_"),
        weekdays:"domingo_segunda-feira_terça-feira_quarta-feira_quinta-feira_sexta-feira_sábado".split("_"),
        weekdaysShort:"dom_seg_ter_qua_qui_sex_sáb".split("_"),
        weekdaysMin:"dom_2ª_3ª_4ª_5ª_6ª_sáb".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D [de] MMMM [de] YYYY",
            LLL:"D [de] MMMM [de] YYYY LT",
            LLLL:"dddd, D [de] MMMM [de] YYYY LT"
        },
        calendar:{
            sameDay:"[Hoje às] LT",
            nextDay:"[Amanhã às] LT",
            nextWeek:"dddd [às] LT",
            lastDay:"[Ontem às] LT",
            lastWeek:function(){
                return this.day()===0||this.day()===6?"[Último] dddd [às] LT":"[Última] dddd [às] LT"
                },
            sameElse:"L"
        },
        relativeTime:{
            future:"em %s",
            past:"há %s",
            s:"segundos",
            m:"um minuto",
            mm:"%d minutos",
            h:"uma hora",
            hh:"%d horas",
            d:"um dia",
            dd:"%d dias",
            M:"um mês",
            MM:"%d meses",
            y:"um ano",
            yy:"%d anos"
        },
        ordinal:"%dº",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i){
        var r=" ";
        return(n%100>=20||n>=100&&n%100==0)&&(r=" de "),n+r+{
            mm:"minute",
            hh:"ore",
            dd:"zile",
            MM:"luni",
            yy:"ani"
        }
        [i]
        }
        return n.lang("ro",{
        months:"ianuarie_februarie_martie_aprilie_mai_iunie_iulie_august_septembrie_octombrie_noiembrie_decembrie".split("_"),
        monthsShort:"ian._febr._mart._apr._mai_iun._iul._aug._sept._oct._nov._dec.".split("_"),
        weekdays:"duminică_luni_marți_miercuri_joi_vineri_sâmbătă".split("_"),
        weekdaysShort:"Dum_Lun_Mar_Mie_Joi_Vin_Sâm".split("_"),
        weekdaysMin:"Du_Lu_Ma_Mi_Jo_Vi_Sâ".split("_"),
        longDateFormat:{
            LT:"H:mm",
            L:"DD.MM.YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY H:mm",
            LLLL:"dddd, D MMMM YYYY H:mm"
        },
        calendar:{
            sameDay:"[azi la] LT",
            nextDay:"[mâine la] LT",
            nextWeek:"dddd [la] LT",
            lastDay:"[ieri la] LT",
            lastWeek:"[fosta] dddd [la] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"peste %s",
            past:"%s în urmă",
            s:"câteva secunde",
            m:"un minut",
            mm:t,
            h:"o oră",
            hh:t,
            d:"o zi",
            dd:t,
            M:"o lună",
            MM:t,
            y:"un an",
            yy:t
        },
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function i(n,t){
        var i=n.split("_");
        return t%10==1&&t%100!=11?i[0]:t%10>=2&&t%10<=4&&(t%100<10||t%100>=20)?i[1]:i[2]
        }
        function t(n,t,r){
        var u={
            mm:t?"минута_минуты_минут":"минуту_минуты_минут",
            hh:"час_часа_часов",
            dd:"день_дня_дней",
            MM:"месяц_месяца_месяцев",
            yy:"год_года_лет"
        };
        
        return r==="m"?t?"минута":"минуту":n+" "+i(u[r],+n)
        }
        function r(n,t){
        var i={
            nominative:"январь_февраль_март_апрель_май_июнь_июль_август_сентябрь_октябрь_ноябрь_декабрь".split("_"),
            accusative:"января_февраля_марта_апреля_мая_июня_июля_августа_сентября_октября_ноября_декабря".split("_")
            },r=/D[oD]?(\[[^\[\]]*\]|\s+)+MMMM?/.test(t)?"accusative":"nominative";
        return i[r][n.month()]
        }
        function u(n,t){
        var i={
            nominative:"янв_фев_мар_апр_май_июнь_июль_авг_сен_окт_ноя_дек".split("_"),
            accusative:"янв_фев_мар_апр_мая_июня_июля_авг_сен_окт_ноя_дек".split("_")
            },r=/D[oD]?(\[[^\[\]]*\]|\s+)+MMMM?/.test(t)?"accusative":"nominative";
        return i[r][n.month()]
        }
        function f(n,t){
        var i={
            nominative:"воскресенье_понедельник_вторник_среда_четверг_пятница_суббота".split("_"),
            accusative:"воскресенье_понедельник_вторник_среду_четверг_пятницу_субботу".split("_")
            },r=/\[ ?[Вв] ?(?:прошлую|следующую)? ?\] ?dddd/.test(t)?"accusative":"nominative";
        return i[r][n.day()]
        }
        return n.lang("ru",{
        months:r,
        monthsShort:u,
        weekdays:f,
        weekdaysShort:"вс_пн_вт_ср_чт_пт_сб".split("_"),
        weekdaysMin:"вс_пн_вт_ср_чт_пт_сб".split("_"),
        monthsParse:[/^янв/i,/^фев/i,/^мар/i,/^апр/i,/^ма[й|я]/i,/^июн/i,/^июл/i,/^авг/i,/^сен/i,/^окт/i,/^ноя/i,/^дек/i],
        longDateFormat:{
            LT:"HH:mm",
            L:"DD.MM.YYYY",
            LL:"D MMMM YYYY г.",
            LLL:"D MMMM YYYY г., LT",
            LLLL:"dddd, D MMMM YYYY г., LT"
        },
        calendar:{
            sameDay:"[Сегодня в] LT",
            nextDay:"[Завтра в] LT",
            lastDay:"[Вчера в] LT",
            nextWeek:function(){
                return this.day()===2?"[Во] dddd [в] LT":"[В] dddd [в] LT"
                },
            lastWeek:function(){
                switch(this.day()){
                    case 0:
                        return"[В прошлое] dddd [в] LT";
                    case 1:case 2:case 4:
                        return"[В прошлый] dddd [в] LT";
                    case 3:case 5:case 6:
                        return"[В прошлую] dddd [в] LT"
                        }
                    },
        sameElse:"L"
    },
    relativeTime:{
        future:"через %s",
        past:"%s назад",
        s:"несколько секунд",
        m:t,
        mm:t,
        h:"час",
        hh:t,
        d:"день",
        dd:t,
        M:"месяц",
        MM:t,
        y:"год",
        yy:t
    },
    meridiemParse:/ночи|утра|дня|вечера/i,
    isPM:function(n){
        return/^(дня|вечера)$/.test(n)
        },
    meridiem:function(n){
        return n<4?"ночи":n<12?"утра":n<17?"дня":"вечера"
        },
    ordinal:function(n,t){
        switch(t){
            case"M":case"d":case"DDD":
                return n+"-й";
            case"D":
                return n+"-го";
            case"w":case"W":
                return n+"-я";
            default:
                return n
                }
            },
    week:{
        dow:1,
        doy:7
    }
})
}),function(n){
    n(t)
    }(function(n){
    function i(n){
        return n>1&&n<5
        }
        function t(n,t,r,u){
        var f=n+" ";
        switch(r){
            case"s":
                return t||u?"pár sekúnd":"pár sekundami";
            case"m":
                return t?"minúta":u?"minútu":"minútou";
            case"mm":
                return t||u?f+(i(n)?"minúty":"minút"):f+"minútami";
            case"h":
                return t?"hodina":u?"hodinu":"hodinou";
            case"hh":
                return t||u?f+(i(n)?"hodiny":"hodín"):f+"hodinami";
            case"d":
                return t||u?"deň":"dňom";
            case"dd":
                return t||u?f+(i(n)?"dni":"dní"):f+"dňami";
            case"M":
                return t||u?"mesiac":"mesiacom";
            case"MM":
                return t||u?f+(i(n)?"mesiace":"mesiacov"):f+"mesiacmi";
            case"y":
                return t||u?"rok":"rokom";
            case"yy":
                return t||u?f+(i(n)?"roky":"rokov"):f+"rokmi"
                }
            }
    var r="január_február_marec_apríl_máj_jún_júl_august_september_október_november_december".split("_"),u="jan_feb_mar_apr_máj_jún_júl_aug_sep_okt_nov_dec".split("_");
    return n.lang("sk",{
    months:r,
    monthsShort:u,
    monthsParse:function(n,t){
        for(var r=[],i=0;i<12;i++)r[i]=new RegExp("^"+n[i]+"$|^"+t[i]+"$","i");
        return r
        }(r,u),
    weekdays:"nedeľa_pondelok_utorok_streda_štvrtok_piatok_sobota".split("_"),
    weekdaysShort:"ne_po_ut_st_št_pi_so".split("_"),
    weekdaysMin:"ne_po_ut_st_št_pi_so".split("_"),
    longDateFormat:{
        LT:"H:mm",
        L:"DD.MM.YYYY",
        LL:"D. MMMM YYYY",
        LLL:"D. MMMM YYYY LT",
        LLLL:"dddd D. MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[dnes o] LT",
        nextDay:"[zajtra o] LT",
        nextWeek:function(){
            switch(this.day()){
                case 0:
                    return"[v nedeľu o] LT";
                case 1:case 2:
                    return"[v] dddd [o] LT";
                case 3:
                    return"[v stredu o] LT";
                case 4:
                    return"[vo štvrtok o] LT";
                case 5:
                    return"[v piatok o] LT";
                case 6:
                    return"[v sobotu o] LT"
                    }
                },
    lastDay:"[včera o] LT",
    lastWeek:function(){
        switch(this.day()){
            case 0:
                return"[minulú nedeľu o] LT";
            case 1:case 2:
                return"[minulý] dddd [o] LT";
            case 3:
                return"[minulú stredu o] LT";
            case 4:case 5:
                return"[minulý] dddd [o] LT";
            case 6:
                return"[minulú sobotu o] LT"
                }
            },
sameElse:"L"
},
relativeTime:{
    future:"za %s",
    past:"pred %s",
    s:t,
    m:t,
    mm:t,
    h:t,
    hh:t,
    d:t,
    dd:t,
    M:t,
    MM:t,
    y:t,
    yy:t
},
ordinal:"%d.",
week:{
    dow:1,
    doy:4
}
})
}),function(n){
    n(t)
    }(function(n){
    function t(n,t,i){
        var r=n+" ";
        switch(i){
            case"m":
                return t?"ena minuta":"eno minuto";
            case"mm":
                return r+(n===1?"minuta":n===2?"minuti":n===3||n===4?"minute":"minut");
            case"h":
                return t?"ena ura":"eno uro";
            case"hh":
                return r+(n===1?"ura":n===2?"uri":n===3||n===4?"ure":"ur");
            case"dd":
                return r+(n===1?"dan":"dni");
            case"MM":
                return r+(n===1?"mesec":n===2?"meseca":n===3||n===4?"mesece":"mesecev");
            case"yy":
                return r+(n===1?"leto":n===2?"leti":n===3||n===4?"leta":"let")
                }
            }
    return n.lang("sl",{
    months:"januar_februar_marec_april_maj_junij_julij_avgust_september_oktober_november_december".split("_"),
    monthsShort:"jan._feb._mar._apr._maj._jun._jul._avg._sep._okt._nov._dec.".split("_"),
    weekdays:"nedelja_ponedeljek_torek_sreda_četrtek_petek_sobota".split("_"),
    weekdaysShort:"ned._pon._tor._sre._čet._pet._sob.".split("_"),
    weekdaysMin:"ne_po_to_sr_če_pe_so".split("_"),
    longDateFormat:{
        LT:"H:mm",
        L:"DD. MM. YYYY",
        LL:"D. MMMM YYYY",
        LLL:"D. MMMM YYYY LT",
        LLLL:"dddd, D. MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[danes ob] LT",
        nextDay:"[jutri ob] LT",
        nextWeek:function(){
            switch(this.day()){
                case 0:
                    return"[v] [nedeljo] [ob] LT";
                case 3:
                    return"[v] [sredo] [ob] LT";
                case 6:
                    return"[v] [soboto] [ob] LT";
                case 1:case 2:case 4:case 5:
                    return"[v] dddd [ob] LT"
                    }
                },
    lastDay:"[včeraj ob] LT",
    lastWeek:function(){
        switch(this.day()){
            case 0:case 3:case 6:
                return"[prejšnja] dddd [ob] LT";
            case 1:case 2:case 4:case 5:
                return"[prejšnji] dddd [ob] LT"
                }
            },
sameElse:"L"
},
relativeTime:{
    future:"čez %s",
    past:"%s nazaj",
    s:"nekaj sekund",
    m:t,
    mm:t,
    h:t,
    hh:t,
    d:"en dan",
    dd:t,
    M:"en mesec",
    MM:t,
    y:"eno leto",
    yy:t
},
ordinal:"%d.",
week:{
    dow:1,
    doy:7
}
})
}),function(n){
    n(t)
    }(function(n){
    return n.lang("sq",{
        months:"Janar_Shkurt_Mars_Prill_Maj_Qershor_Korrik_Gusht_Shtator_Tetor_Nëntor_Dhjetor".split("_"),
        monthsShort:"Jan_Shk_Mar_Pri_Maj_Qer_Kor_Gus_Sht_Tet_Nën_Dhj".split("_"),
        weekdays:"E Diel_E Hënë_E Martë_E Mërkurë_E Enjte_E Premte_E Shtunë".split("_"),
        weekdaysShort:"Die_Hën_Mar_Mër_Enj_Pre_Sht".split("_"),
        weekdaysMin:"D_H_Ma_Më_E_P_Sh".split("_"),
        meridiem:function(n){
            return n<12?"PD":"MD"
            },
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Sot në] LT",
            nextDay:"[Nesër në] LT",
            nextWeek:"dddd [në] LT",
            lastDay:"[Dje në] LT",
            lastWeek:"dddd [e kaluar në] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"në %s",
            past:"%s më parë",
            s:"disa sekonda",
            m:"një minutë",
            mm:"%d minuta",
            h:"një orë",
            hh:"%d orë",
            d:"një ditë",
            dd:"%d ditë",
            M:"një muaj",
            MM:"%d muaj",
            y:"një vit",
            yy:"%d vite"
        },
        ordinal:"%d.",
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    var t={
        words:{
            m:["један минут","једне минуте"],
            mm:["минут","минуте","минута"],
            h:["један сат","једног сата"],
            hh:["сат","сата","сати"],
            dd:["дан","дана","дана"],
            MM:["месец","месеца","месеци"],
            yy:["година","године","година"]
            },
        correctGrammaticalCase:function(n,t){
            return n===1?t[0]:n>=2&&n<=4?t[1]:t[2]
            },
        translate:function(n,i,r){
            var u=t.words[r];
            return r.length===1?i?u[0]:u[1]:n+" "+t.correctGrammaticalCase(n,u)
            }
        };
    
return n.lang("sr-cyrl",{
    months:["јануар","фебруар","март","април","мај","јун","јул","август","септембар","октобар","новембар","децембар"],
    monthsShort:["јан.","феб.","мар.","апр.","мај","јун","јул","авг.","сеп.","окт.","нов.","дец."],
    weekdays:["недеља","понедељак","уторак","среда","четвртак","петак","субота"],
    weekdaysShort:["нед.","пон.","уто.","сре.","чет.","пет.","суб."],
    weekdaysMin:["не","по","ут","ср","че","пе","су"],
    longDateFormat:{
        LT:"H:mm",
        L:"DD. MM. YYYY",
        LL:"D. MMMM YYYY",
        LLL:"D. MMMM YYYY LT",
        LLLL:"dddd, D. MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[данас у] LT",
        nextDay:"[сутра у] LT",
        nextWeek:function(){
            switch(this.day()){
                case 0:
                    return"[у] [недељу] [у] LT";
                case 3:
                    return"[у] [среду] [у] LT";
                case 6:
                    return"[у] [суботу] [у] LT";
                case 1:case 2:case 4:case 5:
                    return"[у] dddd [у] LT"
                    }
                },
    lastDay:"[јуче у] LT",
    lastWeek:function(){
        return["[прошле] [недеље] [у] LT","[прошлог] [понедељка] [у] LT","[прошлог] [уторка] [у] LT","[прошле] [среде] [у] LT","[прошлог] [четвртка] [у] LT","[прошлог] [петка] [у] LT","[прошле] [суботе] [у] LT"][this.day()]
        },
    sameElse:"L"
},
relativeTime:{
    future:"за %s",
    past:"пре %s",
    s:"неколико секунди",
    m:t.translate,
    mm:t.translate,
    h:t.translate,
    hh:t.translate,
    d:"дан",
    dd:t.translate,
    M:"месец",
    MM:t.translate,
    y:"годину",
    yy:t.translate
    },
ordinal:"%d.",
week:{
    dow:1,
    doy:7
}
})
}),function(n){
    n(t)
    }(function(n){
    var t={
        words:{
            m:["jedan minut","jedne minute"],
            mm:["minut","minute","minuta"],
            h:["jedan sat","jednog sata"],
            hh:["sat","sata","sati"],
            dd:["dan","dana","dana"],
            MM:["mesec","meseca","meseci"],
            yy:["godina","godine","godina"]
            },
        correctGrammaticalCase:function(n,t){
            return n===1?t[0]:n>=2&&n<=4?t[1]:t[2]
            },
        translate:function(n,i,r){
            var u=t.words[r];
            return r.length===1?i?u[0]:u[1]:n+" "+t.correctGrammaticalCase(n,u)
            }
        };
    
return n.lang("sr",{
    months:["januar","februar","mart","april","maj","jun","jul","avgust","septembar","oktobar","novembar","decembar"],
    monthsShort:["jan.","feb.","mar.","apr.","maj","jun","jul","avg.","sep.","okt.","nov.","dec."],
    weekdays:["nedelja","ponedeljak","utorak","sreda","četvrtak","petak","subota"],
    weekdaysShort:["ned.","pon.","uto.","sre.","čet.","pet.","sub."],
    weekdaysMin:["ne","po","ut","sr","če","pe","su"],
    longDateFormat:{
        LT:"H:mm",
        L:"DD. MM. YYYY",
        LL:"D. MMMM YYYY",
        LLL:"D. MMMM YYYY LT",
        LLLL:"dddd, D. MMMM YYYY LT"
    },
    calendar:{
        sameDay:"[danas u] LT",
        nextDay:"[sutra u] LT",
        nextWeek:function(){
            switch(this.day()){
                case 0:
                    return"[u] [nedelju] [u] LT";
                case 3:
                    return"[u] [sredu] [u] LT";
                case 6:
                    return"[u] [subotu] [u] LT";
                case 1:case 2:case 4:case 5:
                    return"[u] dddd [u] LT"
                    }
                },
    lastDay:"[juče u] LT",
    lastWeek:function(){
        return["[prošle] [nedelje] [u] LT","[prošlog] [ponedeljka] [u] LT","[prošlog] [utorka] [u] LT","[prošle] [srede] [u] LT","[prošlog] [četvrtka] [u] LT","[prošlog] [petka] [u] LT","[prošle] [subote] [u] LT"][this.day()]
        },
    sameElse:"L"
},
relativeTime:{
    future:"za %s",
    past:"pre %s",
    s:"nekoliko sekundi",
    m:t.translate,
    mm:t.translate,
    h:t.translate,
    hh:t.translate,
    d:"dan",
    dd:t.translate,
    M:"mesec",
    MM:t.translate,
    y:"godinu",
    yy:t.translate
    },
ordinal:"%d.",
week:{
    dow:1,
    doy:7
}
})
}),function(n){
    n(t)
    }(function(n){
    return n.lang("sv",{
        months:"januari_februari_mars_april_maj_juni_juli_augusti_september_oktober_november_december".split("_"),
        monthsShort:"jan_feb_mar_apr_maj_jun_jul_aug_sep_okt_nov_dec".split("_"),
        weekdays:"söndag_måndag_tisdag_onsdag_torsdag_fredag_lördag".split("_"),
        weekdaysShort:"sön_mån_tis_ons_tor_fre_lör".split("_"),
        weekdaysMin:"sö_må_ti_on_to_fr_lö".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"YYYY-MM-DD",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[Idag] LT",
            nextDay:"[Imorgon] LT",
            lastDay:"[Igår] LT",
            nextWeek:"dddd LT",
            lastWeek:"[Förra] dddd[en] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"om %s",
            past:"för %s sedan",
            s:"några sekunder",
            m:"en minut",
            mm:"%d minuter",
            h:"en timme",
            hh:"%d timmar",
            d:"en dag",
            dd:"%d dagar",
            M:"en månad",
            MM:"%d månader",
            y:"ett år",
            yy:"%d år"
        },
        ordinal:function(n){
            var t=n%10,i=~~(n%100/10)==1?"e":t===1?"a":t===2?"a":t===3?"e":"e";
            return n+i
            },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("ta",{
        months:"ஜனவரி_பிப்ரவரி_மார்ச்_ஏப்ரல்_மே_ஜூன்_ஜூலை_ஆகஸ்ட்_செப்டெம்பர்_அக்டோபர்_நவம்பர்_டிசம்பர்".split("_"),
        monthsShort:"ஜனவரி_பிப்ரவரி_மார்ச்_ஏப்ரல்_மே_ஜூன்_ஜூலை_ஆகஸ்ட்_செப்டெம்பர்_அக்டோபர்_நவம்பர்_டிசம்பர்".split("_"),
        weekdays:"ஞாயிற்றுக்கிழமை_திங்கட்கிழமை_செவ்வாய்கிழமை_புதன்கிழமை_வியாழக்கிழமை_வெள்ளிக்கிழமை_சனிக்கிழமை".split("_"),
        weekdaysShort:"ஞாயிறு_திங்கள்_செவ்வாய்_புதன்_வியாழன்_வெள்ளி_சனி".split("_"),
        weekdaysMin:"ஞா_தி_செ_பு_வி_வெ_ச".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY, LT",
            LLLL:"dddd, D MMMM YYYY, LT"
        },
        calendar:{
            sameDay:"[இன்று] LT",
            nextDay:"[நாளை] LT",
            nextWeek:"dddd, LT",
            lastDay:"[நேற்று] LT",
            lastWeek:"[கடந்த வாரம்] dddd, LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s இல்",
            past:"%s முன்",
            s:"ஒரு சில விநாடிகள்",
            m:"ஒரு நிமிடம்",
            mm:"%d நிமிடங்கள்",
            h:"ஒரு மணி நேரம்",
            hh:"%d மணி நேரம்",
            d:"ஒரு நாள்",
            dd:"%d நாட்கள்",
            M:"ஒரு மாதம்",
            MM:"%d மாதங்கள்",
            y:"ஒரு வருடம்",
            yy:"%d ஆண்டுகள்"
        },
        ordinal:function(n){
            return n+"வது"
            },
        meridiem:function(n){
            return n>=6&&n<=10?" காலை":n>=10&&n<=14?" நண்பகல்":n>=14&&n<=18?" எற்பாடு":n>=18&&n<=20?" மாலை":n>=20&&n<=24?" இரவு":n>=0&&n<=6?" வைகறை":void 0
            },
        week:{
            dow:0,
            doy:6
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("th",{
        months:"มกราคม_กุมภาพันธ์_มีนาคม_เมษายน_พฤษภาคม_มิถุนายน_กรกฎาคม_สิงหาคม_กันยายน_ตุลาคม_พฤศจิกายน_ธันวาคม".split("_"),
        monthsShort:"มกรา_กุมภา_มีนา_เมษา_พฤษภา_มิถุนา_กรกฎา_สิงหา_กันยา_ตุลา_พฤศจิกา_ธันวา".split("_"),
        weekdays:"อาทิตย์_จันทร์_อังคาร_พุธ_พฤหัสบดี_ศุกร์_เสาร์".split("_"),
        weekdaysShort:"อาทิตย์_จันทร์_อังคาร_พุธ_พฤหัส_ศุกร์_เสาร์".split("_"),
        weekdaysMin:"อา._จ._อ._พ._พฤ._ศ._ส.".split("_"),
        longDateFormat:{
            LT:"H นาฬิกา m นาที",
            L:"YYYY/MM/DD",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY เวลา LT",
            LLLL:"วันddddที่ D MMMM YYYY เวลา LT"
        },
        meridiem:function(n){
            return n<12?"ก่อนเที่ยง":"หลังเที่ยง"
            },
        calendar:{
            sameDay:"[วันนี้ เวลา] LT",
            nextDay:"[พรุ่งนี้ เวลา] LT",
            nextWeek:"dddd[หน้า เวลา] LT",
            lastDay:"[เมื่อวานนี้ เวลา] LT",
            lastWeek:"[วัน]dddd[ที่แล้ว เวลา] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"อีก %s",
            past:"%sที่แล้ว",
            s:"ไม่กี่วินาที",
            m:"1 นาที",
            mm:"%d นาที",
            h:"1 ชั่วโมง",
            hh:"%d ชั่วโมง",
            d:"1 วัน",
            dd:"%d วัน",
            M:"1 เดือน",
            MM:"%d เดือน",
            y:"1 ปี",
            yy:"%d ปี"
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("tl-ph",{
        months:"Enero_Pebrero_Marso_Abril_Mayo_Hunyo_Hulyo_Agosto_Setyembre_Oktubre_Nobyembre_Disyembre".split("_"),
        monthsShort:"Ene_Peb_Mar_Abr_May_Hun_Hul_Ago_Set_Okt_Nob_Dis".split("_"),
        weekdays:"Linggo_Lunes_Martes_Miyerkules_Huwebes_Biyernes_Sabado".split("_"),
        weekdaysShort:"Lin_Lun_Mar_Miy_Huw_Biy_Sab".split("_"),
        weekdaysMin:"Li_Lu_Ma_Mi_Hu_Bi_Sab".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"MM/D/YYYY",
            LL:"MMMM D, YYYY",
            LLL:"MMMM D, YYYY LT",
            LLLL:"dddd, MMMM DD, YYYY LT"
        },
        calendar:{
            sameDay:"[Ngayon sa] LT",
            nextDay:"[Bukas sa] LT",
            nextWeek:"dddd [sa] LT",
            lastDay:"[Kahapon sa] LT",
            lastWeek:"dddd [huling linggo] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"sa loob ng %s",
            past:"%s ang nakalipas",
            s:"ilang segundo",
            m:"isang minuto",
            mm:"%d minuto",
            h:"isang oras",
            hh:"%d oras",
            d:"isang araw",
            dd:"%d araw",
            M:"isang buwan",
            MM:"%d buwan",
            y:"isang taon",
            yy:"%d taon"
        },
        ordinal:function(n){
            return n
            },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    var t={
        1:"'inci",
        5:"'inci",
        8:"'inci",
        70:"'inci",
        80:"'inci",
        2:"'nci",
        7:"'nci",
        20:"'nci",
        50:"'nci",
        3:"'üncü",
        4:"'üncü",
        100:"'üncü",
        6:"'ncı",
        9:"'uncu",
        10:"'uncu",
        30:"'uncu",
        60:"'ıncı",
        90:"'ıncı"
    };
    
    return n.lang("tr",{
        months:"Ocak_Şubat_Mart_Nisan_Mayıs_Haziran_Temmuz_Ağustos_Eylül_Ekim_Kasım_Aralık".split("_"),
        monthsShort:"Oca_Şub_Mar_Nis_May_Haz_Tem_Ağu_Eyl_Eki_Kas_Ara".split("_"),
        weekdays:"Pazar_Pazartesi_Salı_Çarşamba_Perşembe_Cuma_Cumartesi".split("_"),
        weekdaysShort:"Paz_Pts_Sal_Çar_Per_Cum_Cts".split("_"),
        weekdaysMin:"Pz_Pt_Sa_Ça_Pe_Cu_Ct".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD.MM.YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd, D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[bugün saat] LT",
            nextDay:"[yarın saat] LT",
            nextWeek:"[haftaya] dddd [saat] LT",
            lastDay:"[dün] LT",
            lastWeek:"[geçen hafta] dddd [saat] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s sonra",
            past:"%s önce",
            s:"birkaç saniye",
            m:"bir dakika",
            mm:"%d dakika",
            h:"bir saat",
            hh:"%d saat",
            d:"bir gün",
            dd:"%d gün",
            M:"bir ay",
            MM:"%d ay",
            y:"bir yıl",
            yy:"%d yıl"
        },
        ordinal:function(n){
            if(n===0)return n+"'ıncı";
            var i=n%10,r=n%100-i,u=n>=100?100:null;
            return n+(t[i]||t[r]||t[u])
            },
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("tzm-latn",{
        months:"innayr_brˤayrˤ_marˤsˤ_ibrir_mayyw_ywnyw_ywlywz_ɣwšt_šwtanbir_ktˤwbrˤ_nwwanbir_dwjnbir".split("_"),
        monthsShort:"innayr_brˤayrˤ_marˤsˤ_ibrir_mayyw_ywnyw_ywlywz_ɣwšt_šwtanbir_ktˤwbrˤ_nwwanbir_dwjnbir".split("_"),
        weekdays:"asamas_aynas_asinas_akras_akwas_asimwas_asiḍyas".split("_"),
        weekdaysShort:"asamas_aynas_asinas_akras_akwas_asimwas_asiḍyas".split("_"),
        weekdaysMin:"asamas_aynas_asinas_akras_akwas_asimwas_asiḍyas".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[asdkh g] LT",
            nextDay:"[aska g] LT",
            nextWeek:"dddd [g] LT",
            lastDay:"[assant g] LT",
            lastWeek:"dddd [g] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"dadkh s yan %s",
            past:"yan %s",
            s:"imik",
            m:"minuḍ",
            mm:"%d minuḍ",
            h:"saɛa",
            hh:"%d tassaɛin",
            d:"ass",
            dd:"%d ossan",
            M:"ayowr",
            MM:"%d iyyirn",
            y:"asgas",
            yy:"%d isgasn"
        },
        week:{
            dow:6,
            doy:12
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("tzm",{
        months:"ⵉⵏⵏⴰⵢⵔ_ⴱⵕⴰⵢⵕ_ⵎⴰⵕⵚ_ⵉⴱⵔⵉⵔ_ⵎⴰⵢⵢⵓ_ⵢⵓⵏⵢⵓ_ⵢⵓⵍⵢⵓⵣ_ⵖⵓⵛⵜ_ⵛⵓⵜⴰⵏⴱⵉⵔ_ⴽⵟⵓⴱⵕ_ⵏⵓⵡⴰⵏⴱⵉⵔ_ⴷⵓⵊⵏⴱⵉⵔ".split("_"),
        monthsShort:"ⵉⵏⵏⴰⵢⵔ_ⴱⵕⴰⵢⵕ_ⵎⴰⵕⵚ_ⵉⴱⵔⵉⵔ_ⵎⴰⵢⵢⵓ_ⵢⵓⵏⵢⵓ_ⵢⵓⵍⵢⵓⵣ_ⵖⵓⵛⵜ_ⵛⵓⵜⴰⵏⴱⵉⵔ_ⴽⵟⵓⴱⵕ_ⵏⵓⵡⴰⵏⴱⵉⵔ_ⴷⵓⵊⵏⴱⵉⵔ".split("_"),
        weekdays:"ⴰⵙⴰⵎⴰⵙ_ⴰⵢⵏⴰⵙ_ⴰⵙⵉⵏⴰⵙ_ⴰⴽⵔⴰⵙ_ⴰⴽⵡⴰⵙ_ⴰⵙⵉⵎⵡⴰⵙ_ⴰⵙⵉⴹⵢⴰⵙ".split("_"),
        weekdaysShort:"ⴰⵙⴰⵎⴰⵙ_ⴰⵢⵏⴰⵙ_ⴰⵙⵉⵏⴰⵙ_ⴰⴽⵔⴰⵙ_ⴰⴽⵡⴰⵙ_ⴰⵙⵉⵎⵡⴰⵙ_ⴰⵙⵉⴹⵢⴰⵙ".split("_"),
        weekdaysMin:"ⴰⵙⴰⵎⴰⵙ_ⴰⵢⵏⴰⵙ_ⴰⵙⵉⵏⴰⵙ_ⴰⴽⵔⴰⵙ_ⴰⴽⵡⴰⵙ_ⴰⵙⵉⵎⵡⴰⵙ_ⴰⵙⵉⴹⵢⴰⵙ".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"dddd D MMMM YYYY LT"
        },
        calendar:{
            sameDay:"[ⴰⵙⴷⵅ ⴴ] LT",
            nextDay:"[ⴰⵙⴽⴰ ⴴ] LT",
            nextWeek:"dddd [ⴴ] LT",
            lastDay:"[ⴰⵚⴰⵏⵜ ⴴ] LT",
            lastWeek:"dddd [ⴴ] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"ⴷⴰⴷⵅ ⵙ ⵢⴰⵏ %s",
            past:"ⵢⴰⵏ %s",
            s:"ⵉⵎⵉⴽ",
            m:"ⵎⵉⵏⵓⴺ",
            mm:"%d ⵎⵉⵏⵓⴺ",
            h:"ⵙⴰⵄⴰ",
            hh:"%d ⵜⴰⵙⵙⴰⵄⵉⵏ",
            d:"ⴰⵙⵙ",
            dd:"%d oⵙⵙⴰⵏ",
            M:"ⴰⵢoⵓⵔ",
            MM:"%d ⵉⵢⵢⵉⵔⵏ",
            y:"ⴰⵙⴳⴰⵙ",
            yy:"%d ⵉⵙⴳⴰⵙⵏ"
        },
        week:{
            dow:6,
            doy:12
        }
    })
}),function(n){
    n(t)
    }(function(n){
    function r(n,t){
        var i=n.split("_");
        return t%10==1&&t%100!=11?i[0]:t%10>=2&&t%10<=4&&(t%100<10||t%100>=20)?i[1]:i[2]
        }
        function t(n,t,i){
        return i==="m"?t?"хвилина":"хвилину":i==="h"?t?"година":"годину":n+" "+r({
            mm:"хвилина_хвилини_хвилин",
            hh:"година_години_годин",
            dd:"день_дні_днів",
            MM:"місяць_місяці_місяців",
            yy:"рік_роки_років"
        }
        [i],+n)
        }
        function u(n,t){
        var i={
            nominative:"січень_лютий_березень_квітень_травень_червень_липень_серпень_вересень_жовтень_листопад_грудень".split("_"),
            accusative:"січня_лютого_березня_квітня_травня_червня_липня_серпня_вересня_жовтня_листопада_грудня".split("_")
            },r=/D[oD]? *MMMM?/.test(t)?"accusative":"nominative";
        return i[r][n.month()]
        }
        function f(n,t){
        var i={
            nominative:"неділя_понеділок_вівторок_середа_четвер_п’ятниця_субота".split("_"),
            accusative:"неділю_понеділок_вівторок_середу_четвер_п’ятницю_суботу".split("_"),
            genitive:"неділі_понеділка_вівторка_середи_четверга_п’ятниці_суботи".split("_")
            },r=/(\[[ВвУу]\]) ?dddd/.test(t)?"accusative":/\[?(?:минулої|наступної)? ?\] ?dddd/.test(t)?"genitive":"nominative";
        return i[r][n.day()]
        }
        function i(n){
        return function(){
            return n+"о"+(this.hours()===11?"б":"")+"] LT"
            }
        }
    return n.lang("uk",{
    months:u,
    monthsShort:"січ_лют_бер_квіт_трав_черв_лип_серп_вер_жовт_лист_груд".split("_"),
    weekdays:f,
    weekdaysShort:"нд_пн_вт_ср_чт_пт_сб".split("_"),
    weekdaysMin:"нд_пн_вт_ср_чт_пт_сб".split("_"),
    longDateFormat:{
        LT:"HH:mm",
        L:"DD.MM.YYYY",
        LL:"D MMMM YYYY р.",
        LLL:"D MMMM YYYY р., LT",
        LLLL:"dddd, D MMMM YYYY р., LT"
    },
    calendar:{
        sameDay:i("[Сьогодні "),
        nextDay:i("[Завтра "),
        lastDay:i("[Вчора "),
        nextWeek:i("[У] dddd ["),
        lastWeek:function(){
            switch(this.day()){
                case 0:case 3:case 5:case 6:
                    return i("[Минулої] dddd [").call(this);
                case 1:case 2:case 4:
                    return i("[Минулого] dddd [").call(this)
                    }
                },
    sameElse:"L"
},
relativeTime:{
    future:"за %s",
    past:"%s тому",
    s:"декілька секунд",
    m:t,
    mm:t,
    h:"годину",
    hh:t,
    d:"день",
    dd:t,
    M:"місяць",
    MM:t,
    y:"рік",
    yy:t
},
meridiem:function(n){
    return n<4?"ночі":n<12?"ранку":n<17?"дня":"вечора"
    },
ordinal:function(n,t){
    switch(t){
        case"M":case"d":case"DDD":case"w":case"W":
            return n+"-й";
        case"D":
            return n+"-го";
        default:
            return n
            }
        },
week:{
    dow:1,
    doy:7
}
})
}),function(n){
    n(t)
    }(function(n){
    return n.lang("uz",{
        months:"январь_февраль_март_апрель_май_июнь_июль_август_сентябрь_октябрь_ноябрь_декабрь".split("_"),
        monthsShort:"янв_фев_мар_апр_май_июн_июл_авг_сен_окт_ноя_дек".split("_"),
        weekdays:"Якшанба_Душанба_Сешанба_Чоршанба_Пайшанба_Жума_Шанба".split("_"),
        weekdaysShort:"Якш_Душ_Сеш_Чор_Пай_Жум_Шан".split("_"),
        weekdaysMin:"Як_Ду_Се_Чо_Па_Жу_Ша".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM YYYY",
            LLL:"D MMMM YYYY LT",
            LLLL:"D MMMM YYYY, dddd LT"
        },
        calendar:{
            sameDay:"[Бугун соат] LT [да]",
            nextDay:"[Эртага] LT [да]",
            nextWeek:"dddd [куни соат] LT [да]",
            lastDay:"[Кеча соат] LT [да]",
            lastWeek:"[Утган] dddd [куни соат] LT [да]",
            sameElse:"L"
        },
        relativeTime:{
            future:"Якин %s ичида",
            past:"Бир неча %s олдин",
            s:"фурсат",
            m:"бир дакика",
            mm:"%d дакика",
            h:"бир соат",
            hh:"%d соат",
            d:"бир кун",
            dd:"%d кун",
            M:"бир ой",
            MM:"%d ой",
            y:"бир йил",
            yy:"%d йил"
        },
        week:{
            dow:1,
            doy:7
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("vi",{
        months:"tháng 1_tháng 2_tháng 3_tháng 4_tháng 5_tháng 6_tháng 7_tháng 8_tháng 9_tháng 10_tháng 11_tháng 12".split("_"),
        monthsShort:"Th01_Th02_Th03_Th04_Th05_Th06_Th07_Th08_Th09_Th10_Th11_Th12".split("_"),
        weekdays:"chủ nhật_thứ hai_thứ ba_thứ tư_thứ năm_thứ sáu_thứ bảy".split("_"),
        weekdaysShort:"CN_T2_T3_T4_T5_T6_T7".split("_"),
        weekdaysMin:"CN_T2_T3_T4_T5_T6_T7".split("_"),
        longDateFormat:{
            LT:"HH:mm",
            L:"DD/MM/YYYY",
            LL:"D MMMM [năm] YYYY",
            LLL:"D MMMM [năm] YYYY LT",
            LLLL:"dddd, D MMMM [năm] YYYY LT",
            l:"DD/M/YYYY",
            ll:"D MMM YYYY",
            lll:"D MMM YYYY LT",
            llll:"ddd, D MMM YYYY LT"
        },
        calendar:{
            sameDay:"[Hôm nay lúc] LT",
            nextDay:"[Ngày mai lúc] LT",
            nextWeek:"dddd [tuần tới lúc] LT",
            lastDay:"[Hôm qua lúc] LT",
            lastWeek:"dddd [tuần rồi lúc] LT",
            sameElse:"L"
        },
        relativeTime:{
            future:"%s tới",
            past:"%s trước",
            s:"vài giây",
            m:"một phút",
            mm:"%d phút",
            h:"một giờ",
            hh:"%d giờ",
            d:"một ngày",
            dd:"%d ngày",
            M:"một tháng",
            MM:"%d tháng",
            y:"một năm",
            yy:"%d năm"
        },
        ordinal:function(n){
            return n
            },
        week:{
            dow:1,
            doy:4
        }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("zh-cn",{
        months:"一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月".split("_"),
        monthsShort:"1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
        weekdays:"星期日_星期一_星期二_星期三_星期四_星期五_星期六".split("_"),
        weekdaysShort:"周日_周一_周二_周三_周四_周五_周六".split("_"),
        weekdaysMin:"日_一_二_三_四_五_六".split("_"),
        longDateFormat:{
            LT:"Ah点mm",
            L:"YYYY-MM-DD",
            LL:"YYYY年MMMD日",
            LLL:"YYYY年MMMD日LT",
            LLLL:"YYYY年MMMD日ddddLT",
            l:"YYYY-MM-DD",
            ll:"YYYY年MMMD日",
            lll:"YYYY年MMMD日LT",
            llll:"YYYY年MMMD日ddddLT"
        },
        meridiem:function(n,t){
            var i=n*100+t;
            return i<600?"凌晨":i<900?"早上":i<1130?"上午":i<1230?"中午":i<1800?"下午":"晚上"
            },
        calendar:{
            sameDay:function(){
                return this.minutes()===0?"[今天]Ah[点整]":"[今天]LT"
                },
            nextDay:function(){
                return this.minutes()===0?"[明天]Ah[点整]":"[明天]LT"
                },
            lastDay:function(){
                return this.minutes()===0?"[昨天]Ah[点整]":"[昨天]LT"
                },
            nextWeek:function(){
                var i,t;
                return i=n().startOf("week"),t=this.unix()-i.unix()>=604800?"[下]":"[本]",this.minutes()===0?t+"dddAh点整":t+"dddAh点mm"
                },
            lastWeek:function(){
                var i,t;
                return i=n().startOf("week"),t=this.unix()<i.unix()?"[上]":"[本]",this.minutes()===0?t+"dddAh点整":t+"dddAh点mm"
                },
            sameElse:"LL"
        },
        ordinal:function(n,t){
            switch(t){
                case"d":case"D":case"DDD":
                    return n+"日";
                case"M":
                    return n+"月";
                case"w":case"W":
                    return n+"周";
                default:
                    return n
                    }
                },
    relativeTime:{
        future:"%s内",
        past:"%s前",
        s:"几秒",
        m:"1分钟",
        mm:"%d分钟",
        h:"1小时",
        hh:"%d小时",
        d:"1天",
        dd:"%d天",
        M:"1个月",
        MM:"%d个月",
        y:"1年",
        yy:"%d年"
    },
    week:{
        dow:1,
        doy:4
    }
    })
}),function(n){
    n(t)
    }(function(n){
    return n.lang("zh-tw",{
        months:"一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月".split("_"),
        monthsShort:"1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"),
        weekdays:"星期日_星期一_星期二_星期三_星期四_星期五_星期六".split("_"),
        weekdaysShort:"週日_週一_週二_週三_週四_週五_週六".split("_"),
        weekdaysMin:"日_一_二_三_四_五_六".split("_"),
        longDateFormat:{
            LT:"Ah點mm",
            L:"YYYY年MMMD日",
            LL:"YYYY年MMMD日",
            LLL:"YYYY年MMMD日LT",
            LLLL:"YYYY年MMMD日ddddLT",
            l:"YYYY年MMMD日",
            ll:"YYYY年MMMD日",
            lll:"YYYY年MMMD日LT",
            llll:"YYYY年MMMD日ddddLT"
        },
        meridiem:function(n,t){
            var i=n*100+t;
            return i<900?"早上":i<1130?"上午":i<1230?"中午":i<1800?"下午":"晚上"
            },
        calendar:{
            sameDay:"[今天]LT",
            nextDay:"[明天]LT",
            nextWeek:"[下]ddddLT",
            lastDay:"[昨天]LT",
            lastWeek:"[上]ddddLT",
            sameElse:"L"
        },
        ordinal:function(n,t){
            switch(t){
                case"d":case"D":case"DDD":
                    return n+"日";
                case"M":
                    return n+"月";
                case"w":case"W":
                    return n+"週";
                default:
                    return n
                    }
                },
    relativeTime:{
        future:"%s內",
        past:"%s前",
        s:"幾秒",
        m:"一分鐘",
        mm:"%d分鐘",
        h:"一小時",
        hh:"%d小時",
        d:"一天",
        dd:"%d天",
        M:"一個月",
        MM:"%d個月",
        y:"一年",
        yy:"%d年"
    }
    })
});
t.lang("en");
ui?module.exports=t:typeof define=="function"&&define.amd?(define("moment",function(n,i,r){
    return r.config&&r.config()&&r.config().noGlobal===!0&&(rt.moment=ii),t
    }),hr(!0)):hr()
}.call(this),function(n){
    function d(n,t,i){
        switch(arguments.length){
            case 2:
                return n!=null?n:t;
            case 3:
                return n!=null?n:t!=null?t:i;
            default:
                throw new Error("Implement me");
        }
    }
    function lt(){
    return{
        empty:!1,
        unusedTokens:[],
        unusedInput:[],
        overflow:-2,
        charsLeftOver:0,
        nullInput:!1,
        invalidMonth:null,
        invalidFormat:!1,
        userInvalidated:!1,
        iso:!1
        }
    }
function g(n,i){
    function u(){
        t.suppressDeprecationWarnings===!1&&typeof console!="undefined"&&console.warn&&console.warn("Deprecation warning: "+n)
        }
        var r=!0;
    return l(function(){
        return r&&(u(),r=!1),i.apply(this,arguments)
        },i)
    }
    function vi(n,t){
    return function(i){
        return r(n.call(this,i),t)
        }
    }
function ou(n,t){
    return function(i){
        return this.lang().ordinal(n.call(this,i),t)
        }
    }
function yi(){}
function at(n){
    gi(n);
    l(this,n)
    }
    function vt(n){
    var t=wi(n),i=t.year||0,r=t.quarter||0,u=t.month||0,f=t.week||0,e=t.day||0,o=t.hour||0,s=t.minute||0,h=t.second||0,c=t.millisecond||0;
    this._milliseconds=+c+h*1e3+s*6e4+o*36e5;
    this._days=+e+f*7;
    this._months=+u+r*3+i*12;
    this._data={};
    
    this._bubble()
    }
    function l(n,t){
    for(var i in t)t.hasOwnProperty(i)&&(n[i]=t[i]);return t.hasOwnProperty("toString")&&(n.toString=t.toString),t.hasOwnProperty("valueOf")&&(n.valueOf=t.valueOf),n
    }
    function su(n){
    var i={};
    
    for(var t in n)n.hasOwnProperty(t)&&ri.hasOwnProperty(t)&&(i[t]=n[t]);return i
    }
    function w(n){
    return n<0?Math.ceil(n):Math.floor(n)
    }
    function r(n,t,i){
    for(var r=""+Math.abs(n),u=n>=0;r.length<t;)r="0"+r;
    return(u?i?"+":"":"-")+r
    }
    function yt(n,i,r,u){
    var o=i._milliseconds,f=i._days,e=i._months;
    u=u==null?!0:u;
    o&&n._d.setTime(+n._d+o*r);
    f&&or(n,"Date",ti(n,"Date")+f*r);
    e&&er(n,ti(n,"Month")+e*r);
    u&&t.updateOffset(n,f||e)
    }
    function ft(n){
    return Object.prototype.toString.call(n)==="[object Array]"
    }
    function hu(n){
    return Object.prototype.toString.call(n)==="[object Date]"||n instanceof Date
    }
    function pi(n,t,r){
    for(var e=Math.min(n.length,t.length),o=Math.abs(n.length-t.length),f=0,u=0;u<e;u++)(r&&n[u]!==t[u]||!r&&i(n[u])!==i(t[u]))&&f++;
    return f+o
    }
    function a(n){
    if(n){
        var t=n.toLowerCase().replace(/(.)s$/,"$1");
        n=fu[n]||eu[t]||t
        }
        return n
    }
    function wi(n){
    var r={},t;
    for(var i in n)n.hasOwnProperty(i)&&(t=a(i),t&&(r[t]=n[i]));return r
    }
    function cu(i){
    var r,u;
    if(i.indexOf("week")===0)r=7,u="day";
    else if(i.indexOf("month")===0)r=12,u="month";else return;
    t[i]=function(f,e){
        var o,s,c=t.fn._lang[i],h=[];
        if(typeof f=="number"&&(e=f,f=n),s=function(n){
            var i=t().utc().set(u,n);
            return c.call(t.fn._lang,i,f||"")
            },e!=null)return s(e);
        for(o=0;o<r;o++)h.push(s(o));
        return h
        }
    }
function i(n){
    var t=+n,i=0;
    return t!==0&&isFinite(t)&&(i=t>=0?Math.floor(t):Math.ceil(t)),i
    }
    function pt(n,t){
    return new Date(Date.UTC(n,t+1,0)).getUTCDate()
    }
    function bi(n,i,r){
    return k(t([n,11,31+i-r]),i,r).week
    }
    function ki(n){
    return di(n)?366:365
    }
    function di(n){
    return n%4==0&&n%100!=0||n%400==0
    }
    function gi(n){
    var t;
    n._a&&n._pf.overflow===-2&&(t=n._a[s]<0||n._a[s]>11?s:n._a[e]<1||n._a[e]>pt(n._a[o],n._a[s])?e:n._a[h]<0||n._a[h]>23?h:n._a[nt]<0||n._a[nt]>59?nt:n._a[tt]<0||n._a[tt]>59?tt:n._a[it]<0||n._a[it]>999?it:-1,n._pf._overflowDayOfYear&&(t<o||t>e)&&(t=e),n._pf.overflow=t)
    }
    function nr(n){
    return n._isValid==null&&(n._isValid=!isNaN(n._d.getTime())&&n._pf.overflow<0&&!n._pf.empty&&!n._pf.invalidMonth&&!n._pf.nullInput&&!n._pf.invalidFormat&&!n._pf.userInvalidated,n._strict&&(n._isValid=n._isValid&&n._pf.charsLeftOver===0&&n._pf.unusedTokens.length===0)),n._isValid
    }
    function wt(n){
    return n?n.toLowerCase().replace("_","-"):n
    }
    function bt(n,i){
    return i._isUTC?t(n).zone(i._offset||0):t(n).local()
    }
    function lu(n,t){
    return t.abbr=n,y[n]||(y[n]=new yi),y[n].set(t),y[n]
    }
    function au(n){
    delete y[n]
}
function f(n){
    var f=0,r,u,i,e,o=function(n){
        if(!y[n]&&ui)try{
            require("./lang/"+n)
            }catch(t){}
            return y[n]
        };
        
    if(!n)return t.fn._lang;
    if(!ft(n)){
        if(u=o(n),u)return u;
        n=[n]
        }while(f<n.length){
        for(e=wt(n[f]).split("-"),r=e.length,i=wt(n[f+1]),i=i?i.split("-"):null;r>0;){
            if(u=o(e.slice(0,r).join("-")),u)return u;
            if(i&&i.length>=r&&pi(e,i,!0)>=r-1)break;
            r--
        }
        f++
    }
    return t.fn._lang
    }
    function vu(n){
    return n.match(/\[[\s\S]/)?n.replace(/^\[|\]$/g,""):n.replace(/\\/g,"")
    }
    function yu(n){
    for(var i=n.match(fi),t=0,r=i.length;t<r;t++)i[t]=c[i[t]]?c[i[t]]:vu(i[t]);
    return function(u){
        var f="";
        for(t=0;t<r;t++)f+=i[t]instanceof Function?i[t].call(u,n):i[t];
        return f
        }
    }
function kt(n,t){
    return n.isValid()?(t=tr(t,n.lang()),ct[t]||(ct[t]=yu(t)),ct[t](n)):n.lang().invalidDate()
    }
    function tr(n,t){
    function r(n){
        return t.longDateFormat(n)||n
        }
        var i=5;
    for(ut.lastIndex=0;i>=0&&ut.test(n);)n=n.replace(ut,r),ut.lastIndex=0,i-=1;
    return n
    }
    function pu(n,t){
    var i=t._strict;
    switch(n){
        case"Q":
            return oi;
        case"DDDD":
            return hi;
        case"YYYY":case"GGGG":case"gggg":
            return i?nu:yr;
        case"Y":case"G":case"g":
            return iu;
        case"YYYYYY":case"YYYYY":case"GGGGG":case"ggggg":
            return i?tu:pr;
        case"S":
            if(i)return oi;case"SS":
            if(i)return si;case"SSS":
            if(i)return hi;case"DDD":
            return vr;
        case"MMM":case"MMMM":case"dd":case"ddd":case"dddd":
            return br;
        case"a":case"A":
            return f(t._l)._meridiemParse;
        case"X":
            return dr;
        case"Z":case"ZZ":
            return et;
        case"T":
            return kr;
        case"SSSS":
            return wr;
        case"MM":case"DD":case"YY":case"GG":case"gg":case"HH":case"hh":case"mm":case"ss":case"ww":case"WW":
            return i?si:ei;
        case"M":case"D":case"d":case"H":case"h":case"m":case"s":case"w":case"W":case"e":case"E":
            return ei;
        case"Do":
            return gr;
        default:
            return new RegExp(nf(gu(n.replace("\\","")),"i"))
            }
        }
function ir(n){
    n=n||"";
    var r=n.match(et)||[],f=r[r.length-1]||[],t=(f+"").match(uu)||["-",0,0],u=+(t[1]*60)+i(t[2]);
    return t[0]==="+"?-u:u
    }
    function wu(n,r,u){
    var l,c=u._a;
    switch(n){
        case"Q":
            r!=null&&(c[s]=(i(r)-1)*3);
            break;
        case"M":case"MM":
            r!=null&&(c[s]=i(r)-1);
            break;
        case"MMM":case"MMMM":
            l=f(u._l).monthsParse(r);
            l!=null?c[s]=l:u._pf.invalidMonth=r;
            break;
        case"D":case"DD":
            r!=null&&(c[e]=i(r));
            break;
        case"Do":
            r!=null&&(c[e]=i(parseInt(r,10)));
            break;
        case"DDD":case"DDDD":
            r!=null&&(u._dayOfYear=i(r));
            break;
        case"YY":
            c[o]=t.parseTwoDigitYear(r);
            break;
        case"YYYY":case"YYYYY":case"YYYYYY":
            c[o]=i(r);
            break;
        case"a":case"A":
            u._isPm=f(u._l).isPM(r);
            break;
        case"H":case"HH":case"h":case"hh":
            c[h]=i(r);
            break;
        case"m":case"mm":
            c[nt]=i(r);
            break;
        case"s":case"ss":
            c[tt]=i(r);
            break;
        case"S":case"SS":case"SSS":case"SSSS":
            c[it]=i(("0."+r)*1e3);
            break;
        case"X":
            u._d=new Date(parseFloat(r)*1e3);
            break;
        case"Z":case"ZZ":
            u._useUTC=!0;
            u._tzm=ir(r);
            break;
        case"dd":case"ddd":case"dddd":
            l=f(u._l).weekdaysParse(r);
            l!=null?(u._w=u._w||{},u._w.d=l):u._pf.invalidWeekday=r;
            break;
        case"w":case"ww":case"W":case"WW":case"d":case"e":case"E":
            n=n.substr(0,1);
        case"gggg":case"GGGG":case"GGGGG":
            n=n.substr(0,2);
            r&&(u._w=u._w||{},u._w[n]=i(r));
            break;
        case"gg":case"GG":
            u._w=u._w||{};
            
            u._w[n]=t.parseTwoDigitYear(r)
            }
        }
function bu(n){
    var i,h,e,u,r,s,c,l;
    i=n._w;
    i.GG!=null||i.W!=null||i.E!=null?(r=1,s=4,h=d(i.GG,n._a[o],k(t(),1,4).year),e=d(i.W,1),u=d(i.E,1)):(l=f(n._l),r=l._week.dow,s=l._week.doy,h=d(i.gg,n._a[o],k(t(),r,s).year),e=d(i.w,1),i.d!=null?(u=i.d,u<r&&++e):u=i.e!=null?i.e+r:r);
    c=hf(h,e,u,s,r);
    n._a[o]=c.year;
    n._dayOfYear=c.dayOfYear
    }
    function dt(n){
    var t,i,r=[],u,f;
    if(!n._d){
        for(u=du(n),n._w&&n._a[e]==null&&n._a[s]==null&&bu(n),n._dayOfYear&&(f=d(n._a[o],u[o]),n._dayOfYear>ki(f)&&(n._pf._overflowDayOfYear=!0),i=ni(f,0,n._dayOfYear),n._a[s]=i.getUTCMonth(),n._a[e]=i.getUTCDate()),t=0;t<3&&n._a[t]==null;++t)n._a[t]=r[t]=u[t];
        for(;t<7;t++)n._a[t]=r[t]=n._a[t]==null?t===2?1:0:n._a[t];
        n._d=(n._useUTC?ni:ff).apply(null,r);
        n._tzm!=null&&n._d.setUTCMinutes(n._d.getUTCMinutes()+n._tzm)
        }
    }
function ku(n){
    var t;
    n._d||(t=wi(n._i),n._a=[t.year,t.month,t.day,t.hour,t.minute,t.second,t.millisecond],dt(n))
    }
    function du(n){
    var t=new Date;
    return n._useUTC?[t.getUTCFullYear(),t.getUTCMonth(),t.getUTCDate()]:[t.getFullYear(),t.getMonth(),t.getDate()]
    }
    function gt(n){
    if(n._f===t.ISO_8601){
        rr(n);
        return
    }
    n._a=[];
    n._pf.empty=!0;
    for(var a=f(n._l),i=""+n._i,r,u,s,v=i.length,l=0,o=tr(n._f,a).match(fi)||[],e=0;e<o.length;e++)u=o[e],r=(i.match(pu(u,n))||[])[0],r&&(s=i.substr(0,i.indexOf(r)),s.length>0&&n._pf.unusedInput.push(s),i=i.slice(i.indexOf(r)+r.length),l+=r.length),c[u]?(r?n._pf.empty=!1:n._pf.unusedTokens.push(u),wu(u,r,n)):n._strict&&!r&&n._pf.unusedTokens.push(u);
    n._pf.charsLeftOver=v-l;
    i.length>0&&n._pf.unusedInput.push(i);
    n._isPm&&n._a[h]<12&&(n._a[h]+=12);
    n._isPm===!1&&n._a[h]===12&&(n._a[h]=0);
    dt(n);
    gi(n)
    }
    function gu(n){
    return n.replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g,function(n,t,i,r,u){
        return t||i||r||u
        })
    }
    function nf(n){
    return n.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&")
    }
    function tf(n){
    var t,f,u,r,i;
    if(n._f.length===0){
        n._pf.invalidFormat=!0;
        n._d=new Date(NaN);
        return
    }
    for(r=0;r<n._f.length;r++)(i=0,t=l({},n),t._pf=lt(),t._f=n._f[r],gt(t),nr(t))&&(i+=t._pf.charsLeftOver,i+=t._pf.unusedTokens.length*10,t._pf.score=i,(u==null||i<u)&&(u=i,f=t));
    l(n,f||t)
    }
    function rr(n){
    var t,i,r=n._i,u=ru.exec(r);
    if(u){
        for(n._pf.iso=!0,t=0,i=ot.length;t<i;t++)if(ot[t][1].exec(r)){
            n._f=ot[t][0]+(u[6]||" ");
            break
        }
        for(t=0,i=st.length;t<i;t++)if(st[t][1].exec(r)){
            n._f+=st[t][0];
            break
        }
        r.match(et)&&(n._f+="Z");
        gt(n)
        }else n._isValid=!1
        }
        function rf(n){
    rr(n);
    n._isValid===!1&&(delete n._isValid,t.createFromInputFallback(n))
    }
    function uf(i){
    var r=i._i,u=cr.exec(r);
    r===n?i._d=new Date:u?i._d=new Date(+u[1]):typeof r=="string"?rf(i):ft(r)?(i._a=r.slice(0),dt(i)):hu(r)?i._d=new Date(+r):typeof r=="object"?ku(i):typeof r=="number"?i._d=new Date(r):t.createFromInputFallback(i)
    }
    function ff(n,t,i,r,u,f,e){
    var o=new Date(n,t,i,r,u,f,e);
    return n<1970&&o.setFullYear(n),o
    }
    function ni(n){
    var t=new Date(Date.UTC.apply(null,arguments));
    return n<1970&&t.setUTCFullYear(n),t
    }
    function ef(n,t){
    if(typeof n=="string")if(isNaN(n)){
        if(n=t.weekdaysParse(n),typeof n!="number")return null
            }else n=parseInt(n,10);
    return n
    }
    function of(n,t,i,r,u){
    return u.relativeTime(t||1,!!i,n,r)
    }
    function sf(n,t,i){
    var o=b(Math.abs(n)/1e3),u=b(o/60),f=b(u/60),r=b(f/24),s=b(r/365),e=o<p.s&&["s",o]||u===1&&["m"]||u<p.m&&["mm",u]||f===1&&["h"]||f<p.h&&["hh",f]||r===1&&["d"]||r<=p.dd&&["dd",r]||r<=p.dm&&["M"]||r<p.dy&&["MM",b(r/30)]||s===1&&["y"]||["yy",s];
    return e[2]=t,e[3]=n>0,e[4]=i,of.apply({},e)
    }
    function k(n,i,r){
    var e=r-i,u=r-n.day(),f;
    return u>e&&(u-=7),u<e-7&&(u+=7),f=t(n).add("d",u),{
        week:Math.ceil(f.dayOfYear()/7),
        year:f.year()
        }
    }
function hf(n,t,i,r,u){
    var f=ni(n,0,1).getUTCDay(),o,e;
    return f=f===0?7:f,i=i!=null?i:u,o=u-f+(f>r?7:0)-(f<u?7:0),e=7*(t-1)+(i-u)+o+1,{
        year:e>0?n:n-1,
        dayOfYear:e>0?e:ki(n-1)+e
        }
    }
function ur(i){
    var r=i._i,u=i._f;
    return r===null||u===n&&r===""?t.invalid({
        nullInput:!0
        }):(typeof r=="string"&&(i._i=r=f().preparse(r)),t.isMoment(r)?(i=su(r),i._d=new Date(+r._d)):u?ft(u)?tf(i):gt(i):uf(i),new at(i))
    }
    function fr(n,i){
    var u,r;
    if(i.length===1&&ft(i[0])&&(i=i[0]),!i.length)return t();
    for(u=i[0],r=1;r<i.length;++r)i[r][n](u)&&(u=i[r]);
    return u
    }
    function er(n,t){
    var i;
    return typeof t=="string"&&(t=n.lang().monthsParse(t),typeof t!="number")?n:(i=Math.min(n.date(),pt(n.year(),t)),n._d["set"+(n._isUTC?"UTC":"")+"Month"](t,i),n)
    }
    function ti(n,t){
    return n._d["get"+(n._isUTC?"UTC":"")+t]()
    }
    function or(n,t,i){
    return t==="Month"?er(n,i):n._d["set"+(n._isUTC?"UTC":"")+t](i)
    }
    function v(n,i){
    return function(r){
        return r!=null?(or(this,n,r),t.updateOffset(this,i),this):ti(this,n)
        }
    }
function cf(n){
    t.duration.fn[n]=function(){
        return this._data[n]
        }
    }
function sr(n,i){
    t.duration.fn["as"+n]=function(){
        return+this/i
        }
    }
function hr(n){
    typeof ender=="undefined"&&(ii=rt.moment,rt.moment=n?g("Accessing Moment through the global scope is deprecated, and will be removed in an upcoming release.",t):t)
    }
    for(var t,rt=typeof global!="undefined"?global:this,ii,b=Math.round,u,o=0,s=1,e=2,h=3,nt=4,tt=5,it=6,y={},ri={
    _isAMomentObject:null,
    _i:null,
    _f:null,
    _l:null,
    _strict:null,
    _tzm:null,
    _isUTC:null,
    _offset:null,
    _pf:null,
    _lang:null
},ui=typeof module!="undefined"&&module.exports,cr=/^\/?Date\((\-?\d+)/i,lr=/(\-)?(?:(\d*)\.)?(\d+)\:(\d+)(?:\:(\d+)\.?(\d{3})?)?/,ar=/^(-)?P(?:(?:([0-9,.]*)Y)?(?:([0-9,.]*)M)?(?:([0-9,.]*)D)?(?:T(?:([0-9,.]*)H)?(?:([0-9,.]*)M)?(?:([0-9,.]*)S)?)?|([0-9,.]*)W)$/,fi=/(\[[^\[]*\])|(\\)?(Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Q|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|mm?|ss?|S{1,4}|X|zz?|ZZ?|.)/g,ut=/(\[[^\[]*\])|(\\)?(LT|LL?L?L?|l{1,4})/g,ei=/\d\d?/,vr=/\d{1,3}/,yr=/\d{1,4}/,pr=/[+\-]?\d{1,6}/,wr=/\d+/,br=/[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i,et=/Z|[\+\-]\d\d:?\d\d/gi,kr=/T/i,dr=/[\+\-]?\d+(\.\d{1,3})?/,gr=/\d{1,2}/,oi=/\d/,si=/\d\d/,hi=/\d{3}/,nu=/\d{4}/,tu=/[+-]?\d{6}/,iu=/[+-]?\d+/,ru=/^\s*(?:[+-]\d{6}|\d{4})-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,ot=[["YYYYYY-MM-DD",/[+-]\d{6}-\d{2}-\d{2}/],["YYYY-MM-DD",/\d{4}-\d{2}-\d{2}/],["GGGG-[W]WW-E",/\d{4}-W\d{2}-\d/],["GGGG-[W]WW",/\d{4}-W\d{2}/],["YYYY-DDD",/\d{4}-\d{3}/]],st=[["HH:mm:ss.SSSS",/(T| )\d\d:\d\d:\d\d\.\d+/],["HH:mm:ss",/(T| )\d\d:\d\d:\d\d/],["HH:mm",/(T| )\d\d:\d\d/],["HH",/(T| )\d\d/]],uu=/([\+\-]|\d\d)/gi,lf="Date|Hours|Minutes|Seconds|Milliseconds".split("|"),ht={
    Milliseconds:1,
    Seconds:1e3,
    Minutes:6e4,
    Hours:36e5,
    Days:864e5,
    Months:2592e6,
    Years:31536e6
},fu={
    ms:"millisecond",
    s:"second",
    m:"minute",
    h:"hour",
    d:"day",
    D:"date",
    w:"week",
    W:"isoWeek",
    M:"month",
    Q:"quarter",
    y:"year",
    DDD:"dayOfYear",
    e:"weekday",
    E:"isoWeekday",
    gg:"weekYear",
    GG:"isoWeekYear"
},eu={
    dayofyear:"dayOfYear",
    isoweekday:"isoWeekday",
    isoweek:"isoWeek",
    weekyear:"weekYear",
    isoweekyear:"isoWeekYear"
},ct={},p={
    s:45,
    m:45,
    h:22,
    dd:25,
    dm:45,
    dy:345
},ci="DDD w W M D d".split(" "),li="M D H h m s w W".split(" "),c={
    M:function(){
        return this.month()+1
        },
    MMM:function(n){
        return this.lang().monthsShort(this,n)
        },
    MMMM:function(n){
        return this.lang().months(this,n)
        },
    D:function(){
        return this.date()
        },
    DDD:function(){
        return this.dayOfYear()
        },
    d:function(){
        return this.day()
        },
    dd:function(n){
        return this.lang().weekdaysMin(this,n)
        },
    ddd:function(n){
        return this.lang().weekdaysShort(this,n)
        },
    dddd:function(n){
        return this.lang().weekdays(this,n)
        },
    w:function(){
        return this.week()
        },
    W:function(){
        return this.isoWeek()
        },
    YY:function(){
        return r(this.year()%100,2)
        },
    YYYY:function(){
        return r(this.year(),4)
        },
    YYYYY:function(){
        return r(this.year(),5)
        },
    YYYYYY:function(){
        var n=this.year(),t=n>=0?"+":"-";
        return t+r(Math.abs(n),6)
        },
    gg:function(){
        return r(this.weekYear()%100,2)
        },
    gggg:function(){
        return r(this.weekYear(),4)
        },
    ggggg:function(){
        return r(this.weekYear(),5)
        },
    GG:function(){
        return r(this.isoWeekYear()%100,2)
        },
    GGGG:function(){
        return r(this.isoWeekYear(),4)
        },
    GGGGG:function(){
        return r(this.isoWeekYear(),5)
        },
    e:function(){
        return this.weekday()
        },
    E:function(){
        return this.isoWeekday()
        },
    a:function(){
        return this.lang().meridiem(this.hours(),this.minutes(),!0)
        },
    A:function(){
        return this.lang().meridiem(this.hours(),this.minutes(),!1)
        },
    H:function(){
        return this.hours()
        },
    h:function(){
        return this.hours()%12||12
        },
    m:function(){
        return this.minutes()
        },
    s:function(){
        return this.seconds()
        },
    S:function(){
        return i(this.milliseconds()/100)
        },
    SS:function(){
        return r(i(this.milliseconds()/10),2)
        },
    SSS:function(){
        return r(this.milliseconds(),3)
        },
    SSSS:function(){
        return r(this.milliseconds(),3)
        },
    Z:function(){
        var n=-this.zone(),t="+";
        return n<0&&(n=-n,t="-"),t+r(i(n/60),2)+":"+r(i(n)%60,2)
        },
    ZZ:function(){
        var n=-this.zone(),t="+";
        return n<0&&(n=-n,t="-"),t+r(i(n/60),2)+r(i(n)%60,2)
        },
    z:function(){
        return this.zoneAbbr()
        },
    zz:function(){
        return this.zoneName()
        },
    X:function(){
        return this.unix()
        },
    Q:function(){
        return this.quarter()
        }
    },ai=["months","monthsShort","weekdays","weekdaysShort","weekdaysMin"];ci.length;)u=ci.pop(),c[u+"o"]=ou(c[u],u);
while(li.length)u=li.pop(),c[u+u]=vi(c[u],2);
for(c.DDDD=vi(c.DDD,3),l(yi.prototype,{
    set:function(n){
        var t;
        for(var i in n)t=n[i],typeof t=="function"?this[i]=t:this["_"+i]=t
            },
    _months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_"),
    months:function(n){
        return this._months[n.month()]
        },
    _monthsShort:"Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"),
    monthsShort:function(n){
        return this._monthsShort[n.month()]
        },
    monthsParse:function(n){
        var i,r,u;
        for(this._monthsParse||(this._monthsParse=[]),i=0;i<12;i++)if(this._monthsParse[i]||(r=t.utc([2e3,i]),u="^"+this.months(r,"")+"|^"+this.monthsShort(r,""),this._monthsParse[i]=new RegExp(u.replace(".",""),"i")),this._monthsParse[i].test(n))return i
            },
    _weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),
    weekdays:function(n){
        return this._weekdays[n.day()]
        },
    _weekdaysShort:"Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),
    weekdaysShort:function(n){
        return this._weekdaysShort[n.day()]
        },
    _weekdaysMin:"Su_Mo_Tu_We_Th_Fr_Sa".split("_"),
    weekdaysMin:function(n){
        return this._weekdaysMin[n.day()]
        },
    weekdaysParse:function(n){
        var i,r,u;
        for(this._weekdaysParse||(this._weekdaysParse=[]),i=0;i<7;i++)if(this._weekdaysParse[i]||(r=t([2e3,1]).day(i),u="^"+this.weekdays(r,"")+"|^"+this.weekdaysShort(r,"")+"|^"+this.weekdaysMin(r,""),this._weekdaysParse[i]=new RegExp(u.replace(".",""),"i")),this._weekdaysParse[i].test(n))return i
            },
    _longDateFormat:{
        LT:"h:mm A",
        L:"MM/DD/YYYY",
        LL:"MMMM D YYYY",
        LLL:"MMMM D YYYY LT",
        LLLL:"dddd, MMMM D YYYY LT"
    },
    longDateFormat:function(n){
        var t=this._longDateFormat[n];
        return!t&&this._longDateFormat[n.toUpperCase()]&&(t=this._longDateFormat[n.toUpperCase()].replace(/MMMM|MM|DD|dddd/g,function(n){
            return n.slice(1)
            }),this._longDateFormat[n]=t),t
        },
    isPM:function(n){
        return(n+"").toLowerCase().charAt(0)==="p"
        },
    _meridiemParse:/[ap]\.?m?\.?/i,
    meridiem:function(n,t,i){
        return n>11?i?"pm":"PM":i?"am":"AM"
        },
    _calendar:{
        sameDay:"[Today at] LT",
        nextDay:"[Tomorrow at] LT",
        nextWeek:"dddd [at] LT",
        lastDay:"[Yesterday at] LT",
        lastWeek:"[Last] dddd [at] LT",
        sameElse:"L"
    },
    calendar:function(n,t){
        var i=this._calendar[n];
        return typeof i=="function"?i.apply(t):i
        },
    _relativeTime:{
        future:"in %s",
        past:"%s ago",
        s:"a few seconds",
        m:"a minute",
        mm:"%d minutes",
        h:"an hour",
        hh:"%d hours",
        d:"a day",
        dd:"%d days",
        M:"a month",
        MM:"%d months",
        y:"a year",
        yy:"%d years"
    },
    relativeTime:function(n,t,i,r){
        var u=this._relativeTime[i];
        return typeof u=="function"?u(n,t,i,r):u.replace(/%d/i,n)
        },
    pastFuture:function(n,t){
        var i=this._relativeTime[n>0?"future":"past"];
        return typeof i=="function"?i(t):i.replace(/%s/i,t)
        },
    ordinal:function(n){
        return this._ordinal.replace("%d",n)
        },
    _ordinal:"%d",
    preparse:function(n){
        return n
        },
    postformat:function(n){
        return n
        },
    week:function(n){
        return k(n,this._week.dow,this._week.doy).week
        },
    _week:{
        dow:0,
        doy:6
    },
    _invalidDate:"Invalid date",
    invalidDate:function(){
        return this._invalidDate
        }
    }),t=function(t,i,r,u){
    var f;
    return typeof r=="boolean"&&(u=r,r=n),f={},f._isAMomentObject=!0,f._i=t,f._f=i,f._l=r,f._strict=u,f._isUTC=!1,f._pf=lt(),ur(f)
    },t.suppressDeprecationWarnings=!1,t.createFromInputFallback=g("moment construction falls back to js Date. This is discouraged and will be removed in upcoming major release. Please refer to https://github.com/moment/moment/issues/1407 for more info.",function(n){
    n._d=new Date(n._i)
    }),t.min=function(){
    var n=[].slice.call(arguments,0);
    return fr("isBefore",n)
    },t.max=function(){
    var n=[].slice.call(arguments,0);
    return fr("isAfter",n)
    },t.utc=function(t,i,r,u){
    var f;
    return typeof r=="boolean"&&(u=r,r=n),f={},f._isAMomentObject=!0,f._useUTC=!0,f._isUTC=!0,f._l=r,f._i=t,f._f=i,f._strict=u,f._pf=lt(),ur(f).utc()
    },t.unix=function(n){
    return t(n*1e3)
    },t.duration=function(n,r){
    var s=n,u=null,f,c,o;
    return t.isDuration(n)?s={
        ms:n._milliseconds,
        d:n._days,
        M:n._months
        }:typeof n=="number"?(s={},r?s[r]=n:s.milliseconds=n):(u=lr.exec(n))?(f=u[1]==="-"?-1:1,s={
        y:0,
        d:i(u[e])*f,
        h:i(u[h])*f,
        m:i(u[nt])*f,
        s:i(u[tt])*f,
        ms:i(u[it])*f
        }):!(u=ar.exec(n))||(f=u[1]==="-"?-1:1,o=function(n){
        var t=n&&parseFloat(n.replace(",","."));
        return(isNaN(t)?0:t)*f
        },s={
        y:o(u[2]),
        M:o(u[3]),
        d:o(u[4]),
        h:o(u[5]),
        m:o(u[6]),
        s:o(u[7]),
        w:o(u[8])
        }),c=new vt(s),t.isDuration(n)&&n.hasOwnProperty("_lang")&&(c._lang=n._lang),c
    },t.version="2.7.0",t.defaultFormat="YYYY-MM-DDTHH:mm:ssZ",t.ISO_8601=function(){},t.momentProperties=ri,t.updateOffset=function(){},t.relativeTimeThreshold=function(t,i){
    return p[t]===n?!1:(p[t]=i,!0)
    },t.lang=function(n,i){
    var r;
    return n?(i?lu(wt(n),i):i===null?(au(n),n="en"):y[n]||f(n),r=t.duration.fn._lang=t.fn._lang=f(n),r._abbr):t.fn._lang._abbr
    },t.langData=function(n){
    return n&&n._lang&&n._lang._abbr&&(n=n._lang._abbr),f(n)
    },t.isMoment=function(n){
    return n instanceof at||n!=null&&n.hasOwnProperty("_isAMomentObject")
    },t.isDuration=function(n){
    return n instanceof vt
    },u=ai.length-1;u>=0;--u)cu(ai[u]);
t.normalizeUnits=function(n){
    return a(n)
    };
    
t.invalid=function(n){
    var i=t.utc(NaN);
    return n!=null?l(i._pf,n):i._pf.userInvalidated=!0,i
    };
    
t.parseZone=function(){
    return t.apply(null,arguments).parseZone()
    };
    
t.parseTwoDigitYear=function(n){
    return i(n)+(i(n)>68?1900:2e3)
    };
    
l(t.fn=at.prototype,{
    clone:function(){
        return t(this)
        },
    valueOf:function(){
        return+this._d+(this._offset||0)*6e4
        },
    unix:function(){
        return Math.floor(+this/1e3)
        },
    toString:function(){
        return this.clone().lang("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")
        },
    toDate:function(){
        return this._offset?new Date(+this):this._d
        },
    toISOString:function(){
        var n=t(this).utc();
        return 0<n.year()&&n.year()<=9999?kt(n,"YYYY-MM-DD[T]HH:mm:ss.SSS[Z]"):kt(n,"YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]")
        },
    toArray:function(){
        var n=this;
        return[n.year(),n.month(),n.date(),n.hours(),n.minutes(),n.seconds(),n.milliseconds()]
        },
    isValid:function(){
        return nr(this)
        },
    isDSTShifted:function(){
        return this._a?this.isValid()&&pi(this._a,(this._isUTC?t.utc(this._a):t(this._a)).toArray())>0:!1
        },
    parsingFlags:function(){
        return l({},this._pf)
        },
    invalidAt:function(){
        return this._pf.overflow
        },
    utc:function(){
        return this.zone(0)
        },
    local:function(){
        return this.zone(0),this._isUTC=!1,this
        },
    format:function(n){
        var i=kt(this,n||t.defaultFormat);
        return this.lang().postformat(i)
        },
    add:function(n,i){
        var r;
        return r=typeof n=="string"&&typeof i=="string"?t.duration(isNaN(+i)?+n:+i,isNaN(+i)?i:n):typeof n=="string"?t.duration(+i,n):t.duration(n,i),yt(this,r,1),this
        },
    subtract:function(n,i){
        var r;
        return r=typeof n=="string"&&typeof i=="string"?t.duration(isNaN(+i)?+n:+i,isNaN(+i)?i:n):typeof n=="string"?t.duration(+i,n):t.duration(n,i),yt(this,r,-1),this
        },
    diff:function(n,i,r){
        var f=bt(n,this),o=(this.zone()-f.zone())*6e4,u,e;
        return i=a(i),i==="year"||i==="month"?(u=(this.daysInMonth()+f.daysInMonth())*432e5,e=(this.year()-f.year())*12+(this.month()-f.month()),e+=(this-t(this).startOf("month")-(f-t(f).startOf("month")))/u,e-=(this.zone()-t(this).startOf("month").zone()-(f.zone()-t(f).startOf("month").zone()))*6e4/u,i==="year"&&(e=e/12)):(u=this-f,e=i==="second"?u/1e3:i==="minute"?u/6e4:i==="hour"?u/36e5:i==="day"?(u-o)/864e5:i==="week"?(u-o)/6048e5:u),r?e:w(e)
        },
    from:function(n,i){
        return t.duration(this.diff(n)).lang(this.lang()._abbr).humanize(!i)
        },
    fromNow:function(n){
        return this.from(t(),n)
        },
    calendar:function(n){
        var r=n||t(),u=bt(r,this).startOf("day"),i=this.diff(u,"days",!0),f=i<-6?"sameElse":i<-1?"lastWeek":i<0?"lastDay":i<1?"sameDay":i<2?"nextDay":i<7?"nextWeek":"sameElse";
        return this.format(this.lang().calendar(f,this))
        },
    isLeapYear:function(){
        return di(this.year())
        },
    isDST:function(){
        return this.zone()<this.clone().month(0).zone()||this.zone()<this.clone().month(5).zone()
        },
    day:function(n){
        var t=this._isUTC?this._d.getUTCDay():this._d.getDay();
        return n!=null?(n=ef(n,this.lang()),this.add({
            d:n-t
            })):t
        },
    month:v("Month",!0),
    startOf:function(n){
        n=a(n);
        switch(n){
            case"year":
                this.month(0);
            case"quarter":case"month":
                this.date(1);
            case"week":case"isoWeek":case"day":
                this.hours(0);
            case"hour":
                this.minutes(0);
            case"minute":
                this.seconds(0);
            case"second":
                this.milliseconds(0)
                }
                return n==="week"?this.weekday(0):n==="isoWeek"&&this.isoWeekday(1),n==="quarter"&&this.month(Math.floor(this.month()/3)*3),this
        },
    endOf:function(n){
        return n=a(n),this.startOf(n).add(n==="isoWeek"?"week":n,1).subtract("ms",1)
        },
    isAfter:function(n,i){
        return i=typeof i!="undefined"?i:"millisecond",+this.clone().startOf(i)>+t(n).startOf(i)
        },
    isBefore:function(n,i){
        return i=typeof i!="undefined"?i:"millisecond",+this.clone().startOf(i)<+t(n).startOf(i)
        },
    isSame:function(n,t){
        return t=t||"ms",+this.clone().startOf(t)==+bt(n,this).startOf(t)
        },
    min:g("moment().min is deprecated, use moment.min instead. https://github.com/moment/moment/issues/1548",function(n){
        return n=t.apply(null,arguments),n<this?this:n
        }),
    max:g("moment().max is deprecated, use moment.max instead. https://github.com/moment/moment/issues/1548",function(n){
        return n=t.apply(null,arguments),n>this?this:n
        }),
    zone:function(n,i){
        var r=this._offset||0;
        if(n!=null)typeof n=="string"&&(n=ir(n)),Math.abs(n)<16&&(n=n*60),this._offset=n,this._isUTC=!0,r!==n&&(!i||this._changeInProgress?yt(this,t.duration(r-n,"m"),1,!1):this._changeInProgress||(this._changeInProgress=!0,t.updateOffset(this,!0),this._changeInProgress=null));else return this._isUTC?r:this._d.getTimezoneOffset();
        return this
        },
    zoneAbbr:function(){
        return this._isUTC?"UTC":""
        },
    zoneName:function(){
        return this._isUTC?"Coordinated Universal Time":""
        },
    parseZone:function(){
        return this._tzm?this.zone(this._tzm):typeof this._i=="string"&&this.zone(this._i),this
        },
    hasAlignedHourOffset:function(n){
        return n=n?t(n).zone():0,(this.zone()-n)%60==0
        },
    daysInMonth:function(){
        return pt(this.year(),this.month())
        },
    dayOfYear:function(n){
        var i=b((t(this).startOf("day")-t(this).startOf("year"))/864e5)+1;
        return n==null?i:this.add("d",n-i)
        },
    quarter:function(n){
        return n==null?Math.ceil((this.month()+1)/3):this.month((n-1)*3+this.month()%3)
        },
    weekYear:function(n){
        var t=k(this,this.lang()._week.dow,this.lang()._week.doy).year;
        return n==null?t:this.add("y",n-t)
        },
    isoWeekYear:function(n){
        var t=k(this,1,4).year;
        return n==null?t:this.add("y",n-t)
        },
    week:function(n){
        var t=this.lang().week(this);
        return n==null?t:this.add("d",(n-t)*7)
        },
    isoWeek:function(n){
        var t=k(this,1,4).week;
        return n==null?t:this.add("d",(n-t)*7)
        },
    weekday:function(n){
        var t=(this.day()+7-this.lang()._week.dow)%7;
        return n==null?t:this.add("d",n-t)
        },
    isoWeekday:function(n){
        return n==null?this.day()||7:this.day(this.day()%7?n:n-7)
        },
    isoWeeksInYear:function(){
        return bi(this.year(),1,4)
        },
    weeksInYear:function(){
        var n=this._lang._week;
        return bi(this.year(),n.dow,n.doy)
        },
    get:function(n){
        return n=a(n),this[n]()
        },
    set:function(n,t){
        return n=a(n),typeof this[n]=="function"&&this[n](t),this
        },
    lang:function(t){
        return t===n?this._lang:(this._lang=f(t),this)
        }
    });
t.fn.millisecond=t.fn.milliseconds=v("Milliseconds",!1);
t.fn.second=t.fn.seconds=v("Seconds",!1);
t.fn.minute=t.fn.minutes=v("Minutes",!1);
t.fn.hour=t.fn.hours=v("Hours",!0);
t.fn.date=v("Date",!0);
t.fn.dates=g("dates accessor is deprecated. Use date instead.",v("Date",!0));
t.fn.year=v("FullYear",!0);
t.fn.years=g("years accessor is deprecated. Use year instead.",v("FullYear",!0));
t.fn.days=t.fn.day;
t.fn.months=t.fn.month;
t.fn.weeks=t.fn.week;
t.fn.isoWeeks=t.fn.isoWeek;
t.fn.quarters=t.fn.quarter;
t.fn.toJSON=t.fn.toISOString;
l(t.duration.fn=vt.prototype,{
    _bubble:function(){
        var e=this._milliseconds,t=this._days,i=this._months,n=this._data,r,u,f,o;
        n.milliseconds=e%1e3;
        r=w(e/1e3);
        n.seconds=r%60;
        u=w(r/60);
        n.minutes=u%60;
        f=w(u/60);
        n.hours=f%24;
        t+=w(f/24);
        n.days=t%30;
        i+=w(t/30);
        n.months=i%12;
        o=w(i/12);
        n.years=o
        },
    weeks:function(){
        return w(this.days()/7)
        },
    valueOf:function(){
        return this._milliseconds+this._days*864e5+this._months%12*2592e6+i(this._months/12)*31536e6
        },
    humanize:function(n){
        var i=+this,t=sf(i,!n,this.lang());
        return n&&(t=this.lang().pastFuture(i,t)),this.lang().postformat(t)
        },
    add:function(n,i){
        var r=t.duration(n,i);
        return this._milliseconds+=r._milliseconds,this._days+=r._days,this._months+=r._months,this._bubble(),this
        },
    subtract:function(n,i){
        var r=t.duration(n,i);
        return this._milliseconds-=r._milliseconds,this._days-=r._days,this._months-=r._months,this._bubble(),this
        },
    get:function(n){
        return n=a(n),this[n.toLowerCase()+"s"]()
        },
    as:function(n){
        return n=a(n),this["as"+n.charAt(0).toUpperCase()+n.slice(1)+"s"]()
        },
    lang:t.fn.lang,
    toIsoString:function(){
        var r=Math.abs(this.years()),u=Math.abs(this.months()),f=Math.abs(this.days()),n=Math.abs(this.hours()),t=Math.abs(this.minutes()),i=Math.abs(this.seconds()+this.milliseconds()/1e3);
        return this.asSeconds()?(this.asSeconds()<0?"-":"")+"P"+(r?r+"Y":"")+(u?u+"M":"")+(f?f+"D":"")+(n||t||i?"T":"")+(n?n+"H":"")+(t?t+"M":"")+(i?i+"S":""):"P0D"
        }
    });
for(u in ht)ht.hasOwnProperty(u)&&(sr(u,ht[u]),cf(u.toLowerCase()));sr("Weeks",6048e5);
t.duration.fn.asMonths=function(){
    return(+this-this.years()*31536e6)/2592e6+this.years()*12
    };
    
t.lang("en",{
    ordinal:function(n){
        var t=n%10,r=i(n%100/10)===1?"th":t===1?"st":t===2?"nd":t===3?"rd":"th";
        return n+r
        }
    });
ui?module.exports=t:typeof define=="function"&&define.amd?(define("moment",function(n,i,r){
    return r.config&&r.config()&&r.config().noGlobal===!0&&(rt.moment=ii),t
    }),hr(!0)):hr()
}.call(this);
Number.formatFunctions={
    count:0
};

Number.prototype.NaNstring="NaN";
Number.prototype.posInfinity="Infinity";
Number.prototype.negInfinity="-Infinity";
Number.prototype.conditionRE=/\[(>=|<=|=|>|<)([0-9\.]+)\]/;
Number.prototype.numberFormat=function(n,t){
    return isNaN(this)?Number.prototype.NaNstring:this==+Infinity?Number.prototype.posInfinity:this==-Infinity?Number.prototype.negInfinity:(Number.formatFunctions[n]==null&&Number.createNewFormat(n),this[Number.formatFunctions[n]](t))
    };
    
Number.createNewFormat=function(format){
    var funcName="format"+Number.formatFunctions.count++,i,format,newFormat;
    Number.formatFunctions[format]=funcName;
    var code="Number.prototype."+funcName+" = function(context){\n",formats=format.split(";"),equalConditionsCode="",otherConditionsCode="",rulesWithoutConditionsCount=0,defaultRuleFormat="###.##";
    if(formats.length<2&&format.match(Number.prototype.conditionRE)==null)code+=Number.createTerminalFormat(format);
    else{
        for(i=0;format=formats[i];i++)if((result=format.match(Number.prototype.conditionRE))!==null)newFormat=format.replace(result[0],""),result[1]=="="?equalConditionsCode+=Number.createConditionCode(result[1],result[2],newFormat):otherConditionsCode+=Number.createConditionCode(result[1],result[2],newFormat);
            else{
            switch(rulesWithoutConditionsCount){
                case 0:
                    defaultRuleFormat=format;
                    otherConditionsCode+=Number.createConditionCode(">=",0,format);
                    break;
                case 1:
                    otherConditionsCode+=Number.createConditionCode("<",0,format);
                    break;
                case 2:
                    equalConditionsCode+=Number.createConditionCode("=",0,format);
                    break;
                default:
                    equalConditionsCode="throw 'Too many semicolons in format string';"+equalConditionsCode
                    }
                    rulesWithoutConditionsCount++
        }
        rulesWithoutConditionsCount==1?otherConditionsCode+=Number.createConditionCode("<",0,defaultRuleFormat):rulesWithoutConditionsCount==0&&(otherConditionsCode+=Number.createConditionCode("all",0,defaultRuleFormat));
        code+=equalConditionsCode+otherConditionsCode
        }
        code+="}";
    eval(code)
    };
    
Number.createConditionCode=function(n,t,i){
    var r="";
    if(n=="all")return"\nreturn this.numberFormat('"+String.escape(i)+"', 1);";
    switch(n){
        case"=":
            r="==";
            break;
        case">":
            r="> ";
            break;
        case"<":
            r="< ";
            break;
        case">=":
            r=">=";
            break;
        case"<=":
            r="<=";
            break;
        default:
            throw"Error! Unrecognized condition format!";
    }
    return"\nif (this "+r+" "+parseFloat(t,10)+") {return this.numberFormat('"+String.escape(i)+"', 1);}"
    };
    
Number.createTerminalFormat=function(n){
    var t;
    if(n.length>0&&n.search(/[0#?]/)==-1)return"return '"+String.escape(n)+"';\n";
    var i="var val = (context == null) ? new Number(this) : Math.abs(this);\n",e=!1,r=n,o="",s=0,u=0,f=0,h=!1,c="";
    return t=n.match(/\..*(e)([+-]?)(0+)/i),t&&(c=t[1],h=t[2]=="+",f=t[3].length,n=n.replace(/(e)([+-]?)(0+)/i,"")),t=n.match(/^([^.]*)\.(.*)$/),t&&(r=t[1].replace(/\./g,""),o=t[2].replace(/\./g,"")),n.indexOf("%")>=0&&(i+="val *= 100;\n"),t=r.match(/(,+)(?:$|[^0#?,])/),t&&(i+="val /= "+Math.pow(1e3,t[1].length)+"\n;"),r.search(/[0#?],[0#?]/)>=0&&(e=!0),(t||e)&&(r=r.replace(/,/g,"")),t=r.match(/0[0#?]*/),t&&(s=t[0].length),t=o.match(/[0#?]*/),t&&(u=t[0].length),f>0?i+="var sci = Number.toScientific(val,"+s+", "+u+", "+f+", "+h+");\nvar arr = [sci.l, sci.r];\n":(n.indexOf(".")<0&&(i+="var sign = (this < 0 && context == null) ? -1 : 1;\n",i+="val = Math.round(val*sign)*sign;\n"),i+="var arr = val.round("+u+").toFixed("+u+").split('.');\n",i+="arr[0] = (val < 0 ? '-' : '') + String.leftPad((val < 0 ? arr[0].substring(1) : arr[0]), "+s+", '0');\n"),e&&(i+="arr[0] = Number.addSeparators(arr[0]);\n"),i+="arr[0] = Number.injectIntoFormat(arr[0].reverse(), '"+String.escape(r.reverse())+"', true).reverse();\n",u>0&&(i+="arr[1] = Number.injectIntoFormat(arr[1], '"+String.escape(o)+"', false);\n"),f>0&&(i+="arr[1] = arr[1].replace(/(\\d{"+u+"})/, '$1"+c+"' + sci.s);\n"),i+"return arr.join('.');\n"
    };
    
Number.toScientific=function(n,t,i,r,u){
    var e={
        l:"",
        r:"",
        s:""
    },o="",s=Math.abs(n).toFixed(t+i+1).trim("0"),f=Math.round(new Number(s.replace(".","").replace(new RegExp("(\\d{"+(t+i)+"})(.*)"),"$1.$2"))).toFixed(0);
    return f.length>=t?f=f.substring(0,t)+"."+f.substring(t):f+=".",e.s=s.indexOf(".")-s.search(/[1-9]/)-f.indexOf("."),e.s<0&&e.s++,e.l=(n<0?"-":"")+String.leftPad(f.substring(0,f.indexOf(".")),t,"0"),e.r=f.substring(f.indexOf(".")+1),e.s<0?o="-":u&&(o="+"),e.s=o+String.leftPad(Math.abs(e.s).toFixed(0),r,"0"),e
    };
    
Number.prototype.round=function(n){
    var t,r,i;
    return n>0&&(decimalPrecision=Math.min(n+10,20),t=this.toFixed(decimalPrecision).match(new RegExp("(-?\\d*).(\\d{"+n+"})(\\d)\\d*$")),t&&t.length)?(r=t[1].charAt(0)=="-"?-1:1,i=String.leftPad(Math.round(t[2]+"."+t[3]),n,"0"),i.length>n?new Number(t[1])+r:new Number(t[1]+"."+i)):this
    };
    
Number.injectIntoFormat=function(n,t,i){
    var r=0,u=0,f="",e=n.charAt(n.length-1)=="-";
    for(e&&(n=n.substring(0,n.length-1));r<t.length&&u<n.length&&t.substring(r).search(/[0#?]/)>=0;)t.charAt(r).match(/[0#?]/)?(f+=n.charAt(u)!="-"?n.charAt(u):"0",u++):f+=t.charAt(r),++r;
    return e&&u==n.length&&(f+="-"),u<n.length&&(i&&(f+=n.substring(u)),e&&(f+="-")),r<t.length&&(f+=t.substring(r)),f.replace(/#/g,"").replace(/\?/g," ")
    };
    
Number.addSeparators=function(n){
    return n.reverse().replace(/(\d{3})/g,"$1,").reverse().replace(/^(-)?,/,"$1")
    };
    
String.prototype.reverse=function(){
    for(var t="",n=this.length;n>0;--n)t+=this.charAt(n-1);
    return t
    };
    
String.prototype.trim=function(n){
    return n||(n=" "),this.replace(new RegExp("^"+n+"+|"+n+"+$","g"),"")
    };
    
String.leftPad=function(n,t,i){
    var r=new String(n);
    for(i==null&&(i=" ");r.length<t;)r=i+r;
    return r
    };
    
String.escape=function(n){
    return n.replace(/(')/g,"\\$1").replace(/[\r\n]/g,"")
    };
    
window.rangy=function(){
    function t(n,t){
        var i=typeof n[t];
        return i==k||!!(i==p&&n[t])||i=="unknown"
        }
        function f(n,t){
        return!!(typeof n[t]==p&&n[t])
        }
        function w(n,t){
        return typeof n[t]!=r
        }
        function s(n){
        return function(t,i){
            for(var r=i.length;r--;)if(!n(t,i[r]))return!1;return!0
            }
        }
    function b(n){
    return n&&h(n,tt)&&c(n,nt)
    }
    function i(t){
    window.alert("Rangy not supported in your browser. Reason: "+t);
    n.initialized=!0;
    n.supported=!1
    }
    function rt(t){
    var i="Rangy warning: "+t;
    n.config.alertOnWarn?window.alert(i):typeof console!=r&&typeof window.console.log!=r&&window.console.log(i)
    }
    function v(){
    var r,u,e,o,v,s,y;
    if(!n.initialized)for(u=!1,e=!1,t(document,"createRange")&&(r=document.createRange(),h(r,g)&&c(r,d)&&(u=!0),r.detach()),o=f(document,"body")?document.body:document.getElementsByTagName("body")[0],o&&t(o,"createTextRange")&&(r=o.createTextRange(),b(r)&&(e=!0)),u||e||i("Neither Range nor TextRange are implemented"),n.initialized=!0,n.features={
        implementsDomRange:u,
        implementsTextRange:e
    },v=a.concat(l),s=0,y=v.length;s<y;++s)try{
        v[s](n)
        }catch(p){
        f(window,"console")&&t(window.console,"log")&&window.console.log("Init listener threw an exception. Continuing.",p)
        }
    }
    function ut(n){
    n=n||window;
    v();
    for(var t=0,i=e.length;t<i;++t)e[t](n)
        }
        function u(n){
    this.name=n;
    this.initialized=!1;
    this.supported=!1
    }
    var p="object",k="function",r="undefined",d=["startContainer","startOffset","endContainer","endOffset","collapsed","commonAncestorContainer","START_TO_START","START_TO_END","END_TO_START","END_TO_END"],g=["setStart","setStartBefore","setStartAfter","setEnd","setEndBefore","setEndAfter","collapse","selectNode","selectNodeContents","compareBoundaryPoints","deleteContents","extractContents","cloneContents","insertNode","surroundContents","cloneRange","toString","detach"],nt=["boundingHeight","boundingLeft","boundingTop","boundingWidth","htmlText","text"],tt=["collapse","compareEndPoints","duplicate","getBookmark","moveToBookmark","moveToElementText","parentElement","pasteHTML","select","setEndPoint","getBoundingClientRect"],h=s(t),it=s(f),c=s(w),n={
    version:"1.2.3",
    initialized:!1,
    supported:!0,
    util:{
        isHostMethod:t,
        isHostObject:f,
        isHostProperty:w,
        areHostMethods:h,
        areHostObjects:it,
        areHostProperties:c,
        isTextRange:b
    },
    features:{},
    modules:{},
    config:{
        alertOnWarn:!1,
        preferTextRange:!1
        }
    },l,a,e,y,o;
if(n.fail=i,n.warn=rt,{}.hasOwnProperty?n.util.extend=function(n,t){
    for(var i in t)t.hasOwnProperty(i)&&(n[i]=t[i])
        }:i("hasOwnProperty not supported"),l=[],a=[],n.init=v,n.addInitListener=function(t){
    n.initialized?t(n):l.push(t)
    },e=[],n.addCreateMissingNativeApiListener=function(n){
    e.push(n)
    },n.createMissingNativeApi=ut,u.prototype.fail=function(n){
    this.initialized=!0;
    this.supported=!1;
    throw new Error("Module '"+this.name+"' failed to load: "+n);
},u.prototype.warn=function(t){
    n.warn("Module "+this.name+": "+t)
    },u.prototype.createError=function(n){
    return new Error("Error in Rangy "+this.name+" module: "+n)
    },n.createModule=function(t,i){
    var r=new u(t);
    n.modules[t]=r;
    a.push(function(n){
        i(n,r);
        r.initialized=!0;
        r.supported=!0
        })
    },n.requireModules=function(t){
    for(var f=0,e=t.length,i,r;f<e;++f){
        if(r=t[f],i=n.modules[r],!i||!(i instanceof u))throw new Error("Module '"+r+"' not found");
        if(!i.supported)throw new Error("Module '"+r+"' not supported");
    }
    },y=!1,o=function(){
    y||(y=!0,n.initialized||v())
    },typeof window==r){
    i("No window found");
    return
}
if(typeof document==r){
    i("No document found");
    return
}
return t(document,"addEventListener")&&document.addEventListener("DOMContentLoaded",o,!1),t(window,"addEventListener")?window.addEventListener("load",o,!1):t(window,"attachEvent")?window.attachEvent("onload",o):i("Window does not have required addEventListener or attachEvent method"),n
}();
rangy.createModule("DomUtil",function(n,t){
    function b(n){
        var t;
        return typeof n.namespaceURI==i||(t=n.namespaceURI)===null||t=="http://www.w3.org/1999/xhtml"
        }
        function k(n){
        var t=n.parentNode;
        return t.nodeType==1?t:null
        }
        function h(n){
        for(var t=0;n=n.previousSibling;)t++;
        return t
        }
        function d(n){
        var t;
        return c(n)?n.length:(t=n.childNodes)?t.length:0
        }
        function a(n,t){
        for(var r=[],i=n;i;i=i.parentNode)r.push(i);
        for(i=t;i;i=i.parentNode)if(s(r,i))return i;return null
        }
        function g(n,t,i){
        for(var r=i?t:t.parentNode;r;){
            if(r===n)return!0;
            r=r.parentNode
            }
            return!1
        }
        function f(n,t,i){
        for(var u,r=i?n:n.parentNode;r;){
            if(u=r.parentNode,u===t)return r;
            r=u
            }
            return null
        }
        function c(n){
        var t=n.nodeType;
        return t==3||t==4||t==8
        }
        function v(n,t){
        var i=t.nextSibling,r=t.parentNode;
        return i?r.insertBefore(n,i):r.appendChild(n),n
        }
        function nt(n,t){
        var i=n.cloneNode(!1);
        return i.deleteData(0,t),n.deleteData(t,n.length-t),v(i,n),i
        }
        function e(n){
        if(n.nodeType==9)return n;
        if(typeof n.ownerDocument!=i)return n.ownerDocument;
        if(typeof n.document!=i)return n.document;
        if(n.parentNode)return e(n.parentNode);
        throw new Error("getDocument: no document found for node");
    }
    function tt(n){
        var t=e(n);
        if(typeof t.defaultView!=i)return t.defaultView;
        if(typeof t.parentWindow!=i)return t.parentWindow;
        throw new Error("Cannot get a window object for node");
    }
    function it(n){
        if(typeof n.contentDocument!=i)return n.contentDocument;
        if(typeof n.contentWindow!=i)return n.contentWindow.document;
        throw new Error("getIframeWindow: No Document object found for iframe element");
    }
    function rt(n){
        if(typeof n.contentWindow!=i)return n.contentWindow;
        if(typeof n.contentDocument!=i)return n.contentDocument.defaultView;
        throw new Error("getIframeWindow: No Window object found for iframe element");
    }
    function ut(n){
        return r.isHostObject(n,"body")?n.body:n.getElementsByTagName("body")[0]
        }
        function ft(n){
        for(var t;t=n.parentNode;)n=t;
        return n
        }
        function et(n,t,i,r){
        var o,u,s,c,e;
        if(n==i)return t===r?0:t<r?-1:1;
        if(o=f(i,n,!0))return t<=h(o)?-1:1;
        if(o=f(n,i,!0))return h(o)<r?-1:1;
        if(u=a(n,i),s=n===u?u:f(n,u,!0),c=i===u?u:f(i,u,!0),s===c)throw new Error("comparePoints got to case 4 and childA and childB are the same!");
        else{
            for(e=u.firstChild;e;){
                if(e===s)return-1;
                if(e===c)return 1;
                e=e.nextSibling
                }
                throw new Error("Should not be here!");
        }
    }
    function ot(n){
    for(var t=e(n).createDocumentFragment(),i;i=n.firstChild;)t.appendChild(i);
    return t
    }
    function y(n){
    if(!n)return"[No node]";
    if(c(n))return'"'+n.data+'"';
    if(n.nodeType==1){
        var t=n.id?' id="'+n.id+'"':"";
        return"<"+n.nodeName+t+">["+n.childNodes.length+"]"
        }
        return n.nodeName
    }
    function p(n){
    this.root=n;
    this._next=n
    }
    function st(n){
    return new p(n)
    }
    function w(n,t){
    this.node=n;
    this.offset=t
    }
    function l(n){
    this.code=this[n];
    this.codeName=n;
    this.message="DOMException: "+this.codeName
    }
    var i="undefined",r=n.util,u,o,s;
r.areHostMethods(document,["createDocumentFragment","createElement","createTextNode"])||t.fail("document missing a Node creation method");
    r.isHostMethod(document,"getElementsByTagName")||t.fail("document missing getElementsByTagName method");
    u=document.createElement("div");
    r.areHostMethods(u,["insertBefore","appendChild","cloneNode"]||!r.areHostObjects(u,["previousSibling","nextSibling","childNodes","parentNode"]))||t.fail("Incomplete Element implementation");
    r.isHostProperty(u,"innerHTML")||t.fail("Element is missing innerHTML property");
    o=document.createTextNode("test");
    r.areHostMethods(o,["splitText","deleteData","insertData","appendData","cloneNode"]||!r.areHostObjects(u,["previousSibling","nextSibling","childNodes","parentNode"])||!r.areHostProperties(o,["data"]))||t.fail("Incomplete Text Node implementation");
    s=function(n,t){
    for(var i=n.length;i--;)if(n[i]===t)return!0;return!1
    };
    
p.prototype={
    _current:null,
    hasNext:function(){
        return!!this._next
        },
    next:function(){
        var n=this._current=this._next,t,i;
        if(this._current)if(t=n.firstChild,t)this._next=t;
            else{
            for(i=null;n!==this.root&&!(i=n.nextSibling);)n=n.parentNode;
            this._next=i
            }
            return this._current
        },
    detach:function(){
        this._current=this._next=this.root=null
        }
    };

w.prototype={
    equals:function(n){
        return this.node===n.node&this.offset==n.offset
        },
    inspect:function(){
        return"[DomPosition("+y(this.node)+":"+this.offset+")]"
        }
    };

l.prototype={
    INDEX_SIZE_ERR:1,
    HIERARCHY_REQUEST_ERR:3,
    WRONG_DOCUMENT_ERR:4,
    NO_MODIFICATION_ALLOWED_ERR:7,
    NOT_FOUND_ERR:8,
    NOT_SUPPORTED_ERR:9,
    INVALID_STATE_ERR:11
};

l.prototype.toString=function(){
    return this.message
    };
    
n.dom={
    arrayContains:s,
    isHtmlNamespace:b,
    parentElement:k,
    getNodeIndex:h,
    getNodeLength:d,
    getCommonAncestor:a,
    isAncestorOf:g,
    getClosestAncestorIn:f,
    isCharacterDataNode:c,
    insertAfter:v,
    splitDataNode:nt,
    getDocument:e,
    getWindow:tt,
    getIframeWindow:rt,
    getIframeDocument:it,
    getBody:ut,
    getRootContainer:ft,
    comparePoints:et,
    inspectNode:y,
    fragmentFromNodeChildren:ot,
    createIterator:st,
    DomPosition:w
};

n.DOMException=l
});
rangy.createModule("DomRange",function(n){
    function c(n,i){
        return n.nodeType!=3&&(t.isAncestorOf(n,i.startContainer,!0)||t.isAncestorOf(n,i.endContainer,!0))
        }
        function r(n){
        return t.getDocument(n.startContainer)
        }
        function ot(n,t,i){
        var u=n._listeners[t],r,f;
        if(u)for(r=0,f=u.length;r<f;++r)u[r].call(n,{
            target:n,
            args:i
        })
        }
        function st(n){
        return new et(n.parentNode,t.getNodeIndex(n))
        }
        function b(n){
        return new et(n.parentNode,t.getNodeIndex(n)+1)
        }
        function ht(n,i,r){
        var u=n.nodeType==11?n.firstChild:n;
        return t.isCharacterDataNode(i)?r==i.length?t.insertAfter(n,i):i.parentNode.insertBefore(n,r==0?i:t.splitDataNode(i,r)):r>=i.childNodes.length?i.appendChild(n):i.insertBefore(n,i.childNodes[r]),u
        }
        function ct(n){
        for(var i,t,e=r(n.range).createDocumentFragment(),u;t=n.next();){
            if(i=n.isPartiallySelectedSubtree(),t=t.cloneNode(!i),i&&(u=n.getSubtreeIterator(),t.appendChild(ct(u)),u.detach(!0)),t.nodeType==10)throw new f("HIERARCHY_REQUEST_ERR");
            e.appendChild(t)
            }
            return e
        }
        function y(n,i,r){
        var e,o,u,f;
        for(r=r||{
            stop:!1
            };
            u=n.next();)if(n.isPartiallySelectedSubtree()){
            if(i(u)===!1){
                r.stop=!0;
                return
            }
            if(f=n.getSubtreeIterator(),y(f,i,r),f.detach(!0),r.stop)return
        }else for(e=t.createIterator(u);o=e.next();)if(i(o)===!1){
            r.stop=!0;
            return
        }
        }
        function lt(n){
    for(var t;n.next();)n.isPartiallySelectedSubtree()?(t=n.getSubtreeIterator(),lt(t),t.detach(!0)):n.remove()
        }
        function at(n){
    for(var t,u=r(n.range).createDocumentFragment(),i;t=n.next();){
        if(n.isPartiallySelectedSubtree()?(t=t.cloneNode(!1),i=n.getSubtreeIterator(),t.appendChild(at(i)),i.detach(!0)):n.remove(),t.nodeType==10)throw new f("HIERARCHY_REQUEST_ERR");
        u.appendChild(t)
        }
        return u
    }
    function vt(n,t,i){
    var u=!!(t&&t.length),f,e=!!i,r;
    return u&&(f=new RegExp("^("+t.join("|")+")$")),r=[],y(new o(n,!1),function(n){
        (!u||f.test(n.nodeType))&&(!e||i(n))&&r.push(n)
        }),r
    }
    function yt(n){
    var i=typeof n.getName=="undefined"?"Range":n.getName();
    return"["+i+"("+t.inspectNode(n.startContainer)+":"+n.startOffset+", "+t.inspectNode(n.endContainer)+":"+n.endOffset+")]"
    }
    function o(n,i){
    if(this.range=n,this.clonePartiallySelectedTextNodes=i,!n.collapsed){
        this.sc=n.startContainer;
        this.so=n.startOffset;
        this.ec=n.endContainer;
        this.eo=n.endOffset;
        var r=n.commonAncestorContainer;
        this.sc===this.ec&&t.isCharacterDataNode(this.sc)?(this.isSingleCharacterDataNode=!0,this._first=this._last=this._next=this.sc):(this._first=this._next=this.sc===r&&!t.isCharacterDataNode(this.sc)?this.sc.childNodes[this.so]:t.getClosestAncestorIn(this.sc,r,!0),this._last=this.ec===r&&!t.isCharacterDataNode(this.ec)?this.ec.childNodes[this.eo-1]:t.getClosestAncestorIn(this.ec,r,!0))
        }
    }
function s(n){
    this.code=this[n];
    this.codeName=n;
    this.message="RangeException: "+this.codeName
    }
    function pt(n,t,i){
    this.nodes=vt(n,t,i);
    this._next=this.nodes[0];
    this._position=0
    }
    function k(n){
    return function(i,r){
        for(var f,u=r?i:i.parentNode;u;){
            if(f=u.nodeType,t.arrayContains(n,f))return u;
            u=u.parentNode
            }
            return null
        }
    }
function a(n,t){
    if(yi(n,t))throw new s("INVALID_NODE_TYPE_ERR");
}
function e(n){
    if(!n.startContainer)throw new f("INVALID_STATE_ERR");
}
function v(n,i){
    if(!t.arrayContains(i,n.nodeType))throw new s("INVALID_NODE_TYPE_ERR");
}
function g(n,i){
    if(i<0||i>(t.isCharacterDataNode(n)?n.length:n.childNodes.length))throw new f("INDEX_SIZE_ERR");
}
function nt(n,t){
    if(d(n,!0)!==d(t,!0))throw new f("WRONG_DOCUMENT_ERR");
}
function h(n){
    if(vi(n,!0))throw new f("NO_MODIFICATION_ALLOWED_ERR");
}
function p(n,t){
    if(!n)throw new f(t);
}
function kt(n){
    return!t.arrayContains(bt,n.nodeType)&&!d(n,!0)
    }
    function dt(n,i){
    return i<=(t.isCharacterDataNode(n)?n.length:n.childNodes.length)
    }
    function gt(n){
    return!!n.startContainer&&!!n.endContainer&&!kt(n.startContainer)&&!kt(n.endContainer)&&dt(n.startContainer,n.startOffset)&&dt(n.endContainer,n.endOffset)
    }
    function i(n){
    if(e(n),!gt(n))throw new Error("Range error: Range is no longer valid after DOM mutation ("+n.inspect()+")");
}
function ft(){}
function fi(n){
    n.START_TO_START=rt;
    n.START_TO_END=ni;
    n.END_TO_END=wi;
    n.END_TO_START=ti;
    n.NODE_BEFORE=ii;
    n.NODE_AFTER=ri;
    n.NODE_BEFORE_AND_AFTER=ui;
    n.NODE_INSIDE=ut
    }
    function ei(n){
    fi(n);
    fi(n.prototype)
    }
    function oi(n,r){
    return function(){
        var a;
        i(this);
        var u=this.startContainer,e=this.startOffset,c=this.commonAncestorContainer,f=new o(this,!0),l,s;
        return u!==c&&(l=t.getClosestAncestorIn(u,c,!0),s=b(l),u=s.node,e=s.offset),y(f,h),f.reset(),a=n(f),f.detach(),r(this,u,e,u,e),a
        }
    }
function si(r,u,f){
    function s(n,t){
        return function(i){
            e(this);
            v(i,wt);
            v(l(i),bt);
            var r=(n?st:b)(i);
            (t?y:p)(this,r.node,r.offset)
            }
        }
    function y(n,i,r){
    var f=n.endContainer,e=n.endOffset;
    (i!==n.startContainer||r!==n.startOffset)&&((l(i)!=l(f)||t.comparePoints(i,r,f,e)==1)&&(f=i,e=r),u(n,i,r,f,e))
    }
    function p(n,i,r){
    var f=n.startContainer,e=n.startOffset;
    (i!==n.endContainer||r!==n.endOffset)&&((l(i)!=l(f)||t.comparePoints(i,r,f,e)==-1)&&(f=i,e=r),u(n,f,e,i,r))
    }
    function w(n,t,i){
    (t!==n.startContainer||i!==n.startOffset||t!==n.endContainer||i!==n.endOffset)&&u(n,t,i,t,i)
    }
    r.prototype=new ft;
n.util.extend(r.prototype,{
    setStart:function(n,t){
        e(this);
        a(n,!0);
        g(n,t);
        y(this,n,t)
        },
    setEnd:function(n,t){
        e(this);
        a(n,!0);
        g(n,t);
        p(this,n,t)
        },
    setStartBefore:s(!0,!0),
    setStartAfter:s(!1,!0),
    setEndBefore:s(!0,!1),
    setEndAfter:s(!1,!1),
    collapse:function(n){
        i(this);
        n?u(this,this.startContainer,this.startOffset,this.startContainer,this.startOffset):u(this,this.endContainer,this.endOffset,this.endContainer,this.endOffset)
        },
    selectNodeContents:function(n){
        e(this);
        a(n,!0);
        u(this,n,0,n,t.getNodeLength(n))
        },
    selectNode:function(n){
        e(this);
        a(n,!1);
        v(n,wt);
        var t=st(n),i=b(n);
        u(this,t.node,t.offset,i.node,i.offset)
        },
    extractContents:oi(at,u),
    deleteContents:oi(lt,u),
    canSurroundContents:function(){
        i(this);
        h(this.startContainer);
        h(this.endContainer);
        var n=new o(this,!0),t=n._first&&c(n._first,this)||n._last&&c(n._last,this);
        return n.detach(),!t
        },
    detach:function(){
        f(this)
        },
    splitBoundaries:function(){
        i(this);
        var n=this.startContainer,e=this.startOffset,r=this.endContainer,f=this.endOffset,o=n===r;
        t.isCharacterDataNode(r)&&f>0&&f<r.length&&t.splitDataNode(r,f);
        t.isCharacterDataNode(n)&&e>0&&e<n.length&&(n=t.splitDataNode(n,e),o?(f-=e,r=n):r==n.parentNode&&f>=t.getNodeIndex(n)&&f++,e=0);
        u(this,n,e,r,f)
        },
    normalizeBoundaries:function(){
        var o,s;
        i(this);
        var f=this.startContainer,e=this.startOffset,n=this.endContainer,r=this.endOffset,h=function(t){
            var i=t.nextSibling;
            i&&i.nodeType==t.nodeType&&(n=t,r=t.length,t.appendData(i.data),i.parentNode.removeChild(i))
            },c=function(i){
            var u=i.previousSibling,s,o;
            u&&u.nodeType==i.nodeType&&(f=i,s=i.length,e=u.length,i.insertData(0,u.data),u.parentNode.removeChild(u),f==n?(r+=e,n=f):n==i.parentNode&&(o=t.getNodeIndex(i),r==o?(n=i,r=s):r>o&&r--))
            },l=!0;
        t.isCharacterDataNode(n)?n.length==r&&h(n):(r>0&&(o=n.childNodes[r-1],o&&t.isCharacterDataNode(o)&&h(o)),l=!this.collapsed);
        l?t.isCharacterDataNode(f)?e==0&&c(f):e<f.childNodes.length&&(s=f.childNodes[e],s&&t.isCharacterDataNode(s)&&c(s)):(f=n,e=r);
        u(this,f,e,n,r)
        },
    collapseToPoint:function(n,t){
        e(this);
        a(n,!0);
        g(n,t);
        w(this,n,t)
        }
    });
ei(r)
}
function hi(n){
    n.collapsed=n.startContainer===n.endContainer&&n.startOffset===n.endOffset;
    n.commonAncestorContainer=n.collapsed?n.startContainer:t.getCommonAncestor(n.startContainer,n.endContainer)
    }
    function ci(n,t,i,r,u){
    var f=n.startContainer!==t||n.startOffset!==i,e=n.endContainer!==r||n.endOffset!==u;
    n.startContainer=t;
    n.startOffset=i;
    n.endContainer=r;
    n.endOffset=u;
    hi(n);
    ot(n,"boundarychange",{
        startMoved:f,
        endMoved:e
    })
    }
    function bi(n){
    e(n);
    n.startContainer=n.startOffset=n.endContainer=n.endOffset=null;
    n.collapsed=n.commonAncestorContainer=null;
    ot(n,"detach",null);
    n._listeners=null
    }
    function u(n){
    this.startContainer=n;
    this.startOffset=0;
    this.endContainer=n;
    this.endOffset=0;
    this._listeners={
        boundarychange:[],
        detach:[]
    };
    
    hi(this)
    }
    var tt,w;
n.requireModules(["DomUtil"]);
var t=n.dom,et=t.DomPosition,f=n.DOMException;
o.prototype={
    _current:null,
    _next:null,
    _first:null,
    _last:null,
    isSingleCharacterDataNode:!1,
    reset:function(){
        this._current=null;
        this._next=this._first
        },
    hasNext:function(){
        return!!this._next
        },
    next:function(){
        var n=this._current=this._next;
        return n&&(this._next=n!==this._last?n.nextSibling:null,t.isCharacterDataNode(n)&&this.clonePartiallySelectedTextNodes&&(n===this.ec&&(n=n.cloneNode(!0)).deleteData(this.eo,n.length-this.eo),this._current===this.sc&&(n=n.cloneNode(!0)).deleteData(0,this.so))),n
        },
    remove:function(){
        var n=this._current,i,r;
        t.isCharacterDataNode(n)&&(n===this.sc||n===this.ec)?(i=n===this.sc?this.so:0,r=n===this.ec?this.eo:n.length,i!=r&&n.deleteData(i,r-i)):n.parentNode&&n.parentNode.removeChild(n)
        },
    isPartiallySelectedSubtree:function(){
        var n=this._current;
        return c(n,this.range)
        },
    getSubtreeIterator:function(){
        var n;
        if(this.isSingleCharacterDataNode)n=this.range.cloneRange(),n.collapse();
        else{
            n=new u(r(this.range));
            var i=this._current,f=i,e=0,s=i,h=t.getNodeLength(i);
            t.isAncestorOf(i,this.sc,!0)&&(f=this.sc,e=this.so);
            t.isAncestorOf(i,this.ec,!0)&&(s=this.ec,h=this.eo);
            ci(n,f,e,s,h)
            }
            return new o(n,this.clonePartiallySelectedTextNodes)
        },
    detach:function(n){
        n&&this.range.detach();
        this.range=this._current=this._next=this._first=this._last=this.sc=this.so=this.ec=this.eo=null
        }
    };

s.prototype={
    BAD_BOUNDARYPOINTS_ERR:1,
    INVALID_NODE_TYPE_ERR:2
};

s.prototype.toString=function(){
    return this.message
    };
    
pt.prototype={
    _current:null,
    hasNext:function(){
        return!!this._next
        },
    next:function(){
        return this._current=this._next,this._next=this.nodes[++this._position],this._current
        },
    detach:function(){
        this._current=this._next=this.nodes=null
        }
    };

var wt=[1,3,4,5,7,8,10],bt=[2,9,11],li=[1,3,4,5,7,8,10,11],ai=[1,3,4,5,7,8];
var l=t.getRootContainer,d=k([9,11]),vi=k([5,6,10,12]),yi=k([6,10,12]);
tt=document.createElement("style");
w=!1;
try{
    tt.innerHTML="<b>x<\/b>";
    w=tt.firstChild.nodeType==3
    }catch(ki){}
n.features.htmlParsingConforms=w;
var pi=w?function(n){
    var r=this.startContainer,u=t.getDocument(r),i;
    if(!r)throw new f("INVALID_STATE_ERR");
    return i=null,r.nodeType==1?i=r:t.isCharacterDataNode(r)&&(i=t.parentElement(r)),i=i===null||i.nodeName=="HTML"&&t.isHtmlNamespace(t.getDocument(i).documentElement)&&t.isHtmlNamespace(i)?u.createElement("body"):i.cloneNode(!1),i.innerHTML=n,t.fragmentFromNodeChildren(i)
    }:function(n){
    e(this);
    var u=r(this),i=u.createElement("body");
    return i.innerHTML=n,t.fragmentFromNodeChildren(i)
    },it=["startContainer","startOffset","endContainer","endOffset","collapsed","commonAncestorContainer"],rt=0,ni=1,wi=2,ti=3,ii=0,ri=1,ui=2,ut=3;
ft.prototype={
    attachListener:function(n,t){
        this._listeners[n].push(t)
        },
    compareBoundaryPoints:function(n,r){
        i(this);
        nt(this.startContainer,r.startContainer);
        var u,f,e,o,s=n==ti||n==rt?"start":"end",h=n==ni||n==rt?"start":"end";
        return u=this[s+"Container"],f=this[s+"Offset"],e=r[h+"Container"],o=r[h+"Offset"],t.comparePoints(u,f,e,o)
        },
    insertNode:function(n){
        if(i(this),v(n,li),h(this.startContainer),t.isAncestorOf(n,this.startContainer,!0))throw new f("HIERARCHY_REQUEST_ERR");
        var r=ht(n,this.startContainer,this.startOffset);
        this.setStartBefore(r)
        },
    cloneContents:function(){
        var n,u,f;
        return i(this),this.collapsed?r(this).createDocumentFragment():this.startContainer===this.endContainer&&t.isCharacterDataNode(this.startContainer)?(n=this.startContainer.cloneNode(!0),n.data=n.data.slice(this.startOffset,this.endOffset),u=r(this).createDocumentFragment(),u.appendChild(n),u):(f=new o(this,!0),n=ct(f),f.detach(),n)
        },
    canSurroundContents:function(){
        i(this);
        h(this.startContainer);
        h(this.endContainer);
        var n=new o(this,!0),t=n._first&&c(n._first,this)||n._last&&c(n._last,this);
        return n.detach(),!t
        },
    surroundContents:function(n){
        if(v(n,ai),!this.canSurroundContents())throw new s("BAD_BOUNDARYPOINTS_ERR");
        var t=this.extractContents();
        if(n.hasChildNodes())while(n.lastChild)n.removeChild(n.lastChild);
        ht(n,this.startContainer,this.startOffset);
        n.appendChild(t);
        this.selectNode(n)
        },
    cloneRange:function(){
        i(this);
        for(var t=new u(r(this)),f=it.length,n;f--;)n=it[f],t[n]=this[n];
        return t
        },
    toString:function(){
        var n,r,u;
        return i(this),n=this.startContainer,n===this.endContainer&&t.isCharacterDataNode(n)?n.nodeType==3||n.nodeType==4?n.data.slice(this.startOffset,this.endOffset):"":(r=[],u=new o(this,!0),y(u,function(n){
            (n.nodeType==3||n.nodeType==4)&&r.push(n.data)
            }),u.detach(),r.join(""))
        },
    compareNode:function(n){
        var r,u,o,e;
        if(i(this),r=n.parentNode,u=t.getNodeIndex(n),!r)throw new f("NOT_FOUND_ERR");
        return o=this.comparePoint(r,u),e=this.comparePoint(r,u+1),o<0?e>0?ui:ii:e>0?ri:ut
        },
    comparePoint:function(n,r){
        return(i(this),p(n,"HIERARCHY_REQUEST_ERR"),nt(n,this.startContainer),t.comparePoints(n,r,this.startContainer,this.startOffset)<0)?-1:t.comparePoints(n,r,this.endContainer,this.endOffset)>0?1:0
        },
    createContextualFragment:pi,
    toHtml:function(){
        i(this);
        var n=r(this).createElement("div");
        return n.appendChild(this.cloneContents()),n.innerHTML
        },
    intersectsNode:function(n,u){
        var f,e,o,s;
        return(i(this),p(n,"NOT_FOUND_ERR"),t.getDocument(n)!==r(this))?!1:(f=n.parentNode,e=t.getNodeIndex(n),p(f,"NOT_FOUND_ERR"),o=t.comparePoints(f,e,this.endContainer,this.endOffset),s=t.comparePoints(f,e+1,this.startContainer,this.startOffset),u?o<=0&&s>=0:o<0&&s>0)
        },
    isPointInRange:function(n,r){
        return i(this),p(n,"HIERARCHY_REQUEST_ERR"),nt(n,this.startContainer),t.comparePoints(n,r,this.startContainer,this.startOffset)>=0&&t.comparePoints(n,r,this.endContainer,this.endOffset)<=0
        },
    intersectsRange:function(n,u){
        if(i(this),r(n)!=r(this))throw new f("WRONG_DOCUMENT_ERR");
        var e=t.comparePoints(this.startContainer,this.startOffset,n.endContainer,n.endOffset),o=t.comparePoints(this.endContainer,this.endOffset,n.startContainer,n.startOffset);
        return u?e<=0&&o>=0:e<0&&o>0
        },
    intersection:function(n){
        if(this.intersectsRange(n)){
            var r=t.comparePoints(this.startContainer,this.startOffset,n.startContainer,n.startOffset),u=t.comparePoints(this.endContainer,this.endOffset,n.endContainer,n.endOffset),i=this.cloneRange();
            return r==-1&&i.setStart(n.startContainer,n.startOffset),u==1&&i.setEnd(n.endContainer,n.endOffset),i
            }
            return null
        },
    union:function(n){
        if(this.intersectsRange(n,!0)){
            var i=this.cloneRange();
            return t.comparePoints(n.startContainer,n.startOffset,this.startContainer,this.startOffset)==-1&&i.setStart(n.startContainer,n.startOffset),t.comparePoints(n.endContainer,n.endOffset,this.endContainer,this.endOffset)==1&&i.setEnd(n.endContainer,n.endOffset),i
            }
            throw new s("Ranges do not intersect");
    },
    containsNode:function(n,t){
        return t?this.intersectsNode(n,!1):this.compareNode(n)==ut
        },
    containsNodeContents:function(n){
        return this.comparePoint(n,0)>=0&&this.comparePoint(n,t.getNodeLength(n))<=0
        },
    containsRange:function(n){
        return this.intersection(n).equals(n)
        },
    containsNodeText:function(n){
        var t=this.cloneRange(),i,r,u;
        return t.selectNode(n),i=t.getNodes([3]),i.length>0?(t.setStart(i[0],0),r=i.pop(),t.setEnd(r,r.length),u=this.containsRange(t),t.detach(),u):this.containsNodeContents(n)
        },
    createNodeIterator:function(n,t){
        return i(this),new pt(this,n,t)
        },
    getNodes:function(n,t){
        return i(this),vt(this,n,t)
        },
    getDocument:function(){
        return r(this)
        },
    collapseBefore:function(n){
        e(this);
        this.setEndBefore(n);
        this.collapse(!1)
        },
    collapseAfter:function(n){
        e(this);
        this.setStartAfter(n);
        this.collapse(!0)
        },
    getName:function(){
        return"DomRange"
        },
    equals:function(n){
        return u.rangesEqual(this,n)
        },
    isValid:function(){
        return gt(this)
        },
    inspect:function(){
        return yt(this)
        }
    };

si(u,ci,bi);
n.rangePrototype=ft.prototype;
u.rangeProperties=it;
u.RangeIterator=o;
u.copyComparisonConstants=ei;
u.createPrototypeRange=si;
u.inspect=yt;
u.getRangeDocument=r;
u.rangesEqual=function(n,t){
    return n.startContainer===t.startContainer&&n.startOffset===t.startOffset&&n.endContainer===t.endContainer&&n.endOffset===t.endOffset
    };
    
n.DomRange=u;
n.RangeException=s
});
rangy.createModule("WrappedRange",function(n){
    function s(n){
        var e=n.parentElement(),i=n.duplicate(),r,f,u;
        return i.collapse(!0),r=i.parentElement(),i=n.duplicate(),i.collapse(!1),f=i.parentElement(),u=r==f?r:t.getCommonAncestor(r,f),u==e?u:t.getCommonAncestor(e,u)
        }
        function h(n){
        return n.compareEndPoints("StartToEnd",n)==0
        }
        function f(n,i,u,f){
        var s=n.duplicate(),o,e,y,w,c,a,p,l,v,h,b;
        if(s.collapse(u),o=s.parentElement(),t.isAncestorOf(i,o,!0)||(o=i),!o.canHaveHTML)return new r(o.parentNode,t.getNodeIndex(o));
        e=t.getDocument(o).createElement("span");
        w=u?"StartToStart":"StartToEnd";
        do o.insertBefore(e,e.previousSibling),s.moveToElementText(e);while((y=s.compareEndPoints(w,n))>0&&e.previousSibling);
        if(l=e.nextSibling,y==-1&&l&&t.isCharacterDataNode(l)){
            if(s.setEndPoint(u?"EndToStart":"EndToEnd",n),/[\r\n]/.test(l.data))for(h=s.duplicate(),b=h.text.replace(/\r\n/g,"\r").length,v=h.moveStart("character",b);(y=h.compareEndPoints("StartToEnd",h))==-1;)v++,h.moveStart("character",1);else v=s.text.length;
            p=new r(l,v)
            }else c=(f||!u)&&e.previousSibling,a=(f||u)&&e.nextSibling,p=a&&t.isCharacterDataNode(a)?new r(a,0):c&&t.isCharacterDataNode(c)?new r(c,c.length):new r(o,t.getNodeIndex(e));
        return e.parentNode.removeChild(e),p
        }
        function e(n,i){
        var u,f,o=n.offset,h=t.getDocument(n.node),r,s,e=h.body.createTextRange(),c=t.isCharacterDataNode(n.node);
        return c?(u=n.node,f=u.parentNode):(s=n.node.childNodes,u=o<s.length?s[o]:null,f=n.node),r=h.createElement("span"),r.innerHTML="&#feff;",u?f.insertBefore(r,u):f.appendChild(r),e.moveToElementText(r),e.collapse(!i),f.removeChild(r),c&&e[i?"moveStart":"moveEnd"]("character",o),e
        }
        var o;
    n.requireModules(["DomUtil","DomRange"]);
    var i,t=n.dom,r=t.DomPosition,u=n.DomRange;
    !n.features.implementsDomRange||n.features.implementsTextRange&&n.config.preferTextRange?n.features.implementsTextRange&&(i=function(n){
        this.textRange=n;
        this.refresh()
        },i.prototype=new u(document),i.prototype.refresh=function(){
        var n,t,i=s(this.textRange);
        h(this.textRange)?t=n=f(this.textRange,i,!0,!0):(n=f(this.textRange,i,!0,!1),t=f(this.textRange,i,!1,!1));
        this.setStart(n.node,n.offset);
        this.setEnd(t.node,t.offset)
        },u.copyComparisonConstants(i),o=function(){
        return this
        }(),typeof o.Range=="undefined"&&(o.Range=i),n.createNativeRange=function(n){
        return n=n||document,n.body.createTextRange()
        }):(function(){
        function o(n){
            for(var i=c.length,t;i--;)t=c[i],n[t]=n.nativeRange[t]
                }
                function a(n,t,i,r,u){
            var f=n.startContainer!==t||n.startOffset!=i,e=n.endContainer!==r||n.endOffset!=u;
            (f||e)&&(n.setEnd(r,u),n.setStart(t,i))
            }
            function v(n){
            n.nativeRange.detach();
            n.detached=!0;
            for(var t=c.length,i;t--;)i=c[t],n[i]=null
                }
                var r,c=u.rangeProperties,l,h,e,f,s;
        i=function(n){
            if(!n)throw new Error("Range must be specified");
            this.nativeRange=n;
            o(this)
            };
            
        u.createPrototypeRange(i,a,v);
        r=i.prototype;
        r.selectNode=function(n){
            this.nativeRange.selectNode(n);
            o(this)
            };
            
        r.deleteContents=function(){
            this.nativeRange.deleteContents();
            o(this)
            };
            
        r.extractContents=function(){
            var n=this.nativeRange.extractContents();
            return o(this),n
            };
            
        r.cloneContents=function(){
            return this.nativeRange.cloneContents()
            };
            
        r.surroundContents=function(n){
            this.nativeRange.surroundContents(n);
            o(this)
            };
            
        r.collapse=function(n){
            this.nativeRange.collapse(n);
            o(this)
            };
            
        r.cloneRange=function(){
            return new i(this.nativeRange.cloneRange())
            };
            
        r.refresh=function(){
            o(this)
            };
            
        r.toString=function(){
            return this.nativeRange.toString()
            };
            
        e=document.createTextNode("test");
        t.getBody(document).appendChild(e);
        f=document.createRange();
        f.setStart(e,0);
        f.setEnd(e,0);
        try{
            f.setStart(e,1);
            l=!0;
            r.setStart=function(n,t){
                this.nativeRange.setStart(n,t);
                o(this)
                };
                
            r.setEnd=function(n,t){
                this.nativeRange.setEnd(n,t);
                o(this)
                };
                
            h=function(n){
                return function(t){
                    this.nativeRange[n](t);
                    o(this)
                    }
                }
        }catch(y){
        l=!1;
        r.setStart=function(n,t){
            try{
                this.nativeRange.setStart(n,t)
                }catch(i){
                this.nativeRange.setEnd(n,t);
                this.nativeRange.setStart(n,t)
                }
                o(this)
            };
            
        r.setEnd=function(n,t){
            try{
                this.nativeRange.setEnd(n,t)
                }catch(i){
                this.nativeRange.setStart(n,t);
                this.nativeRange.setEnd(n,t)
                }
                o(this)
            };
            
        h=function(n,t){
            return function(i){
                try{
                    this.nativeRange[n](i)
                    }catch(r){
                    this.nativeRange[t](i);
                    this.nativeRange[n](i)
                    }
                    o(this)
                }
            }
    }
r.setStartBefore=h("setStartBefore","setEndBefore");
    r.setStartAfter=h("setStartAfter","setEndAfter");
    r.setEndBefore=h("setEndBefore","setStartBefore");
    r.setEndAfter=h("setEndAfter","setStartAfter");
    f.selectNodeContents(e);
    r.selectNodeContents=f.startContainer==e&&f.endContainer==e&&f.startOffset==0&&f.endOffset==e.length?function(n){
    this.nativeRange.selectNodeContents(n);
    o(this)
    }:function(n){
    this.setStart(n,0);
    this.setEnd(n,u.getEndOffset(n))
    };
    
f.selectNodeContents(e);
    f.setEnd(e,3);
    s=document.createRange();
    s.selectNodeContents(e);
    s.setEnd(e,4);
    s.setStart(e,2);
    r.compareBoundaryPoints=f.compareBoundaryPoints(f.START_TO_END,s)==-1&f.compareBoundaryPoints(f.END_TO_START,s)==1?function(n,t){
    return t=t.nativeRange||t,n==t.START_TO_END?n=t.END_TO_START:n==t.END_TO_START&&(n=t.START_TO_END),this.nativeRange.compareBoundaryPoints(n,t)
    }:function(n,t){
    return this.nativeRange.compareBoundaryPoints(n,t.nativeRange||t)
    };
    
n.util.isHostMethod(f,"createContextualFragment")&&(r.createContextualFragment=function(n){
    return this.nativeRange.createContextualFragment(n)
    });
t.getBody(document).removeChild(e);
    f.detach();
    s.detach()
    }(),n.createNativeRange=function(n){
    return n=n||document,n.createRange()
    });
n.features.implementsTextRange&&(i.rangeToTextRange=function(n){
    if(n.collapsed)return e(new r(n.startContainer,n.startOffset),!0);
    var u=e(new r(n.startContainer,n.startOffset),!0),f=e(new r(n.endContainer,n.endOffset),!1),i=t.getDocument(n.startContainer).body.createTextRange();
    return i.setEndPoint("StartToStart",u),i.setEndPoint("EndToEnd",f),i
    });
i.prototype.getName=function(){
    return"WrappedRange"
    };
    
n.WrappedRange=i;
n.createRange=function(t){
    return t=t||document,new i(n.createNativeRange(t))
    };
    
n.createRangyRange=function(n){
    return n=n||document,new u(n)
    };
    
n.createIframeRange=function(i){
    return n.createRange(t.getIframeDocument(i))
    };
    
n.createIframeRangyRange=function(i){
    return n.createRangyRange(t.getIframeDocument(i))
    };
    
n.addCreateMissingNativeApiListener(function(t){
    var i=t.document;
    typeof i.createRange=="undefined"&&(i.createRange=function(){
        return n.createRange(this)
        });
    i=t=null
    })
});
rangy.createModule("WrappedSelection",function(n,t){
    function ri(n){
        return(n||window).getSelection()
        }
        function yt(n){
        return(n||window).document.selection
        }
        function p(n,t,i){
        var r=i?"end":"start",u=i?"start":"end";
        n.anchorNode=t[r+"Container"];
        n.anchorOffset=t[r+"Offset"];
        n.focusNode=t[u+"Container"];
        n.focusOffset=t[u+"Offset"]
        }
        function ui(n){
        var t=n.nativeSelection;
        n.anchorNode=t.anchorNode;
        n.anchorOffset=t.anchorOffset;
        n.focusNode=t.focusNode;
        n.focusOffset=t.focusOffset
        }
        function s(n){
        n.anchorNode=n.focusNode=null;
        n.anchorOffset=n.focusOffset=0;
        n.rangeCount=0;
        n.isCollapsed=!0;
        n._ranges.length=0
        }
        function st(t){
        var i;
        return t instanceof h?(i=t._selectionNativeRange,i||(i=n.createNativeRange(r.getDocument(t.startContainer)),i.setEnd(t.endContainer,t.endOffset),i.setStart(t.startContainer,t.startOffset),t._selectionNativeRange=i,t.attachListener("detach",function(){
            this._selectionNativeRange=null
            }))):t instanceof k?i=t.nativeRange:n.features.implementsDomRange&&t instanceof r.getWindow(t.startContainer).Range&&(i=t),i
        }
        function fi(n){
        if(!n.length||n[0].nodeType!=1)return!1;
        for(var t=1,i=n.length;t<i;++t)if(!r.isAncestorOf(n[0],n[t]))return!1;return!0
        }
        function ht(n){
        var t=n.getNodes();
        if(!fi(t))throw new Error("getSingleElementFromRange: range "+n.inspect()+" did not consist of a single element");
        return t[0]
        }
        function kt(n){
        return!!n&&typeof n.text!="undefined"
        }
        function dt(n,t){
        var i=new k(t);
        n._ranges=[i];
        p(n,i,!1);
        n.rangeCount=1;
        n.isCollapsed=i.collapsed
        }
        function w(t){
        var i,f,e,u;
        if(t._ranges.length=0,t.docSelection.type=="None")s(t);
        else if(i=t.docSelection.createRange(),kt(i))dt(t,i);
        else{
            for(t.rangeCount=i.length,e=r.getDocument(i.item(0)),u=0;u<t.rangeCount;++u)f=n.createRange(e),f.selectNode(i.item(u)),t._ranges.push(f);
            t.isCollapsed=t.rangeCount==1&&t._ranges[0].collapsed;
            p(t,t._ranges[t.rangeCount-1],!1)
            }
        }
    function gt(n,t){
    for(var i=n.docSelection.createRange(),e=ht(t),o=r.getDocument(i.item(0)),u=r.getBody(o).createControlRange(),f=0,s=i.length;f<s;++f)u.add(i.item(f));
    try{
        u.add(e)
        }catch(h){
        throw new Error("addRange(): Element within the specified Range could not be added to control selection (does it have layout?)");
    }
    u.select();
    w(n)
    }
    function rt(n,t,i){
    this.nativeSelection=n;
    this.docSelection=t;
    this._ranges=[];
    this.win=i;
    this.refresh()
    }
    function ni(n,t){
    for(var e=r.getDocument(t[0].startContainer),u=r.getBody(e).createControlRange(),i=0,f;i<rangeCount;++i){
        f=ht(t[i]);
        try{
            u.add(f)
            }catch(o){
            throw new Error("setRanges(): Element within the one of the specified Ranges could not be added to control selection (does it have layout?)");
        }
    }
    u.select();
    w(n)
    }
    function ti(n,t){
    if(n.anchorNode&&r.getDocument(n.anchorNode)!==r.getDocument(t))throw new d("WRONG_DOCUMENT_ERR");
}
function ii(n){
    var i=[],u=new vt(n.anchorNode,n.anchorOffset),f=new vt(n.focusNode,n.focusOffset),e=typeof n.getName=="function"?n.getName():"Selection",t,r;
    if(typeof n.rangeCount!="undefined")for(t=0,r=n.rangeCount;t<r;++t)i[t]=h.inspect(n.getRangeAt(t));
    return"["+e+"(Ranges: "+i.join(", ")+")(anchor: "+u.inspect()+", focus: "+f.inspect()+"]"
    }
    var nt,et,tt,ot,e,bt,it,i,ct,ut,lt,b;
n.requireModules(["DomUtil","DomRange","WrappedRange"]);
    n.config.checkSelectionRanges=!0;
    var at="boolean",ft="_rangySelection",r=n.dom,f=n.util,h=n.DomRange,k=n.WrappedRange,d=n.DOMException,vt=r.DomPosition,l,g,o="Control";
    var pt=n.util.isHostMethod(window,"getSelection"),a=n.util.isHostObject(document,"selection"),v=a&&(!pt||n.config.preferTextRange);
    v?(l=yt,n.isSelectionValid=function(n){
    var t=(n||window).document,i=t.selection;
    return i.type!="None"||r.getDocument(i.createRange().parentElement())==t
    }):pt?(l=ri,n.isSelectionValid=function(){
    return!0
    }):t.fail("Neither document.selection or window.getSelection() detected.");
    n.getNativeSelection=l;
    var u=l(),wt=n.createNativeRange(document),y=r.getBody(document),c=f.areHostObjects(u,["anchorNode","focusNode"]&&f.areHostProperties(u,["anchorOffset","focusOffset"]));
    if(n.features.selectionHasAnchorAndFocus=c,nt=f.isHostMethod(u,"extend"),n.features.selectionHasExtend=nt,et=typeof u.rangeCount=="number",n.features.selectionHasRangeCount=et,tt=!1,ot=!0,f.areHostMethods(u,["addRange","getRangeAt","removeAllRanges"])&&typeof u.rangeCount=="number"&&n.features.implementsDomRange&&function(){
    var n=document.createElement("iframe"),i,f;
    n.frameBorder=0;
    n.style.position="absolute";
    n.style.left="-10000px";
    y.appendChild(n);
    i=r.getIframeDocument(n);
    i.open();
    i.write("<html><head><\/head><body>12<\/body><\/html>");
    i.close();
    var u=r.getIframeWindow(n).getSelection(),o=i.documentElement,s=o.lastChild,e=s.firstChild,t=i.createRange();
    t.setStart(e,1);
    t.collapse(!0);
    u.addRange(t);
    ot=u.rangeCount==1;
    u.removeAllRanges();
    f=t.cloneRange();
    t.setStart(e,0);
    f.setEnd(e,2);
    u.addRange(t);
    u.addRange(f);
    tt=u.rangeCount==2;
    t.detach();
    f.detach();
    y.removeChild(n)
    }(),n.features.selectionSupportsMultipleRanges=tt,n.features.collapsedNonEditableSelectionsSupported=ot,e=!1,y&&f.isHostMethod(y,"createControlRange")&&(bt=y.createControlRange(),f.areHostProperties(bt,["item","add"])&&(e=!0)),n.features.implementsControlRange=e,g=c?function(n){
    return n.anchorNode===n.focusNode&&n.anchorOffset===n.focusOffset
    }:function(n){
    return n.rangeCount?n.getRangeAt(n.rangeCount-1).collapsed:!1
    },f.isHostMethod(u,"getRangeAt")?it=function(n,t){
    try{
        return n.getRangeAt(t)
        }catch(i){
        return null
        }
    }:c&&(it=function(t){
    var u=r.getDocument(t.anchorNode),i=n.createRange(u);
    return i.setStart(t.anchorNode,t.anchorOffset),i.setEnd(t.focusNode,t.focusOffset),i.collapsed!==this.isCollapsed&&(i.setStart(t.focusNode,t.focusOffset),i.setEnd(t.anchorNode,t.anchorOffset)),i
    }),n.getSelection=function(n){
    n=n||window;
    var t=n[ft],i=l(n),r=a?yt(n):null;
    return t?(t.nativeSelection=i,t.docSelection=r,t.refresh(n)):(t=new rt(i,r,n),n[ft]=t),t
    },n.getIframeSelection=function(t){
    return n.getSelection(r.getIframeWindow(t))
    },i=rt.prototype,!v&&c&&f.areHostMethods(u,["removeAllRanges","addRange"]))i.removeAllRanges=function(){
    this.nativeSelection.removeAllRanges();
    s(this)
    },ct=function(t,i){
    var u=h.getRangeDocument(i),r=n.createRange(u);
    r.collapseToPoint(i.endContainer,i.endOffset);
    t.nativeSelection.addRange(st(r));
    t.nativeSelection.extend(i.startContainer,i.startOffset);
    t.refresh()
    },i.addRange=et?function(t,i){
    var u,r;
    e&&a&&this.docSelection.type==o?gt(this,t):i&&nt?ct(this,t):(tt?u=this.rangeCount:(this.removeAllRanges(),u=0),this.nativeSelection.addRange(st(t)),this.rangeCount=this.nativeSelection.rangeCount,this.rangeCount==u+1?(n.config.checkSelectionRanges&&(r=it(this.nativeSelection,this.rangeCount-1),r&&!h.rangesEqual(r,t)&&(t=new k(r))),this._ranges[this.rangeCount-1]=t,p(this,t,b(this.nativeSelection)),this.isCollapsed=g(this)):this.refresh())
    }:function(n,t){
    t&&nt?ct(this,n):(this.nativeSelection.addRange(st(n)),this.refresh())
    },i.setRanges=function(n){
    if(e&&n.length>1)ni(this,n);
    else{
        this.removeAllRanges();
        for(var t=0,i=n.length;t<i;++t)this.addRange(n[t])
            }
        };
else if(f.isHostMethod(u,"empty")&&f.isHostMethod(wt,"select")&&e&&v)i.removeAllRanges=function(){
    var n,t,i;
    try{
        this.docSelection.empty();
        this.docSelection.type!="None"&&(this.anchorNode?n=r.getDocument(this.anchorNode):this.docSelection.type==o&&(t=this.docSelection.createRange(),t.length&&(n=r.getDocument(t.item(0)).body.createTextRange())),n&&(i=n.body.createTextRange(),i.select(),this.docSelection.empty()))
        }catch(u){}
    s(this)
    },i.addRange=function(n){
    this.docSelection.type==o?gt(this,n):(k.rangeToTextRange(n).select(),this._ranges[0]=n,this.rangeCount=1,this.isCollapsed=this._ranges[0].collapsed,p(this,n,!1))
    },i.setRanges=function(n){
    this.removeAllRanges();
    var t=n.length;
    t>1?ni(this,n):t&&this.addRange(n[0])
    };else return t.fail("No means of selecting a Range or TextRange was found"),!1;
if(i.getRangeAt=function(n){
    if(n<0||n>=this.rangeCount)throw new d("INDEX_SIZE_ERR");else return this._ranges[n]
        },v)ut=function(t){
    var i;
    n.isSelectionValid(t.win)?i=t.docSelection.createRange():(i=r.getBody(t.win.document).createTextRange(),i.collapse(!0));
    t.docSelection.type==o?w(t):kt(i)?dt(t,i):s(t)
    };
else if(f.isHostMethod(u,"getRangeAt")&&typeof u.rangeCount=="number")ut=function(t){
    if(e&&a&&t.docSelection.type==o)w(t);
    else if(t._ranges.length=t.rangeCount=t.nativeSelection.rangeCount,t.rangeCount){
        for(var i=0,r=t.rangeCount;i<r;++i)t._ranges[i]=new n.WrappedRange(t.nativeSelection.getRangeAt(i));
        p(t,t._ranges[t.rangeCount-1],b(t.nativeSelection));
        t.isCollapsed=g(t)
        }else s(t)
        };
else if(c&&typeof u.isCollapsed==at&&typeof wt.collapsed==at&&n.features.implementsDomRange)ut=function(n){
    var t,i=n.nativeSelection;
    i.anchorNode?(t=it(i,0),n._ranges=[t],n.rangeCount=1,ui(n),n.isCollapsed=g(n)):s(n)
    };else return t.fail("No means of obtaining a Range or TextRange from the user's selection was found"),!1;
i.refresh=function(n){
    var i=n?this._ranges.slice(0):null,t;
    if(ut(this),n){
        if(t=i.length,t!=this._ranges.length)return!1;
        while(t--)if(!h.rangesEqual(i[t],this._ranges[t]))return!1;
        return!0
        }
    };

lt=function(n,t){
    var r=n.getAllRanges(),u=!1,i,f;
    for(n.removeAllRanges(),i=0,f=r.length;i<f;++i)u||t!==r[i]?n.addRange(r[i]):u=!0;
    n.rangeCount||s(n)
    };
    
i.removeRange=e?function(n){
    var t,s;
    if(this.docSelection.type==o){
        var i=this.docSelection.createRange(),h=ht(n),c=r.getDocument(i.item(0)),u=r.getBody(c).createControlRange(),f,e=!1;
        for(t=0,s=i.length;t<s;++t)f=i.item(t),f!==h||e?u.add(i.item(t)):e=!0;
        u.select();
        w(this)
        }else lt(this,n)
        }:function(n){
    lt(this,n)
    };
!v&&c&&n.features.implementsDomRange?(b=function(n){
    var t=!1;
    return n.anchorNode&&(t=r.comparePoints(n.anchorNode,n.anchorOffset,n.focusNode,n.focusOffset)==1),t
    },i.isBackwards=function(){
    return b(this)
    }):b=i.isBackwards=function(){
    return!1
    };
    
i.toString=function(){
    for(var t=[],n=0,i=this.rangeCount;n<i;++n)t[n]=""+this._ranges[n];
    return t.join("")
    };
    
i.collapse=function(t,i){
    ti(this,t);
    var u=n.createRange(r.getDocument(t));
    u.collapseToPoint(t,i);
    this.removeAllRanges();
    this.addRange(u);
    this.isCollapsed=!0
    };
    
i.collapseToStart=function(){
    if(this.rangeCount){
        var n=this._ranges[0];
        this.collapse(n.startContainer,n.startOffset)
        }else throw new d("INVALID_STATE_ERR");
};

i.collapseToEnd=function(){
    if(this.rangeCount){
        var n=this._ranges[this.rangeCount-1];
        this.collapse(n.endContainer,n.endOffset)
        }else throw new d("INVALID_STATE_ERR");
};

i.selectAllChildren=function(t){
    ti(this,t);
    var i=n.createRange(r.getDocument(t));
    i.selectNodeContents(t);
    this.removeAllRanges();
    this.addRange(i)
    };
    
i.deleteFromDocument=function(){
    var n,t,i,r,u;
    if(e&&a&&this.docSelection.type==o){
        for(n=this.docSelection.createRange();n.length;)t=n.item(0),n.remove(t),t.parentNode.removeChild(t);
        this.refresh()
        }else if(this.rangeCount){
        for(i=this.getAllRanges(),this.removeAllRanges(),r=0,u=i.length;r<u;++r)i[r].deleteContents();
        this.addRange(i[u-1])
        }
    };

i.getAllRanges=function(){
    return this._ranges.slice(0)
    };
    
i.setSingleRange=function(n){
    this.setRanges([n])
    };
    
i.containsNode=function(n,t){
    for(var i=0,r=this._ranges.length;i<r;++i)if(this._ranges[i].containsNode(n,t))return!0;return!1
    };
    
i.toHtml=function(){
    var i="",t,n,r;
    if(this.rangeCount){
        for(t=h.getRangeDocument(this._ranges[0]).createElement("div"),n=0,r=this._ranges.length;n<r;++n)t.appendChild(this._ranges[n].cloneContents());
        i=t.innerHTML
        }
        return i
    };
    
i.getName=function(){
    return"WrappedSelection"
    };
    
i.inspect=function(){
    return ii(this)
    };
    
i.detach=function(){
    this.win[ft]=null;
    this.win=this.anchorNode=this.focusNode=null
    };
    
rt.inspect=ii;
n.Selection=rt;
n.selectionPrototype=i;
n.addCreateMissingNativeApiListener(function(t){
    typeof t.getSelection=="undefined"&&(t.getSelection=function(){
        return n.getSelection(this)
        });
    t=null
    })
});
rangy.createModule("CssClassApplier",function(n,t){
    function ht(n){
        return n.replace(/^\s\s*/,"").replace(/\s\s*$/,"")
        }
        function o(n,t){
        return n.className&&new RegExp("(?:^|\\s)"+t+"(?:\\s|$)").test(n.className)
        }
        function s(n,t){
        n.className?o(n,t)||(n.className+=" "+t):n.className=t
        }
        function y(n){
        return n.split(/\s+/).sort().join(" ")
        }
        function c(n){
        return y(n.className)
        }
        function p(n,t){
        return c(n)==c(t)
        }
        function w(n){
        for(var t=n.parentNode;n.hasChildNodes();)t.insertBefore(n.firstChild,n);
        t.removeChild(n)
        }
        function b(n,t){
        var i=n.cloneRange(),r,u;
        return i.selectNodeContents(t),r=i.intersection(n),u=r?r.toString():"",i.detach(),u!=""
        }
        function k(n){
        return n.getNodes([3],function(t){
            return b(n,t)
            })
        }
        function d(n,t){
        if(n.attributes.length!=t.attributes.length)return!1;
        for(var r=0,e=n.attributes.length,i,u,f;r<e;++r)if(i=n.attributes[r],f=i.name,f!="class"&&((u=t.attributes.getNamedItem(f),i.specified!=u.specified)||i.specified&&i.nodeValue!==u.nodeValue))return!1;return!0
        }
        function g(n,t){
        for(var r=0,f=n.attributes.length,u;r<f;++r)if(u=n.attributes[r].name,!(t&&i.arrayContains(t,u))&&n.attributes[r].specified&&u!="class")return!0;return!1
        }
        function ct(n,t){
        for(var i in t)if(t.hasOwnProperty(i)&&n[i]!==t[i])return!1;return!0
        }
        function nt(n){
        var t;
        return n&&n.nodeType==1&&((t=n.parentNode)&&t.nodeType==9&&t.designMode=="on"||r(n)&&!r(n.parentNode))
        }
        function tt(n){
        return(r(n)||n.nodeType!=1&&r(n.parentNode))&&!nt(n)
        }
        function rt(n){
        return n&&n.nodeType==1&&!it.test(f(n,"display"))
        }
        function lt(n){
        if(n.data.length==0)return!0;
        if(ut.test(n.data))return!1;
        var t=f(n.parentNode,"whiteSpace");
        switch(t){
            case"pre":case"pre-wrap":case"-moz-pre-wrap":
                return!1;
            case"pre-line":
                if(/[\r\n]/.test(n.data))return!1
                }
                return rt(n.previousSibling)||rt(n.nextSibling)
        }
        function at(n,t){
        return i.isCharacterDataNode(n)?t==0?!!n.previousSibling:t==n.length?!!n.nextSibling:!0:t>0&&t<n.childNodes.length
        }
        function u(n,r,f,e){
        var o,c=f==0,h,s;
        if(i.isAncestorOf(r,n))return n;
        if(i.isCharacterDataNode(r))if(f==0)f=i.getNodeIndex(r),r=r.parentNode;
            else if(f==r.length)f=i.getNodeIndex(r)+1,r=r.parentNode;else throw t.createError("splitNodeAt should not be called with offset in the middle of a data node ("+f+" in "+r.data);
        if(at(r,f)){
            if(!o){
                for(o=r.cloneNode(!1),o.id&&o.removeAttribute("id");h=r.childNodes[f];)o.appendChild(h);
                i.insertAfter(o,r)
                }
                return r==n?o:u(n,o.parentNode,i.getNodeIndex(o),e)
            }
            return n!=r?(o=r.parentNode,s=i.getNodeIndex(r),c||s++,u(n,o,s,e)):n
        }
        function vt(n,t){
        return n.tagName==t.tagName&&p(n,t)&&d(n,t)
        }
        function ft(n){
        var t=n?"nextSibling":"previousSibling";
        return function(i,r){
            var f=i.parentNode,u=i[t];
            if(u){
                if(u&&u.nodeType==3)return u
                    }else if(r&&(u=f[t],u&&u.nodeType==1&&vt(f,u)))return u[n?"firstChild":"lastChild"];
            return null
            }
        }
    function l(n){
    this.isElementMerge=n.nodeType==1;
    this.firstTextNode=this.isElementMerge?n.lastChild:n;
    this.textNodes=[this.firstTextNode]
    }
    function e(n,t,i){
    var e,u,c,o,f,s,r,h;
    if(this.cssClass=n,f=null,typeof t=="object"&&t!==null){
        for(i=t.tagNames,f=t.elementProperties,u=0;o=st[u++];)t.hasOwnProperty(o)&&(this[o]=t[o]);
        e=t.normalize
        }else e=t;
    this.normalize=typeof e=="undefined"?!0:e;
    this.attrExceptions=[];
    s=document.createElement(this.elementTagName);
    this.elementProperties={};
    
    for(r in f)f.hasOwnProperty(r)&&(a.hasOwnProperty(r)&&(r=a[r]),s[r]=f[r],this.elementProperties[r]=s[r],this.attrExceptions.push(r));if(this.elementSortedClassName=this.elementProperties.hasOwnProperty("className")?y(this.elementProperties.className+" "+n):n,this.applyToAnyTagName=!1,h=typeof i,h=="string")i=="*"?this.applyToAnyTagName=!0:this.tagNames=ht(i.toLowerCase()).split(/\s*,\s*/);
    else if(h=="object"&&typeof i.length=="number")for(this.tagNames=[],u=0,c=i.length;u<c;++u)i[u]=="*"?this.applyToAnyTagName=!0:this.tagNames.push(i[u].toLowerCase());else this.tagNames=[this.elementTagName]
        }
        function yt(n,t,i){
    return new e(n,t,i)
    }
    var i,v,h,f,r,it,ut,et,ot,st,a;
n.requireModules(["WrappedSelection","WrappedRange"]);
    i=n.dom;
    v="span";
    h=function(){
    function n(n,t,i){
        return t&&i?" ":""
        }
        return function(t,i){
        t.className&&(t.className=t.className.replace(new RegExp("(?:^|\\s)"+i+"(?:\\s|$)"),n))
        }
    }();
    typeof getComputedStyle!="undefined"?f=function(n,t){
    return i.getWindow(n).getComputedStyle(n,null)[t]
    }:typeof document.documentElement.currentStyle!="undefined"?f=function(n,t){
    return n.currentStyle[t]
    }:t.fail("No means of obtaining computed style properties found"),function(){
    var n=document.createElement("div");
    r=typeof n.isContentEditable=="boolean"?function(n){
        return n&&n.nodeType==1&&n.isContentEditable
        }:function(n){
        return!n||n.nodeType!=1||n.contentEditable=="false"?!1:n.contentEditable=="true"||r(n.parentNode)
        }
    }();
it=/^inline(-block|-table)?$/i;
ut=/[^\r\n\t\f \u200B]/;
et=ft(!1);
ot=ft(!0);
l.prototype={
    doMerge:function(){
        for(var r=[],i,n,u,t=0,f=this.textNodes.length;t<f;++t)i=this.textNodes[t],n=i.parentNode,r[t]=i.data,t&&(n.removeChild(i),n.hasChildNodes()||n.parentNode.removeChild(n));
        return this.firstTextNode.data=u=r.join(""),u
        },
    getLength:function(){
        for(var n=this.textNodes.length,t=0;n--;)t+=this.textNodes[n].length;
        return t
        },
    toString:function(){
        for(var t=[],n=0,i=this.textNodes.length;n<i;++n)t[n]="'"+this.textNodes[n].data+"'";
        return"[Merge("+t.join(",")+")]"
        }
    };

st=["elementTagName","ignoreWhiteSpace","applyToEditableOnly"];
a={
    "class":"className"
};

e.prototype={
    elementTagName:v,
    elementProperties:{},
    ignoreWhiteSpace:!0,
    applyToEditableOnly:!1,
    hasClass:function(n){
        return n.nodeType==1&&i.arrayContains(this.tagNames,n.tagName.toLowerCase())&&o(n,this.cssClass)
        },
    getSelfOrAncestorWithClass:function(n){
        while(n){
            if(this.hasClass(n,this.cssClass))return n;
            n=n.parentNode
            }
            return null
        },
    isModifiable:function(n){
        return!this.applyToEditableOnly||tt(n)
        },
    isIgnorableWhiteSpaceNode:function(n){
        return this.ignoreWhiteSpace&&n&&n.nodeType==3&&lt(n)
        },
    postApply:function(n,t,i){
        for(var a,v=n[0],f=n[n.length-1],e=[],r,s=v,y=f,p=0,w=f.length,o,h,u=0,c=n.length;u<c;++u)o=n[u],h=et(o,!i),h?(r||(r=new l(h),e.push(r)),r.textNodes.push(o),o===v&&(s=r.firstTextNode,p=s.length),o===f&&(y=r.firstTextNode,w=r.getLength())):r=null;
        if(a=ot(f,!i),a&&(r||(r=new l(f),e.push(r)),r.textNodes.push(a)),e.length){
            for(u=0,c=e.length;u<c;++u)e[u].doMerge();
            t.setStart(s,p);
            t.setEnd(y,w)
            }
        },
createContainer:function(t){
    var i=t.createElement(this.elementTagName);
    return n.util.extend(i,this.elementProperties),s(i,this.cssClass),i
    },
applyToTextNode:function(n){
    var t=n.parentNode,r;
    t.childNodes.length==1&&i.arrayContains(this.tagNames,t.tagName.toLowerCase())?s(t,this.cssClass):(r=this.createContainer(i.getDocument(n)),n.parentNode.insertBefore(r,n),r.appendChild(n))
    },
isRemovable:function(n){
    return n.tagName.toLowerCase()==this.elementTagName&&c(n)==this.elementSortedClassName&&ct(n,this.elementProperties)&&!g(n,this.attrExceptions)&&this.isModifiable(n)
    },
undoToTextNode:function(n,t,i){
    if(!t.containsNode(i)){
        var r=t.cloneRange();
        r.selectNode(i);
        r.isPointInRange(t.endContainer,t.endOffset)&&(u(i,t.endContainer,t.endOffset,[t]),t.setEndAfter(i));
        r.isPointInRange(t.startContainer,t.startOffset)&&(i=u(i,t.startContainer,t.startOffset,[t]))
        }
        this.isRemovable(i)?w(i):h(i,this.cssClass)
    },
applyToRange:function(n){
    var t,i,r,u;
    if(n.splitBoundaries(),t=k(n),t.length){
        for(r=0,u=t.length;r<u;++r)i=t[r],this.isIgnorableWhiteSpaceNode(i)||this.getSelfOrAncestorWithClass(i)||!this.isModifiable(i)||this.applyToTextNode(i);
        n.setStart(t[0],0);
        i=t[t.length-1];
        n.setEnd(i,i.length);
        this.normalize&&this.postApply(t,n,!1)
        }
    },
applyToSelection:function(t){
    var i,r,u,f;
    for(t=t||window,i=n.getSelection(t),u=i.getAllRanges(),i.removeAllRanges(),f=u.length;f--;)r=u[f],this.applyToRange(r),i.addRange(r)
        },
undoToRange:function(n){
    var t,i,u,f,r,e;
    if(n.splitBoundaries(),t=k(n),f=t[t.length-1],t.length){
        for(r=0,e=t.length;r<e;++r)i=t[r],u=this.getSelfOrAncestorWithClass(i),u&&this.isModifiable(i)&&this.undoToTextNode(i,n,u),n.setStart(t[0],0),n.setEnd(f,f.length);
        this.normalize&&this.postApply(t,n,!0)
        }
    },
undoToSelection:function(t){
    var i,u,f,r,e;
    for(t=t||window,i=n.getSelection(t),u=i.getAllRanges(),i.removeAllRanges(),r=0,e=u.length;r<e;++r)f=u[r],this.undoToRange(f),i.addRange(f)
        },
getTextSelectedByRange:function(n,t){
    var i=t.cloneRange(),r,u;
    return i.selectNodeContents(n),r=i.intersection(t),u=r?r.toString():"",i.detach(),u
    },
isAppliedToRange:function(n){
    var i,r,t;
    if(n.collapsed)return!!this.getSelfOrAncestorWithClass(n.commonAncestorContainer);
    for(i=n.getNodes([3]),r=0;t=i[r++];)if(!this.isIgnorableWhiteSpaceNode(t)&&b(n,t)&&this.isModifiable(t)&&!this.getSelfOrAncestorWithClass(t))return!1;return!0
    },
isAppliedToSelection:function(t){
    t=t||window;
    for(var u=n.getSelection(t),i=u.getAllRanges(),r=i.length;r--;)if(!this.isAppliedToRange(i[r]))return!1;return!0
    },
toggleRange:function(n){
    this.isAppliedToRange(n)?this.undoToRange(n):this.applyToRange(n)
    },
toggleSelection:function(n){
    this.isAppliedToSelection(n)?this.undoToSelection(n):this.applyToSelection(n)
    },
detach:function(){}
};

e.util={
    hasClass:o,
    addClass:s,
    removeClass:h,
    hasSameClasses:p,
    replaceWithOwnChildren:w,
    elementsHaveSameNonClassAttributes:d,
    elementHasNonClassAttributes:g,
    splitNodeAt:u,
    isEditableElement:r,
    isEditingHost:nt,
    isEditable:tt
};

n.CssClassApplier=e;
n.createCssClassApplier=yt
});
rangy.createModule("SaveRestore",function(n,t){
    function i(n,t){
        return(t||document).getElementById(n)
        }
        function u(n,t){
        var f="selectionBoundary_"+ +new Date+"_"+(""+Math.random()).slice(2),i,u=e.getDocument(n.startContainer),r=n.cloneRange();
        return r.collapse(t),i=u.createElement("span"),i.id=f,i.style.lineHeight="0",i.style.display="none",i.className="rangySelectionBoundary",i.appendChild(u.createTextNode(o)),r.insertNode(i),r.detach(),i
        }
        function f(n,r,u,f){
        var e=i(u,n);
        e?(r[f?"setStartBefore":"setEndBefore"](e),e.parentNode.removeChild(e)):t.warn("Marker element has been removed. Cannot restore selection.")
        }
        function s(n,t){
        return t.compareBoundaryPoints(n.START_TO_START,n)
        }
        function h(r){
        var c,f,v;
        if(r=r||window,c=r.document,!n.isSelectionValid(r)){
            t.warn("Cannot save selection. This usually happens when the selection is collapsed and the selection document has lost focus.");
            return
        }
        var a=n.getSelection(r),o=a.getAllRanges(),h=[],y,l,e;
        for(o.sort(s),f=0,v=o.length;f<v;++f)e=o[f],e.collapsed?(l=u(e,!1),h.push({
            markerId:l.id,
            collapsed:!0
            })):(l=u(e,!1),y=u(e,!0),h[f]={
            startMarkerId:y.id,
            endMarkerId:l.id,
            collapsed:!1,
            backwards:o.length==1&&a.isBackwards()
            });
        for(f=v-1;f>=0;--f)e=o[f],e.collapsed?e.collapseBefore(i(h[f].markerId,c)):(e.setEndBefore(i(h[f].endMarkerId,c)),e.setStartAfter(i(h[f].startMarkerId,c)));
        return a.setRanges(o),{
            win:r,
            doc:c,
            rangeInfos:h,
            restored:!1
            }
        }
    function c(r,u){
    var l,s,h,o,e,c;
    if(!r.restored){
        var a=r.rangeInfos,v=n.getSelection(r.win),y=[];
        for(l=a.length,s=l-1;s>=0;--s)h=a[s],o=n.createRange(r.doc),h.collapsed?(e=i(h.markerId,r.doc),e?(e.style.display="inline",c=e.previousSibling,c&&c.nodeType==3?(e.parentNode.removeChild(e),o.collapseToPoint(c,c.length)):(o.collapseBefore(e),e.parentNode.removeChild(e))):t.warn("Marker element has been removed. Cannot restore selection.")):(f(r.doc,o,h.startMarkerId,!0),f(r.doc,o,h.endMarkerId,!1)),l==1&&o.normalizeBoundaries(),y[s]=o;
        l==1&&u&&n.features.selectionHasExtend&&a[0].backwards?(v.removeAllRanges(),v.addRange(y[0],!0)):v.setRanges(y);
        r.restored=!0
        }
    }
function r(n,t){
    var r=i(t,n);
    r&&r.parentNode.removeChild(r)
    }
    function l(n){
    for(var u=n.rangeInfos,i=0,f=u.length,t;i<f;++i)t=u[i],t.collapsed?r(n.doc,t.markerId):(r(n.doc,t.startMarkerId),r(n.doc,t.endMarkerId))
        }
        n.requireModules(["DomUtil","DomRange","WrappedRange"]);
    var e=n.dom,o="﻿";
    n.saveSelection=h;
    n.restoreSelection=c;
    n.removeMarkerElement=r;
    n.removeMarkers=l
    });
rangy.createModule("Serializer",function(n,t){
    function h(n){
        return n.replace(/</g,"&lt;").replace(/>/g,"&gt;")
        }
        function c(n,t){
        var r;
        t=t||[];
        var f=n.nodeType,e=n.childNodes,o=e.length,s=[f,n.nodeName,o].join(":"),i="",u="";
        switch(f){
            case 3:
                i=h(n.nodeValue);
                break;
            case 8:
                i="<!--"+h(n.nodeValue)+"-->";
                break;
            default:
                i="<"+s+">";
                u="<\/>"
                }
                for(i&&t.push(i),r=0;r<o;++r)c(e[r],t);
        return u&&t.push(u),t
        }
        function r(n){
        var t=c(n).join("");
        return s(t).toString(16)
        }
        function f(n,t,r){
        var f=[],u=n;
        for(r=r||i.getDocument(n).documentElement;u&&u!=r;)f.push(i.getNodeIndex(u,!0)),u=u.parentNode;
        return f.join("/")+":"+t
        }
        function e(n,r,u){
        r?u=u||i.getDocument(r):(u=u||document,r=u.documentElement);
        for(var o=n.split(":"),f=r,s=o[0]?o[0].split("/"):[],e=s.length,h;e--;)if(h=parseInt(s[e],10),h<f.childNodes.length)f=f.childNodes[parseInt(s[e],10)];else throw t.createError("deserializePosition failed: node "+i.inspectNode(f)+" has no child with index "+h+", "+e);return new i.DomPosition(f,parseInt(o[1],10))
        }
        function l(t,u,e){
        if(e=e||n.DomRange.getRangeDocument(t).documentElement,!i.isAncestorOf(e,t.commonAncestorContainer,!0))throw new Error("serializeRange: range is not wholly contained within specified root node");
        var o=f(t.startContainer,t.startOffset,e)+","+f(t.endContainer,t.endOffset,e);
        return u||(o+="{"+r(e)+"}"),o
        }
        function a(t,u,f){
        u?f=f||i.getDocument(u):(f=f||document,u=f.documentElement);
        var o=/^([^,]+),([^,\{]+)({([^}]+)})?$/.exec(t),s=o[4],a=r(u);
        if(s&&s!==r(u))throw new Error("deserializeRange: checksums of serialized range root node ("+s+") and target root node ("+a+") do not match");
        var c=e(o[1],u,f),l=e(o[2],u,f),h=n.createRange(f);
        return h.setStart(c.node,c.offset),h.setEnd(l.node,l.offset),h
        }
        function v(n,t,u){
        t?u=u||i.getDocument(t):(u=u||document,t=u.documentElement);
        var e=/^([^,]+),([^,]+)({([^}]+)})?$/.exec(n),f=e[3];
        return!f||f===r(t)
        }
        function y(t,i,r){
        var f,e,u,o;
        for(t=t||n.getSelection(),f=t.getAllRanges(),e=[],u=0,o=f.length;u<o;++u)e[u]=l(f[u],i,r);
        return e.join("|")
        }
        function p(t,r,u){
        var f,h;
        r?u=u||i.getWindow(r):(u=u||window,r=u.document.documentElement);
        var e=t.split("|"),o=n.getSelection(u),s=[];
        for(f=0,h=e.length;f<h;++f)s[f]=a(e[f],r,u.document);
        return o.setRanges(s),o
        }
        function w(n,t,r){
        var e,f,u,o;
        for(t?e=r?r.document:i.getDocument(t):(r=r||window,t=r.document.documentElement),f=n.split("|"),u=0,o=f.length;u<o;++u)if(!v(f[u],t,e))return!1;return!0
        }
        function b(n){
        for(var u=n.split(/[;,]/),t=0,f=u.length,i,r;t<f;++t)if(i=u[t].split("="),i[0].replace(/^\s+/,"")==o&&(r=i[1],r))return decodeURIComponent(r.replace(/\s+$/,""));return null
        }
        function k(n){
        n=n||window;
        var t=b(n.document.cookie);
        t&&p(t,n.doc)
        }
        function d(t,i){
        t=t||window;
        i=typeof i=="object"?i:{};
        
        var r=i.expires?";expires="+i.expires.toUTCString():"",u=i.path?";path="+i.path:"",f=i.domain?";domain="+i.domain:"",e=i.secure?";secure":"",s=y(n.getSelection(t));
        t.document.cookie=encodeURIComponent(o)+"="+encodeURIComponent(s)+r+u+f+e
        }
        var u,s,i,o;
    n.requireModules(["WrappedSelection","WrappedRange"]);
    u="undefined";
    (typeof encodeURIComponent==u||typeof decodeURIComponent==u)&&t.fail("Global object is missing encodeURIComponent and/or decodeURIComponent method");
    s=function(){
        function t(n){
            for(var i=[],r=0,u=n.length,t;r<u;++r)t=n.charCodeAt(r),t<128?i.push(t):t<2048?i.push(t>>6|192,t&63|128):i.push(t>>12|224,t>>6&63|128,t&63|128);
            return i
            }
            function i(){
            for(var i=[],t=0,r,n;t<256;++t){
                for(n=t,r=8;r--;)(n&1)==1?n=n>>>1^3988292384:n>>>=1;
                i[t]=n>>>0
                }
                return i
            }
            function r(){
            return n||(n=i()),n
            }
            var n=null;
        return function(n){
            for(var f=t(n),i=-1,o=r(),u=0,s=f.length,e;u<s;++u)e=(i^f[u])&255,i=i>>>8^o[e];
            return(i^-1)>>>0
            }
        }();
    i=n.dom;
    o="rangySerializedSelection";
    n.serializePosition=f;
    n.deserializePosition=e;
    n.serializeRange=l;
    n.deserializeRange=a;
    n.canDeserializeRange=v;
    n.serializeSelection=y;
    n.deserializeSelection=p;
    n.canDeserializeSelection=w;
    n.restoreSelectionFromCookie=k;
    n.saveSelectionCookie=d;
    n.getElementChecksum=r
    }),function(n){
    var o="0.3.4",f="hasOwnProperty",e=/[\.\/]/,s="*",h=function(){},c=function(n,t){
        return n-t
        },r,i,u={
        n:{}
},t=function(n,f){
    var k=u,w=i,v=Array.prototype.slice.call(arguments,2),s=t.listeners(n),a=0,e,l=[],y={},h=[],b=r,o,p;
    for(r=n,i=0,o=0,p=s.length;o<p;o++)"zIndex"in s[o]&&(l.push(s[o].zIndex),s[o].zIndex<0&&(y[s[o].zIndex]=s[o]));
    for(l.sort(c);l[a]<0;)if(e=y[l[a++]],h.push(e.apply(f,v)),i)return i=w,h;for(o=0;o<p;o++)if(e=s[o],"zIndex"in e)if(e.zIndex==l[a]){
        if(h.push(e.apply(f,v)),i)break;
        do if(a++,e=y[l[a]],e&&h.push(e.apply(f,v)),i)break;while(e)
    }else y[e.zIndex]=e;
        else if(h.push(e.apply(f,v)),i)break;return i=w,r=b,h.length?h:null
    };
    
t.listeners=function(n){
    for(var a=n.split(e),t=u,i,v,o,f,p,h,c=[t],l=[],r=0,y=a.length;r<y;r++){
        for(h=[],f=0,p=c.length;f<p;f++)for(t=c[f].n,v=[t[a[r]],t[s]],o=2;o--;)i=v[o],i&&(h.push(i),l=l.concat(i.f||[]));
        c=h
        }
        return l
    };
    
t.on=function(n,t){
    for(var f=n.split(e),i=u,r=0,o=f.length;r<o;r++)i=i.n,i[f[r]]||(i[f[r]]={
        n:{}
    }),i=i[f[r]];
for(i.f=i.f||[],r=0,o=i.f.length;r<o;r++)if(i.f[r]==t)return h;return i.f.push(t),function(n){
    +n==+n&&(t.zIndex=+n)
    }
};

t.stop=function(){
    i=1
    };
    
t.nt=function(n){
    return n?new RegExp("(?:\\.|\\/|^)"+n+"(?:\\.|\\/|$)").test(r):r
    };
    
t.off=t.unbind=function(n,t){
    for(var v=n.split(e),i,o,l,r,p,c=[u],a,h=0,y=v.length;h<y;h++)for(r=0;r<c.length;r+=l.length-2){
        if(l=[r,1],i=c[r].n,v[h]!=s)i[v[h]]&&l.push(i[v[h]]);else for(o in i)i[f](o)&&l.push(i[o]);c.splice.apply(c,l)
        }
        for(h=0,y=c.length;h<y;h++)for(i=c[h];i.n;){
        if(t){
            if(i.f){
                for(r=0,p=i.f.length;r<p;r++)if(i.f[r]==t){
                    i.f.splice(r,1);
                    break
                }
                i.f.length||delete i.f
                }
                for(o in i.n)if(i.n[f](o)&&i.n[o].f){
                for(a=i.n[o].f,r=0,p=a.length;r<p;r++)if(a[r]==t){
                    a.splice(r,1);
                    break
                }
                a.length||delete i.n[o].f
                }
            }else{
        delete i.f;
        for(o in i.n)i.n[f](o)&&i.n[o].f&&delete i.n[o].f
            }
            i=i.n
    }
    };
    
t.once=function(n,i){
    var r=function(){
        var u=i.apply(this,arguments);
        return t.unbind(n,r),u
        };
        
    return t.on(n,r)
    };
    
t.version=o;
t.toString=function(){
    return"You are running Eve "+o
    };
    
typeof module!="undefined"&&module.exports?module.exports=t:typeof define!="undefined"?define("eve",[],function(){
    return t
    }):n.eve=t
}(this),function(){
    function n(t){
        var i,r;
        return n.is(t,"function")?ei?t():eve.on("raphael.DOMload",t):n.is(t,g)?n._engine.create[c](n,t.splice(0,3+n.is(t[0],v))).add(t):(i=Array.prototype.slice.call(arguments,0),n.is(i[i.length-1],"function")?(r=i.pop(),ei?r.call(n._engine.create[c](n,i)):eve.on("raphael.DOMload",function(){
            r.call(n._engine.create[c](n,i))
            })):n._engine.create[c](n,arguments))
        }
        function wi(n){
        var i,t;
        if(Object(n)!==n)return n;
        i=new n.constructor;
        for(t in n)n[h](t)&&(i[t]=wi(n[t]));return i
        }
        function ff(n,t){
        for(var i=0,r=n.length;i<r;i++)if(n[i]===t)return n.push(n.splice(i,1)[0])
            }
            function nt(n,t,i){
        function r(){
            var o=Array.prototype.slice.call(arguments,0),u=o.join("␀"),f=r.cache=r.cache||{},e=r.count=r.count||[];
            return f[h](u)?(ff(e,u),i?i(f[u]):f[u]):(e.length>=1e3&&delete f[e.shift()],e.push(u),f[u]=n[c](t,o),i?i(f[u]):f[u])
            }
            return r
        }
        function ti(){
        return this.hex
        }
        function pr(n,t){
        for(var i,f=[],r=0,u=n.length;u-2*!t>r;r+=2)i=[{
            x:+n[r-2],
            y:+n[r-1]
            },{
            x:+n[r],
            y:+n[r+1]
            },{
            x:+n[r+2],
            y:+n[r+3]
            },{
            x:+n[r+4],
            y:+n[r+5]
            }],t?r?u-4==r?i[3]={
            x:+n[0],
            y:+n[1]
            }:u-2==r&&(i[2]={
            x:+n[0],
            y:+n[1]
            },i[3]={
            x:+n[2],
            y:+n[3]
            }):i[0]={
            x:+n[u-2],
            y:+n[u-1]
            }:u-4==r?i[3]=i[2]:r||(i[0]={
            x:+n[r],
            y:+n[r+1]
            }),f.push(["C",(-i[0].x+6*i[1].x+i[2].x)/6,(-i[0].y+6*i[1].y+i[2].y)/6,(i[1].x+6*i[2].x-i[3].x)/6,(i[1].y+6*i[2].y-i[3].y)/6,i[2].x,i[2].y]);
        return f
        }
        function wr(n,t,i,r,u){
        var f=-3*t+9*i-9*r+3*u,e=n*f+6*t-12*i+6*r;
        return n*e-3*t+3*i
        }
        function lt(n,t,r,u,f,e,o,s,h){
        var c;
        h==null&&(h=1);
        h=h>1?1:h<0?0:h;
        var l=h/2,w=[-.1252,.1252,-.3678,.3678,-.5873,.5873,-.7699,.7699,-.9041,.9041,-.9816,.9816],b=[.2491,.2491,.2335,.2335,.2032,.2032,.1601,.1601,.1069,.1069,.0472,.0472],a=0;
        for(c=0;c<12;c++){
            var v=l*w[c]+l,y=wr(v,n,r,f,o),p=wr(v,t,u,e,s),k=y*y+p*p;
            a+=b[c]*i.sqrt(k)
            }
            return l*a
        }
        function of(n,t,i,r,u,f,e,o,s){
        if(!(s<0)&&!(lt(n,t,i,r,u,f,e,o)<s)){
            for(var v=1,l=v/2,h=v-l,c=lt(n,t,i,r,u,f,e,o,h);a(c-s)>.01;)l/=2,h+=(c<s?1:-1)*l,c=lt(n,t,i,r,u,f,e,o,h);
            return h
            }
        }
    function sf(n,t,i,r,u,f,o,s){
    if(!(e(n,i)<l(u,o))&&!(l(n,i)>e(u,o))&&!(e(t,r)<l(f,s))&&!(l(t,r)>e(f,s))){
        var p=(n*r-t*i)*(u-o)-(n-i)*(u*s-f*o),w=(n*r-t*i)*(f-s)-(t-r)*(u*s-f*o),a=(n-i)*(f-s)-(t-r)*(u-o);
        if(a){
            var v=p/a,y=w/a,h=+v.toFixed(2),c=+y.toFixed(2);
            if(!(h<+l(n,i).toFixed(2))&&!(h>+e(n,i).toFixed(2))&&!(h<+l(u,o).toFixed(2))&&!(h>+e(u,o).toFixed(2))&&!(c<+l(t,r).toFixed(2))&&!(c>+e(t,r).toFixed(2))&&!(c<+l(f,s).toFixed(2))&&!(c>+e(f,s).toFixed(2)))return{
                x:v,
                y:y
            }
            }
        }
}
function bi(t,i,r){
    var it=n.bezierBBox(t),rt=n.bezierBBox(i),u,s,h,b,k;
    if(!n.isBBoxIntersect(it,rt))return r?0:[];
    var ut=lt.apply(0,t),ft=lt.apply(0,i),v=~~(ut/5),y=~~(ft/5),d=[],g=[],tt={},nt=r?0:[];
    for(u=0;u<v+1;u++)s=n.findDotsAtSegment.apply(n,t.concat(u/v)),d.push({
        x:s.x,
        y:s.y,
        t:u/v
        });
    for(u=0;u<y+1;u++)s=n.findDotsAtSegment.apply(n,i.concat(u/y)),g.push({
        x:s.x,
        y:s.y,
        t:u/y
        });
    for(u=0;u<v;u++)for(h=0;h<y;h++){
        var e=d[u],c=d[u+1],o=g[h],l=g[h+1],p=a(c.x-e.x)<.001?"y":"x",w=a(l.x-o.x)<.001?"y":"x",f=sf(e.x,e.y,c.x,c.y,o.x,o.y,l.x,l.y);
        if(f){
            if(tt[f.x.toFixed(4)]==f.y.toFixed(4))continue;
            tt[f.x.toFixed(4)]=f.y.toFixed(4);
            b=e.t+a((f[p]-e[p])/(c[p]-e[p]))*(c.t-e.t);
            k=o.t+a((f[w]-o[w])/(l[w]-o[w]))*(l.t-o.t);
            b>=0&&b<=1&&k>=0&&k<=1&&(r?nt++:nt.push({
                x:f.x,
                y:f.y,
                t1:b,
                t2:k
            }))
            }
        }
    return nt
}
function ki(t,i,r){
    var e,o,s,h,b,k,d,g,c,l,y,p,nt,a,w,tt,v,u,f,it;
    for(t=n._path2curve(t),i=n._path2curve(i),y=r?0:[],p=0,nt=t.length;p<nt;p++)if(a=t[p],a[0]=="M")e=b=a[1],o=k=a[2];else for(a[0]=="C"?(c=[e,o].concat(a.slice(1)),e=c[6],o=c[7]):(c=[e,o,e,o,b,k,b,k],e=b,o=k),w=0,tt=i.length;w<tt;w++)if(v=i[w],v[0]=="M")s=d=v[1],h=g=v[2];
        else if(v[0]=="C"?(l=[s,h].concat(v.slice(1)),s=l[6],h=l[7]):(l=[s,h,s,h,d,g,d,g],s=d,h=g),u=bi(c,l,r),r)y+=u;
        else{
        for(f=0,it=u.length;f<it;f++)u[f].segment1=p,u[f].segment2=w,u[f].bez1=c,u[f].bez2=l;
        y=y.concat(u)
        }
        return y
    }
    function et(n,t,i,r,u,f){
    n!=null?(this.a=+n,this.b=+t,this.c=+i,this.d=+r,this.e=+u,this.f=+f):(this.a=1,this.b=0,this.c=0,this.d=1,this.e=0,this.f=0)
    }
    function ru(){
    return this.x+ct+this.y+ct+this.width+" × "+this.height
    }
    function bf(n,t,i,r,u,f){
    function l(n){
        return((h*n+o)*n+e)*n
        }
        function y(n,t){
        var i=p(n,t);
        return((v*i+c)*i+s)*i
        }
        function p(n,t){
        for(var r,u,f,s,i=n,c=0;c<8;c++){
            if(f=l(i)-n,a(f)<t)return i;
            if(s=(3*h*i+2*o)*i+e,a(s)<1e-6)break;
            i=i-f/s
            }
            if(r=0,u=1,i=n,i<r)return r;
        if(i>u)return u;
        while(r<u){
            if(f=l(i),a(f-n)<t)return i;
            n>f?r=i:u=i;
            i=(u-r)/2+r
            }
            return i
        }
        var e=3*t,o=3*(r-t)-e,h=1-e-o,s=3*i,c=3*(u-i)-s,v=1-s-c;
    return y(n,1/(200*f))
    }
    function rt(n,t){
    var i=[],u={},r;
    if(this.ms=t,this.times=1,n){
        for(r in n)n[h](r)&&(u[o(r)]=n[r],i.push(o(r)));i.sort(du)
        }
        this.anim=u;
    this.top=i[i.length-1];
    this.percents=i
    }
    function pt(t,i,u,e,s,c){
    var g,a,ft,l,lt,kt,ti,nt,at,dt,yt,k,rt,st,ht,gt,ut,ct;
    u=o(u);
    var tt,ot,pt,ni,wt,bt,w=t.ms,p={},d={},b={};
    
    if(e){
        for(a=0,ft=r.length;a<ft;a++)if(g=r[a],g.el.id==i.id&&g.anim==t){
            g.percent!=u?(r.splice(a,1),pt=1):ot=g;
            i.attr(g.totalOrigin);
            break
        }
        }else e=+d;
for(a=0,ft=t.percents.length;a<ft;a++)if(t.percents[a]==u||t.percents[a]>e*t.top){
    u=t.percents[a];
    wt=t.percents[a-1]||0;
    w=w/t.top*(u-wt);
    ni=t.percents[a+1];
    tt=t.anim[u];
    break
}else e&&i.attr(t.anim[t.percents[a]]);if(tt){
    if(ot)ot.initstatus=e,ot.start=new Date-ot.ms*e;
    else{
        for(l in tt)if(tt[h](l)&&(ai[h](l)||i.paper.customAttributes[h](l))){
            p[l]=i.attr(l);
            p[l]==null&&(p[l]=yu[l]);
            d[l]=tt[l];
            switch(ai[l]){
                case v:
                    b[l]=(d[l]-p[l])/w;
                    break;
                case"colour":
                    p[l]=n.getRGB(p[l]);
                    lt=n.getRGB(d[l]);
                    b[l]={
                    r:(lt.r-p[l].r)/w,
                    g:(lt.g-p[l].g)/w,
                    b:(lt.b-p[l].b)/w
                    };
                    
                break;
                case"path":
                    for(kt=vt(p[l],d[l]),ti=kt[1],p[l]=kt[0],b[l]=[],a=0,ft=p[l].length;a<ft;a++)for(b[l][a]=[0],nt=1,at=p[l][a].length;nt<at;nt++)b[l][a][nt]=(ti[a][nt]-p[l][a][nt])/w;
                    break;
                case"transform":
                    if(dt=i._,yt=lf(dt[l],d[l]),yt)for(p[l]=yt.from,d[l]=yt.to,b[l]=[],b[l].real=!0,a=0,ft=p[l].length;a<ft;a++)for(b[l][a]=[p[l][a][0]],nt=1,at=p[l][a].length;nt<at;nt++)b[l][a][nt]=(d[l][a][nt]-p[l][a][nt])/w;else k=i.matrix||new et,rt={
                    _:{
                        transform:dt.transform
                        },
                    getBBox:function(){
                        return i.getBBox(1)
                        }
                    },p[l]=[k.a,k.b,k.c,k.d,k.e,k.f],nu(rt,d[l]),d[l]=rt._.transform,b[l]=[(rt.matrix.a-k.a)/w,(rt.matrix.b-k.b)/w,(rt.matrix.c-k.c)/w,(rt.matrix.d-k.d)/w,(rt.matrix.e-k.e)/w,(rt.matrix.f-k.f)/w];
                break;
            case"csv":
                if(st=y(tt[l])[it](oi),ht=y(p[l])[it](oi),l=="clip-rect")for(p[l]=ht,b[l]=[],a=ht.length;a--;)b[l][a]=(st[a]-p[l][a])/w;
                d[l]=st;
                break;
            default:
                for(st=[][f](tt[l]),ht=[][f](p[l]),b[l]=[],a=i.paper.customAttributes[l].length;a--;)b[l][a]=((st[a]||0)-(ht[a]||0))/w
                }
            }
        if(gt=tt.easing,ut=n.easing_formulas[gt],ut||(ut=y(gt).match(vu),ut&&ut.length==5?(ct=ut,ut=function(n){
    return bf(n,+ct[1],+ct[2],+ct[3],+ct[4],w)
    }):ut=nf),bt=tt.start||t.start||+new Date,g={
    anim:t,
    percent:u,
    timestamp:bt,
    start:bt+(t.del||0),
    status:0,
    initstatus:e||0,
    stop:!1,
    ms:w,
    easing:ut,
    from:p,
    diff:b,
    to:d,
    el:i,
    callback:tt.callback,
    prev:wt,
    next:ni,
    repeat:c||t.times,
    origin:i.attr(),
    totalOrigin:s
},r.push(g),e&&!ot&&!pt&&(g.stop=!0,g.start=new Date-w*e,r.length==1))return fr();
pt&&(g.start=new Date-g.ms*e);
r.length==1&&eu(fr)
}
eve("raphael.anim.start."+i.id,i,t)
}
}
function ou(n){
    for(var t=0;t<r.length;t++)r[t].el.paper==n&&r.splice(t--,1)
        }
        var dt,gt,tf,ef,ut,yt,tr,st,iu,k,ht,w,fi;
n.version="2.1.0";
n.eve=eve;
var ei,oi=/[, ]+/,su={
    circle:1,
    rect:1,
    path:1,
    ellipse:1,
    text:1,
    image:1
},hu=/\{(\d+)\}/g,h="hasOwnProperty",t={
    doc:document,
    win:window
},si={
    was:Object.prototype[h].call(t.win,"Raphael"),
    is:t.win.Raphael
    },or=function(){
    this.ca=this.customAttributes={}
},s,c="apply",f="concat",hi="createTouch"in t.doc,b="",ct=" ",y=String,it="split",sr="click dblclick mousedown mousemove mouseout mouseover mouseup touchstart touchmove touchend touchcancel"[it](ct),ci={
    mousedown:"touchstart",
    mousemove:"touchmove",
    mouseup:"touchend"
},wt=y.prototype.toLowerCase,i=Math,e=i.max,l=i.min,a=i.abs,d=i.pow,p=i.PI,v="number",bt="string",g="array",cu=Object.prototype.toString,kf=n._ISURL=/^url\(['"]?([^\)]+?)['"]?\)$/i,lu=/^\s*((#[a-f\d]{6})|(#[a-f\d]{3})|rgba?\(\s*([\d\.]+%?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+%?(?:\s*,\s*[\d\.]+%?)?)\s*\)|hsba?\(\s*([\d\.]+(?:deg|\xb0|%)?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+(?:%?\s*,\s*[\d\.]+)?)%?\s*\)|hsla?\(\s*([\d\.]+(?:deg|\xb0|%)?\s*,\s*[\d\.]+%?\s*,\s*[\d\.]+(?:%?\s*,\s*[\d\.]+)?)%?\s*\))\s*$/i,au={
    NaN:1,
    Infinity:1,
    "-Infinity":1
},vu=/^(?:cubic-)?bezier\(([^,]+),([^,]+),([^,]+),([^\)]+)\)/,li=i.round,o=parseFloat,ft=parseInt,hr=y.prototype.toUpperCase,yu=n._availableAttrs={
    "arrow-end":"none",
    "arrow-start":"none",
    blur:0,
    "clip-rect":"0 0 1e9 1e9",
    cursor:"default",
    cx:0,
    cy:0,
    fill:"#fff",
    "fill-opacity":1,
    font:'10px "Arial"',
    "font-family":'"Arial"',
    "font-size":"10",
    "font-style":"normal",
    "font-weight":400,
    gradient:0,
    height:0,
    href:"http://raphaeljs.com/",
    "letter-spacing":0,
    opacity:1,
    path:"M0,0",
    r:0,
    rx:0,
    ry:0,
    src:"",
    stroke:"#000",
    "stroke-dasharray":"",
    "stroke-linecap":"butt",
    "stroke-linejoin":"butt",
    "stroke-miterlimit":0,
    "stroke-opacity":1,
    "stroke-width":1,
    target:"_blank",
    "text-anchor":"middle",
    title:"Raphael",
    transform:"",
    width:0,
    x:0,
    y:0
},ai=n._availableAnimAttrs={
    blur:v,
    "clip-rect":"csv",
    cx:v,
    cy:v,
    fill:"colour",
    "fill-opacity":v,
    "font-size":v,
    height:v,
    opacity:v,
    path:"path",
    r:v,
    rx:v,
    ry:v,
    stroke:"colour",
    "stroke-opacity":v,
    "stroke-width":v,
    transform:"transform",
    width:v,
    x:v,
    y:v
},vi=/[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*/,pu={
    hs:1,
    rg:1
},wu=/,?([achlmqrstvxz]),?/gi,bu=/([achlmrqstvz])[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029,]*((-?\d*\.?\d*(?:e[\-+]?\d+)?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*)+)/ig,ku=/([rstm])[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029,]*((-?\d*\.?\d*(?:e[\-+]?\d+)?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*)+)/ig,cr=/(-?\d*\.?\d*(?:e[\-+]?\d+)?)[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,?[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*/ig,df=n._radial_gradient=/^r(?:\(([^,]+?)[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*,[\x09\x0a\x0b\x0c\x0d\x20\xa0\u1680\u180e\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u202f\u205f\u3000\u2028\u2029]*([^\)]+?)\))?/,at={},gf=function(n,t){
    return n.key-t.key
    },du=function(n,t){
    return o(n)-o(t)
    },gu=function(){},nf=function(n){
    return n
    },yi=n._rectPath=function(n,t,i,r,u){
    return u?[["M",n+u,t],["l",i-u*2,0],["a",u,u,0,0,1,u,u],["l",0,r-u*2],["a",u,u,0,0,1,-u,u],["l",u*2-i,0],["a",u,u,0,0,1,-u,-u],["l",0,u*2-r],["a",u,u,0,0,1,u,-u],["z"]]:[["M",n,t],["l",i,0],["l",0,r],["l",-i,0],["z"]]
    },lr=function(n,t,i,r){
    return r==null&&(r=i),[["M",n,t],["m",0,-r],["a",i,r,0,1,1,0,2*r],["a",i,r,0,1,1,0,-2*r],["z"]]
    },kt=n._getPath={
    path:function(n){
        return n.attr("path")
        },
    circle:function(n){
        var t=n.attrs;
        return lr(t.cx,t.cy,t.r)
        },
    ellipse:function(n){
        var t=n.attrs;
        return lr(t.cx,t.cy,t.rx,t.ry)
        },
    rect:function(n){
        var t=n.attrs;
        return yi(t.x,t.y,t.width,t.height,t.r)
        },
    image:function(n){
        var t=n.attrs;
        return yi(t.x,t.y,t.width,t.height)
        },
    text:function(n){
        var t=n._getBBox();
        return yi(t.x,t.y,t.width,t.height)
        }
    },pi=n.mapPath=function(n,t){
    if(!t)return n;
    var f,e,u,i,o,s,r;
    for(n=vt(n),u=0,o=n.length;u<o;u++)for(r=n[u],i=1,s=r.length;i<s;i+=2)f=t.x(r[i],r[i+1]),e=t.y(r[i],r[i+1]),r[i]=f,r[i+1]=e;
    return n
    };
    
if(n._g=t,n.type=t.win.SVGAngle||t.doc.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure","1.1")?"SVG":"VML",n.type=="VML"){
    if(dt=t.doc.createElement("div"),dt.innerHTML='<v:shape adj="1"/>',gt=dt.firstChild,gt.style.behavior="url(#default#VML)",!(gt&&typeof gt.adj=="object"))return n.type=b;
    dt=null
    }
    n.svg=!(n.vml=n.type=="VML");
n._Paper=or;
n.fn=s=or.prototype=n.prototype;
n._id=0;
n._oid=0;
n.is=function(n,t){
    return(t=wt.call(t),t=="finite")?!au[h](+n):t=="array"?n instanceof Array:t=="null"&&n===null||t==typeof n&&n!==null||t=="object"&&n===Object(n)||t=="array"&&Array.isArray&&Array.isArray(n)||cu.call(n).slice(8,-1).toLowerCase()==t
    };
    
n.angle=function(t,r,u,f,e,o){
    if(e==null){
        var s=t-u,h=r-f;
        return!s&&!h?0:(180+i.atan2(-h,-s)*180/p+360)%360
        }
        return n.angle(t,r,e,o)-n.angle(u,f,e,o)
    };
    
n.rad=function(n){
    return n%360*p/180
    };
    
n.deg=function(n){
    return n*180/p%360
    };
    
n.snapTo=function(t,i,r){
    var f,u;
    if(r=n.is(r,"finite")?r:10,n.is(t,g)){
        for(f=t.length;f--;)if(a(t[f]-i)<=r)return t[f]
            }else{
        if(t=+t,u=i%t,u<r)return i-u;
        if(u>t-r)return i-u+t
            }
            return i
    };
    
tf=n.createUUID=function(n,t){
    return function(){
        return"xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(n,t).toUpperCase()
        }
    }(/[xy]/g,function(n){
    var t=i.random()*16|0,r=n=="x"?t:t&3|8;
    return r.toString(16)
    });
n.setWindow=function(i){
    eve("raphael.setWindow",n,t.win,i);
    t.win=i;
    t.doc=t.win.document;
    n._engine.initWin&&n._engine.initWin(t.win)
    };
    
var ni=function(i){
    var e,u,f,o,r;
    if(n.vml){
        e=/^\s+|\s+$/g;
        try{
            f=new ActiveXObject("htmlfile");
            f.write("<body>");
            f.close();
            u=f.body
            }catch(s){
            u=createPopup().document.body
            }
            o=u.createTextRange();
        ni=nt(function(n){
            try{
                u.style.color=y(n).replace(e,b);
                var t=o.queryCommandValue("ForeColor");
                return t=(t&255)<<16|t&65280|(t&16711680)>>>16,"#"+("000000"+t.toString(16)).slice(-6)
                }catch(i){
                return"none"
                }
            })
    }else r=t.doc.createElement("i"),r.title="Raphaël Colour Picker",r.style.display="none",t.doc.body.appendChild(r),ni=nt(function(n){
    return r.style.color=n,t.doc.defaultView.getComputedStyle(r,b).getPropertyValue("color")
    });
return ni(i)
},rf=function(){
    return"hsb("+[this.h,this.s,this.b]+")"
    },uf=function(){
    return"hsl("+[this.h,this.s,this.l]+")"
    },ar=function(){
    return this.hex
    },vr=function(t,i,r){
    if(i==null&&n.is(t,"object")&&"r"in t&&"g"in t&&"b"in t&&(r=t.b,i=t.g,t=t.r),i==null&&n.is(t,bt)){
        var u=n.getRGB(t);
        t=u.r;
        i=u.g;
        r=u.b
        }
        return(t>1||i>1||r>1)&&(t/=255,i/=255,r/=255),[t,i,r]
    },yr=function(t,i,r,u){
    t*=255;
    i*=255;
    r*=255;
    var f={
        r:t,
        g:i,
        b:r,
        hex:n.rgb(t,i,r),
        toString:ar
    };
    
    return n.is(u,"finite")&&(f.opacity=u),f
    };
    
n.color=function(t){
    var i;
    return n.is(t,"object")&&"h"in t&&"s"in t&&"b"in t?(i=n.hsb2rgb(t),t.r=i.r,t.g=i.g,t.b=i.b,t.hex=i.hex):n.is(t,"object")&&"h"in t&&"s"in t&&"l"in t?(i=n.hsl2rgb(t),t.r=i.r,t.g=i.g,t.b=i.b,t.hex=i.hex):(n.is(t,"string")&&(t=n.getRGB(t)),n.is(t,"object")&&"r"in t&&"g"in t&&"b"in t?(i=n.rgb2hsl(t),t.h=i.h,t.s=i.s,t.l=i.l,i=n.rgb2hsb(t),t.v=i.b):(t={
        hex:"none"
    },t.r=t.g=t.b=t.h=t.s=t.v=t.l=-1)),t.toString=ar,t
    };
    
n.hsb2rgb=function(n,t,i,r){
    this.is(n,"object")&&"h"in n&&"s"in n&&"b"in n&&(i=n.b,t=n.s,n=n.h,r=n.o);
    n*=360;
    var e,o,s,f,u;
    return n=n%360/60,u=i*t,f=u*(1-a(n%2-1)),e=o=s=i-u,n=~~n,e+=[u,f,0,0,f,u][n],o+=[f,u,u,f,0,0][n],s+=[0,0,f,u,u,f][n],yr(e,o,s,r)
    };
    
n.hsl2rgb=function(n,t,i,r){
    this.is(n,"object")&&"h"in n&&"s"in n&&"l"in n&&(i=n.l,t=n.s,n=n.h);
    (n>1||t>1||i>1)&&(n/=360,t/=100,i/=100);
    n*=360;
    var e,o,s,f,u;
    return n=n%360/60,u=2*t*(i<.5?i:1-i),f=u*(1-a(n%2-1)),e=o=s=i-u/2,n=~~n,e+=[u,f,0,0,f,u][n],o+=[f,u,u,f,0,0][n],s+=[0,0,f,u,u,f][n],yr(e,o,s,r)
    };
    
n.rgb2hsb=function(n,t,i){
    i=vr(n,t,i);
    n=i[0];
    t=i[1];
    i=i[2];
    var f,o,u,r;
    return u=e(n,t,i),r=u-l(n,t,i),f=r==0?null:u==n?(t-i)/r:u==t?(i-n)/r+2:(n-t)/r+4,f=(f+360)%6/6,o=r==0?0:r/u,{
        h:f,
        s:o,
        b:u,
        toString:rf
    }
};

n.rgb2hsl=function(n,t,i){
    i=vr(n,t,i);
    n=i[0];
    t=i[1];
    i=i[2];
    var o,h,u,f,s,r;
    return f=e(n,t,i),s=l(n,t,i),r=f-s,o=r==0?null:f==n?(t-i)/r:f==t?(i-n)/r+2:(n-t)/r+4,o=(o+360)%6/6,u=(f+s)/2,h=r==0?0:u<.5?r/(2*u):r/(2-2*u),{
        h:o,
        s:h,
        l:u,
        toString:uf
    }
};

n._path2string=function(){
    return this.join(",").replace(wu,"$1")
    };
    
ef=n._preload=function(n,i){
    var r=t.doc.createElement("img");
    r.style.cssText="position:absolute;left:-9999em;top:-9999em";
    r.onload=function(){
        i.call(this);
        this.onload=null;
        t.doc.body.removeChild(this)
        };
        
    r.onerror=function(){
        t.doc.body.removeChild(this)
        };
        
    t.doc.body.appendChild(r);
    r.src=n
    };
    
n.getRGB=nt(function(t){
    if(!t||!!((t=y(t)).indexOf("-")+1))return{
        r:-1,
        g:-1,
        b:-1,
        hex:"none",
        error:1,
        toString:ti
    };
    
    if(t=="none")return{
        r:-1,
        g:-1,
        b:-1,
        hex:"none",
        toString:ti
    };
    
    pu[h](t.toLowerCase().substring(0,2))||t.charAt()=="#"||(t=ni(t));
    var u,f,e,s,c,i,r=t.match(lu);
    return r?(r[2]&&(e=ft(r[2].substring(5),16),f=ft(r[2].substring(3,5),16),u=ft(r[2].substring(1,3),16)),r[3]&&(e=ft((c=r[3].charAt(3))+c,16),f=ft((c=r[3].charAt(2))+c,16),u=ft((c=r[3].charAt(1))+c,16)),r[4]&&(i=r[4][it](vi),u=o(i[0]),i[0].slice(-1)=="%"&&(u*=2.55),f=o(i[1]),i[1].slice(-1)=="%"&&(f*=2.55),e=o(i[2]),i[2].slice(-1)=="%"&&(e*=2.55),r[1].toLowerCase().slice(0,4)=="rgba"&&(s=o(i[3])),i[3]&&i[3].slice(-1)=="%"&&(s/=100)),r[5])?(i=r[5][it](vi),u=o(i[0]),i[0].slice(-1)=="%"&&(u*=2.55),f=o(i[1]),i[1].slice(-1)=="%"&&(f*=2.55),e=o(i[2]),i[2].slice(-1)=="%"&&(e*=2.55),(i[0].slice(-3)=="deg"||i[0].slice(-1)=="°")&&(u/=360),r[1].toLowerCase().slice(0,4)=="hsba"&&(s=o(i[3])),i[3]&&i[3].slice(-1)=="%"&&(s/=100),n.hsb2rgb(u,f,e,s)):r[6]?(i=r[6][it](vi),u=o(i[0]),i[0].slice(-1)=="%"&&(u*=2.55),f=o(i[1]),i[1].slice(-1)=="%"&&(f*=2.55),e=o(i[2]),i[2].slice(-1)=="%"&&(e*=2.55),(i[0].slice(-3)=="deg"||i[0].slice(-1)=="°")&&(u/=360),r[1].toLowerCase().slice(0,4)=="hsla"&&(s=o(i[3])),i[3]&&i[3].slice(-1)=="%"&&(s/=100),n.hsl2rgb(u,f,e,s)):(r={
        r:u,
        g:f,
        b:e,
        toString:ti
    },r.hex="#"+(16777216|e|f<<8|u<<16).toString(16).slice(1),n.is(s,"finite")&&(r.opacity=s),r):{
        r:-1,
        g:-1,
        b:-1,
        hex:"none",
        error:1,
        toString:ti
    }
},n);
n.hsb=nt(function(t,i,r){
    return n.hsb2rgb(t,i,r).hex
    });
n.hsl=nt(function(t,i,r){
    return n.hsl2rgb(t,i,r).hex
    });
n.rgb=nt(function(n,t,i){
    return"#"+(16777216|i|t<<8|n<<16).toString(16).slice(1)
    });
n.getColor=function(n){
    var t=this.getColor.start=this.getColor.start||{
        h:0,
        s:1,
        b:n||.75
        },i=this.hsb2rgb(t.h,t.s,t.b);
    return t.h+=.075,t.h>1&&(t.h=0,t.s-=.2,t.s<=0&&(this.getColor.start={
        h:0,
        s:1,
        b:t.b
        })),i.hex
    };
    
n.getColor.reset=function(){
    delete this.start
    };
    
n.parsePathString=function(t){
    var r,u,i;
    return t?(r=ut(t),r.arr)?tt(r.arr):(u={
        a:7,
        c:6,
        h:1,
        l:2,
        m:2,
        r:4,
        q:4,
        s:4,
        t:2,
        v:1,
        z:0
    },i=[],n.is(t,g)&&n.is(t[0],g)&&(i=tt(t)),i.length||y(t).replace(bu,function(n,t,r){
        var e=[],o=t.toLowerCase();
        if(r.replace(cr,function(n,t){
            t&&e.push(+t)
            }),o=="m"&&e.length>2&&(i.push([t][f](e.splice(0,2))),o="l",t=t=="m"?"l":"L"),o=="r")i.push([t][f](e));else while(e.length>=u[o])if(i.push([t][f](e.splice(0,u[o]))),!u[o])break
    }),i.toString=n._path2string,r.arr=tt(i),i):null
    };
    
n.parseTransformString=nt(function(t){
    if(!t)return null;
    var i=[];
    return n.is(t,g)&&n.is(t[0],g)&&(i=tt(t)),i.length||y(t).replace(ku,function(n,t,r){
        var u=[],e=wt.call(t);
        r.replace(cr,function(n,t){
            t&&u.push(+t)
            });
        i.push([t][f](u))
        }),i.toString=n._path2string,i
    });
ut=function(n){
    var t=ut.ps=ut.ps||{};
    
    return t[n]?t[n].sleep=100:t[n]={
        sleep:100
    },setTimeout(function(){
        for(var i in t)t[h](i)&&i!=n&&(t[i].sleep--,t[i].sleep||delete t[i])
            }),t[n]
    };
    
n.findDotsAtSegment=function(n,t,r,u,f,e,o,s,h){
    var c=1-h,b=d(c,3),k=d(c,2),l=h*h,g=l*h,tt=b*n+k*3*h*r+c*3*h*h*f+g*o,it=b*t+k*3*h*u+c*3*h*h*e+g*s,a=n+2*h*(r-n)+l*(f-2*r+n),v=t+2*h*(u-t)+l*(e-2*u+t),y=r+2*h*(f-r)+l*(o-2*f+r),w=u+2*h*(e-u)+l*(s-2*e+u),rt=c*n+h*r,ut=c*t+h*u,ft=c*f+h*o,et=c*e+h*s,nt=90-i.atan2(a-y,v-w)*180/p;
    return(a>y||v<w)&&(nt+=180),{
        x:tt,
        y:it,
        m:{
            x:a,
            y:v
        },
        n:{
            x:y,
            y:w
        },
        start:{
            x:rt,
            y:ut
        },
        end:{
            x:ft,
            y:et
        },
        alpha:nt
    }
};

n.bezierBBox=function(t,i,r,u,f,e,o,s){
    n.is(t,"array")||(t=[t,i,r,u,f,e,o,s]);
    var h=gr.apply(null,t);
    return{
        x:h.min.x,
        y:h.min.y,
        x2:h.max.x,
        y2:h.max.y,
        width:h.max.x-h.min.x,
        height:h.max.y-h.min.y
        }
    };

n.isPointInsideBBox=function(n,t,i){
    return t>=n.x&&t<=n.x2&&i>=n.y&&i<=n.y2
    };
    
n.isBBoxIntersect=function(t,i){
    var r=n.isPointInsideBBox;
    return r(i,t.x,t.y)||r(i,t.x2,t.y)||r(i,t.x,t.y2)||r(i,t.x2,t.y2)||r(t,i.x,i.y)||r(t,i.x2,i.y)||r(t,i.x,i.y2)||r(t,i.x2,i.y2)||(t.x<i.x2&&t.x>i.x||i.x<t.x2&&i.x>t.x)&&(t.y<i.y2&&t.y>i.y||i.y<t.y2&&i.y>t.y)
    };
    
n.pathIntersection=function(n,t){
    return ki(n,t)
    };
    
n.pathIntersectionNumber=function(n,t){
    return ki(n,t,1)
    };
    
n.isPointInsidePath=function(t,i,r){
    var u=n.pathBBox(t);
    return n.isPointInsideBBox(u,i,r)&&ki(t,[["M",i,r],["H",u.x2+10]],1)%2==1
    };
    
n._removedFactory=function(n){
    return function(){
        eve("raphael.log",null,"Raphaël: you are calling to method “"+n+"” of removed object",n)
        }
    };

var di=n.pathBBox=function(n){
    var a=ut(n),h,v,u;
    if(a.bbox)return a.bbox;
    if(!n)return{
        x:0,
        y:0,
        width:0,
        height:0,
        x2:0,
        y2:0
    };
    
    n=vt(n);
    var o=0,s=0,i=[],r=[],t;
    for(h=0,v=n.length;h<v;h++)t=n[h],t[0]=="M"?(o=t[1],s=t[2],i.push(o),r.push(s)):(u=gr(o,s,t[1],t[2],t[3],t[4],t[5],t[6]),i=i[f](u.min.x,u.max.x),r=r[f](u.min.y,u.max.y),o=t[5],s=t[6]);
    var y=l[c](0,i),p=l[c](0,r),w=e[c](0,i),b=e[c](0,r),k={
        x:y,
        y:p,
        x2:w,
        y2:b,
        width:w-y,
        height:b-p
        };
        
    return a.bbox=wi(k),k
    },tt=function(t){
    var i=wi(t);
    return i.toString=n._path2string,i
    },hf=n._pathToRelative=function(t){
    var v=ut(t),u,p,f,i,s,w,h,b,c;
    if(v.rel)return tt(v.rel);
    n.is(t,g)&&n.is(t&&t[0],g)||(t=n.parsePathString(t));
    var r=[],o=0,e=0,l=0,a=0,y=0;
    for(t[0][0]=="M"&&(o=t[0][1],e=t[0][2],l=o,a=e,y++,r.push(["M",o,e])),u=y,p=t.length;u<p;u++){
        if(f=r[u]=[],i=t[u],i[0]!=wt.call(i[0])){
            f[0]=wt.call(i[0]);
            switch(f[0]){
                case"a":
                    f[1]=i[1];
                    f[2]=i[2];
                    f[3]=i[3];
                    f[4]=i[4];
                    f[5]=i[5];
                    f[6]=+(i[6]-o).toFixed(3);
                    f[7]=+(i[7]-e).toFixed(3);
                    break;
                case"v":
                    f[1]=+(i[1]-e).toFixed(3);
                    break;
                case"m":
                    l=i[1];
                    a=i[2];
                default:
                    for(s=1,w=i.length;s<w;s++)f[s]=+(i[s]-(s%2?o:e)).toFixed(3)
                    }
                }else for(f=r[u]=[],i[0]=="m"&&(l=i[1]+o,a=i[2]+e),h=0,b=i.length;h<b;h++)r[u][h]=i[h];
        c=r[u].length;
        switch(r[u][0]){
        case"z":
            o=l;
            e=a;
            break;
        case"h":
            o+=+r[u][c-1];
            break;
        case"v":
            e+=+r[u][c-1];
            break;
        default:
            o+=+r[u][c-2];
            e+=+r[u][c-1]
            }
        }
    return r.toString=n._path2string,v.rel=tt(r),r
},br=n._pathToAbsolute=function(t){
    var p=ut(t),w,i,r,v,k,h,o,y,c,d;
    if(p.abs)return tt(p.abs);
    if(n.is(t,g)&&n.is(t&&t[0],g)||(t=n.parsePathString(t)),!t||!t.length)return[["M",0,0]];
    var s=[],u=0,e=0,l=0,a=0,b=0;
    for(t[0][0]=="M"&&(u=+t[0][1],e=+t[0][2],l=u,a=e,b++,s[0]=["M",u,e]),w=t.length==3&&t[0][0]=="M"&&t[1][0].toUpperCase()=="R"&&t[2][0].toUpperCase()=="Z",v=b,k=t.length;v<k;v++){
        if(s.push(i=[]),r=t[v],r[0]!=hr.call(r[0])){
            i[0]=hr.call(r[0]);
            switch(i[0]){
                case"A":
                    i[1]=r[1];
                    i[2]=r[2];
                    i[3]=r[3];
                    i[4]=r[4];
                    i[5]=r[5];
                    i[6]=+(r[6]+u);
                    i[7]=+(r[7]+e);
                    break;
                case"V":
                    i[1]=+r[1]+e;
                    break;
                case"H":
                    i[1]=+r[1]+u;
                    break;
                case"R":
                    for(h=[u,e][f](r.slice(1)),o=2,y=h.length;o<y;o++)h[o]=+h[o]+u,h[++o]=+h[o]+e;
                    s.pop();
                    s=s[f](pr(h,w));
                    break;
                case"M":
                    l=+r[1]+u;
                    a=+r[2]+e;
                default:
                    for(o=1,y=r.length;o<y;o++)i[o]=+r[o]+(o%2?u:e)
                    }
                }else if(r[0]=="R")h=[u,e][f](r.slice(1)),s.pop(),s=s[f](pr(h,w)),i=["R"][f](r.slice(-2));else for(c=0,d=r.length;c<d;c++)i[c]=r[c];
        switch(i[0]){
        case"Z":
            u=l;
            e=a;
            break;
        case"H":
            u=i[1];
            break;
        case"V":
            e=i[1];
            break;
        case"M":
            l=i[i.length-2];
            a=i[i.length-1];
        default:
            u=i[i.length-2];
            e=i[i.length-1]
            }
        }
    return s.toString=n._path2string,p.abs=tt(s),s
},ii=function(n,t,i,r){
    return[n,t,i,r,i,r]
    },kr=function(n,t,i,r,u,f){
    var e=1/3,o=2/3;
    return[e*n+o*i,e*t+o*r,e*u+o*i,e*f+o*r,u,f]
    },dr=function(n,t,r,u,e,o,s,h,c,l){
    var at=p*120/180,et=p/180*(+e||0),w=[],g,ot=nt(function(n,t,r){
        var u=n*i.cos(r)-t*i.sin(r),f=n*i.sin(r)+t*i.cos(r);
        return{
            x:u,
            y:f
        }
    }),st,lt,b,gt;
if(l)y=l[0],v=l[1],ut=l[2],ft=l[3];
else{
    g=ot(n,t,-et);
    n=g.x;
    t=g.y;
    g=ot(h,c,-et);
    h=g.x;
    c=g.y;
    var oi=i.cos(p/180*e),si=i.sin(p/180*e),k=(n-h)/2,d=(t-c)/2,rt=k*k/(r*r)+d*d/(u*u);
    rt>1&&(rt=i.sqrt(rt),r=rt*r,u=rt*u);
    var ht=r*r,ct=u*u,vt=(o==s?-1:1)*i.sqrt(a((ht*ct-ht*d*d-ct*k*k)/(ht*d*d+ct*k*k))),ut=vt*r*d/u+(n+h)/2,ft=vt*-u*k/r+(t+c)/2,y=i.asin(((t-ft)/u).toFixed(9)),v=i.asin(((c-ft)/u).toFixed(9));
    y=n<ut?p-y:y;
    v=h<ut?p-v:v;
    y<0&&(y=p*2+y);
    v<0&&(v=p*2+v);
    s&&y>v&&(y=y-p*2);
    !s&&v>y&&(v=v-p*2)
    }
    if(st=v-y,a(st)>at){
    var ni=v,ti=h,ii=c;
    v=y+at*(s&&v>y?1:-1);
    h=ut+r*i.cos(v);
    c=ft+u*i.sin(v);
    w=dr(h,c,r,u,e,0,s,ti,ii,[v,ni,ut,ft])
    }
    st=v-y;
var ri=i.cos(y),ui=i.sin(y),fi=i.cos(v),ei=i.sin(v),yt=i.tan(st/4),pt=4/3*r*yt,wt=4/3*u*yt,bt=[n,t],tt=[n+pt*ui,t-wt*ri],kt=[h+pt*ei,c-wt*fi],dt=[h,c];
if(tt[0]=2*bt[0]-tt[0],tt[1]=2*bt[1]-tt[1],l)return[tt,kt,dt][f](w);
for(w=[tt,kt,dt][f](w).join()[it](","),lt=[],b=0,gt=w.length;b<gt;b++)lt[b]=b%2?ot(w[b-1],w[b],et).y:ot(w[b],w[b+1],et).x;
return lt
},ri=function(n,t,i,r,u,f,e,o,s){
    var h=1-s;
    return{
        x:d(h,3)*n+d(h,2)*3*s*i+h*3*s*s*u+d(s,3)*e,
        y:d(h,3)*t+d(h,2)*3*s*r+h*3*s*s*f+d(s,3)*o
        }
    },gr=nt(function(n,t,r,u,f,o,s,h){
    var b=f-2*r+n-(s-2*f+r),v=2*(r-n)-2*(f-r),g=n-r,p=(-v+i.sqrt(v*v-4*b*g))/2/b,w=(-v-i.sqrt(v*v-4*b*g))/2/b,k=[t,h],d=[n,s],y;
    return a(p)>"1e12"&&(p=.5),a(w)>"1e12"&&(w=.5),p>0&&p<1&&(y=ri(n,t,r,u,f,o,s,h,p),d.push(y.x),k.push(y.y)),w>0&&w<1&&(y=ri(n,t,r,u,f,o,s,h,w),d.push(y.x),k.push(y.y)),b=o-2*u+t-(h-2*o+u),v=2*(u-t)-2*(o-u),g=t-u,p=(-v+i.sqrt(v*v-4*b*g))/2/b,w=(-v-i.sqrt(v*v-4*b*g))/2/b,a(p)>"1e12"&&(p=.5),a(w)>"1e12"&&(w=.5),p>0&&p<1&&(y=ri(n,t,r,u,f,o,s,h,p),d.push(y.x),k.push(y.y)),w>0&&w<1&&(y=ri(n,t,r,u,f,o,s,h,w),d.push(y.x),k.push(y.y)),{
        min:{
            x:l[c](0,d),
            y:l[c](0,k)
            },
        max:{
            x:e[c](0,d),
            y:e[c](0,k)
            }
        }
}),vt=n._path2curve=nt(function(n,t){
    var w=!t&&ut(n),r,v;
    if(!t&&w.curve)return tt(w.curve);
    var u=br(n),i=t&&br(t),s={
        x:0,
        y:0,
        bx:0,
        by:0,
        X:0,
        Y:0,
        qx:null,
        qy:null
    },h={
        x:0,
        y:0,
        bx:0,
        by:0,
        X:0,
        Y:0,
        qx:null,
        qy:null
    },b=function(n,t){
        var i,r;
        if(!n)return["C",t.x,t.y,t.x,t.y,t.x,t.y];
        n[0]in{
            T:1,
            Q:1
        }||(t.qx=t.qy=null);
        switch(n[0]){
            case"M":
                t.X=n[1];
                t.Y=n[2];
                break;
            case"A":
                n=["C"][f](dr[c](0,[t.x,t.y][f](n.slice(1))));
                break;
            case"S":
                i=t.x+(t.x-(t.bx||t.x));
                r=t.y+(t.y-(t.by||t.y));
                n=["C",i,r][f](n.slice(1));
                break;
            case"T":
                t.qx=t.x+(t.x-(t.qx||t.x));
                t.qy=t.y+(t.y-(t.qy||t.y));
                n=["C"][f](kr(t.x,t.y,t.qx,t.qy,n[1],n[2]));
                break;
            case"Q":
                t.qx=n[1];
                t.qy=n[2];
                n=["C"][f](kr(t.x,t.y,n[1],n[2],n[3],n[4]));
                break;
            case"L":
                n=["C"][f](ii(t.x,t.y,n[1],n[2]));
                break;
            case"H":
                n=["C"][f](ii(t.x,t.y,n[1],t.y));
                break;
            case"V":
                n=["C"][f](ii(t.x,t.y,t.x,n[1]));
                break;
            case"Z":
                n=["C"][f](ii(t.x,t.y,t.X,t.Y))
                }
                return n
        },k=function(n,t){
        if(n[t].length>7){
            n[t].shift();
            for(var r=n[t];r.length;)n.splice(t++,0,["C"][f](r.splice(0,6)));
            n.splice(t,1);
            v=e(u.length,i&&i.length||0)
            }
        },d=function(n,t,r,f,o){
    n&&t&&n[o][0]=="M"&&t[o][0]!="M"&&(t.splice(o,0,["M",f.x,f.y]),r.bx=0,r.by=0,r.x=n[o][1],r.y=n[o][2],v=e(u.length,i&&i.length||0))
    };
    
for(r=0,v=e(u.length,i&&i.length||0);r<v;r++){
    u[r]=b(u[r],s);
    k(u,r);
    i&&(i[r]=b(i[r],h));
    i&&k(i,r);
    d(u,i,s,h,r);
    d(i,u,h,s,r);
    var l=u[r],a=i&&i[r],y=l.length,p=i&&a.length;
    s.x=l[y-2];
    s.y=l[y-1];
    s.bx=o(l[y-4])||s.x;
    s.by=o(l[y-3])||s.y;
    h.bx=i&&(o(a[p-4])||h.x);
    h.by=i&&(o(a[p-3])||h.y);
    h.x=i&&a[p-2];
    h.y=i&&a[p-1]
    }
    return i||(w.curve=tt(u)),i?[u,i]:u
    },null,tt),ie=n._parseDots=nt(function(t){
    for(var f,h,c,e,u,l,r=[],i=0,s=t.length;i<s;i++){
        if(f={},h=t[i].match(/^([^:]*):?([\d\.]*)/),f.color=n.getRGB(h[1]),f.color.error)return null;
        f.color=f.color.hex;
        h[2]&&(f.offset=h[2]+"%");
        r.push(f)
        }
        for(i=1,s=r.length-1;i<s;i++)if(!r[i].offset){
        for(c=o(r[i-1].offset||0),e=0,u=i+1;u<s;u++)if(r[u].offset){
            e=r[u].offset;
            break
        }
        for(e||(e=100,u=s),e=o(e),l=(e-c)/(u-i+1);i<u;i++)c+=l,r[i].offset=c+"%"
            }
            return r
    }),ui=n._tear=function(n,t){
    n==t.top&&(t.top=n.prev);
    n==t.bottom&&(t.bottom=n.next);
    n.next&&(n.next.prev=n.prev);
    n.prev&&(n.prev.next=n.next)
    },re=n._tofront=function(n,t){
    t.top!==n&&(ui(n,t),n.next=null,n.prev=t.top,t.top.next=n,t.top=n)
    },ue=n._toback=function(n,t){
    t.bottom!==n&&(ui(n,t),n.next=t.bottom,n.prev=null,t.bottom.prev=n,t.bottom=n)
    },fe=n._insertafter=function(n,t,i){
    ui(n,i);
    t==i.top&&(i.top=n);
    t.next&&(t.next.prev=n);
    n.next=t.next;
    n.prev=t;
    t.next=n
    },ee=n._insertbefore=function(n,t,i){
    ui(n,i);
    t==i.bottom&&(i.bottom=n);
    t.prev&&(t.prev.next=n);
    n.prev=t.prev;
    t.prev=n;
    n.next=t
    },cf=n.toMatrix=function(n,t){
    var r=di(n),i={
        _:{
            transform:b
        },
        getBBox:function(){
            return r
            }
        };
    
return nu(i,t),i.matrix
},oe=n.transformPath=function(n,t){
    return pi(n,cf(n,t))
    },nu=n._extractTransform=function(t,i){
    var k,tt;
    if(i==null)return t._.transform;
    i=y(i).replace(/\.{3}|\u2026/g,t._.transform||b);
    var a=n.parseTransformString(i),v=0,g=0,nt=0,p=1,w=1,e=t._,u=new et;
    if(e.transform=a||[],a)for(k=0,tt=a.length;k<tt;k++){
        var r=a[k],o=r.length,l=y(r[0]).toLowerCase(),d=r[0]!=l,s=d?u.invert():0,it,rt,h,c,f;
        l=="t"&&o==3?d?(it=s.x(0,0),rt=s.y(0,0),h=s.x(r[1],r[2]),c=s.y(r[1],r[2]),u.translate(h-it,c-rt)):u.translate(r[1],r[2]):l=="r"?o==2?(f=f||t.getBBox(1),u.rotate(r[1],f.x+f.width/2,f.y+f.height/2),v+=r[1]):o==4&&(d?(h=s.x(r[2],r[3]),c=s.y(r[2],r[3]),u.rotate(r[1],h,c)):u.rotate(r[1],r[2],r[3]),v+=r[1]):l=="s"?o==2||o==3?(f=f||t.getBBox(1),u.scale(r[1],r[o-1],f.x+f.width/2,f.y+f.height/2),p*=r[1],w*=r[o-1]):o==5&&(d?(h=s.x(r[3],r[4]),c=s.y(r[3],r[4]),u.scale(r[1],r[2],h,c)):u.scale(r[1],r[2],r[3],r[4]),p*=r[1],w*=r[2]):l=="m"&&o==7&&u.add(r[1],r[2],r[3],r[4],r[5],r[6]);
        e.dirtyT=1;
        t.matrix=u
        }
        t.matrix=u;
    e.sx=p;
    e.sy=w;
    e.deg=v;
    e.dx=g=u.e;
    e.dy=nt=u.f;
    p==1&&w==1&&!v&&e.bbox?(e.bbox.x+=+g,e.bbox.y+=+nt):e.dirtyT=1
    },tu=function(n){
    var t=n[0];
    switch(t.toLowerCase()){
        case"t":
            return[t,0,0];
        case"m":
            return[t,1,0,0,1,0,0];
        case"r":
            return n.length==4?[t,0,n[2],n[3]]:[t,0];
        case"s":
            return n.length==5?[t,1,1,n[3],n[4]]:n.length==3?[t,1,1]:[t,1]
            }
        },lf=n._equaliseTransform=function(t,i){
    i=y(i).replace(/\.{3}|\u2026/g,t);
    t=n.parseTransformString(t)||[];
    i=n.parseTransformString(i)||[];
    for(var l=e(t.length,i.length),s=[],h=[],u=0,f,c,r,o;u<l;u++){
        if(r=t[u]||tu(i[u]),o=i[u]||tu(r),r[0]!=o[0]||r[0].toLowerCase()=="r"&&(r[2]!=o[2]||r[3]!=o[3])||r[0].toLowerCase()=="s"&&(r[3]!=o[3]||r[4]!=o[4]))return;
        for(s[u]=[],h[u]=[],f=0,c=e(r.length,o.length);f<c;f++)f in r&&(s[u][f]=r[f]),f in o&&(h[u][f]=o[f])
            }
            return{
        from:s,
        to:h
    }
};

n._getContainer=function(i,r,u,f){
    var e;
    if(e=f==null&&!n.is(i,"object")?t.doc.getElementById(i):i,e!=null)return e.tagName?r==null?{
        container:e,
        width:e.style.pixelWidth||e.offsetWidth,
        height:e.style.pixelHeight||e.offsetHeight
        }:{
        container:e,
        width:r,
        height:u
    }:{
        container:1,
        x:i,
        y:r,
        width:u,
        height:f
    }
    };
    
n.pathToRelative=hf;
n._engine={};

n.path2curve=vt;
n.matrix=function(n,t,i,r,u,f){
    return new et(n,t,i,r,u,f)
    },function(t){
    function r(n){
        return n[0]*n[0]+n[1]*n[1]
        }
        function u(n){
        var t=i.sqrt(r(n));
        n[0]&&(n[0]/=t);
        n[1]&&(n[1]/=t)
        }
        t.add=function(n,t,i,r,u,f){
        var e=[[],[],[]],a=[[this.a,this.c,this.e],[this.b,this.d,this.f],[0,0,1]],l=[[n,i,u],[t,r,f],[0,0,1]],o,s,h,c;
        for(n&&n instanceof et&&(l=[[n.a,n.c,n.e],[n.b,n.d,n.f],[0,0,1]]),o=0;o<3;o++)for(s=0;s<3;s++){
            for(c=0,h=0;h<3;h++)c+=a[o][h]*l[h][s];
            e[o][s]=c
            }
            this.a=e[0][0];
        this.b=e[1][0];
        this.c=e[0][1];
        this.d=e[1][1];
        this.e=e[0][2];
        this.f=e[1][2]
        };
        
    t.invert=function(){
        var n=this,t=n.a*n.d-n.b*n.c;
        return new et(n.d/t,-n.b/t,-n.c/t,n.a/t,(n.c*n.f-n.d*n.e)/t,(n.b*n.e-n.a*n.f)/t)
        };
        
    t.clone=function(){
        return new et(this.a,this.b,this.c,this.d,this.e,this.f)
        };
        
    t.translate=function(n,t){
        this.add(1,0,0,1,n,t)
        };
        
    t.scale=function(n,t,i,r){
        t==null&&(t=n);
        (i||r)&&this.add(1,0,0,1,i,r);
        this.add(n,0,0,t,0,0);
        (i||r)&&this.add(1,0,0,1,-i,-r)
        };
        
    t.rotate=function(t,r,u){
        t=n.rad(t);
        r=r||0;
        u=u||0;
        var f=+i.cos(t).toFixed(9),e=+i.sin(t).toFixed(9);
        this.add(f,e,-e,f,r,u);
        this.add(1,0,0,1,-r,-u)
        };
        
    t.x=function(n,t){
        return n*this.a+t*this.c+this.e
        };
        
    t.y=function(n,t){
        return n*this.b+t*this.d+this.f
        };
        
    t.get=function(n){
        return+this[y.fromCharCode(97+n)].toFixed(4)
        };
        
    t.toString=function(){
        return n.svg?"matrix("+[this.get(0),this.get(1),this.get(2),this.get(3),this.get(4),this.get(5)].join()+")":[this.get(0),this.get(2),this.get(1),this.get(3),0,0].join()
        };
        
    t.toFilter=function(){
        return"progid:DXImageTransform.Microsoft.Matrix(M11="+this.get(0)+", M12="+this.get(2)+", M21="+this.get(1)+", M22="+this.get(3)+", Dx="+this.get(4)+", Dy="+this.get(5)+", sizingmethod='auto expand')"
        };
        
    t.offset=function(){
        return[this.e.toFixed(4),this.f.toFixed(4)]
        };
        
    t.split=function(){
        var t={},f,e,o;
        return t.dx=this.e,t.dy=this.f,f=[[this.a,this.c],[this.b,this.d]],t.scalex=i.sqrt(r(f[0])),u(f[0]),t.shear=f[0][0]*f[1][0]+f[0][1]*f[1][1],f[1]=[f[1][0]-f[0][0]*t.shear,f[1][1]-f[0][1]*t.shear],t.scaley=i.sqrt(r(f[1])),u(f[1]),t.shear/=t.scaley,e=-f[0][1],o=f[1][1],o<0?(t.rotate=n.deg(i.acos(o)),e<0&&(t.rotate=360-t.rotate)):t.rotate=n.deg(i.asin(e)),t.isSimple=!+t.shear.toFixed(9)&&(t.scalex.toFixed(9)==t.scaley.toFixed(9)||!t.rotate),t.isSuperSimple=!+t.shear.toFixed(9)&&t.scalex.toFixed(9)==t.scaley.toFixed(9)&&!t.rotate,t.noRotation=!+t.shear.toFixed(9)&&!t.rotate,t
        };
        
    t.toTransformString=function(n){
        var t=n||this[it]();
        return t.isSimple?(t.scalex=+t.scalex.toFixed(4),t.scaley=+t.scaley.toFixed(4),t.rotate=+t.rotate.toFixed(4),(t.dx||t.dy?"t"+[t.dx,t.dy]:b)+(t.scalex!=1||t.scaley!=1?"s"+[t.scalex,t.scaley,0,0]:b)+(t.rotate?"r"+[t.rotate,0,0]:b)):"m"+[this.get(0),this.get(1),this.get(2),this.get(3),this.get(4),this.get(5)]
        }
    }(et.prototype);
yt=navigator.userAgent.match(/Version\/(.*?)\s/)||navigator.userAgent.match(/Chrome\/(\d+)/);
s.safari=navigator.vendor=="Apple Computer, Inc."&&(yt&&yt[1]<4||navigator.platform.slice(0,2)=="iP")||navigator.vendor=="Google Inc."&&yt&&yt[1]<8?function(){
    var n=this.rect(-99,-99,this.width+99,this.height+99).attr({
        stroke:"none"
    });
    setTimeout(function(){
        n.remove()
        })
    }:gu;
var af=function(){
    this.returnValue=!1
    },vf=function(){
    return this.originalEvent.preventDefault()
    },yf=function(){
    this.cancelBubble=!0
    },pf=function(){
    return this.originalEvent.stopPropagation()
    },wf=function(){
    return t.doc.addEventListener?function(n,i,r,u){
        var f=hi&&ci[i]?ci[i]:i,e=function(f){
            var c=t.doc.documentElement.scrollTop||t.doc.body.scrollTop,l=t.doc.documentElement.scrollLeft||t.doc.body.scrollLeft,a=f.clientX+l,v=f.clientY+c,e,o,s;
            if(hi&&ci[h](i))for(e=0,o=f.targetTouches&&f.targetTouches.length;e<o;e++)if(f.targetTouches[e].target==n){
                s=f;
                f=f.targetTouches[e];
                f.originalEvent=s;
                f.preventDefault=vf;
                f.stopPropagation=pf;
                break
            }
            return r.call(u,f,a,v)
            };
            
        return n.addEventListener(f,e,!1),function(){
            return n.removeEventListener(f,e,!1),!0
            }
        }:t.doc.attachEvent?function(n,i,r,u){
    var f=function(n){
        n=n||t.win.event;
        var i=t.doc.documentElement.scrollTop||t.doc.body.scrollTop,f=t.doc.documentElement.scrollLeft||t.doc.body.scrollLeft,e=n.clientX+f,o=n.clientY+i;
        return n.preventDefault=n.preventDefault||af,n.stopPropagation=n.stopPropagation||yf,r.call(u,n,e,o)
        };
        
    return n.attachEvent("on"+i,f),function(){
        return n.detachEvent("on"+i,f),!0
        }
    }:void 0
}(),ot=[],gi=function(n){
    for(var u=n.clientX,f=n.clientY,a=t.doc.documentElement.scrollTop||t.doc.body.scrollTop,v=t.doc.documentElement.scrollLeft||t.doc.body.scrollLeft,i,c=ot.length,o,e;c--;){
        if(i=ot[c],hi){
            for(o=n.touches.length;o--;)if(e=n.touches[o],e.identifier==i.el._drag.id){
                u=e.clientX;
                f=e.clientY;
                (n.originalEvent?n.originalEvent:n).preventDefault();
                break
            }
            }else n.preventDefault();
        var r=i.el.node,s,l=r.nextSibling,h=r.parentNode,y=r.style.display;
        t.win.opera&&h.removeChild(r);
        r.style.display="none";
        s=i.el.paper.getElementByPoint(u,f);
        r.style.display=y;
        t.win.opera&&(l?h.insertBefore(r,l):h.appendChild(r));
        s&&eve("raphael.drag.over."+i.el.id,i.el,s);
        u+=v;
        f+=a;
        eve("raphael.drag.move."+i.el.id,i.move_scope||i.el,u-i.el._drag.x,f-i.el._drag.y,u,f,n)
        }
    },nr=function(t){
    n.unmousemove(gi).unmouseup(nr);
    for(var r=ot.length,i;r--;)i=ot[r],i.el._drag={},eve("raphael.drag.end."+i.el.id,i.end_scope||i.start_scope||i.move_scope||i.el,t);
    ot=[]
    },u=n.el={};

for(tr=sr.length;tr--;)(function(i){
    n[i]=u[i]=function(r,u){
        return n.is(r,"function")&&(this.events=this.events||[],this.events.push({
            name:i,
            f:r,
            unbind:wf(this.shape||this.node||t.doc,i,r,u||this)
            })),this
        };
        
    n["un"+i]=u["un"+i]=function(n){
        for(var t=this.events||[],r=t.length;r--;)if(t[r].name==i&&t[r].f==n)return t[r].unbind(),t.splice(r,1),t.length||delete this.events,this;return this
        }
    })(sr[tr]);
u.data=function(t,i){
    var u=at[this.id]=at[this.id]||{},r;
    if(arguments.length==1){
        if(n.is(t,"object")){
            for(r in t)t[h](r)&&this.data(r,t[r]);return this
            }
            return eve("raphael.data.get."+this.id,this,u[t],t),u[t]
        }
        return u[t]=i,eve("raphael.data.set."+this.id,this,i,t),this
    };
    
u.removeData=function(n){
    return n==null?at[this.id]={}:at[this.id]&&delete at[this.id][n],this
    };
    
u.hover=function(n,t,i,r){
    return this.mouseover(n,i).mouseout(t,r||i)
    };
    
u.unhover=function(n,t){
    return this.unmouseover(n).unmouseout(t)
    };
    
st=[];
u.drag=function(i,r,u,f,e,o){
    function s(s){
        (s.originalEvent||s).preventDefault();
        var h=t.doc.documentElement.scrollTop||t.doc.body.scrollTop,c=t.doc.documentElement.scrollLeft||t.doc.body.scrollLeft;
        this._drag.x=s.clientX+c;
        this._drag.y=s.clientY+h;
        this._drag.id=s.identifier;
        ot.length||n.mousemove(gi).mouseup(nr);
        ot.push({
            el:this,
            move_scope:f,
            start_scope:e,
            end_scope:o
        });
        r&&eve.on("raphael.drag.start."+this.id,r);
        i&&eve.on("raphael.drag.move."+this.id,i);
        u&&eve.on("raphael.drag.end."+this.id,u);
        eve("raphael.drag.start."+this.id,e||f||this,s.clientX+c,s.clientY+h,s)
        }
        return this._drag={},st.push({
        el:this,
        start:s
    }),this.mousedown(s),this
    };
    
u.onDragOver=function(n){
    n?eve.on("raphael.drag.over."+this.id,n):eve.unbind("raphael.drag.over."+this.id)
    };
    
u.undrag=function(){
    for(var t=st.length;t--;)st[t].el==this&&(this.unmousedown(st[t].start),st.splice(t,1),eve.unbind("raphael.drag.*."+this.id));
    st.length||n.unmousemove(gi).unmouseup(nr)
    };
    
s.circle=function(t,i,r){
    var u=n._engine.circle(this,t||0,i||0,r||0);
    return this.__set__&&this.__set__.push(u),u
    };
    
s.rect=function(t,i,r,u,f){
    var e=n._engine.rect(this,t||0,i||0,r||0,u||0,f||0);
    return this.__set__&&this.__set__.push(e),e
    };
    
s.ellipse=function(t,i,r,u){
    var f=n._engine.ellipse(this,t||0,i||0,r||0,u||0);
    return this.__set__&&this.__set__.push(f),f
    };
    
s.path=function(t){
    !t||n.is(t,bt)||n.is(t[0],g)||(t+=b);
    var i=n._engine.path(n.format[c](n,arguments),this);
    return this.__set__&&this.__set__.push(i),i
    };
    
s.image=function(t,i,r,u,f){
    var e=n._engine.image(this,t||"about:blank",i||0,r||0,u||0,f||0);
    return this.__set__&&this.__set__.push(e),e
    };
    
s.text=function(t,i,r){
    var u=n._engine.text(this,t||0,i||0,y(r));
    return this.__set__&&this.__set__.push(u),u
    };
    
s.set=function(t){
    n.is(t,"array")||(t=Array.prototype.splice.call(arguments,0,arguments.length));
    var i=new ht(t);
    return this.__set__&&this.__set__.push(i),i
    };
    
s.setStart=function(n){
    this.__set__=n||this.set()
    };
    
s.setFinish=function(){
    var n=this.__set__;
    return delete this.__set__,n
    };
    
s.setSize=function(t,i){
    return n._engine.setSize.call(this,t,i)
    };
    
s.setViewBox=function(t,i,r,u,f){
    return n._engine.setViewBox.call(this,t,i,r,u,f)
    };
    
s.top=s.bottom=null;
s.raphael=n;
iu=function(n){
    var u=n.getBoundingClientRect(),f=n.ownerDocument,i=f.body,r=f.documentElement,e=r.clientTop||i.clientTop||0,o=r.clientLeft||i.clientLeft||0,s=u.top+(t.win.pageYOffset||r.scrollTop||i.scrollTop)-e,h=u.left+(t.win.pageXOffset||r.scrollLeft||i.scrollLeft)-o;
    return{
        y:s,
        x:h
    }
};

s.getElementByPoint=function(n,i){
    var o=this,f=o.canvas,r=t.doc.elementFromPoint(n,i),s,u,e;
    if(t.win.opera&&r.tagName=="svg"&&(s=iu(f),u=f.createSVGRect(),u.x=n-s.x,u.y=i-s.y,u.width=u.height=1,e=f.getIntersectionList(u,null),e.length&&(r=e[e.length-1])),!r)return null;
    while(r.parentNode&&r!=f.parentNode&&!r.raphael)r=r.parentNode;
    return r==o.canvas.parentNode&&(r=f),r&&r.raphael?o.getById(r.raphaelid):null
    };
    
s.getById=function(n){
    for(var t=this.bottom;t;){
        if(t.id==n)return t;
        t=t.next
        }
        return null
    };
    
s.forEach=function(n,t){
    for(var i=this.bottom;i;){
        if(n.call(t,i)===!1)return this;
        i=i.next
        }
        return this
    };
    
s.getElementsByPoint=function(n,t){
    var i=this.set();
    return this.forEach(function(r){
        r.isPointInside(n,t)&&i.push(r)
        }),i
    };
    
u.isPointInside=function(t,i){
    var r=this.realPath=this.realPath||kt[this.type](this);
    return n.isPointInsidePath(r,t,i)
    };
    
u.getBBox=function(n){
    if(this.removed)return{};
        
    var t=this._;
    return n?((t.dirty||!t.bboxwt)&&(this.realPath=kt[this.type](this),t.bboxwt=di(this.realPath),t.bboxwt.toString=ru,t.dirty=0),t.bboxwt):((t.dirty||t.dirtyT||!t.bbox)&&((t.dirty||!this.realPath)&&(t.bboxwt=0,this.realPath=kt[this.type](this)),t.bbox=di(pi(this.realPath,this.matrix)),t.bbox.toString=ru,t.dirty=t.dirtyT=0),t.bbox)
    };
    
u.clone=function(){
    if(this.removed)return null;
    var n=this.paper[this.type]().attr(this.attr());
    return this.__set__&&this.__set__.push(n),n
    };
    
u.glow=function(n){
    var r;
    if(this.type=="text")return null;
    n=n||{};
    
    var t={
        width:(n.width||10)+(+this.attr("stroke-width")||1),
        fill:n.fill||!1,
        opacity:n.opacity||.5,
        offsetx:n.offsetx||0,
        offsety:n.offsety||0,
        color:n.color||"#000"
        },u=t.width/2,f=this.paper,e=f.set(),i=this.realPath||kt[this.type](this);
    for(i=this.matrix?pi(i,this.matrix):i,r=1;r<u+1;r++)e.push(f.path(i).attr({
        stroke:t.color,
        fill:t.fill?t.color:"none",
        "stroke-linejoin":"round",
        "stroke-linecap":"round",
        "stroke-width":+(t.width/u*r).toFixed(3),
        opacity:+(t.opacity/u).toFixed(3)
        }));
    return e.insertBefore(this).translate(t.offsetx,t.offsety)
    };
    
var ir=function(t,i,r,u,f,e,o,s,h){
    return h==null?lt(t,i,r,u,f,e,o,s):n.findDotsAtSegment(t,i,r,u,f,e,o,s,of(t,i,r,u,f,e,o,s,h))
    },rr=function(t,i){
    return function(r,u,f){
        var y,p;
        r=vt(r);
        var s,h,e,a,c="",v={},o,l=0;
        for(y=0,p=r.length;y<p;y++){
            if(e=r[y],e[0]=="M")s=+e[1],h=+e[2];
            else{
                if(a=ir(s,h,e[1],e[2],e[3],e[4],e[5],e[6]),l+a>u){
                    if(i&&!v.start){
                        if(o=ir(s,h,e[1],e[2],e[3],e[4],e[5],e[6],u-l),c+=["C"+o.start.x,o.start.y,o.m.x,o.m.y,o.x,o.y],f)return c;
                        v.start=c;
                        c=["M"+o.x,o.y+"C"+o.n.x,o.n.y,o.end.x,o.end.y,e[5],e[6]].join();
                        l+=a;
                        s=+e[5];
                        h=+e[6];
                        continue
                    }
                    if(!t&&!i)return o=ir(s,h,e[1],e[2],e[3],e[4],e[5],e[6],u-l),{
                        x:o.x,
                        y:o.y,
                        alpha:o.alpha
                        }
                    }
                    l+=a;
            s=+e[5];
            h=+e[6]
            }
            c+=e.shift()+e
            }
            return v.end=c,o=t?l:i?v:n.findDotsAtSegment(s,h,e[0],e[1],e[2],e[3],e[4],e[5],1),o.alpha&&(o={
        x:o.x,
        y:o.y,
        alpha:o.alpha
        }),o
    }
},uu=rr(1),fu=rr(),ur=rr(0,1);
n.getTotalLength=uu;
n.getPointAtLength=fu;
n.getSubpath=function(n,t,i){
    if(this.getTotalLength(n)-i<1e-6)return ur(n,t).end;
    var r=ur(n,i,1);
    return t?ur(r,t).end:r
    };
    
u.getTotalLength=function(){
    if(this.type=="path")return this.node.getTotalLength?this.node.getTotalLength():uu(this.attrs.path)
        };
        
u.getPointAtLength=function(n){
    if(this.type=="path")return fu(this.attrs.path,n)
        };
        
u.getSubpath=function(t,i){
    if(this.type=="path")return n.getSubpath(this.attrs.path,t,i)
        };
        
k=n.easing_formulas={
    linear:function(n){
        return n
        },
    "<":function(n){
        return d(n,1.7)
        },
    ">":function(n){
        return d(n,.48)
        },
    "<>":function(n){
        var r=.48-n/1.04,u=i.sqrt(.1734+r*r),f=u-r,o=d(a(f),1/3)*(f<0?-1:1),e=-u-r,s=d(a(e),1/3)*(e<0?-1:1),t=o+s+.5;
        return(1-t)*3*t*t+t*t*t
        },
    backIn:function(n){
        var t=1.70158;
        return n*n*((t+1)*n-t)
        },
    backOut:function(n){
        n=n-1;
        var t=1.70158;
        return n*n*((t+1)*n+t)+1
        },
    elastic:function(n){
        return n==!!n?n:d(2,-10*n)*i.sin((n-.075)*2*p/.3)+1
        },
    bounce:function(n){
        var r=7.5625,t=2.75,i;
        return n<1/t?i=r*n*n:n<2/t?(n-=1.5/t,i=r*n*n+.75):n<2.5/t?(n-=2.25/t,i=r*n*n+.9375):(n-=2.625/t,i=r*n*n+.984375),i
        }
    };

k.easeIn=k["ease-in"]=k["<"];
k.easeOut=k["ease-out"]=k[">"];
k.easeInOut=k["ease-in-out"]=k["<>"];
k["back-in"]=k.backIn;
k["back-out"]=k.backOut;
var r=[],eu=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(n){
    setTimeout(n,16)
    },fr=function(){
    for(var ut=+new Date,w=0,t,a,i,u,d,c,g,p,rt;w<r.length;w++)if(t=r[w],!t.el.removed&&!t.paused){
        var b=ut-t.start,s=t.ms,ft=t.easing,o=t.from,l=t.diff,nt=t.to,et=t.t,y=t.el,tt={},e,it={},k;
        if(t.initstatus?(b=(t.initstatus*t.anim.top-t.prev)/(t.percent-t.prev)*s,t.status=t.initstatus,delete t.initstatus,t.stop&&r.splice(w--,1)):t.status=(t.prev+(t.percent-t.prev)*(b/s))/t.anim.top,!(b<0))if(b<s){
            a=ft(b/s);
            for(i in o)if(o[h](i)){
                switch(ai[i]){
                    case v:
                        e=+o[i]+a*s*l[i];
                        break;
                    case"colour":
                        e="rgb("+[er(li(o[i].r+a*s*l[i].r)),er(li(o[i].g+a*s*l[i].g)),er(li(o[i].b+a*s*l[i].b))].join(",")+")";
                        break;
                    case"path":
                        for(e=[],u=0,d=o[i].length;u<d;u++){
                        for(e[u]=[o[i][u][0]],c=1,g=o[i][u].length;c<g;c++)e[u][c]=+o[i][u][c]+a*s*l[i][u][c];
                        e[u]=e[u].join(ct)
                        }
                        e=e.join(ct);
                        break;
                    case"transform":
                        if(l[i].real)for(e=[],u=0,d=o[i].length;u<d;u++)for(e[u]=[o[i][u][0]],c=1,g=o[i][u].length;c<g;c++)e[u][c]=o[i][u][c]+a*s*l[i][u][c];else p=function(n){
                        return+o[i][n]+a*s*l[i][n]
                        },e=[["m",p(0),p(1),p(2),p(3),p(4),p(5)]];
                        break;
                    case"csv":
                        if(i=="clip-rect")for(e=[],u=4;u--;)e[u]=+o[i][u]+a*s*l[i][u];
                        break;
                    default:
                        for(rt=[][f](o[i]),e=[],u=y.paper.customAttributes[i].length;u--;)e[u]=+rt[u]+a*s*l[i][u]
                        }
                        tt[i]=e
                }
                y.attr(tt),function(n,t,i){
                setTimeout(function(){
                    eve("raphael.anim.frame."+n,t,i)
                    })
                }(y.id,y,t.anim)
            }else{
            if(function(t,i,r){
                setTimeout(function(){
                    eve("raphael.anim.frame."+i.id,i,r);
                    eve("raphael.anim.finish."+i.id,i,r);
                    n.is(t,"function")&&t.call(i)
                    })
                }(t.callback,y,t.anim),y.attr(nt),r.splice(w--,1),t.repeat>1&&!t.next){
                for(k in nt)nt[h](k)&&(it[k]=t.totalOrigin[k]);t.el.attr(it);
                pt(t.anim,t.el,t.anim.percents[0],null,t.totalOrigin,t.repeat-1)
                }
                t.next&&!t.stop&&pt(t.anim,t.el,t.next,null,t.totalOrigin,t.repeat)
            }
        }
        n.svg&&y&&y.paper&&y.paper.safari();
r.length&&eu(fr)
},er=function(n){
    return n>255?255:n<0?0:n
    };
    
u.animateWith=function(t,i,u,f,e,o){
    var s=this,c,h,l;
    if(s.removed)return o&&o.call(s),s;
    for(c=u instanceof rt?u:n.animation(u,f,e,o),pt(c,s,c.percents[0],null,s.attr()),h=0,l=r.length;h<l;h++)if(r[h].anim==i&&r[h].el==t){
        r[l-1].start=r[h].start;
        break
    }
    return s
    };
    
u.onAnimation=function(n){
    return n?eve.on("raphael.anim.frame."+this.id,n):eve.unbind("raphael.anim.frame."+this.id),this
    };
    
rt.prototype.delay=function(n){
    var t=new rt(this.anim,this.ms);
    return t.times=this.times,t.del=+n||0,t
    };
    
rt.prototype.repeat=function(n){
    var t=new rt(this.anim,this.ms);
    return t.del=this.del,t.times=i.floor(e(n,0))||1,t
    };
    
n.animation=function(t,i,r,u){
    if(t instanceof rt)return t;
    (n.is(r,"function")||!r)&&(u=u||r||null,r=null);
    t=Object(t);
    i=+i||0;
    var e={},s;
    for(var f in t)t[h](f)&&o(f)!=f&&o(f)+"%"!=f&&(s=!0,e[f]=t[f]);return s?(r&&(e.easing=r),u&&(e.callback=u),new rt({
        100:e
    },i)):new rt(t,i)
    };
    
u.animate=function(t,i,r,u){
    var f=this,e;
    return f.removed?(u&&u.call(f),f):(e=t instanceof rt?t:n.animation(t,i,r,u),pt(e,f,e.percents[0],null,f.attr()),f)
    };
    
u.setTime=function(n,t){
    return n&&t!=null&&this.status(n,l(t,n.ms)/n.ms),this
    };
    
u.status=function(n,t){
    var f=[],u=0,e,i;
    if(t!=null)return pt(n,this,-1,l(t,1)),this;
    for(e=r.length;u<e;u++)if(i=r[u],i.el.id==this.id&&(!n||i.anim==n)){
        if(n)return i.status;
        f.push({
            anim:i.anim,
            status:i.status
            })
        }
        return n?0:f
    };
    
u.pause=function(n){
    for(var t=0;t<r.length;t++)r[t].el.id!=this.id||n&&r[t].anim!=n||eve("raphael.anim.pause."+this.id,this,r[t].anim)!==!1&&(r[t].paused=!0);
    return this
    };
    
u.resume=function(n){
    for(var i,t=0;t<r.length;t++)r[t].el.id!=this.id||n&&r[t].anim!=n||(i=r[t],eve("raphael.anim.resume."+this.id,this,i.anim)!==!1&&(delete i.paused,this.status(i.anim,i.status)));
    return this
    };
    
u.stop=function(n){
    for(var t=0;t<r.length;t++)r[t].el.id!=this.id||n&&r[t].anim!=n||eve("raphael.anim.stop."+this.id,this,r[t].anim)!==!1&&r.splice(t--,1);
    return this
    };
    
eve.on("raphael.remove",ou);
eve.on("raphael.clear",ou);
u.toString=function(){
    return"Raphaël’s object"
    };
    
ht=function(n){
    if(this.items=[],this.length=0,this.type="set",n)for(var t=0,i=n.length;t<i;t++)n[t]&&(n[t].constructor==u.constructor||n[t].constructor==ht)&&(this[this.items.length]=this.items[this.items.length]=n[t],this.length++)
        };
        
w=ht.prototype;
w.push=function(){
    for(var n,t,i=0,r=arguments.length;i<r;i++)n=arguments[i],n&&(n.constructor==u.constructor||n.constructor==ht)&&(t=this.items.length,this[t]=this.items[t]=n,this.length++);
    return this
    };
    
w.pop=function(){
    return this.length&&delete this[this.length--],this.items.pop()
    };
    
w.forEach=function(n,t){
    for(var i=0,r=this.items.length;i<r;i++)if(n.call(t,this.items[i],i)===!1)return this;return this
    };
    
for(fi in u)u[h](fi)&&(w[fi]=function(n){
    return function(){
        var t=arguments;
        return this.forEach(function(i){
            i[n][c](i,t)
            })
        }
    }(fi));w.attr=function(t,i){
    var r,f,u,e;
    if(t&&n.is(t,g)&&n.is(t[0],"object"))for(r=0,f=t.length;r<f;r++)this.items[r].attr(t[r]);else for(u=0,e=this.items.length;u<e;u++)this.items[u].attr(t,i);
    return this
    };
    
w.clear=function(){
    while(this.length)this.pop()
        };
        
w.splice=function(n,t){
    var r;
    n=n<0?e(this.length+n,0):n;
    t=e(0,l(this.length-n,t));
    for(var u=[],o=[],f=[],i=2;i<arguments.length;i++)f.push(arguments[i]);
    for(i=0;i<t;i++)o.push(this[n+i]);
    for(;i<this.length-n;i++)u.push(this[n+i]);
    for(r=f.length,i=0;i<r+u.length;i++)this.items[n+i]=this[n+i]=i<r?f[i]:u[i-r];
    for(i=this.items.length=this.length-=t-r;this[i];)delete this[i++];
    return new ht(o)
    };
    
w.exclude=function(n){
    for(var t=0,i=this.length;t<i;t++)if(this[t]==n)return this.splice(t,1),!0
        };
        
w.animate=function(t,i,r,u){
    var e;
    (n.is(r,"function")||!r)&&(u=r||null);
    var o=this.items.length,f=o,h,c=this,s;
    if(!o)return this;
    for(u&&(s=function(){
        --o||u.call(c)
        }),r=n.is(r,bt)?r:s,e=n.animation(t,i,r,s),h=this.items[--f].animate(e);f--;)this.items[f]&&!this.items[f].removed&&this.items[f].animateWith(h,e,e);
    return this
    };
    
w.insertAfter=function(n){
    for(var t=this.items.length;t--;)this.items[t].insertAfter(n);
    return this
    };
    
w.getBBox=function(){
    for(var n,t=[],i=[],r=[],u=[],f=this.items.length;f--;)this.items[f].removed||(n=this.items[f].getBBox(),t.push(n.x),i.push(n.y),r.push(n.x+n.width),u.push(n.y+n.height));
    return t=l[c](0,t),i=l[c](0,i),r=e[c](0,r),u=e[c](0,u),{
        x:t,
        y:i,
        x2:r,
        y2:u,
        width:r-t,
        height:u-i
        }
    };

w.clone=function(n){
    n=new ht;
    for(var t=0,i=this.items.length;t<i;t++)n.push(this.items[t].clone());
    return n
    };
    
w.toString=function(){
    return"Raphaël‘s set"
    };
    
n.registerFont=function(n){
    var i,u,f,r,t,e;
    if(!n.face)return n;
    this.fonts=this.fonts||{};
    
    i={
        w:n.w,
        face:{},
        glyphs:{}
};

u=n.face["font-family"];
for(f in n.face)n.face[h](f)&&(i.face[f]=n.face[f]);if(this.fonts[u]?this.fonts[u].push(i):this.fonts[u]=[i],!n.svg){
    i.face["units-per-em"]=ft(n.face["units-per-em"],10);
    for(r in n.glyphs)if(n.glyphs[h](r)&&(t=n.glyphs[r],i.glyphs[r]={
        w:t.w,
        k:{},
        d:t.d&&"M"+t.d.replace(/[mlcxtrv]/g,function(n){
            return{
                l:"L",
                c:"C",
                x:"z",
                t:"m",
                r:"l",
                v:"c"
            }
            [n]||"M"
            })+"z"
        },t.k))for(e in t.k)t[h](e)&&(i.glyphs[r].k[e]=t.k[e])
        }
        return n
};

s.getFont=function(t,i,r,u){
    var f,c,o,e,s,l;
    if(u=u||"normal",r=r||"normal",i=+i||{
        normal:400,
        bold:700,
        lighter:300,
        bolder:800
    }
    [i]||400,n.fonts){
        if(f=n.fonts[t],!f){
            c=new RegExp("(^|\\s)"+t.replace(/[^\w\d\s+!~.:_-]/g,b)+"(\\s|$)","i");
            for(o in n.fonts)if(n.fonts[h](o)&&c.test(o)){
                f=n.fonts[o];
                break
            }
            }
            if(f)for(s=0,l=f.length;s<l;s++)if(e=f[s],e.face["font-weight"]==i&&(e.face["font-style"]==r||!e.face["font-style"])&&e.face["font-stretch"]==u)break;return e
    }
};

s.print=function(t,i,r,u,f,o,s){
    var c,ft,k,v;
    o=o||"middle";
    s=e(l(s||0,1),-1);
    var a=y(r)[it](b),d=0,p=0,nt=b,h;
    if(n.is(u,r)&&(u=this.getFont(u)),u){
        h=(f||16)/u.face["units-per-em"];
        var w=u.face.bbox[it](oi),tt=+w[0],g=w[3]-w[1],rt=0,ut=+w[1]+(o=="baseline"?g+ +u.face.descent:g/2);
        for(c=0,ft=a.length;c<ft;c++)a[c]=="\n"?(d=0,v=0,p=0,rt+=g):(k=p&&u.glyphs[a[c-1]]||{},v=u.glyphs[a[c]],d+=p?(k.w||u.w)+(k.k&&k.k[a[c]]||0)+u.w*s:0,p=1),v&&v.d&&(nt+=n.transformPath(v.d,["t",d*h,rt*h,"s",h,h,tt,ut,"t",(t-tt)/h,(i-ut)/h]))
            }
            return this.path(nt).attr({
        fill:"#000",
        stroke:"none"
    })
    };
    
s.add=function(t){
    if(n.is(t,"array"))for(var u=this.set(),r=0,f=t.length,i;r<f;r++)i=t[r]||{},su[h](i.type)&&u.push(this[i.type]().attr(i));
    return u
    };
    
n.format=function(t,i){
    var r=n.is(i,g)?[0][f](i):arguments;
    return t&&n.is(t,bt)&&r.length-1&&(t=t.replace(hu,function(n,t){
        return r[++t]==null?b:r[t]
        })),t||b
    };
    
n.fullfill=function(){
    var n=/\{([^\}]+)\}/g,t=/(?:(?:^|\.)(.+?)(?=\[|\.|$|\()|\[('|")(.+?)\2\])(\(\))?/g,i=function(n,i,r){
        var u=r;
        return i.replace(t,function(n,t,i,r,f){
            t=t||r;
            u&&(t in u&&(u=u[t]),typeof u=="function"&&f&&(u=u()))
            }),u=(u==null||u==r?n:u)+""
        };
        
    return function(t,r){
        return String(t).replace(n,function(n,t){
            return i(n,t,r)
            })
        }
    }();
n.ninja=function(){
    return si.was?t.win.Raphael=si.is:delete Raphael,n
    };
    
n.st=w,function(t,i,r){
    function u(){
        /in/.test(t.readyState)?setTimeout(u,9):n.eve("raphael.DOMload")
        }
        t.readyState==null&&t.addEventListener&&(t.addEventListener(i,r=function(){
        t.removeEventListener(i,r,!1);
        t.readyState="complete"
        },!1),t.readyState="loading");
    u()
    }(document,"DOMContentLoaded");
si.was?t.win.Raphael=n:Raphael=n;
eve.on("raphael.DOMload",function(){
    ei=!0
    })
}();
window.Raphael.svg&&function(n){
    var i="hasOwnProperty",u=String,f=parseFloat,tt=parseInt,c=Math,k=c.max,y=c.abs,d=c.pow,l=/[, ]+/,p=n.eve,o="",w=" ",a="http://www.w3.org/1999/xlink",ft={
        block:"M5,0 0,2.5 5,5z",
        classic:"M5,0 0,2.5 5,5 3.5,3 3.5,2z",
        diamond:"M2.5,0 5,2.5 2.5,5 0,2.5z",
        open:"M6,1 1,3.5 6,6",
        oval:"M2.5,0A2.5,2.5,0,0,1,2.5,5 2.5,2.5,0,0,1,2.5,0z"
    },e={},nt,v;
    n.toString=function(){
        return"Your browser supports SVG.\nYou are running Raphaël "+this.version
        };
        
    var t=function(r,f){
        if(f){
            typeof r=="string"&&(r=t(r));
            for(var e in f)f[i](e)&&(e.substring(0,6)=="xlink:"?r.setAttributeNS(a,e.substring(6),u(f[e])):r.setAttribute(e,u(f[e])))
                }else r=n._g.doc.createElementNS("http://www.w3.org/2000/svg",r),r.style&&(r.style.webkitTapHighlightColor="rgba(0,0,0,0)");
        return r
        },it=function(i,r){
        var w="linear",l=i.id+r,b=.5,s=.5,tt=i.node,it=i.paper,g=tt.style,a=n._g.doc.getElementById(l),v,e,nt,p,h,rt;
        if(!a){
            if(r=u(r).replace(n._radial_gradient,function(n,t,i){
                if(w="radial",t&&i){
                    b=f(t);
                    s=f(i);
                    var r=(s>.5)*2-1;
                    d(b-.5,2)+d(s-.5,2)>.25&&(s=c.sqrt(.25-d(b-.5,2))*r+.5)&&s!=.5&&(s=s.toFixed(5)-1e-5*r)
                    }
                    return o
                }),r=r.split(/\s*\-\s*/),w=="linear"){
                if(v=r.shift(),v=-f(v),isNaN(v))return null;
                e=[0,0,c.cos(n.rad(v)),c.sin(n.rad(v))];
                nt=1/(k(y(e[2]),y(e[3]))||1);
                e[2]*=nt;
                e[3]*=nt;
                e[2]<0&&(e[0]=-e[2],e[2]=0);
                e[3]<0&&(e[1]=-e[3],e[3]=0)
                }
                if(p=n._parseDots(r),!p)return null;
            if(l=l.replace(/[\(\)\s,\xb0#]/g,"_"),i.gradient&&l!=i.gradient.id&&(it.defs.removeChild(i.gradient),delete i.gradient),!i.gradient)for(a=t(w+"Gradient",{
                id:l
            }),i.gradient=a,t(a,w=="radial"?{
                fx:b,
                fy:s
            }:{
                x1:e[0],
                y1:e[1],
                x2:e[2],
                y2:e[3],
                gradientTransform:i.matrix.invert()
                }),it.defs.appendChild(a),h=0,rt=p.length;h<rt;h++)a.appendChild(t("stop",{
                offset:p[h].offset?p[h].offset:h?"100%":"0%",
                "stop-color":p[h].color||"#fff"
                }))
            }
            return t(tt,{
            fill:"url(#"+l+")",
            opacity:1,
            "fill-opacity":1
        }),g.fill=o,g.opacity=1,g.fillOpacity=1,1
        },b=function(n){
        var i=n.getBBox(1);
        t(n.pattern,{
            patternTransform:n.matrix.invert()+" translate("+i.x+","+i.y+")"
            })
        },s=function(r,f,s){
        var b,k,g,tt,it,rt;
        if(r.type=="path"){
            for(var ut=u(f).toLowerCase().split("-"),ht=r.paper,h=s?"end":"start",ct=r.node,l=r.attrs,d=l["stroke-width"],et=ut.length,a="classic",p,w,ot,st,c,v=3,y=3,nt=5;et--;)switch(ut[et]){
                case"block":case"classic":case"oval":case"diamond":case"open":case"none":
                    a=ut[et];
                    break;
                case"wide":
                    y=5;
                    break;
                case"narrow":
                    y=2;
                    break;
                case"long":
                    v=5;
                    break;
                case"short":
                    v=2
                    }
                    a=="open"?(v+=2,y+=2,nt+=2,ot=1,st=s?4:1,c={
                fill:"none",
                stroke:l.stroke
                }):(st=ot=v/2,c={
                fill:l.stroke,
                stroke:"none"
            });
            r._.arrows?s?(r._.arrows.endPath&&e[r._.arrows.endPath]--,r._.arrows.endMarker&&e[r._.arrows.endMarker]--):(r._.arrows.startPath&&e[r._.arrows.startPath]--,r._.arrows.startMarker&&e[r._.arrows.startMarker]--):r._.arrows={};
            
            a!="none"?(b="raphael-marker-"+a,k="raphael-marker-"+h+a+v+y,n._g.doc.getElementById(b)?e[b]++:(ht.defs.appendChild(t(t("path"),{
                "stroke-linecap":"round",
                d:ft[a],
                id:b
            })),e[b]=1),g=n._g.doc.getElementById(k),g?(e[k]++,tt=g.getElementsByTagName("use")[0]):(g=t(t("marker"),{
                id:k,
                markerHeight:y,
                markerWidth:v,
                orient:"auto",
                refX:st,
                refY:y/2
                }),tt=t(t("use"),{
                "xlink:href":"#"+b,
                transform:(s?"rotate(180 "+v/2+" "+y/2+") ":o)+"scale("+v/nt+","+y/nt+")",
                "stroke-width":(2/(v/nt+y/nt)).toFixed(4)
                }),g.appendChild(tt),ht.defs.appendChild(g),e[k]=1),t(tt,c),it=ot*(a!="diamond"&&a!="oval"),s?(p=r._.arrows.startdx*d||0,w=n.getTotalLength(l.path)-it*d):(p=it*d,w=n.getTotalLength(l.path)-(r._.arrows.enddx*d||0)),c={},c["marker-"+h]="url(#"+k+")",(w||p)&&(c.d=Raphael.getSubpath(l.path,p,w)),t(ct,c),r._.arrows[h+"Path"]=b,r._.arrows[h+"Marker"]=k,r._.arrows[h+"dx"]=it,r._.arrows[h+"Type"]=a,r._.arrows[h+"String"]=f):(s?(p=r._.arrows.startdx*d||0,w=n.getTotalLength(l.path)-p):(p=0,w=n.getTotalLength(l.path)-(r._.arrows.enddx*d||0)),r._.arrows[h+"Path"]&&t(ct,{
                d:Raphael.getSubpath(l.path,p,w)
                }),delete r._.arrows[h+"Path"],delete r._.arrows[h+"Marker"],delete r._.arrows[h+"dx"],delete r._.arrows[h+"Type"],delete r._.arrows[h+"String"]);
            for(c in e)e[i](c)&&!e[c]&&(rt=n._g.doc.getElementById(c),rt&&rt.parentNode.removeChild(rt))
                }
            },et={
    "":[0],
    none:[0],
    "-":[3,1],
    ".":[1,1],
    "-.":[3,1,1,1],
    "-..":[3,1,1,1,1,1],
    ". ":[1,3],
    "- ":[4,3],
    "--":[8,3],
    "- .":[4,3,1,3],
    "--.":[8,3,1,3],
    "--..":[8,3,1,3,1,3]
    },rt=function(n,i,r){
    if(i=et[u(i).toLowerCase()],i){
        for(var e=n.attrs["stroke-width"]||"1",s={
            round:e,
            square:e,
            butt:0
        }
        [n.attrs["stroke-linecap"]||r["stroke-linecap"]]||0,o=[],f=i.length;f--;)o[f]=i[f]*e+(f%2?1:-1)*s;
        t(n.node,{
            "stroke-dasharray":o.join(",")
            })
        }
    },g=function(r,f){
    var h=r.node,c=r.attrs,vt=h.style.visibility,v,e,d,ft,g,p,et,lt,st,ht,ct,w,nt,ut,at;
    h.style.visibility="hidden";
    for(v in f)if(f[i](v)){
        if(!n._availableAttrs[i](v))continue;
        e=f[v];
        c[v]=e;
        switch(v){
            case"blur":
                r.blur(e);
                break;
            case"href":case"title":case"target":
                d=h.parentNode;
                d.tagName.toLowerCase()!="a"&&(ft=t("a"),d.insertBefore(ft,h),ft.appendChild(h),d=ft);
                v=="target"?d.setAttributeNS(a,"show",e=="blank"?"new":e):d.setAttributeNS(a,v,e);
                break;
            case"cursor":
                h.style.cursor=e;
                break;
            case"transform":
                r.transform(e);
                break;
            case"arrow-start":
                s(r,e);
                break;
            case"arrow-end":
                s(r,e,1);
                break;
            case"clip-rect":
                g=u(e).split(l);
                g.length==4&&(r.clip&&r.clip.parentNode.parentNode.removeChild(r.clip.parentNode),p=t("clipPath"),et=t("rect"),p.id=n.createUUID(),t(et,{
                x:g[0],
                y:g[1],
                width:g[2],
                height:g[3]
                }),p.appendChild(et),r.paper.defs.appendChild(p),t(h,{
                "clip-path":"url(#"+p.id+")"
                }),r.clip=et);
            e||(lt=h.getAttribute("clip-path"),lt&&(st=n._g.doc.getElementById(lt.replace(/(^url\(#|\)$)/g,o)),st&&st.parentNode.removeChild(st),t(h,{
                "clip-path":o
            }),delete r.clip));
            break;
            case"path":
                r.type=="path"&&(t(h,{
                d:e?c.path=n._pathToAbsolute(e):"M0,0"
                }),r._.dirty=1,r._.arrows&&("startString"in r._.arrows&&s(r,r._.arrows.startString),"endString"in r._.arrows&&s(r,r._.arrows.endString,1)));
                break;
            case"width":
                if(h.setAttribute(v,e),r._.dirty=1,c.fx)v="x",e=c.x;else break;case"x":
                c.fx&&(e=-c.x-(c.width||0));
            case"rx":
                if(v=="rx"&&r.type=="rect")break;case"cx":
                h.setAttribute(v,e);
                r.pattern&&b(r);
                r._.dirty=1;
                break;
            case"height":
                if(h.setAttribute(v,e),r._.dirty=1,c.fy)v="y",e=c.y;else break;case"y":
                c.fy&&(e=-c.y-(c.height||0));
            case"ry":
                if(v=="ry"&&r.type=="rect")break;case"cy":
                h.setAttribute(v,e);
                r.pattern&&b(r);
                r._.dirty=1;
                break;
            case"r":
                r.type=="rect"?t(h,{
                rx:e,
                ry:e
            }):h.setAttribute(v,e);
                r._.dirty=1;
                break;
            case"src":
                r.type=="image"&&h.setAttributeNS(a,"href",e);
                break;
            case"stroke-width":
                (r._.sx!=1||r._.sy!=1)&&(e/=k(y(r._.sx),y(r._.sy))||1);
                r.paper._vbSize&&(e*=r.paper._vbSize);
                h.setAttribute(v,e);
                c["stroke-dasharray"]&&rt(r,c["stroke-dasharray"],f);
                r._.arrows&&("startString"in r._.arrows&&s(r,r._.arrows.startString),"endString"in r._.arrows&&s(r,r._.arrows.endString,1));
                break;
            case"stroke-dasharray":
                rt(r,e,f);
                break;
            case"fill":
                if(ht=u(e).match(n._ISURL),ht){
                p=t("pattern");
                ct=t("image");
                p.id=n.createUUID();
                t(p,{
                    x:0,
                    y:0,
                    patternUnits:"userSpaceOnUse",
                    height:1,
                    width:1
                });
                t(ct,{
                    x:0,
                    y:0,
                    "xlink:href":ht[1]
                    });
                p.appendChild(ct),function(i){
                    n._preload(ht[1],function(){
                        var n=this.offsetWidth,u=this.offsetHeight;
                        t(i,{
                            width:n,
                            height:u
                        });
                        t(ct,{
                            width:n,
                            height:u
                        });
                        r.paper.safari()
                        })
                    }(p);
                r.paper.defs.appendChild(p);
                t(h,{
                    fill:"url(#"+p.id+")"
                    });
                r.pattern=p;
                r.pattern&&b(r);
                break
            }
            if(w=n.getRGB(e),w.error){
                if((r.type=="circle"||r.type=="ellipse"||u(e).charAt()!="r")&&it(r,e)){
                    ("opacity"in c||"fill-opacity"in c)&&(nt=n._g.doc.getElementById(h.getAttribute("fill").replace(/^url\(#|\)$/g,o)),nt&&(ut=nt.getElementsByTagName("stop"),t(ut[ut.length-1],{
                        "stop-opacity":("opacity"in c?c.opacity:1)*("fill-opacity"in c?c["fill-opacity"]:1)
                        })));
                    c.gradient=e;
                    c.fill="none";
                    break
                }
            }else delete f.gradient,delete c.gradient,!n.is(c.opacity,"undefined")&&n.is(f.opacity,"undefined")&&t(h,{
                opacity:c.opacity
                }),!n.is(c["fill-opacity"],"undefined")&&n.is(f["fill-opacity"],"undefined")&&t(h,{
                "fill-opacity":c["fill-opacity"]
                });
            w[i]("opacity")&&t(h,{
                "fill-opacity":w.opacity>1?w.opacity/100:w.opacity
                });
        case"stroke":
            w=n.getRGB(e);
            h.setAttribute(v,w.hex);
            v=="stroke"&&w[i]("opacity")&&t(h,{
            "stroke-opacity":w.opacity>1?w.opacity/100:w.opacity
            });
        v=="stroke"&&r._.arrows&&("startString"in r._.arrows&&s(r,r._.arrows.startString),"endString"in r._.arrows&&s(r,r._.arrows.endString,1));
            break;
        case"gradient":
            (r.type=="circle"||r.type=="ellipse"||u(e).charAt()!="r")&&it(r,e);
            break;
        case"opacity":
            c.gradient&&!c[i]("stroke-opacity")&&t(h,{
            "stroke-opacity":e>1?e/100:e
            });
        case"fill-opacity":
            if(c.gradient){
            nt=n._g.doc.getElementById(h.getAttribute("fill").replace(/^url\(#|\)$/g,o));
            nt&&(ut=nt.getElementsByTagName("stop"),t(ut[ut.length-1],{
                "stop-opacity":e
            }));
            break
        }
        default:
            v=="font-size"&&(e=tt(e,10)+"px");
            at=v.replace(/(\-.)/g,function(n){
            return n.substring(1).toUpperCase()
            });
        h.style[at]=e;
        r._.dirty=1;
        h.setAttribute(v,e)
            }
        }
    ot(r,f);
h.style.visibility=vt
},ut=1.2,ot=function(r,f){
    var y,h,l,e,a,p,v;
    if(r.type=="text"&&(f[i]("text")||f[i]("font")||f[i]("font-size")||f[i]("x")||f[i]("y"))){
        var c=r.attrs,s=r.node,w=s.firstChild?tt(n._g.doc.defaultView.getComputedStyle(s.firstChild,o).getPropertyValue("font-size"),10):10;
        if(f[i]("text")){
            for(c.text=f.text;s.firstChild;)s.removeChild(s.firstChild);
            for(y=u(f.text).split("\n"),h=[],e=0,a=y.length;e<a;e++)l=t("tspan"),e&&t(l,{
                dy:w*ut,
                x:c.x
                }),l.appendChild(n._g.doc.createTextNode(y[e])),s.appendChild(l),h[e]=l
                }else for(h=s.getElementsByTagName("tspan"),e=0,a=h.length;e<a;e++)e?t(h[e],{
            dy:w*ut,
            x:c.x
            }):t(h[0],{
            dy:0
        });
        t(s,{
            x:c.x,
            y:c.y
            });
        r._.dirty=1;
        p=r._getBBox();
        v=c.y-(p.y+p.height/2);
        v&&n.is(v,"finite")&&t(h[0],{
            dy:v
        })
        }
    },h=function(t,i){
    this[0]=this.node=t;
    t.raphael=!0;
    this.id=n._oid++;
    t.raphaelid=this.id;
    this.matrix=n.matrix();
    this.realPath=null;
    this.paper=i;
    this.attrs=this.attrs||{};
    
    this._={
        transform:[],
        sx:1,
        sy:1,
        deg:0,
        dx:0,
        dy:0,
        dirty:1
    };
    
    i.bottom||(i.bottom=this);
    this.prev=i.top;
    i.top&&(i.top.next=this);
    i.top=this;
    this.next=null
    },r=n.el;
h.prototype=r;
r.constructor=h;
n._engine.path=function(n,i){
    var u=t("path"),r;
    return i.canvas&&i.canvas.appendChild(u),r=new h(u,i),r.type="path",g(r,{
        fill:"none",
        stroke:"#000",
        path:n
    }),r
    };
    
r.rotate=function(n,t,i){
    if(this.removed)return this;
    if(n=u(n).split(l),n.length-1&&(t=f(n[1]),i=f(n[2])),n=f(n[0]),i==null&&(t=i),t==null||i==null){
        var r=this.getBBox(1);
        t=r.x+r.width/2;
        i=r.y+r.height/2
        }
        return this.transform(this._.transform.concat([["r",n,t,i]])),this
    };
    
r.scale=function(n,t,i,r){
    if(this.removed)return this;
    if(n=u(n).split(l),n.length-1&&(t=f(n[1]),i=f(n[2]),r=f(n[3])),n=f(n[0]),t==null&&(t=n),r==null&&(i=r),i==null||r==null)var e=this.getBBox(1);
    return i=i==null?e.x+e.width/2:i,r=r==null?e.y+e.height/2:r,this.transform(this._.transform.concat([["s",n,t,i,r]])),this
    };
    
r.translate=function(n,t){
    return this.removed?this:(n=u(n).split(l),n.length-1&&(t=f(n[1])),n=f(n[0])||0,t=+t||0,this.transform(this._.transform.concat([["t",n,t]])),this)
    };
    
r.transform=function(r){
    var u=this._,f;
    return r==null?u.transform:(n._extractTransform(this,r),this.clip&&t(this.clip,{
        transform:this.matrix.invert()
        }),this.pattern&&b(this),this.node&&t(this.node,{
        transform:this.matrix
        }),(u.sx!=1||u.sy!=1)&&(f=this.attrs[i]("stroke-width")?this.attrs["stroke-width"]:1,this.attr({
        "stroke-width":f
    })),this)
    };
    
r.hide=function(){
    return this.removed||this.paper.safari(this.node.style.display="none"),this
    };
    
r.show=function(){
    return this.removed||this.paper.safari(this.node.style.display=""),this
    };
    
r.remove=function(){
    var t,i;
    if(!this.removed&&this.node.parentNode){
        t=this.paper;
        t.__set__&&t.__set__.exclude(this);
        p.unbind("raphael.*.*."+this.id);
        this.gradient&&t.defs.removeChild(this.gradient);
        n._tear(this,t);
        this.node.parentNode.tagName.toLowerCase()=="a"?this.node.parentNode.parentNode.removeChild(this.node.parentNode):this.node.parentNode.removeChild(this.node);
        for(i in this)this[i]=typeof this[i]=="function"?n._removedFactory(i):null;this.removed=!0
        }
    };

r._getBBox=function(){
    var t,n;
    this.node.style.display=="none"&&(this.show(),t=!0);
    n={};
    
    try{
        n=this.node.getBBox()
        }catch(i){}finally{
        n=n||{}
    }
    return t&&this.hide(),n
};

r.attr=function(t,r){
    var e,c,a,s,o,h,f,u,v,y;
    if(this.removed)return this;
    if(t==null){
        e={};
        
        for(c in this.attrs)this.attrs[i](c)&&(e[c]=this.attrs[c]);return e.gradient&&e.fill=="none"&&(e.fill=e.gradient)&&delete e.gradient,e.transform=this._.transform,e
        }
        if(r==null&&n.is(t,"string")){
        if(t=="fill"&&this.attrs.fill=="none"&&this.attrs.gradient)return this.attrs.gradient;
        if(t=="transform")return this._.transform;
        for(a=t.split(l),s={},o=0,h=a.length;o<h;o++)t=a[o],s[t]=t in this.attrs?this.attrs[t]:n.is(this.paper.customAttributes[t],"function")?this.paper.customAttributes[t].def:n._availableAttrs[t];
        return h-1?s:s[a[0]]
        }
        if(r==null&&n.is(t,"array")){
        for(s={},o=0,h=t.length;o<h;o++)s[t[o]]=this.attr(t[o]);
        return s
        }
        r!=null?(f={},f[t]=r):t!=null&&n.is(t,"object")&&(f=t);
    for(u in f)p("raphael.attr."+u+"."+this.id,this,f[u]);for(u in this.paper.customAttributes)if(this.paper.customAttributes[i](u)&&f[i](u)&&n.is(this.paper.customAttributes[u],"function")){
        v=this.paper.customAttributes[u].apply(this,[].concat(f[u]));
        this.attrs[u]=f[u];
        for(y in v)v[i](y)&&(f[y]=v[y])
            }
            return g(this,f),this
    };
    
r.toFront=function(){
    if(this.removed)return this;
    this.node.parentNode.tagName.toLowerCase()=="a"?this.node.parentNode.parentNode.appendChild(this.node.parentNode):this.node.parentNode.appendChild(this.node);
    var t=this.paper;
    return t.top!=this&&n._tofront(this,t),this
    };
    
r.toBack=function(){
    var t,i;
    return this.removed?this:(t=this.node.parentNode,t.tagName.toLowerCase()=="a"?t.parentNode.insertBefore(this.node.parentNode,this.node.parentNode.parentNode.firstChild):t.firstChild!=this.node&&t.insertBefore(this.node,this.node.parentNode.firstChild),n._toback(this,this.paper),i=this.paper,this)
    };
    
r.insertAfter=function(t){
    if(this.removed)return this;
    var i=t.node||t[t.length-1].node;
    return i.nextSibling?i.parentNode.insertBefore(this.node,i.nextSibling):i.parentNode.appendChild(this.node),n._insertafter(this,t,this.paper),this
    };
    
r.insertBefore=function(t){
    if(this.removed)return this;
    var i=t.node||t[0].node;
    return i.parentNode.insertBefore(this.node,i),n._insertbefore(this,t,this.paper),this
    };
    
r.blur=function(i){
    var r=this,u,f;
    +i!=0?(u=t("filter"),f=t("feGaussianBlur"),r.attrs.blur=i,u.id=n.createUUID(),t(f,{
        stdDeviation:+i||1.5
        }),u.appendChild(f),r.paper.defs.appendChild(u),r._blur=u,t(r.node,{
        filter:"url(#"+u.id+")"
        })):(r._blur&&(r._blur.parentNode.removeChild(r._blur),delete r._blur,delete r.attrs.blur),r.node.removeAttribute("filter"))
    };
    
n._engine.circle=function(n,i,r,u){
    var e=t("circle"),f;
    return n.canvas&&n.canvas.appendChild(e),f=new h(e,n),f.attrs={
        cx:i,
        cy:r,
        r:u,
        fill:"none",
        stroke:"#000"
    },f.type="circle",t(e,f.attrs),f
    };
    
n._engine.rect=function(n,i,r,u,f,e){
    var s=t("rect"),o;
    return n.canvas&&n.canvas.appendChild(s),o=new h(s,n),o.attrs={
        x:i,
        y:r,
        width:u,
        height:f,
        r:e||0,
        rx:e||0,
        ry:e||0,
        fill:"none",
        stroke:"#000"
    },o.type="rect",t(s,o.attrs),o
    };
    
n._engine.ellipse=function(n,i,r,u,f){
    var o=t("ellipse"),e;
    return n.canvas&&n.canvas.appendChild(o),e=new h(o,n),e.attrs={
        cx:i,
        cy:r,
        rx:u,
        ry:f,
        fill:"none",
        stroke:"#000"
    },e.type="ellipse",t(o,e.attrs),e
    };
    
n._engine.image=function(n,i,r,u,f,e){
    var o=t("image"),s;
    return t(o,{
        x:r,
        y:u,
        width:f,
        height:e,
        preserveAspectRatio:"none"
    }),o.setAttributeNS(a,"href",i),n.canvas&&n.canvas.appendChild(o),s=new h(o,n),s.attrs={
        x:r,
        y:u,
        width:f,
        height:e,
        src:i
    },s.type="image",s
    };
    
n._engine.text=function(i,r,u,f){
    var o=t("text"),e;
    return i.canvas&&i.canvas.appendChild(o),e=new h(o,i),e.attrs={
        x:r,
        y:u,
        "text-anchor":"middle",
        text:f,
        font:n._availableAttrs.font,
        stroke:"none",
        fill:"#000"
    },e.type="text",g(e,e.attrs),e
    };
    
n._engine.setSize=function(n,t){
    return this.width=n||this.width,this.height=t||this.height,this.canvas.setAttribute("width",this.width),this.canvas.setAttribute("height",this.height),this._viewBox&&this.setViewBox.apply(this,this._viewBox),this
    };
    
n._engine.create=function(){
    var u=n._getContainer.apply(0,arguments),i=u&&u.container,o=u.x,s=u.y,f=u.width,e=u.height,r,h,c;
    if(!i)throw new Error("SVG container not found.");
    return r=t("svg"),h="overflow:hidden;",o=o||0,s=s||0,f=f||512,e=e||342,t(r,{
        height:e,
        version:1.1,
        width:f,
        xmlns:"http://www.w3.org/2000/svg"
    }),i==1?(r.style.cssText=h+"position:absolute;left:"+o+"px;top:"+s+"px",n._g.doc.body.appendChild(r),c=1):(r.style.cssText=h+"position:relative",i.firstChild?i.insertBefore(r,i.firstChild):i.appendChild(r)),i=new n._Paper,i.width=f,i.height=e,i.canvas=r,i.clear(),i._left=i._top=0,c&&(i.renderfix=function(){}),i.renderfix(),i
    };
    
n._engine.setViewBox=function(n,i,r,u,f){
    p("raphael.setViewBox",this,this._viewBox,[n,i,r,u,f]);
    var o=k(r/this.width,u/this.height),e=this.top,c=f?"meet":"xMinYMin",s,h;
    for(n==null?(this._vbSize&&(o=1),delete this._vbSize,s="0 0 "+this.width+w+this.height):(this._vbSize=o,s=n+w+i+w+r+w+u),t(this.canvas,{
        viewBox:s,
        preserveAspectRatio:c
    });o&&e;)h="stroke-width"in e.attrs?e.attrs["stroke-width"]:1,e.attr({
        "stroke-width":h
    }),e._.dirty=1,e._.dirtyT=1,e=e.prev;
    return this._viewBox=[n,i,r,u,!!f],this
    };
    
n.prototype.renderfix=function(){
    var n=this.canvas,u=n.style,t,i,r;
    try{
        t=n.getScreenCTM()||n.createSVGMatrix()
        }catch(f){
        t=n.createSVGMatrix()
        }
        i=-t.e%1;
    r=-t.f%1;
    (i||r)&&(i&&(this._left=(this._left+i)%1,u.left=this._left+"px"),r&&(this._top=(this._top+r)%1,u.top=this._top+"px"))
    };
    
n.prototype.clear=function(){
    n.eve("raphael.clear",this);
    for(var i=this.canvas;i.firstChild;)i.removeChild(i.firstChild);
    this.bottom=this.top=null;
    (this.desc=t("desc")).appendChild(n._g.doc.createTextNode("Created with Raphaël "+n.version));
    i.appendChild(this.desc);
    i.appendChild(this.defs=t("defs"))
    };
    
n.prototype.remove=function(){
    p("raphael.remove",this);
    this.canvas.parentNode&&this.canvas.parentNode.removeChild(this.canvas);
    for(var t in this)this[t]=typeof this[t]=="function"?n._removedFactory(t):null
        };
        
nt=n.st;
for(v in r)r[i](v)&&!nt[i](v)&&(nt[v]=function(n){
    return function(){
        var t=arguments;
        return this.forEach(function(i){
            i[n].apply(i,t)
            })
        }
    }(v))
    }(window.Raphael);
window.Raphael.vml&&function(n){
    var h="hasOwnProperty",i=String,f=parseFloat,c=Math,e=c.round,k=c.max,g=c.min,p=c.abs,l="fill",a=/[, ]+/,ut=n.eve,ft=" progid:DXImageTransform.Microsoft",o=" ",u="",nt={
        M:"m",
        L:"l",
        C:"c",
        Z:"x",
        m:"t",
        l:"r",
        c:"v",
        z:"x"
    },et=/([clmz]),?([^clmz]*)/gi,ot=/ progid:\S+Blur\([^\)]+\)/g,st=/-?[^,\s-]+/g,tt="position:absolute;left:0;top:0;width:1px;height:1px",t=21600,ht={
        path:1,
        rect:1,
        image:1
    },ct={
        circle:1,
        ellipse:1
    },lt=function(r){
        var l=/[ahqstv]/ig,a=n._pathToAbsolute,v,c,y,f,s,w,h,p;
        if(i(r).match(l)&&(a=n._path2curve),l=/[clmz]/g,a==n._pathToAbsolute&&!i(r).match(l))return i(r).replace(et,function(n,i,r){
            var u=[],o=i.toLowerCase()=="m",f=nt[i];
            return r.replace(st,function(n){
                o&&u.length==2&&(f+=u+nt[i=="m"?"l":"L"],u=[]);
                u.push(e(n*t))
                }),f+u
            });
        for(c=a(r),v=[],s=0,w=c.length;s<w;s++){
            for(y=c[s],f=c[s][0].toLowerCase(),f=="z"&&(f="x"),h=1,p=y.length;h<p;h++)f+=e(y[h]*t)+(h!=p-1?",":u);
            v.push(f)
            }
            return v.join(o)
        },it=function(t,i,r){
        var u=n.matrix();
        return u.rotate(-t,.5,.5),{
            dx:u.x(i,r),
            dy:u.y(i,r)
            }
        },w=function(n,i,r,u,f,e){
    var v=n._,k=n.matrix,h=v.fillpos,c=n.node,y=c.style,w=1,b="",d=t/i,g=t/r,a,s;
    (y.visibility="hidden",i&&r)&&(c.coordsize=p(d)+o+p(g),y.rotation=e*(i*r<0?-1:1),e&&(a=it(e,u,f),u=a.dx,f=a.dy),i<0&&(b+="x"),r<0&&(b+=" y")&&(w=-1),y.flip=b,c.coordorigin=u*-d+o+f*-g,(h||v.fillsize)&&(s=c.getElementsByTagName(l),s=s&&s[0],c.removeChild(s),h&&(a=it(e,k.x(h[0],h[1]),k.y(h[0],h[1])),s.position=a.dx*w+o+a.dy*w),v.fillsize&&(s.size=v.fillsize[0]*p(i)+o+v.fillsize[1]*p(r)),c.appendChild(s)),y.visibility="visible")
    },s,d,y;
n.toString=function(){
    return"Your browser doesn’t support SVG. Falling down to VML.\nYou are running Raphaël "+this.version
    };
    
var rt=function(n,t,r){
    for(var u=i(t).toLowerCase().split("-"),o=r?"end":"start",f=u.length,s="classic",h="medium",c="medium",e;f--;)switch(u[f]){
        case"block":case"classic":case"oval":case"diamond":case"open":case"none":
            s=u[f];
            break;
        case"wide":case"narrow":
            c=u[f];
            break;
        case"long":case"short":
            h=u[f]
            }
            e=n.node.getElementsByTagName("stroke")[0];
    e[o+"arrow"]=s;
    e[o+"arrowlength"]=h;
    e[o+"arrowwidth"]=c
    },v=function(r,c){
    var yt,nt,ot,ut,ft,y,si,pt,st,tt,d,dt,gt,et,ni,vt,ri,bt,hi;
    r.attrs=r.attrs||{};
    
    var b=r.node,v=r.attrs,it=b.style,ui=ht[r.type]&&(c.x!=v.x||c.y!=v.y||c.width!=v.width||c.height!=v.height||c.cx!=v.cx||c.cy!=v.cy||c.rx!=v.rx||c.ry!=v.ry||c.r!=v.r),ci=ct[r.type]&&(v.cx!=c.cx||v.cy!=c.cy||v.r!=c.r||v.rx!=c.rx||v.ry!=c.ry),p=r;
    for(yt in c)c[h](yt)&&(v[yt]=c[yt]);if(ui&&(v.path=n._getPath[r.type](r),r._.dirty=1),c.href&&(b.href=c.href),c.title&&(b.title=c.title),c.target&&(b.target=c.target),c.cursor&&(it.cursor=c.cursor),"blur"in c&&r.blur(c.blur),(c.path&&r.type=="path"||ui)&&(b.path=lt(~i(v.path).toLowerCase().indexOf("r")?n._pathToAbsolute(v.path):v.path),r.type=="image"&&(r._.fillpos=[v.x,v.y],r._.fillsize=[v.width,v.height],w(r,1,1,0,0,0))),"transform"in c&&r.transform(c.transform),ci){
        var kt=+v.cx,fi=+v.cy,ei=+v.rx||+v.r||0,oi=+v.ry||+v.r||0;
        b.path=n.format("ar{0},{1},{2},{3},{4},{1},{4},{1}x",e((kt-ei)*t),e((fi-oi)*t),e((kt+ei)*t),e((fi+oi)*t),e(kt*t))
        }
        if("clip-rect"in c&&(nt=i(c["clip-rect"]).split(a),nt.length==4&&(nt[2]=+nt[2]+ +nt[0],nt[3]=+nt[3]+ +nt[1],ot=b.clipRect||n._g.doc.createElement("div"),ut=ot.style,ut.clip=n.format("rect({1}px {2}px {3}px {0}px)",nt),b.clipRect||(ut.position="absolute",ut.top=0,ut.left=0,ut.width=r.paper.width+"px",ut.height=r.paper.height+"px",b.parentNode.insertBefore(ot,b),ot.appendChild(b),b.clipRect=ot)),c["clip-rect"]||b.clipRect&&(b.clipRect.style.clip="auto")),r.textpath&&(ft=r.textpath.style,c.font&&(ft.font=c.font),c["font-family"]&&(ft.fontFamily='"'+c["font-family"].split(",")[0].replace(/^['"]+|['"]+$/g,u)+'"'),c["font-size"]&&(ft.fontSize=c["font-size"]),c["font-weight"]&&(ft.fontWeight=c["font-weight"]),c["font-style"]&&(ft.fontStyle=c["font-style"])),"arrow-start"in c&&rt(p,c["arrow-start"]),"arrow-end"in c&&rt(p,c["arrow-end"],1),(c.opacity!=null||c["stroke-width"]!=null||c.fill!=null||c.src!=null||c.stroke!=null||c["stroke-width"]!=null||c["stroke-opacity"]!=null||c["fill-opacity"]!=null||c["stroke-dasharray"]!=null||c["stroke-miterlimit"]!=null||c["stroke-linejoin"]!=null||c["stroke-linecap"]!=null)&&(y=b.getElementsByTagName(l),si=!1,y=y&&y[0],y||(si=y=s(l)),r.type=="image"&&c.src&&(y.src=c.src),c.fill&&(y.on=!0),(y.on==null||c.fill=="none"||c.fill===null)&&(y.on=!1),y.on&&c.fill&&(pt=i(c.fill).match(n._ISURL),pt?(y.parentNode==b&&b.removeChild(y),y.rotate=!0,y.src=pt[1],y.type="tile",st=r.getBBox(1),y.position=st.x+o+st.y,r._.fillpos=[st.x,st.y],n._preload(pt[1],function(){
        r._.fillsize=[this.offsetWidth,this.offsetHeight]
        })):(y.color=n.getRGB(c.fill).hex,y.src=u,y.type="solid",n.getRGB(c.fill).error&&(p.type in{
        circle:1,
        ellipse:1
    }||i(c.fill).charAt()!="r")&&at(p,c.fill,y)&&(v.fill="none",v.gradient=c.fill,y.rotate=!1))),("fill-opacity"in c||"opacity"in c)&&(tt=((+v["fill-opacity"]+1||2)-1)*((+v.opacity+1||2)-1)*((+n.getRGB(c.fill).o+1||2)-1),tt=g(k(tt,0),1),y.opacity=tt,y.src&&(y.color="none")),b.appendChild(y),d=b.getElementsByTagName("stroke")&&b.getElementsByTagName("stroke")[0],dt=!1,d||(dt=d=s("stroke")),(c.stroke&&c.stroke!="none"||c["stroke-width"]||c["stroke-opacity"]!=null||c["stroke-dasharray"]||c["stroke-miterlimit"]||c["stroke-linejoin"]||c["stroke-linecap"])&&(d.on=!0),(c.stroke=="none"||c.stroke===null||d.on==null||c.stroke==0||c["stroke-width"]==0)&&(d.on=!1),gt=n.getRGB(c.stroke),d.on&&c.stroke&&(d.color=gt.hex),tt=((+v["stroke-opacity"]+1||2)-1)*((+v.opacity+1||2)-1)*((+gt.o+1||2)-1),et=(f(c["stroke-width"])||1)*.75,tt=g(k(tt,0),1),c["stroke-width"]==null&&(et=v["stroke-width"]),c["stroke-width"]&&(d.weight=et),et&&et<1&&(tt*=et)&&(d.weight=1),d.opacity=tt,c["stroke-linejoin"]&&(d.joinstyle=c["stroke-linejoin"]||"miter"),d.miterlimit=c["stroke-miterlimit"]||8,c["stroke-linecap"]&&(d.endcap=c["stroke-linecap"]=="butt"?"flat":c["stroke-linecap"]=="square"?"square":"round"),c["stroke-dasharray"]&&(ni={
        "-":"shortdash",
        ".":"shortdot",
        "-.":"shortdashdot",
        "-..":"shortdashdotdot",
        ". ":"dot",
        "- ":"dash",
        "--":"longdash",
        "- .":"dashdot",
        "--.":"longdashdot",
        "--..":"longdashdotdot"
    },d.dashstyle=ni[h](c["stroke-dasharray"])?ni[c["stroke-dasharray"]]:u),dt&&b.appendChild(d)),p.type=="text"){
        p.paper.canvas.style.display=u;
        var ti=p.paper.span,ii=100,wt=v.font&&v.font.match(/\d+(?:\.\d*)?(?=px)/);
        for(it=ti.style,v.font&&(it.font=v.font),v["font-family"]&&(it.fontFamily=v["font-family"]),v["font-weight"]&&(it.fontWeight=v["font-weight"]),v["font-style"]&&(it.fontStyle=v["font-style"]),wt=f(v["font-size"]||wt&&wt[0])||10,it.fontSize=wt*ii+"px",p.textpath.string&&(ti.innerHTML=i(p.textpath.string).replace(/</g,"&#60;").replace(/&/g,"&#38;").replace(/\n/g,"<br>")),vt=ti.getBoundingClientRect(),p.W=v.w=(vt.right-vt.left)/ii,p.H=v.h=(vt.bottom-vt.top)/ii,p.X=v.x,p.Y=v.y+p.H/2,(("x"in c)||("y"in c))&&(p.path.v=n.format("m{0},{1}l{2},{1}",e(v.x*t),e(v.y*t),e(v.x*t)+1)),ri=["x","y","text","font","font-family","font-weight","font-style","font-size"],bt=0,hi=ri.length;bt<hi;bt++)if(ri[bt]in c){
            p._.dirty=1;
            break
        }
        switch(v["text-anchor"]){
            case"start":
                p.textpath.style["v-text-align"]="left";
                p.bbx=p.W/2;
                break;
            case"end":
                p.textpath.style["v-text-align"]="right";
                p.bbx=-p.W/2;
                break;
            default:
                p.textpath.style["v-text-align"]="center";
                p.bbx=0
                }
                p.textpath.style["v-text-kern"]=!0
        }
    },at=function(t,r,e){
    var l,s,a,h,w;
    t.attrs=t.attrs||{};
    
    var b=t.attrs,v=Math.pow,y="linear",p=".5 .5";
    if((t.attrs.gradient=r,r=i(r).replace(n._radial_gradient,function(n,t,i){
        return y="radial",t&&i&&(t=f(t),i=f(i),v(t-.5,2)+v(i-.5,2)>.25&&(i=c.sqrt(.25-v(t-.5,2))*((i>.5)*2-1)+.5),p=t+o+i),u
        }),r=r.split(/\s*\-\s*/),y=="linear"&&(l=r.shift(),l=-f(l),isNaN(l)))||(s=n._parseDots(r),!s))return null;
    if(t=t.shape||t.node,s.length){
        for(t.removeChild(e),e.on=!0,e.method="none",e.color=s[0].color,e.color2=s[s.length-1].color,a=[],h=0,w=s.length;h<w;h++)s[h].offset&&a.push(s[h].offset+o+s[h].color);
        e.colors=a.length?a.join():"0% "+e.color;
        y=="radial"?(e.type="gradientTitle",e.focus="100%",e.focussize="0 0",e.focusposition=p,e.angle=0):(e.type="gradient",e.angle=(270-l)%360);
        t.appendChild(e)
        }
        return 1
    },b=function(t,i){
    this[0]=this.node=t;
    t.raphael=!0;
    this.id=n._oid++;
    t.raphaelid=this.id;
    this.X=0;
    this.Y=0;
    this.attrs={};
    
    this.paper=i;
    this.matrix=n.matrix();
    this._={
        transform:[],
        sx:1,
        sy:1,
        dx:0,
        dy:0,
        deg:0,
        dirty:1,
        dirtyT:1
    };
    
    i.bottom||(i.bottom=this);
    this.prev=i.top;
    i.top&&(i.top.next=this);
    i.top=this;
    this.next=null
    },r=n.el;
b.prototype=r;
r.constructor=b;
r.transform=function(r){
    var e,a,l;
    if(r==null)return this._.transform;
    e=this.paper._viewBoxShift;
    a=e?"s"+[e.scale,e.scale]+"-1-1t"+[e.dx,e.dy]:u;
    e&&(l=r=i(r).replace(/\.{3}|\u2026/g,this._.transform||u));
    n._extractTransform(this,a+r);
    var s=this.matrix.clone(),h=this.skew,c=this.node,f,v=~i(this.attrs.fill).indexOf("-"),d=!i(this.attrs.fill).indexOf("url(");
    if(s.translate(-.5,-.5),d||v||this.type=="image")if(h.matrix="1 0 0 1",h.offset="0 0",f=s.split(),v&&f.noRotation||!f.isSimple){
        c.style.filter=s.toFilter();
        var y=this.getBBox(),p=this.getBBox(1),b=y.x-p.x,k=y.y-p.y;
        c.coordorigin=b*-t+o+k*-t;
        w(this,1,1,b,k,0)
        }else c.style.filter=u,w(this,f.scalex,f.scaley,f.dx,f.dy,f.rotate);else c.style.filter=u,h.matrix=i(s),h.offset=s.offset();
    return l&&(this._.transform=l),this
    };
    
r.rotate=function(n,t,r){
    if(this.removed)return this;
    if(n!=null){
        if(n=i(n).split(a),n.length-1&&(t=f(n[1]),r=f(n[2])),n=f(n[0]),r==null&&(t=r),t==null||r==null){
            var u=this.getBBox(1);
            t=u.x+u.width/2;
            r=u.y+u.height/2
            }
            return this._.dirtyT=1,this.transform(this._.transform.concat([["r",n,t,r]])),this
        }
    };

r.translate=function(n,t){
    return this.removed?this:(n=i(n).split(a),n.length-1&&(t=f(n[1])),n=f(n[0])||0,t=+t||0,this._.bbox&&(this._.bbox.x+=n,this._.bbox.y+=t),this.transform(this._.transform.concat([["t",n,t]])),this)
    };
    
r.scale=function(n,t,r,u){
    if(this.removed)return this;
    if(n=i(n).split(a),n.length-1&&(t=f(n[1]),r=f(n[2]),u=f(n[3]),isNaN(r)&&(r=null),isNaN(u)&&(u=null)),n=f(n[0]),t==null&&(t=n),u==null&&(r=u),r==null||u==null)var e=this.getBBox(1);
    return r=r==null?e.x+e.width/2:r,u=u==null?e.y+e.height/2:u,this.transform(this._.transform.concat([["s",n,t,r,u]])),this._.dirtyT=1,this
    };
    
r.hide=function(){
    return this.removed||(this.node.style.display="none"),this
    };
    
r.show=function(){
    return this.removed||(this.node.style.display=u),this
    };
    
r._getBBox=function(){
    return this.removed?{}:{
        x:this.X+(this.bbx||0)-this.W/2,
        y:this.Y-this.H,
        width:this.W,
        height:this.H
        }
    };

r.remove=function(){
    if(!this.removed&&this.node.parentNode){
        this.paper.__set__&&this.paper.__set__.exclude(this);
        n.eve.unbind("raphael.*.*."+this.id);
        n._tear(this,this.paper);
        this.node.parentNode.removeChild(this.node);
        this.shape&&this.shape.parentNode.removeChild(this.shape);
        for(var t in this)this[t]=typeof this[t]=="function"?n._removedFactory(t):null;this.removed=!0
        }
    };

r.attr=function(t,i){
    var f,c,y,o,e,s,r,u,p,w;
    if(this.removed)return this;
    if(t==null){
        f={};
        
        for(c in this.attrs)this.attrs[h](c)&&(f[c]=this.attrs[c]);return f.gradient&&f.fill=="none"&&(f.fill=f.gradient)&&delete f.gradient,f.transform=this._.transform,f
        }
        if(i==null&&n.is(t,"string")){
        if(t==l&&this.attrs.fill=="none"&&this.attrs.gradient)return this.attrs.gradient;
        for(y=t.split(a),o={},e=0,s=y.length;e<s;e++)t=y[e],o[t]=t in this.attrs?this.attrs[t]:n.is(this.paper.customAttributes[t],"function")?this.paper.customAttributes[t].def:n._availableAttrs[t];
        return s-1?o:o[y[0]]
        }
        if(this.attrs&&i==null&&n.is(t,"array")){
        for(o={},e=0,s=t.length;e<s;e++)o[t[e]]=this.attr(t[e]);
        return o
        }
        i!=null&&(r={},r[t]=i);
    i==null&&n.is(t,"object")&&(r=t);
    for(u in r)ut("raphael.attr."+u+"."+this.id,this,r[u]);if(r){
        for(u in this.paper.customAttributes)if(this.paper.customAttributes[h](u)&&r[h](u)&&n.is(this.paper.customAttributes[u],"function")){
            p=this.paper.customAttributes[u].apply(this,[].concat(r[u]));
            this.attrs[u]=r[u];
            for(w in p)p[h](w)&&(r[w]=p[w])
                }
                r.text&&this.type=="text"&&(this.textpath.string=r.text);
        v(this,r)
        }
        return this
    };
    
r.toFront=function(){
    return this.removed||this.node.parentNode.appendChild(this.node),this.paper&&this.paper.top!=this&&n._tofront(this,this.paper),this
    };
    
r.toBack=function(){
    return this.removed?this:(this.node.parentNode.firstChild!=this.node&&(this.node.parentNode.insertBefore(this.node,this.node.parentNode.firstChild),n._toback(this,this.paper)),this)
    };
    
r.insertAfter=function(t){
    return this.removed?this:(t.constructor==n.st.constructor&&(t=t[t.length-1]),t.node.nextSibling?t.node.parentNode.insertBefore(this.node,t.node.nextSibling):t.node.parentNode.appendChild(this.node),n._insertafter(this,t,this.paper),this)
    };
    
r.insertBefore=function(t){
    return this.removed?this:(t.constructor==n.st.constructor&&(t=t[0]),t.node.parentNode.insertBefore(this.node,t.node),n._insertbefore(this,t,this.paper),this)
    };
    
r.blur=function(t){
    var i=this.node.runtimeStyle,r=i.filter;
    r=r.replace(ot,u);
    +t!=0?(this.attrs.blur=t,i.filter=r+o+ft+".Blur(pixelradius="+(+t||1.5)+")",i.margin=n.format("-{0}px 0 0 -{0}px",e(+t||1.5))):(i.filter=r,i.margin=0,delete this.attrs.blur)
    };
    
n._engine.path=function(n,i){
    var f=s("shape"),r,h,e;
    return f.style.cssText=tt,f.coordsize=t+o+t,f.coordorigin=i.coordorigin,r=new b(f,i),h={
        fill:"none",
        stroke:"#000"
    },n&&(h.path=n),r.type="path",r.path=[],r.Path=u,v(r,h),i.canvas.appendChild(f),e=s("skew"),e.on=!0,f.appendChild(e),r.skew=e,r.transform(u),r
    };
    
n._engine.rect=function(t,i,r,u,f,e){
    var h=n._rectPath(i,r,u,f,e),o=t.path(h),s=o.attrs;
    return o.X=s.x=i,o.Y=s.y=r,o.W=s.width=u,o.H=s.height=f,s.r=e,s.path=h,o.type="rect",o
    };
    
n._engine.ellipse=function(n,t,i,r,u){
    var f=n.path(),e=f.attrs;
    return f.X=t-r,f.Y=i-u,f.W=r*2,f.H=u*2,f.type="ellipse",v(f,{
        cx:t,
        cy:i,
        rx:r,
        ry:u
    }),f
    };
    
n._engine.circle=function(n,t,i,r){
    var u=n.path(),f=u.attrs;
    return u.X=t-r,u.Y=i-r,u.W=u.H=r*2,u.type="circle",v(u,{
        cx:t,
        cy:i,
        r:r
    }),u
    };
    
n._engine.image=function(t,i,r,u,f,e){
    var a=n._rectPath(r,u,f,e),o=t.path(a).attr({
        stroke:"none"
    }),s=o.attrs,c=o.node,h=c.getElementsByTagName(l)[0];
    return s.src=i,o.X=s.x=r,o.Y=s.y=u,o.W=s.width=f,o.H=s.height=e,s.path=a,o.type="image",h.parentNode==c&&c.removeChild(h),h.rotate=!0,h.src=i,h.type="tile",o._.fillpos=[r,u],o._.fillsize=[f,e],c.appendChild(h),w(o,1,1,0,0,0),o
    };
    
n._engine.text=function(r,f,h,c){
    var a=s("shape"),y=s("path"),p=s("textpath"),l,k,w;
    return f=f||0,h=h||0,c=c||"",y.v=n.format("m{0},{1}l{2},{1}",e(f*t),e(h*t),e(f*t)+1),y.textpathok=!0,p.string=i(c),p.on=!0,a.style.cssText=tt,a.coordsize=t+o+t,a.coordorigin="0 0",l=new b(a,r),k={
        fill:"#000",
        stroke:"none",
        font:n._availableAttrs.font,
        text:c
    },l.shape=a,l.path=y,l.textpath=p,l.type="text",l.attrs.text=i(c),l.attrs.x=f,l.attrs.y=h,l.attrs.w=1,l.attrs.h=1,v(l,k),a.appendChild(p),a.appendChild(y),r.canvas.appendChild(a),w=s("skew"),w.on=!0,a.appendChild(w),l.skew=w,l.transform(u),l
    };
    
n._engine.setSize=function(t,i){
    var r=this.canvas.style;
    return this.width=t,this.height=i,t==+t&&(t+="px"),i==+i&&(i+="px"),r.width=t,r.height=i,r.clip="rect(0 "+t+" "+i+" 0)",this._viewBox&&n._engine.setViewBox.apply(this,this._viewBox),this
    };
    
n._engine.setViewBox=function(t,i,r,u,f){
    n.eve("raphael.setViewBox",this,this._viewBox,[t,i,r,u,f]);
    var e=this.width,o=this.height,c=1/k(r/e,u/o),s,h;
    return f&&(s=o/u,h=e/r,r*s<e&&(t-=(e-r*s)/2/s),u*h<o&&(i-=(o-u*h)/2/h)),this._viewBox=[t,i,r,u,!!f],this._viewBoxShift={
        dx:-t,
        dy:-i,
        scale:c
    },this.forEach(function(n){
        n.transform("...")
        }),this
    };
    
n._engine.initWin=function(n){
    var t=n.document;
    t.createStyleSheet().addRule(".rvml","behavior:url(#default#VML)");
    try{
        t.namespaces.rvml||t.namespaces.add("rvml","urn:schemas-microsoft-com:vml");
        s=function(n){
            return t.createElement("<rvml:"+n+' class="rvml">')
            }
        }catch(i){
    s=function(n){
        return t.createElement("<"+n+' xmlns="urn:schemas-microsoft.com:vml" class="rvml">')
        }
    }
};

n._engine.initWin(n._g.win);
n._engine.create=function(){
    var e=n._getContainer.apply(0,arguments),f=e.container,r=e.height,u=e.width,c=e.x,l=e.y;
    if(!f)throw new Error("VML container not found.");
    var i=new n._Paper,s=i.canvas=n._g.doc.createElement("div"),h=s.style;
    return c=c||0,l=l||0,u=u||512,r=r||342,i.width=u,i.height=r,u==+u&&(u+="px"),r==+r&&(r+="px"),i.coordsize=t*1e3+o+t*1e3,i.coordorigin="0 0",i.span=n._g.doc.createElement("span"),i.span.style.cssText="position:absolute;left:-9999em;top:-9999em;padding:0;margin:0;line-height:1;",s.appendChild(i.span),h.cssText=n.format("top:0;left:0;width:{0};height:{1};display:inline-block;position:relative;clip:rect(0 {0} {1} 0);overflow:hidden",u,r),f==1?(n._g.doc.body.appendChild(s),h.left=c+"px",h.top=l+"px",h.position="absolute"):f.firstChild?f.insertBefore(s,f.firstChild):f.appendChild(s),i.renderfix=function(){},i
    };
    
n.prototype.clear=function(){
    n.eve("raphael.clear",this);
    this.canvas.innerHTML=u;
    this.span=n._g.doc.createElement("span");
    this.span.style.cssText="position:absolute;left:-9999em;top:-9999em;padding:0;margin:0;line-height:1;display:inline;";
    this.canvas.appendChild(this.span);
    this.bottom=this.top=null
    };
    
n.prototype.remove=function(){
    n.eve("raphael.remove",this);
    this.canvas.parentNode.removeChild(this.canvas);
    for(var t in this)this[t]=typeof this[t]=="function"?n._removedFactory(t):null;return!0
    };
    
d=n.st;
for(y in r)r[h](y)&&!d[h](y)&&(d[y]=function(n){
    return function(){
        var t=arguments;
        return this.forEach(function(i){
            i[n].apply(i,t)
            })
        }
    }(y))
    }(window.Raphael)