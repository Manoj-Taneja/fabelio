var Helper,InventoryDashboard,$s;
(function(n){
    (function(t){
        var i=function(){
            function t(){
                var t=this;
                $("#formulaEditor").length&&(t._input=$("#formulaEditor")[0],t._input.contentEditable="true",t._range=rangy.createRangyRange(this._input),$("a.kpi-formula-button").click(function(i){
                    var r=$(this).attr("data-value");
                    return t.setText(r),t.update(),n.Helpers.Helper.preventDefault(i)
                    }),$(this._input).keypress(function(n){
                    var t=n.charCode?n.charCode:n.keyCode,i=new RegExp("[0-9aAvVgGmMiInNxXsSuU.\\+-/*() ]");
                    if((n.keyCode===t||n.keyCode!==37)&&!($.inArray(n.keyCode,[8,16,32,37,39,46])>-1)&&!i.test(String.fromCharCode(t))){
                        n.preventDefault();
                        return
                    }
                }),$(this._input).keyup(function(n){
                    var i="which"in n?n.which:n.keyCode,r=rangy.getSelection();
                    t._range=r.getRangeAt(0);
                    t._range.endContainer.parentNode.nodeName=="B"&&(t._range.selectNode(t._range.endContainer.parentNode),r.setSingleRange(t._range),(i==8||i==46)&&t._range.deleteContents());
                    t.update()
                    }),$(this._input).click(function(n){
                    var i=rangy.getSelection();
                    return t._range=i.getRangeAt(0),t._range.endContainer.parentNode.nodeName==="B"&&(t._range.selectNode(t._range.endContainer.parentNode),i.setSingleRange(t._range)),n.preventDefault(),t.update(),!1
                    }),$(this._input).blur(function(){
                    t.update()
                    }))
            }
            return t.prototype.update=function(){
            var n=$(this._input).html();
            n=n.replace(/&nbsp;/gi," ");
            n=n.replace(/\[{1}[^\]]+\]{1}/gi,"");
            n=n.replace(/<b data-id="/gi,"[");
            n=n.replace(/">/gi,"]");
            n=n.replace(/<\/b>/gi,"");
            n=n.replace(/<[bB][rR]>|<[\/][bB][rR]>/gi,"");
            $("#"+$(this._input).attr("data-input-id")).val(n)
            },t.prototype.setText=function(n){
            var i=rangy.getSelection(),t=document.createTextNode(" "+n+" ");
            this._range&&this._range.isValid()||(this._range=rangy.createRangyRange(this._input));
            this._range.deleteContents();
            this._range.insertNode(t);
            this._range.setStartAfter(t);
            this._range.collapse(!1);
            i.setSingleRange(this._range);
            this.update()
            },t.prototype.setKpi=function(n,t){
            var r,u;
            try{
                var f=rangy.getSelection(),e=this._input,i=document.createElement("b");
                i.setAttribute("data-id",n);
                i.appendChild(document.createTextNode("["+t+"]"));
                this._range&&this._range.isValid()||(this._range=rangy.createRangyRange(e));
                r=document.createTextNode(" ");
                u=document.createTextNode(" ");
                this._range.deleteContents();
                this._range.insertNode(r);
                this._range.setStartAfter(r);
                this._range.collapse(!1);
                this._range.insertNode(i);
                this._range.setStartAfter(i);
                this._range.collapse(!1);
                this._range.insertNode(u);
                this._range.setStartAfter(u);
                this._range.collapse(!1);
                this.update();
                f.setSingleRange(this._range)
                }catch(o){}
        },t
    }();
    t.formulaEditor=i
    })(n.Helpers||(n.Helpers={}));
    var t=n.Helpers
    })(InventoryDashboard||(InventoryDashboard={})),function(n){
    (function(t){
        var i=function(){
            function t(){}
            return t.setViewLabels=function(t,i){
                var f=$("#"+i).parent(),r="",u="";
                $(f).find("div.name").html(t.name);
                r=n.Helpers.Graph.getViewDateLabel(t.from,t.to);
                u=n.Helpers.Graph.getViewDateLabel(t.compareFrom,t.compareTo);
                u.length>1&&(r+="&nbsp;&nbsp;&nbsp;("+u+")");
                $("#h2Date").html(r);
                $(f).find("div.options > b").html(r)
                },t.formatValueLabel=function(n,t,i){
                var u="",r;
                return i==null&&(i=!1),n!=null&&(r=Number(n),isNaN(r)||(i&&(r/=100),u=r.numberFormat(t))),u
                },t.getViewDateLabel=function(t,i){
                var r=n.Helpers.Helper.dateParse(t),u=n.Helpers.Helper.dateParse(i),f="";
                return t!=null&&r.isValid()&&i!=null&&u.isValid()&&(t=r.format("D MMM YYYY"),i=u.format("D MMM YYYY"),f=t!==i?t+" - "+i:t),f
                },t.getWeekNo=function(n,t){
                var r=1,u=$s.startDayOfWeek===7?0:1,i;
                return r=n.week(),$s.useISOWeek&&(r=n.isoWeek()),t>1&&(i=moment.utc().zone(0).year(n.year()).month(t-1).date(1),n.month()<t-1&&(i=moment.utc().zone(0).year(n.year()-1).month(t-1).date(1)),i.isValid()&&(i.isoWeekday()!==$s.startDayOfWeek?i.startOf("iweek").isoWeekday($s.startDayOfWeek):i.isoWeekday($s.startDayOfWeek-7),r=Math.round(n.diff(i,"days")/7)+1,r===0&&(r=1))),r
                },t.getQuarter=function(n,t){
                var u=1,i=n.year(),r=n.month()+1+(13-t),f="";
                return r>12&&(r-=12),r>n.month()+1&&(i-=1),f=t>1?i.toString()+"-"+(i-1999).toString():i.toString(),u=Math.ceil(r/3),$s.labels.Quarter+" "+u+" ("+f+")"
                },t.getDateLabel=function(n,t,i){
                var u="",r=moment().zone(0),f;
                t&&(r=moment(t),r=moment().zone(0).year(r.year()).month(r.month()).date(r.date()));
                switch(n){
                    case"Y":
                        i>1?(i>r.month()+1&&r.subtract("years",1),u=r.format("YYYY")+"-"+r.add("years",1).format("YY")):u=r.format("YYYY");
                        break;
                    case"Q":
                        u=this.getQuarter(r,i);
                        break;
                    case"M":
                        u=r.format("MMMM YYYY");
                        break;
                    case"W":
                        while(r.isoWeekday()!==$s.startDayOfWeek)r.subtract("days",1);
                        f=this.getWeekNo(r,i);
                        u=$s.labels.Week+" "+f.toString()+" ("+r.format("DD MMM YYYY")+")";
                        break;
                    case"D":
                        u=r.format("YYYY-MM-DD")===moment.utc().format("YYYY-MM-DD")?$s.labels.Today:r.format("YYYY-MM-DD")===moment.utc().subtract("days",1).format("YYYY-MM-DD")?$s.labels.Yesterday:r.format("DD MMMM YYYY")
                        }
                        return u
                },t.getMinChartValue=function(n,t){
                var i=this.getMinValue(n);
                return t||(t=0),i&&(i-=i*(t/100)),i
                },t.getMaxChartValue=function(n,t){
                var i=this.getMaxValue(n);
                return t||(t=0),i&&(i+=i*(t/100)),i
                },t.getMaxValue=function(n){
                var t=null,i,r;
                if(n)for(i=0;i<n.length;i++)r=Number(n[i]),(t===null||r>t)&&(t=r);
                return t
                },t.toStringArray=function(n){
                var t=[],i;
                for(n!==null&&n!==undefined&&(t=n instanceof Array?n:n.split(",")),i=0;i<t.length;i++)t[i]=t[i].toString();
                return t
                },t.toDateArray=function(n){
                var t=[],i,r;
                for(n!==null&&n!==undefined&&(t=n instanceof Array?n:n.split(",")),i=0;i<t.length;i++)r=moment.utc(t[i]),t[i]=r;
                return t
                },t.toNumberArray=function(n){
                var t=[],i;
                for(n!==null&&n!==undefined&&(t=n instanceof Array?n:n.split(",")),i=0;i<t.length;i++)t[i]=Number(t[i]),isNaN(t[i])&&(t[i]=0);
                return t
                },t.formatAxisDateLabels=function(t,i,r){
                if(i==="Date"){
                    var u=n.Helpers.Helper.dateParse(t);
                    switch(r){
                        case"D":
                            return u.format("D MMM");
                        case"W":
                            return u.format("D MMM YY");
                        case"M":
                            return u.format("MMM YYYY");
                        case"Q":
                            return u.format("MMM YYYY");
                        case"Y":
                            return $s.financialMonth>1?u.format("YYYY")+"-"+u.add("years",1).format("YY"):u.format("YYYY")
                            }
                        }else return t
                },t.getTargetPercTitle=function(n){
            var t="";
            return n!=null&&($s.calcOfTarget?t=n===1?$s.labels.on_target:$s.labels.of_target:n===0?t=$s.labels.on_target:n>0?t=$s.labels.above_target:n<0&&(t=$s.labels.below_target)),t
            },t.getTargetColour=function(n,t){
            var r="#b70b0b",u="#90da25",i="";
            return n!=null&&t!=="N"&&($s.calcOfTarget?n>=1?i=u:n<1&&(i=r):n>0?i=u:n<0&&(i=r)),i
            },t.getTargetArrow=function(n,t){
            var i="";
            return n!=null&&t!=="N"&&($s.calcOfTarget?n>=1?i=t==="D"?"green-down-arrow":"green-up-arrow":n<1&&(i=t==="D"?"red-up-arrow":"red-down-arrow"):n>0?i=t==="D"?"green-down-arrow":"green-up-arrow":n<0&&(i=t==="D"?"red-up-arrow":"red-down-arrow"),i.length>0&&(i+=" sprite")),i
            },t.getTargetArrowLarge=function(n,t){
            var i="";
            return n!=null&&t!=="N"&&($s.calcOfTarget?n>=1?i=t==="D"?"white-down-arrow-large":"white-up-arrow-large":n<1&&(i=t==="D"?"white-up-arrow-large":"white-down-arrow-large"):n>0?i=t==="D"?"white-down-arrow-large":"white-up-arrow-large":n<0&&(i=t==="D"?"white-up-arrow-large":"white-down-arrow-large"),i.length>0&&(i+=" sprite")),i
            },t.getTargetPerc=function(n,t,i){
            function u(n,t,i){
                var r=null;
                return t!==0&&(t===n?r=1:t!==0&&(r=Math.round(n/t*100)/100),t<0&&i!=="D"?r=2-r:t>0&&i==="D"&&(r=(r-2)*-1)),r
                }
                var r=null;
            return n!=null&&t!=null&&($s.calcOfTarget?r=u(n,t,i):t!==0?(n-=t,t<0&&(t*=-1),r=Math.round(n/t*100)/100,i==="D"&&(r=r*-1)):r=0),r
            },t.getOfGoalPerc=function(n,t,i){
            var r=null;
            return t!==0&&(t===n?r=1:t!==0&&(r=Math.round(n/t*100)/100),t<0&&i!=="D"?r=2-r:t>0&&i==="D"&&(r=(r-2)*-1)),r
            },t.getGoalColour=function(n,t){
            var i="";
            return n!=null&&t!=="N"&&(n>=1?i="#90da25":n<1&&(i="#b70b0b")),i
            },t.getChangePerc=function(n,t){
            var i=0;
            return n!=null&&t!=null&&(t!==0?(n-=t,t<0&&(t*=-1),i=Math.round(n/t*100)/100):i=0),i
            },t.getChangeBackColour=function(n,t){
            var r="#b70b0b",u="#90da25",i="#D0D0D0";
            return n!=null&&t!=="N"&&(n>0?i=t==="D"?r:u:n<0&&(i=t==="D"?u:r)),i
            },t.getChangeArrow=function(n){
            var t="";
            return n!=null&&(n>0?t="white-up-arrow":n<0&&(t="white-down-arrow"),t.length>0&&(t+=" sprite")),t
            },t.getChangeArrowLarge=function(n){
            var t="";
            return n!=null&&(n>0?t="white-up-arrow-large":n<0&&(t="white-down-arrow-large"),t.length>0&&(t+=" sprite")),t
            },t.getColourMap=function(n,t,i){
            var u=[],s="#62AFEA",f=[],e=[],r,o;
            for(n!=null&&(f=this.toNumberArray(n)),t!=null&&(e=this.toNumberArray(t)),r=0;r<f.length;r++)e.length===f.length?(o=e[r]-f[r],i==="U"&&o>0||i==="D"&&o<0?u.push("#b70b0b"):u.push(s)):u.push(s);
            return u
            },t.getRAGResult=function(n,t,i,r){
            var o=null;
            if(n!=null&&t!=null)try{
                var u=$.parseJSON(t),s=u[0]&&u[0].length>0?Number(u[0])*i:NaN,f=u[1]&&u[1].length>0?Number(u[1])*i:NaN,e=u[2]&&u[2].length>0?Number(u[2])*i:NaN,h=u[3]&&u[3].length>0?Number(u[3])*i:NaN;
                r!=="D"?(isNaN(s)||isNaN(f)?!isNaN(f)&&n<=f&&(o="R"):n>=s&&n<=f&&(o="R"),isNaN(f)||isNaN(e)||n>f&&n<=e&&(o="A"),isNaN(e)||isNaN(h)?!isNaN(e)&&n>e&&(o="G"):n>e&&n<=h&&(o="G")):(isNaN(s)||isNaN(f)?!isNaN(f)&&n>=f&&(o="R"):n<=s&&n>=f&&(o="R"),isNaN(f)||isNaN(e)||n<f&&n>=e&&(o="A"),isNaN(e)||isNaN(h)?!isNaN(e)&&n<e&&(o="G"):n<e&&n>=h&&(o="G"))
                }catch(c){}
                return o
            },t.Red="#FF0000",t.Amber="#FFAE00",t.Green="#94DA2C",t.getMinValue=function(n){
            var t=null,i,r;
            if(n!=null)for(i=0;i<n.length;i++)r=Number(n[i]),(t===null||r<t)&&(t=r);
            return t
            },t
        }();
        t.Graph=i
        })(n.Helpers||(n.Helpers={}));
var t=n.Helpers
}(InventoryDashboard||(InventoryDashboard={})),function(n){
    (function(t){
        var i=function(){
            function t(){}
            return t.imageUploader=function(t,i){
                function e(){
                    r.onComplete=function(t,i,r){
                        r.success?f():n.Helpers.Helper.dialog(r.error)
                        };
                        
                    u=new qq.FileUploader(r)
                    }
                    function f(){
                    var n=(new Date).getTime(),t,i,r,u,f;
                    $("[data-is-logo=true]").length&&(t=$("[data-is-logo='true']").css("background-image").replace('")',""),t+="?"+n+'")',$("[data-is-logo=true]").css("background-image",t));
                    $("i.large-profile").length&&(i=$("i.large-profile").attr("data-item-id"),r=$("i.large-profile").attr("data-size"),$("i.large-profile").css("background-image","url('/Home/_ProfileImage/"+i+"?size="+r+"&ts="+n+"')"));
                    $("i.small-profile").length&&(u=$("i.small-profile").attr("item-id"),f=$("i.small-profile").attr("size"),$("i.small-profile").css("background-image","url('/Home/_ProfileImage/"+u+"?size="+f+"&ts="+n+"')"))
                    }
                    var r={
                    element:document.getElementById("picture_file"),
                    action:t,
                    debug:!1,
                    multiple:!1,
                    maxConnections:1,
                    allowedExtensions:["jpg","png","gif"],
                    params:{
                        id:i
                    },
                    sizeLimit:2048576,
                    template:'<div class="qq-uploader"><div class="button-blue qq-upload-button">'+$s.labels.Upload_new_image+'<\/div><ul class="qq-upload-list"><\/ul><div class="qq-upload-drop-area"><\/div><\/div>',
                    messages:{
                        typeError:$s.labels.FileUploader_typeError,
                        sizeError:$s.labels.FileUploader_sizeError,
                        minSizeError:$s.labels.FileUploader_minSizeError,
                        emptyError:$s.labels.FileUploader_emptyError
                        },
                    onComplete:{},
                    showMessage:function(t){
                        n.Helpers.Helper.dialog(t)
                        }
                    },u;
            r.onComplete=function(n,t,i){
                i.success?f():e()
                };
                
            u=new qq.FileUploader(r)
            },t.preventDefault=function(n){
            return n.preventDefault?n.preventDefault():typeof n.returnValue!="undefined"&&(n.returnValue=!1),!1
            },t.setLoaderMessage=function(n){
            n||(n=$s.labels.Loading+"...");
            var t=$('<div class="loader"><\/div>').appendTo("body"),i=$("<div>"+n+"<\/div>").appendTo(t);
            i.show().position({
                my:"center top",
                at:"center top+400",
                of:window
            })
            },t.setLoader=function(){
            return n.Helpers.Helper.setLoaderMessage($s.labels.Processing+"..."),!0
            },t.clearLoader=function(){
            $("div.loader").remove()
            },t.setProcessingPayment=function(){
            n.Helpers.Helper.setLoaderMessage($s.labels.Processing_Payment+"...")
            },t.dialog=function(n,t){
            if(n){
                $("div#dialog-message").remove();
                var i=$('<div id="dialog-message">').appendTo($("body"));
                i.html("<p>"+n+"<\/p>");
                i.dialog({
                    modal:!0,
                    resizable:!1,
                    width:400,
                    buttons:{
                        OK:function(){
                            t&&t();
                            $(this).dialog("close");
                            $(this).remove()
                            }
                        },
                position:{
                    of:window,
                    my:"center bottom",
                    at:"center center"
                }
                })
        }
    },t.ajaxFail=function(t,i,r){
    if(typeof r=="undefined"&&(r=!0),t.status===401)n.Helpers.Helper.dialog($s.labels.Your_session_has_expired,function(){
        location.reload()
        });
    else if(t.status===550){
        var u=t.responseText?t.responseText:i;
        r&&n.Helpers.Helper.dialog(u)
        }else n.Helpers.Helper.sendError(t)
        },t.sendError=function(t){
    t&&n.Helpers.Helper.sendErrorDetail(t.status,t.statusText,t.responseText)
    },t.sendCatchError=function(t){
    if(t!=null&&t.name!=null){
        var i={
            type:t.name,
            message:t.message,
            file:t.fileName,
            line:t.lineNumber,
            col:t.columnNumber,
            stack:t.stack
            };
            
        n.Helpers.Helper.sendErrorDetail(-1,i,window.location.href,"")
        }
    },t.sendErrorDetail=function(n,t,i,r){
    var u,f,e;
    try{
        n!=null&&n!==200&&n!==0&&n!==550&&t!=null&&(u="",f="",$.toJSON&&(e={
            response:r,
            status:n,
            href:i,
            error:t
        },u=$.toJSON(e)),u!=$s.lastError)
    }catch(o){}
},t.formSubmit=function(n,t,i){
    var r;
    r=$("<form />",{
        action:n,
        method:t,
        style:"display: none;"
    });
    i!=undefined&&$.each(i,function(n,t){
        $("<input />",{
            type:"hidden",
            name:n,
            value:t
        }).appendTo(r)
        });
    r.appendTo("body").submit()
    },t.getIEVersion=function(){
    var n=-1,t,i;
    return navigator.appName=="Microsoft Internet Explorer"&&(t=navigator.userAgent,i=new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})"),i.exec(t)!==null&&(n=parseFloat(RegExp.$1))),n
    },t.dateParseWeek=function(n){
    var t=moment("invalid");
    return t=$s.startDayOfWeek===1?moment.utc().day(1):moment.utc().day(0),t.add("days",n)
    },t.dateParseMonth=function(n,t){
    var i=moment.utc().date(1);
    return i=i.add("months",n),i.add("days",t)
    },t.dateParseQuarter=function(n,t){
    var r=Math.ceil((moment.utc().month()+1)/3)-1,i=moment.utc().month(r*3).date(1);
    return i=i.add("months",n),i.add("days",t)
    },t.dateParseYear=function(n,t){
    var i=moment.utc().month(0).date(1);
    return i=i.add("years",n),i.add("days",t)
    },t.dateParseFinancialQuarter=function(n,t){
    var f=$s.financialMonth-1,i=moment.utc(),u=1,r=i.month()+1+(12-f);
    return r>12&&(r-=12),u=Math.ceil(r/3)-1,i=this.dateParseFinancialYear(0,0).add("months",u*3),i=i.add("months",n),i.add("days",t)
    },t.dateParseFinancialYear=function(n,t){
    var r=$s.financialMonth-1,i=moment.utc(),u=i.month();
    return i=u<r?moment.utc().subtract("years",1).month(r).date(1):moment.utc().month(r).date(1),i=i.add("years",n),i.add("days",t)
    },t.dateParse=function(n){
    var t=moment("invalid"),r,i;
    switch(n){
        case"start this week":
            t=this.dateParseWeek(0);
            break;
        case"end this week":
            t=this.dateParseWeek(6);
            break;
        case"start last week":
            t=this.dateParseWeek(-7);
            break;
        case"end last week":
            t=this.dateParseWeek(-1);
            break;
        case"start this month":
            t=this.dateParseMonth(0,0);
            break;
        case"end this month":
            t=this.dateParseMonth(1,-1);
            break;
        case"start last month":
            t=this.dateParseMonth(-1,0);
            break;
        case"end last month":
            t=this.dateParseMonth(0,-1);
            break;
        case"start this quarter":
            t=this.dateParseQuarter(0,0);
            break;
        case"end this quarter":
            t=this.dateParseQuarter(3,-1);
            break;
        case"start last quarter":
            t=this.dateParseQuarter(-3,0);
            break;
        case"end last quarter":
            t=this.dateParseQuarter(0,-1);
            break;
        case"start this year":
            t=this.dateParseYear(0,0);
            break;
        case"end this year":
            t=this.dateParseYear(1,-1);
            break;
        case"start last year":
            t=this.dateParseYear(-1,0);
            break;
        case"end last year":
            t=this.dateParseYear(0,-1);
            break;
        case"start this financial quarter":
            t=this.dateParseFinancialQuarter(0,0);
            break;
        case"end this financial quarter":
            t=this.dateParseFinancialQuarter(3,-1);
            break;
        case"start last financial quarter":
            t=this.dateParseFinancialQuarter(-3,0);
            break;
        case"end last financial quarter":
            t=this.dateParseFinancialQuarter(0,-1);
            break;
        case"start this financial year":
            t=this.dateParseFinancialYear(0,0);
            break;
        case"end this financial year":
            t=this.dateParseFinancialYear(1,-1);
            break;
        case"start last financial year":
            t=this.dateParseFinancialYear(-1,0);
            break;
        case"end last financial year":
            t=this.dateParseFinancialYear(0,-1);
            break;
        default:
            if(/today|end/ig.test(n)){
            t=moment.utc();
            var u=/end/ig.test(n)?-1:0,r=n.replace(/today|end|\s|\d|-/ig,""),i=Number(n.replace(/\s|[a-zA-Z]/ig,""));
            /days|day|d/ig.test(r)?t.add("days",i+u):/weeks|week/ig.test(r)?(i=i*7+u,t=this.dateParseWeek(i)):/months|month/ig.test(r)?t=this.dateParseMonth(i,u):/financialquarter/ig.test(r)?(i=i*3,t=this.dateParseFinancialQuarter(i,u)):/financialyear/ig.test(r)?t=this.dateParseFinancialYear(i,u):/quarters|quarter/ig.test(r)?(i=i*3,t=this.dateParseQuarter(i,u)):/years|year/ig.test(r)&&(t=this.dateParseYear(i,u))
            }else/todate/ig.test(n)?(t=moment.utc(),r=n.replace(/todate|\s|\d|-/ig,""),i=Number(n.replace(/\s|[a-zA-Z]/ig,"")),/days|day|d/ig.test(r)?t.add("days",i):/weeks|week/ig.test(r)?(i=i*7,t.add("days",i)):/months|month/ig.test(r)?t.add("months",i):/financialquarter/ig.test(r)?(i=i*3,t.add("months",i)):/financialyear/ig.test(r)?t.add("years",i):/quarters|quarter/ig.test(r)?(i=i*3,t.add("months",i)):/years|year/ig.test(r)&&t.add("years",i)):t=moment.utc(n).zone(0)
            }
            return t
    },t.dropDownMenu=function(n,t,i,r){
    typeof i=="undefined"&&(i="right bottom");
    typeof r=="undefined"&&(r="right top");
    var f=!1,e=!0,o=$(n),u=$(t);
    $(n+","+t).hover(function(n){
        return f=!0,o.addClass("selected"),e&&u.stop().show(),u.position({
            my:r,
            at:i,
            of:o
        }),e&&u.hide(),u.fadeIn(400,function(){
            u.position({
                my:r,
                at:i,
                of:o
            })
            }),e=!1,f=!0,n.preventDefault(),!1
        },function(n){
        return f=!1,setTimeout(function(){
            f||(o.removeClass("selected"),u.stop().hide(),e=!0)
            },300),n.preventDefault(),!1
        })
    },t.fixValue=function(n){
    var i="",n=n.replace(/[^\d.-]/g,""),r=0,t;
    for(n.indexOf("-")>-1&&(n=n.replace(/[^\d.]/g,""),n="-"+n),r=0,t=n.length-1;t>=0;t--)n.charAt(t)==="."?(r++,r<=1&&(i+=n.charAt(t))):i+=n.charAt(t);
    return i.split("").reverse().join("")
    },t.setWizard=function(){
    var t=Number($s.wizStep),n=$("div.wizard"),i;
    n&&n.length&&n.length>0&&!isNaN(t)&&t>0&&(i=n.find("a.learn").detach(),n.empty(),t===1?n.append('<a href="/KPI" class="step">1. '+$s.labels.Add_your_KPIs+"<\/a>"):n.append('<i class="sprite done"><\/i>'),n.append('<span class="sprite chevron"><\/span>'),t===1?n.append('<i class="sprite data-entry"><\/i>'):t===2?n.append('<a href="/KPIEntry" class="step">2. '+$s.labels.Add_your_data+"<\/a>"):n.append('<i class="sprite done"><\/i>'),n.append('<span class="sprite chevron"><\/span>'),t===1||t===2?n.append('<i class="sprite dashboards"><\/i>'):t===3?n.append('<a href="/Dashboards" class="step">3. '+$s.labels.Create_a_dashboard+"<\/a>"):n.append('<i class="sprite done"><\/i>'),n.append(i))
    },t
}();
t.Helper=i
})(n.Helpers||(n.Helpers={}));
var t=n.Helpers
}(InventoryDashboard||(InventoryDashboard={})),function(n){
    (function(t){
        var i=function(){
            function t(){}
            return t.currentPopup=function(){
                return $("div.popup-form")
                },t.videoPopup=function(t){
                var u="Video",f="http://support.simplekpi.com",r,i;
                return $(t).attr("data-title")&&(u=$(t).attr("data-title")),$(t).attr("href")&&(f=$(t).attr("href")),r=$('<div class="popup-overlay"><\/div>').appendTo($("body")),i=$('<div class="video-popup"><\/div>').appendTo($("body")),i.append('<a id="btnClosePopup" href="#" class="close">'+$s.labels.Close+"<\/a>"),i.append('<iframe width="960" height="540" src="//player.vimeo.com/video/'+$(t).attr("data-video")+'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen><\/iframe>'),i.position({
                    my:"center",
                    at:"center center-100px",
                    of:window,
                    collision:"fit"
                }),i.find("a.close").click(function(t){
                    return r.remove(),i.remove(),n.Helpers.Helper.preventDefault(t)
                    }),!1
                },t.createPopup=function(t){
                var r=this,i,u;
                if(t!==null){
                    i=$("div.popup-overlay");
                    $("div.popup").remove();
                    i.length||(i=$('<div class="popup-overlay"><\/div>').appendTo($("body")));
                    $(t).length||(u=$('<div id="'+t.replace("#","")+'" class="popup ui-draggable popup-form"><\/div>').appendTo($("body")));
                    $("div.popup").on("click","#btnClosePopup, a.cancel",function(t){
                        return i.remove(),r.currentPopup().remove(),n.Helpers.Helper.preventDefault(t)
                        })
                    }
                },t.repositionPopup=function(){
            var n=this.currentPopup();
            n.length&&(n.show(),n.position({
                my:"center",
                at:"center center-100px",
                of:window,
                collision:"fit"
            }),n.draggable({
                handle:this.currentPopup().find(" > h2")
                }),n.hide().fadeIn())
            },t.contactSupport=function(){
            $(function(){
                $.validator.unobtrusive.parse("#dvContactSupportPopup")
                })
            },t.contactSupportSuccess=function(){
            $("div.popup-overlay").remove();
            n.Helpers.Popups.currentPopup().fadeOut().remove();
            n.Helpers.Helper.dialog($s.labels.A_ticket_has_been_sent)
            },t
        }();
        t.Popups=i
        })(n.Helpers||(n.Helpers={}));
var t=n.Helpers
}(InventoryDashboard||(InventoryDashboard={})),function(n){
    n.fn.daterangepicker=function(t){
        function l(n){
            typeof n=="undefined"&&(n=null);
            k.children("a").removeClass("selected");
            y.find("a.filter-selector").not(n).html("- "+$s.labels.Select+" -");
            y.find("div.custom > label").removeClass("selected")
            }
            function ft(){
            var o,s;
            if(/^\d{4}-?\d{2}-?\d{2}$/ig.test(u)&&e==="true"){
                var n=moment.utc(moment.utc().format("YYYY-MM-DD")),t=a.pickmeup("get_date",!0),i=moment.utc(t[0]),r=moment.utc(t[t.length-1]);
                n.isSame(i)?u="today":(o=n.diff(i,"days")*-1,u="today"+o.toString()+"days");
                n.isSame(r)?f="today":(s=n.diff(r,"days")*-1,f="today"+s.toString()+"days")
                }
            }
        function et(n,t){
        var i=30;
        return t!=null&&t!==NaN?n==="day"&&t>i*365?i*365:n==="week"&&t>i*52?i*52:n==="month"&&t>i*12?i*12:n.indexOf("quarter")>=0&&t>i*4?i*4:n.indexOf("year")>=0&&t>i?i:t:0
        }
        function ot(n){
        var t=et(n,Number(d.val())-1);
        d.val(t+1);
        n!=null&&n.length>0&&t!==NaN&&t>=0&&(t*=-1,u="today "+t.toString()+" "+n,f=n==="day"?"today":"end this "+n,l(g),vt.addClass("selected"),e="true",h.singleSelector("set_value","true"),c())
        }
        function st(n){
        var t=et(n,Number(nt.val()));
        nt.val(t);
        n!=null&&n.length>0&&t!==NaN&&t>=0&&(t*=-1,u="today "+t.toString()+" "+n,f=n==="day"?"today-1day":"end last "+n,l(tt),yt.addClass("selected"),e="true",h.singleSelector("set_value","true"),c())
        }
        function pt(t,i,o){
        var v=n('<label style="margin-right:10px">'+t+"<\/label>").appendTo(s),a=n('<a class="filter-selector sprite" data-selector="true" href=""><\/a>').appendTo(s);
        return a.singleSelector({
            data:w,
            id:"",
            container:r,
            onSelect:function(n){
                u=i+n;
                f=o==="today"?"today":o+n;
                l(a);
                v.addClass("selected");
                e="true";
                h.singleSelector("set_value","true");
                c()
                }
            }),a
    }
    function wt(){
    var n=[],t=InventoryDashboard.Helpers.Helper.dateParse(u),i=InventoryDashboard.Helpers.Helper.dateParse(f);
    return t!=null&&t.isValid()&&n.push(t.toDate()),i!=null&&i.isValid()&&n.push(i.toDate()),n.length>0?n:[new Date]
    }
    function c(t){
    var r,s,c;
    typeof t=="undefined"&&(t=!0);
    e=h.singleSelector("get_value");
    t&&a.pickmeup("set_date",wt());
    e==="true"?(i.from=u,i.to=f):(r=a.pickmeup("get_date",!0),i.from=r[0],i.to=r[r.length-1]);
    s="- "+$s.labels.Optional+" -";
    c=InventoryDashboard.Helpers.Graph.getViewDateLabel(i.from,i.to);
    c.length>0&&(s=c);
    o.find("b").length?o.find("b").html(s):n(o).html(s);
    bt()
    }
    function bt(){
    var t,r;
    if(i.compareTo==null){
        if(t="",r="",e==="true")if(i.from==="today"&&i.to==="today")t="today-1days",r="today-1days";
            else if(i.from==="today-1days"&&i.to==="today-1days")t="today-2days",r="today-2days";
            else if(/^start{1}\s*this/ig.test(i.from)&&i.to==="today")t=i.from.replace(/this/ig,"last"),r="todate -1 "+i.from.replace(/start|\s|this/ig,"");
            else if(/^today{1}\s*-*\d*\s*(day|days){1}$/ig.test(i.from)||/^today{1}\s*-*\d*\s*(day|days){1}$/ig.test(i.to)){
            var f=Number(i.from.replace(/\s|[a-zA-Z]/ig,"")),h=Number(i.to.replace(/\s|[a-zA-Z]/ig,"")),u=i.from.replace(/today|\s|\d|-/ig,""),n=f-h-1;
            u.length<=0&&(u="day");
            r="end "+f.toString()+" "+u;
            isNaN(n)&&(n=0);
            n+=f;
            t="today "+n.toString()+" "+u
            }else{
            var n=Number(i.from.replace(/\s|[a-zA-Z]/ig,"")),u=i.from.replace(/today|\s|\d|-/ig,""),c=/this/ig.test(i.to)||i.to==="today"?-1:0;
            u.length<=0&&(u="day");
            r="end "+n.toString()+" "+u;
            isNaN(n)&&(n=0);
            n=n*2+c;
            t="today "+n.toString()+" "+u
            }else{
            var s=moment.utc(i.from),l=moment.utc(i.to),a=l.diff(s,"days")+1;
            r=moment.utc(s).subtract("days",1).format("YYYY-MM-DD");
            t=s.subtract("days",a).format("YYYY-MM-DD")
            }
            o.data("fromPrev",t);
        o.data("toPrev",r)
        }
    }
function kt(){
    r.data("state")==="closed"&&(n("div[data-selector=true]").hide().data("state","closed"),n("a[data-selector=true]").removeClass("selected"),r.fadeIn(300).data("state","open"),gt(),i.onOpen())
    }
    function it(){
    if(r.data("state")==="open"){
        r.fadeOut(300).data("state","closed");
        i.onClose(i.from,i.to)
        }
    }
function dt(){
    r.data("state")==="open"?it():kt()
    }
    function gt(){
    r.position({
        my:"left top",
        at:"left bottom",
        of:o,
        collision:"none"
    })
    }
    var o=n(this),u="",f="",e="true",p,rt,a,ut;
if(o.length!=null&&o.length>0){
    var w=[{
        id:"week",
        name:$s.labels.Week
        },{
        id:"month",
        name:$s.labels.Month
        },{
        id:"quarter",
        name:$s.labels.Quarter
        },{
        id:"year",
        name:$s.labels.Year
        },{
        id:"financial quarter",
        name:$s.labels.Financial_Quarter
        },{
        id:"financial year",
        name:$s.labels.Financial_Year
        }],v=[{
        id:"day",
        name:$s.labels.Days
        },{
        id:"week",
        name:$s.labels.Weeks
        },{
        id:"month",
        name:$s.labels.Months
        },{
        id:"quarter",
        name:$s.labels.Quarters
        },{
        id:"year",
        name:$s.labels.Years
        },{
        id:"financial quarter",
        name:$s.labels.Financial_Quarters
        },{
        id:"financial year",
        name:$s.labels.Financial_Years
        }],i=n.extend({
        from:"",
        to:"",
        presetRanges:[{
            text:$s.labels.Today,
            from:"today",
            to:"today"
        },{
            text:$s.labels.Yesterday,
            from:"today-1days",
            to:"today-1days"
        },{
            text:$s.labels.Week_to_date,
            from:"start this week",
            to:"today"
        },{
            text:$s.labels.Month_to_date,
            from:"start this month",
            to:"today"
        }],
        dateFormat:"DD MMM YY",
        appendTo:"body",
        onClose:function(){},
        onOpen:function(){},
        onChange:function(){}
    },t),r=n('<div class="ui-daterangepickercontain" data-selector="true"><\/div>'),ht=n("<div><\/div>").appendTo(r),ct=n("<div><\/div>").appendTo(r),lt=n("<div><\/div>").appendTo(r),y=n("<div><\/div>").appendTo(ht),at=n("<div><\/div>").appendTo(ct),b=n('<div class="bottom"><\/div>').appendTo(lt),k=n('<div class="presets"><\/div>').appendTo(y),s=n('<div class="custom"><\/div>').appendTo(y),h=null;
$s.financialMonth===1&&(w.pop(),w.pop(),v.pop(),v.pop());
o.attr("data-selector","true");
u=i.from;
f=i.to;
e=(!/^\d{4}-?\d{2}-?\d{2}$/ig.test(u)).toString();
i.compareTo&&(p=n(i.compareTo),p.length&&(rt=n('<a href="#">'+$s.labels.Previous_Period+"<\/a>").appendTo(k),rt.click(function(t){
    var i=n(this);
    return u=p.data("fromPrev"),f=p.data("toPrev"),l(),i.addClass("selected"),e=(!/^\d{4}-?\d{2}-?\d{2}$/ig.test(u)).toString(),h.singleSelector("set_value",e),c(),t.preventDefault(),!1
    })));
n.each(i.presetRanges,function(){
    var t=n('<a href="#">'+this.text+"<\/a>").data("from",this.from).data("to",this.to).appendTo(k);
    this.from===u&&this.to===f&&t.addClass("selected");
    t.click(function(t){
        var i=n(this);
        return u=i.data("from"),f=i.data("to"),l(),i.addClass("selected"),e="true",h.singleSelector("set_value","true"),c(),t.preventDefault(),!1
        })
    });
s.append("<h3>"+$s.labels.Custom_period_select+"<\/h3>");
var vt=n('<label style="width:50px">'+$s.labels.Present+"<\/label>").appendTo(s),d=n('<input id="txtCurr" name="txtCurr" type="text" value="1" maxlength="3" />').appendTo(s),g=n('<a class="filter-selector sprite" data-selector="true" href=""><\/a>').appendTo(s);
g.singleSelector({
    data:v,
    id:"",
    container:r,
    onSelect:ot
});
d.keyup(function(){
    var n=g.singleSelector("get_value");
    ot(n)
    });
var yt=n('<label style="width:50px">'+$s.labels.Previous+"<\/label>").appendTo(s),nt=n('<input id="txtPrev" name="txtPrev" type="text" value="1" maxlength="3" />').appendTo(s),tt=n('<a class="filter-selector sprite" data-selector="true" href=""><\/a>').appendTo(s);
tt.singleSelector({
    data:v,
    id:"",
    container:r,
    onSelect:st
});
nt.keyup(function(){
    var n=tt.singleSelector("get_value");
    st(n)
    });
pt($s.labels.To_date,"start this ","today");
a=n('<div class="calendar"><\/div>').appendTo(at);
a.pickmeup({
    flat:!0,
    format:"Y-m-d",
    mode:"range",
    calendars:3,
    change:function(n){
        n!=null&&(l(),u=n[0],f=n[n.length-1],ft(),c(!1))
        }
    });
b.append("<label>Rolling Period<\/label>");
h=n('<a class="filter-selector sprite" style="width:30px" data-selector="true" href=""><\/a>').appendTo(b);
h.singleSelector({
    data:[{
        id:"false",
        name:$s.labels.No
        },{
        id:"true",
        name:$s.labels.Yes
        }],
    id:e,
    container:r,
    onSelect:function(n){
        e=n;
        ft();
        c()
        }
    });
ut=n('<a href="#" class="button-green">'+$s.labels.Apply_date_range+"<\/a>").appendTo(b);
ut.click(function(n){
    return it(),n.preventDefault(),!1
    });
o.click(function(){
    return dt(),!1
    });
r.data("state","closed");
n(i.appendTo).append(r);
n(document).click(function(){
    r.is(":visible")&&it()
    });
c();
r.click(function(){
    return!1
    }).hide()
}
}
}($),function(n){
    function t(){
        for(var n=new Date(this.toString()),t=28,i=n.getMonth();n.getMonth()==i;)++t,n.setDate(t);
        return t-1
        }
        n.addDays=function(n){
        this.setDate(this.getDate()+n)
        };
        
    n.addMonths=function(n){
        var i=this.getDate();
        this.setDate(1);
        this.setMonth(this.getMonth()+n);
        this.setDate(Math.min(i,t.apply(this)))
        };
        
    n.addYears=function(n){
        var i=this.getDate();
        this.setDate(1);
        this.setFullYear(this.getFullYear()+n);
        this.setDate(Math.min(i,t.apply(this)))
        };
        
    n.getDayOfYear=function(){
        var n=new Date(this.getFullYear(),this.getMonth(),this.getDate(),0,0,0),t=new Date(this.getFullYear(),0,0,0,0,0),i=Math.abs(n.getTime()-t.getTime());
        return Math.floor(i/24*36e5)
        }
    }(Date.prototype),function(n){
    function s(){
        var t=n(this).data("pickmeup-options"),s=this.pickmeup,p=Math.floor(t.calendars/2),f=t.date,v=t.current,u,a,c,y,k=(new Date).setHours(0,0,0,0),e,h,l,o,w,b;
        for(s.find(".pmu-instance > :not(nav)").remove(),o=0;o<t.calendars;o++){
            if(u=new Date(v),y=s.find(".pmu-instance").eq(o),s.hasClass("pmu-view-years")?(u.addYears((o-p)*12),a=u.getFullYear()-6+" - "+(u.getFullYear()+5)):s.hasClass("pmu-view-months")?(u.addYears(o-p),a=u.getFullYear()):s.hasClass("pmu-view-days")&&(u.addMonths(o),a=r(u,"B, Y",t.locale)),!h&&t.max&&(l=new Date(u),t.select_day?l.addMonths(t.calendars-1):t.select_month?l.addYears(t.calendars-1):l.addYears((t.calendars-1)*12),l>t.max)){
                --o;
                v.addMonths(-1);
                h=undefined;
                continue
            }
            if(h=new Date(u),!e&&(e=new Date(u),e.setDate(1),e.addMonths(1),e.addDays(-1),t.min&&t.min>e)){
                --o;
                v.addMonths(1);
                e=undefined;
                continue
            }
            y.find(".pmu-month").text(a);
            c="";
            w=function(n){
                return t.mode=="range"&&n>=new Date(f[0]).getFullYear()&&n<=new Date(f[1]).getFullYear()||t.mode=="multiple"&&f.reduce(function(n,t){
                    return n.push(new Date(t).getFullYear()),n
                    },[]).indexOf(n)!==-1||new Date(f).getFullYear()==n
                };
                
            b=function(n,i){
                var r=new Date(f[0]).getFullYear(),u=new Date(f[1]).getFullYear(),e=new Date(f[0]).getMonth(),o=new Date(f[1]).getMonth();
                return t.mode=="range"&&n>r&&n<u||t.mode=="range"&&n==r&&n<u&&i>=e||t.mode=="range"&&n>r&&n==u&&i<=o||t.mode=="range"&&n==r&&n==u&&i>=e&&i<=o||t.mode=="multiple"&&f.reduce(function(n,t){
                    return t=new Date(t),n.push(t.getFullYear()+"-"+t.getMonth()),n
                    },[]).indexOf(n+"-"+i)!==-1||new Date(f).getFullYear()==n&&new Date(f).getMonth()==i
                },function(){
                for(var f=[],e=u.getFullYear()-6,o=new Date(t.min).getFullYear(),s=new Date(t.max).getFullYear(),n,r=0;r<12;++r)n={
                    text:e+r,
                    class_name:[]
                },t.min&&n.text<o||t.max&&n.text>s?n.class_name.push("pmu-disabled"):w(n.text)&&n.class_name.push("pmu-selected"),n.class_name=n.class_name.join(" "),f.push(n);
                c+=i.body(f,"pmu-years")
                }(),function(){
                for(var e=[],f=u.getFullYear(),o=new Date(t.min).getFullYear(),h=new Date(t.min).getMonth(),s=new Date(t.max).getFullYear(),l=new Date(t.max).getMonth(),n,r=0;r<12;++r)n={
                    text:t.locale.monthsShort[r],
                    class_name:[]
                },t.min&&(f<o||r<h&&f==o)||t.max&&(f>s||r>l&&f>=s)?n.class_name.push("pmu-disabled"):b(f,r)&&n.class_name.push("pmu-selected"),n.class_name=n.class_name.join(" "),e.push(n);
                c+=i.body(e,"pmu-months")
                }(),function(){
                var s=[],h=u.getMonth(),r,o;
                for(function(){
                    u.setDate(1);
                    var n=(u.getDay()-t.first_day)%7;
                    u.addDays(-(n+(n<0?7:0)))
                    }(),o=0;o<35;++o){
                    r={
                        text:u.getDate(),
                        class_name:[]
                    };
                    
                    h!=u.getMonth()&&r.class_name.push("pmu-not-in-month");
                    u.getDay()==0?r.class_name.push("pmu-sunday"):u.getDay()==6&&r.class_name.push("pmu-saturday");
                    var e=t.render(u)||{},f=u,l=t.min&&t.min>u||t.max&&t.max<u;
                    e.disabled||l?r.class_name.push("pmu-disabled"):(e.selected||t.date==f||n.inArray(f,t.date)!==-1||t.mode=="range"&&f>=t.date[0]&&f<=t.date[1])&&r.class_name.push("pmu-selected");
                    f==k&&r.class_name.push("pmu-today");
                    e.class_name&&r.class_name.push(e.class_name);
                    r.class_name=r.class_name.join(" ");
                    s.push(r);
                    u.addDays(1)
                    }
                    c+=i.body(s,"pmu-days")
                }();
            y.append(c)
            }
            e.setDate(1);
        h.setDate(1);
        h.addMonths(1);
        h.addDays(-1);
        s.find(".pmu-prev").css("visibility",t.min&&t.min>=e?"hidden":"visible");
        s.find(".pmu-next").css("visibility",t.max&&t.max<=h?"hidden":"visible");
        t.fill.apply(this)
        }
        function t(i,r,u,f){
        var a,e;
        if(i.constructor==Date)return i;
        if(!i)return new Date;
        if(a=i.split(u),a.length>1)return a.forEach(function(i,e,o){
            o[e]=t(n.trim(i),r,u,f)
            }),a;
        var p=f.monthsShort.join(")(")+")("+f.months.join(")("),b=new RegExp("[^0-9a-zA-Z("+p+")]+"),o=i.split(u),w=r.split(u),v,h,c,s,y,l=new Date;
        for(e=0;e<o.length;e++)switch(w[e]){
            case"b":
                h=f.monthsShort.indexOf(o[e]);
                break;
            case"B":
                h=f.months.indexOf(o[e]);
                break;
            case"d":case"e":
                v=parseInt(o[e],10);
                break;
            case"m":
                h=parseInt(o[e],10)-1;
                break;
            case"Y":case"y":
                c=parseInt(o[e],10)+(c>100?0:c<29?2e3:1900);
                break;
            case"H":case"I":case"k":case"l":
                s=parseInt(o[e],10);
                break;
            case"P":case"p":
                /pm/i.test(o[e])&&s<12?s+=12:/am/i.test(o[e])&&s>=12&&(s-=12);
                break;
            case"M":
                y=parseInt(o[e],10)
                }
                return new Date(c===undefined?l.getFullYear():c,h===undefined?l.getMonth():h,v===undefined?l.getDate():v,s===undefined?l.getHours():s,y===undefined?l.getMinutes():y,0)
        }
        function r(n,t,i){
        var e=n.getMonth(),h=n.getDate(),a=n.getFullYear(),c=n.getDay(),u=n.getHours(),p=u>=12,f=p?u-12:u,o=n.getDayOfYear(),s;
        f==0&&(f=12);
        var v=n.getMinutes(),y=n.getSeconds(),l=t.split(""),r;
        for(s=0;s<l.length;s++){
            r=l[s];
            switch(r){
                case"a":
                    r=i.daysShort[c];
                    break;
                case"A":
                    r=i.days[c];
                    break;
                case"b":
                    r=i.monthsShort[e];
                    break;
                case"B":
                    r=i.months[e];
                    break;
                case"C":
                    r=1+Math.floor(a/100);
                    break;
                case"d":
                    r=h<10?"0"+h:h;
                    break;
                case"e":
                    r=h;
                    break;
                case"H":
                    r=u<10?"0"+u:u;
                    break;
                case"I":
                    r=f<10?"0"+f:f;
                    break;
                case"j":
                    r=o<100?o<10?"00"+o:"0"+o:o;
                    break;
                case"k":
                    r=u;
                    break;
                case"l":
                    r=f;
                    break;
                case"m":
                    r=e<9?"0"+(1+e):1+e;
                    break;
                case"M":
                    r=v<10?"0"+v:v;
                    break;
                case"p":case"P":
                    r=p?"PM":"AM";
                    break;
                case"s":
                    r=Math.floor(n.getTime()/1e3);
                    break;
                case"S":
                    r=y<10?"0"+y:y;
                    break;
                case"u":
                    r=c+1;
                    break;
                case"w":
                    r=c;
                    break;
                case"y":
                    r=(""+a).substr(2,2);
                    break;
                case"Y":
                    r=a
                    }
                    l[s]=r
            }
            return l.join("")
        }
        function h(){
        var e=n(this),t=e.data("pickmeup-options"),r=t.current,i,u;
        switch(t.mode){
            case"multiple":
                i=r.setHours(0,0,0,0);
                n.inArray(i,t.date)!==-1?n.each(t.date,function(n,r){
                return r==i?(t.date.splice(n,1),!1):!0
                }):t.date.push(i);
                break;
            case"range":
                t.lastSel||(t.date[0]=r.setHours(0,0,0,0));
                i=r.setHours(0,0,0,0);
                i<=t.date[0]?(t.date[1]=t.date[0],t.date[0]=i):t.date[1]=i;
                t.lastSel=!t.lastSel;
                break;
            default:
                t.date=r
                }
                return u=f(t),e.is("input")&&e.val(t.mode=="single"?u[0]:u[0].join(t.separator)),t.change.apply(this,u),t.hide_on_select&&(t.mode!="range"||!t.lastSel)?(t.binded.hide(),!1):void 0
        }
        function c(t){
        var u=n(t.target),o;
        if(u.hasClass("pmu-button")||(u=u.closest(".pmu-button")),u.length){
            if(u.hasClass("pmu-disabled"))return!1;
            var s=n(this),i=s.data("pickmeup-options"),f=u.parents(".pmu-instance").eq(0),r=f.parent(),e=n(".pmu-instance",r).index(f);
            u.parent().is("nav")?u.hasClass("pmu-month")?(i.current.addMonths(e-Math.floor(i.calendars/2)),r.hasClass("pmu-view-years")?(i.current=i.mode!="single"?new Date(i.date[i.date.length-1]):new Date(i.date),i.select_day?r.removeClass("pmu-view-years").addClass("pmu-view-days"):i.select_month&&r.removeClass("pmu-view-years").addClass("pmu-view-months")):r.hasClass("pmu-view-months")?i.select_year?r.removeClass("pmu-view-months").addClass("pmu-view-years"):i.select_day&&r.removeClass("pmu-view-months").addClass("pmu-view-days"):r.hasClass("pmu-view-days")&&(i.select_month?r.removeClass("pmu-view-days").addClass("pmu-view-months"):i.select_year&&r.removeClass("pmu-view-days").addClass("pmu-view-years"))):u.hasClass("pmu-prev")?i.binded.prev(!1):i.binded.next(!1):u.hasClass("pmu-disabled")||(r.hasClass("pmu-view-years")?(i.current.setFullYear(parseInt(u.text(),10)),i.select_month?r.removeClass("pmu-view-years").addClass("pmu-view-months"):i.select_day?r.removeClass("pmu-view-years").addClass("pmu-view-days"):i.binded.update_date()):r.hasClass("pmu-view-months")?(i.current.setMonth(f.find(".pmu-months .pmu-button").index(u)),i.current.setFullYear(parseInt(f.find(".pmu-month").text(),10)),i.select_day?r.removeClass("pmu-view-months").addClass("pmu-view-days"):i.binded.update_date(),i.current.addMonths(Math.floor(i.calendars/2)-e)):(o=parseInt(u.text(),10),i.current.addMonths(e),u.hasClass("pmu-not-in-month")&&i.current.addMonths(o>15?-1:1),i.current.setDate(o),i.binded.update_date()));
            i.binded.fill()
            }
            return!1
        }
        function f(t){
        var i;
        return t.mode=="single"?(i=new Date(t.date),[r(i,t.format,t.locale),i]):(i=[[],[]],n.each(t.date,function(n,u){
            var f=new Date(u);
            i[0].push(r(f,t.format,t.locale));
            i[1].push(f)
            }),i)
        }
        function e(i){
        var u=this.pickmeup;
        if(i||!u.is(":visible")){
            var o=n(this),r=o.data("pickmeup-options"),s=o.offset(),h={
                l:document.documentElement.scrollLeft,
                t:document.documentElement.scrollTop,
                w:document.documentElement.clientWidth,
                h:document.documentElement.clientHeight
                },f=s.top,e=s.left;
            r.binded.fill();
            o.is("input")&&o.pickmeup("set_date",t(o.val(),r.format,r.separator,r.locale)).keydown(function(n){
                n.which==9&&o.pickmeup("hide")
                });
            r.before_show();
            switch(r.position){
                case"top":
                    f-=u.outerHeight();
                    break;
                case"left":
                    e-=u.outerWidth();
                    break;
                case"right":
                    e+=this.offsetWidth;
                    break;
                case"bottom":
                    f+=this.offsetHeight
                    }
                    if(f+u.offsetHeight>h.t+h.h&&(f=s.top-u.offsetHeight),f<h.t&&(f=s.top+this.offsetHeight+u.offsetHeight),e+u.offsetWidth>h.l+h.w&&(e=s.left-u.offsetWidth),e<h.l&&(e=s.left+this.offsetWidth),r.show()==!1)return;
            u.css({
                display:"inline-block",
                top:f+"px",
                left:e+"px"
                });
            n(document).on("mousedown"+r.events_namespace,r.binded.hide).on("resize"+r.events_namespace,[!0],r.binded.forced_show)
            }
        }
    function l(){
    e.call(this,!0)
    }
    function a(t){
    if(!t||!t.target||t.target!=this&&!(this.pickmeup.get(0).compareDocumentPosition(t.target)&16)){
        var r=this.pickmeup,i=n(this).data("pickmeup-options");
        i.hide()!=!1&&(r.hide(),n(document).off("mousedown",i.binded.hide).off("resize",i.binded.forced_show),i.date[1]=i.date[0],i.lastSel=!1)
        }
    }
function v(){
    var t=n(this).data("pickmeup-options");
    n(document).off("mousedown",t.binded.hide).off("resize",t.binded.forced_show);
    t.binded.forced_show()
    }
    function y(){
    var t=n(this).data("pickmeup-options");
    t.mode!="single"&&(t.date=[],t.lastSel=!1,t.binded.fill())
    }
    function p(t){
    typeof t=="undefined"&&(t=!0);
    var r=this.pickmeup,i=n(this).data("pickmeup-options");
    r.hasClass("pmu-view-years")?i.current.addYears(-12):r.hasClass("pmu-view-months")?i.current.addYears(-1):r.hasClass("pmu-view-days")&&i.current.addMonths(-1);
    t&&i.binded.fill()
    }
    function w(t){
    typeof t=="undefined"&&(t=!0);
    var r=this.pickmeup,i=n(this).data("pickmeup-options");
    r.hasClass("pmu-view-years")?i.current.addYears(12):r.hasClass("pmu-view-months")?i.current.addYears(1):r.hasClass("pmu-view-days")&&i.current.addMonths(1);
    t&&i.binded.fill()
    }
    function b(t){
    var u=n(this).data("pickmeup-options"),e=f(u),i;
    return typeof t=="string"?(i=e[1],i.constructor==Date?r(i,t,u.locale):i.map(function(n){
        return r(n,t,u.locale)
        })):e[t?0:1]
    }
    function k(i){
    var r=n(this).data("pickmeup-options"),u;
    if(r.date=i,typeof r.date=="string"?r.date=t(r.date,r.format,r.separator,r.locale).setHours(0,0,0,0):r.date.constructor==Date&&r.date.setHours(0,0,0,0),r.date||(r.date=new Date,r.date.setHours(0,0,0,0)),r.mode!="single")if(r.date.constructor!=Array)r.date=[r.date],r.mode=="range"&&r.date.push(new Date(r.date[0]).setHours(0,0,0,0));
        else{
        for(u=0;u<r.date.length;u++)r.date[u]=t(r.date[u],r.format,r.separator,r.locale).setHours(0,0,0,0);
        r.mode=="range"&&(r.date[1]=new Date(r.date[1]).setHours(0,0,0,0))
        }else r.date=r.date.constructor==Array?r.date[0]:r.date;
    r.current=new Date(r.mode!="single"?r.date[0]:r.date);
    r.binded.fill()
    }
    function d(){
    var t=n(this),i=t.data("pickmeup-options");
    t.removeData("pickmeup-options");
    t.off(i.events_namespace);
    n(document).off(i.events_namespace);
    n(this.pickmeup).remove()
    }
    var o=0,u,i;
n.pickmeup=n.extend(n.pickmeup||{},{
    date:new Date,
    flat:!1,
    first_day:1,
    prev:"&#9664;",
    next:"&#9654;",
    mode:"single",
    select_year:!0,
    select_month:!0,
    select_day:!0,
    view:"days",
    calendars:1,
    format:"d-m-Y",
    position:"bottom",
    trigger_event:"click touchstart",
    class_name:"",
    separator:" - ",
    hide_on_select:!1,
    min:null,
    max:null,
    render:function(){},
    change:function(){
        return!0
        },
    before_show:function(){
        return!0
        },
    show:function(){
        return!0
        },
    hide:function(){
        return!0
        },
    fill:function(){
        return!0
        },
    locale:{
        days:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
        daysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],
        daysMin:["Su","Mo","Tu","We","Th","Fr","Sa","Su"],
        months:["January","February","March","April","May","June","July","August","September","October","November","December"],
        monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
        }
    });
u={
    years:"pmu-view-years",
    months:"pmu-view-months",
    days:"pmu-view-days"
};

i={
    wrapper:'<div class="pickmeup" />',
    head:function(n){
        for(var i="",t=0;t<7;++t)i+="<div>"+n.day[t]+"<\/div>";
        return'<div class="pmu-instance"><nav><div class="pmu-prev pmu-button">'+n.prev+'<\/div><div class="pmu-month pmu-button" /><div class="pmu-next pmu-button">'+n.next+'<\/div><\/nav><nav class="pmu-day-of-week">'+i+"<\/nav><\/div>"
        },
    body:function(n,t){
        for(var r="",i=0;i<n.length;++i)r+='<div class="'+n[i].class_name+' pmu-button">'+n[i].text+"<\/div>";
        return'<div class="'+t+'">'+r+"<\/div>"
        }
    };

n.fn.pickmeup=function(r){
    if(typeof r=="string"){
        var f,g=Array.prototype.slice.call(arguments,1);
        switch(r){
            case"hide":case"show":case"clear":case"update":case"prev":case"next":case"destroy":
                this.each(function(){
                f=n(this).data("pickmeup-options");
                f&&f.binded[r]()
                });
            break;
            case"get_date":
                return f=this.data("pickmeup-options"),f?f.binded.get_date(g[0]):null;
            case"set_date":
                this.each(function(){
                f=n(this).data("pickmeup-options");
                f&&f.binded[r].apply(this,g)
                })
            }
            return this
        }
        return this.each(function(){
        var rt=n(this),g,ut,f,nt,tt,ft,it;
        if(!rt.data("pickmeup-options")){
            f=n.extend({},n.pickmeup,r||{});
            for(g in f)ut=rt.data("pmu-"+g),typeof ut!="undefined"&&(f[g]=ut);if(f.view!="days"||f.select_day||(f.view="months"),f.view!="months"||f.select_month||(f.view="years"),f.view!="years"||f.select_year||(f.view="days"),f.view!="days"||f.select_day||(f.view="months"),f.calendars=Math.max(1,parseInt(f.calendars,10)||1),f.mode=/single|multiple|range/.test(f.mode)?f.mode:"single",typeof f.min=="string"?f.min=t(f.min,f.format,f.separator,f.locale).setHours(0,0,0,0):f.min&&f.min.constructor==Date&&f.min.setHours(0,0,0,0),typeof f.max=="string"?f.max=t(f.max,f.format,f.separator,f.locale).setHours(0,0,0,0):f.max&&f.max.constructor==Date&&f.max.setHours(0,0,0,0),f.select_day||(f.min&&(f.min=new Date(f.min),f.min.setDate(1),f.min=f.min),f.max&&(f.max=new Date(f.max),f.max.setDate(1),f.max=f.max)),typeof f.date=="string"?f.date=t(f.date,f.format,f.separator,f.locale).setHours(0,0,0,0):f.date.constructor==Date&&f.date.setHours(0,0,0,0),f.date||(f.date=new Date,f.date.setHours(0,0,0,0)),f.mode!="single"){
                if(f.date.constructor!=Array)f.date=[f.date],f.mode=="range"&&f.date.push(new Date(f.date[0]).setHours(0,0,0,0));
                else{
                    for(g=0;g<f.date.length;g++)f.date[g]=t(f.date[g],f.format,f.separator,f.locale).setHours(0,0,0,0);
                    f.mode=="range"&&(f.date[1]=new Date(f.date[1]).setHours(0,0,0,0))
                    }
                    if(f.current=new Date(f.date[0]),!f.select_day)for(g=0;g<f.date.length;++g)f.date[g]=new Date(f.date[g]),f.date[g].setDate(1),f.date[g]=f.date[g],f.mode!="range"&&f.date.indexOf(f.date[g])!==g&&(delete f.date.splice(g,1),--g)
                    }else f.date=f.date,f.current=new Date(f.date),f.select_day||(f.date=new Date(f.date),f.date.setDate(1),f.date=f.date);
            for(f.current.setDate(1),f.current.setHours(0,0,0,0),tt=n(i.wrapper),this.pickmeup=tt,f.class_name&&tt.addClass(f.class_name),ft="",g=0;g<f.calendars;g++)nt=f.first_day,ft+=i.head({
                prev:f.prev,
                next:f.next,
                day:[f.locale.daysMin[nt++%7],f.locale.daysMin[nt++%7],f.locale.daysMin[nt++%7],f.locale.daysMin[nt++%7],f.locale.daysMin[nt++%7],f.locale.daysMin[nt++%7],f.locale.daysMin[nt++%7]]
                });
            rt.data("pickmeup-options",f);
            for(g in f)["render","change","before_show","show","hide"].indexOf(g)!=-1&&(f[g]=f[g].bind(this));f.binded={
                fill:s.bind(this),
                update_date:h.bind(this),
                click:c.bind(this),
                show:e.bind(this),
                forced_show:l.bind(this),
                hide:a.bind(this),
                update:v.bind(this),
                clear:y.bind(this),
                prev:p.bind(this),
                next:w.bind(this),
                get_date:b.bind(this),
                set_date:k.bind(this),
                destroy:d.bind(this)
                };
                
            f.events_namespace=".pickmeup-"+ ++o;
            tt.on("click touchstart",f.binded.click).addClass(u[f.view]).append(ft).on(n.support.selectstart?"selectstart":"mousedown",function(n){
                n.preventDefault()
                });
            if(f.binded.fill(),f.flat)tt.appendTo(this).css({
                position:"relative",
                display:"inline-block"
            });
            else{
                for(tt.appendTo(document.body),it=f.trigger_event.split(" "),g=0;g<it.length;++g)it[g]+=f.events_namespace;
                it=it.join(" ");
                rt.on(it,f.binded.show)
                }
            }
    })
}
}(jQuery),function(n){
    function t(t){
        var i=n(this).data("selector-options"),r=this;
        t!=null&&t.length>0?(i.id=t,n(i.data).each(function(){
            t==this.id&&n(r).html(this.name)
            })):n(r).html("- "+$s.labels.Select+" -")
        }
        function i(){
        var t=n(this).data("selector-options");
        return t.id
        }
        function r(){
        var t=n(this).data("selector-options");
        t.dropDown.data("state")==="closed"&&(t.container.find("div[data-selector=true]").hide().data("state","closed"),t.container.find("a[data-selector=true]").removeClass("selected"),t.binded.position(),t.dropDown.fadeIn(300).data("state","open"),t.dropDownList.scrollTop(0),n(this).addClass("selected"))
        }
        function u(){
        var t=n(this).data("selector-options");
        t.dropDown.data("state")==="open"&&(t.dropDown.fadeOut(300).data("state","closed"),n(this).removeClass("selected"))
        }
        function f(){
        var t=n(this).data("selector-options");
        t.dropDown.data("state")==="open"?t.binded.hide():t.binded.show()
        }
        function e(){
        var t=n(this).data("selector-options");
        t.dropDown.show();
        t.dropDown.position({
            my:"left top",
            at:"left bottom",
            of:n(this),
            offset:"0px 0px"
        });
        t.dropDown.hide()
        }
        n.singleSelector=n.extend(n.singleSelector||{},{
        data:[],
        id:"",
        container:jQuery(document),
        onSelect:function(){}
    });
n.fn.singleSelector=function(o){
    var c=this,s,h;
    if(typeof o=="string"){
        h=Array.prototype.slice.call(arguments,1);
        switch(o){
            case"hide":case"show":case"toggle":case"position":
                this.each(function(){
                s=n(this).data("selector-options");
                s&&s.binded[o]()
                });
            break;
            case"get_value":
                return s=n(this).data("selector-options"),s?s.binded.get_value():null;
            case"set_value":
                this.each(function(){
                s=n(this).data("selector-options");
                s&&s.binded[o].apply(this,h)
                })
            }
            return this
        }
        return this.each(function(){
        var h=n(this),s,c;
        h.data("selector-options")||h.length!=null&&h.length>0&&(s=n.extend({},n.singleSelector,o||{}),s.binded={
            show:r.bind(this),
            hide:u.bind(this),
            toggle:f.bind(this),
            position:e.bind(this),
            get_value:i.bind(this),
            set_value:t.bind(this)
            },h.data("selector-options",s),s.dropDown=n('<div class="ui-single-selector" style="display: block;min-width: '+h.width().toString()+'px" data-selector="true"><\/div>'),s.dropDownList=n('<ul class="ui-widget-content"><\/ul>').appendTo(s.dropDown),c=[],n(s.data).each(function(){
            var t=n('<li class="ui-corner-all" data-id="'+this.id+'">'+this.name+"<\/li>").appendTo(s.dropDownList);
            t.hover(function(){
                n(this).addClass("hover")
                },function(){
                n(this).removeClass("hover")
                }).click(function(){
                var t=n(this).attr("data-id");
                s.binded.set_value(t);
                s.binded.hide();
                t.length<=0&&(t=null);
                s.onSelect(t)
                })
            }),s.binded.set_value(s.id),n(this).click(function(){
            return s.binded.toggle(),!1
            }),s.dropDown.data("state","closed"),h.parent().append(s.dropDown),s.binded.position(),s.container.click(function(){
            s.dropDown.is(":visible")&&s.binded.hide()
            }),s.dropDown.click(function(){
            return!1
            }).hide())
        })
    }
}(jQuery);
Helper=InventoryDashboard.Helpers.Helper,function(n){
    (function(t){
        var i=function(){
            function t(){
                var t,i;
                this.animation=!0;
                t=this;
                this.financialMonth=1;
                this.startDayOfWeek=1;
                this.useISOWeek=!0;
                i=function(t,i,r,u,f){
                    var e=f,o;
                    return f?Helper.sendCatchError(f):(arguments&&arguments.callee&&arguments.callee.caller&&(e=arguments.callee.caller()),o={
                        message:t,
                        line:r,
                        file:i,
                        column:u,
                        error:e
                    },n.Helpers.Helper.sendErrorDetail(-1,o,window.location.href,"")),!0
                    };
                    
                window.onerror=i;
                $(function(){
                    try{
                        $(document).ajaxError(function(n,t,i,r){
                            if(t.status===401)Helper.dialog($s.labels.Your_session_has_expired,function(){
                                location.reload()
                                });
                            else if(t.status===550){
                                var u=t.responseText?t.responseText:r;
                                Helper.dialog(u)
                                }else Helper.sendError(t)
                                });
                        $(window).resize(function(){
                            $("span.field-validation-error").each(function(){
                                $(this).position({
                                    my:"left top",
                                    at:"left bottom",
                                    collision:"none",
                                    of:$("#"+$(this).attr("data-valmsg-for"))
                                    })
                                });
                            $("div.video-popup, div.popup").length>0&&$("div.video-popup, div.popup").position({
                                my:"center",
                                at:"center center-100px",
                                of:window,
                                collision:"fit"
                            })
                            });
                        Helper.setWizard();
                        $("div.help-bar a.close").click(function(n){
                            return $.get("/Home/_ToggleHelpBar"),$(this).parent().slideUp(),$("#mnuHelp #aShowHelp").show(),n.preventDefault(),!1
                            });
                        $("#mnuHelp #aShowHelp").click(function(n){
                            return $.get("/Home/_ToggleHelpBar"),$(this).hide(),$("div.help-bar").slideDown(),n.preventDefault(),!1
                            });
                        n.Helpers.Helper.dropDownMenu("a.profile","#mnuProfile");
                        n.Helpers.Helper.dropDownMenu("a.help-support","#mnuHelp");
                        $("a[data-video]").click(function(t){
                            return n.Helpers.Popups.videoPopup(this),Helper.preventDefault(t)
                            });
                        $("a[data-export=print]").click(function(n){
                            return window.print(),n.preventDefault(),!1
                            });
                        $("div.helper > a.close").click(function(n){
                            var t=$(this).attr("href");
                            return n.preventDefault(),$.ajax({
                                url:t,
                                type:"POST",
                                cache:!1,
                                data:{
                                    name:"X-Requested-With",
                                    value:"XMLHttpRequest"
                                }
                            }),$(this).parent().fadeOut(),!1
                            });
                    n.Helpers.Helper.dropDownMenu("div.manage-my","ul.manage-my");
                    $(document).tooltip&&$(document).tooltip({
                        show:{
                            delay:800
                        },
                        position:{
                            my:"center bottom-30",
                            at:"top center",
                            using:function(n,t){
                                $(this).css(n);
                                $("<div>").addClass("ui-tooltip-arrow").addClass(t.vertical).addClass(t.horizontal).appendTo(this)
                                }
                            }
                    });
                t.dropdown()
                }catch(i){
                Helper.sendCatchError(i)
                }
            })
    }
    return t.prototype.dropdown=function(){
    var t=1e3,n=null;
    $(document).on("click","dl.dropdown dt",function(){
        n=$(this).parent();
        $("dl.dropdown dd").not(n.children("dd")).hide();
        n.children("dd").toggle().css("z-index",t);
        t++
    });
    $(document).click(function(n){
        $(n.target).parents("dl.dropdown").length===0&&$("dl.dropdown dd").hide()
        });
    $(document).on("click","dl.dropdown li",function(){
        var n=$(this),t=n.parent().parent().parent(),u=n.attr("data-id"),f,r,i;
        if(t.children("dd").hide(),n.attr("data-link")!=null)window.location.replace(n.attr("data-link"));
        else if(t.attr("data-formula")!=null)f=n.attr("data-name"),$s.editor.setKpi(u,f);
        else if(t.children("dt").html(n.html()),$("#"+t.attr("data-input-id")).val(u),t.attr("data-function")!=null){
            for(r=(t.attr("data-function")||"").split("."),i=window[r.shift()];r.length>0;)i=i[r.shift()];
            typeof i=="function"&&i(u,n.html())
            }
        });
$(document).bind("click",function(n){
    var t=$(n.target);
    t.parents().hasClass("dropdown")||$(".dropdown dd").hide()
    })
},t.prototype.messages=function(n,t,i){
    function o(){
        $.ajax({
            cache:!1,
            contentType:"application/json",
            dataType:"json",
            type:"post",
            url:n,
            context:document.body,
            success:function(n){
                r=n
                },
            complete:function(){
                var t,n;
                if(l(),i!=null){
                    for(t=-1,n=0;n<r.length;n++)r[n].MessageID===i&&(t=n);
                    a(t);
                    i=null
                    }
                }
        })
}
function l(){
    var n=0;
    r!=null&&(n=r.length);
    u.hide();
    u.empty();
    n<=0?(h._messagePopup.append('<h3 style="text-align:center;margin-top:50px">'+$s.labels.You_dont_have_any_messages+"<\/h3>"),$("a.messages").html("")):y()
    }
    function y(){
    var s=r.length,t=e*10,w=t-9,h,v=0,y,p,b,c,f,i,n;
    for(t>s&&(t=s),y=$("<h3>"+$s.labels.Messages+" "+w+" "+$s.labels.to+" "+t+" "+$s.labels.of+" "+s+"<\/h3>").appendTo(u),e===1&&s>t?h=$('<a href="#" data-page="2">'+$s.labels.View_older_messages+"<\/a>").appendTo(y):e===2&&(h=$('<a href="#" data-page="1">'+$s.labels.View_newer_messages+"<\/a>").appendTo(y)),h!=null&&h.click(function(n){
        return e=Number($(this).attr("data-page")),l(),n.preventDefault(),!1
        }),p=$('<table class="messages"><\/table>').appendTo(u),p.append('<thead>  <tr>      <th class="checkbox"><input id="chkMHead" type="checkbox"/><\/th>\t    <th class="subject">'+$s.labels.Subject+'<\/th>\t    <th class="date">'+$s.labels.Received+'<\/th>\t    <th class="delete">'+$s.labels.Delete+"<\/th>  <\/tr><\/thead>"),b=$("<tbody><\/tbody>").appendTo(p),c=!0,f=w-1;f<t;f++)i="",n=r[f],n.ReadOn!=null&&(n.ReadOn=moment(n.ReadOn)),n.ReceivedOn=moment(n.ReceivedOn),c?(i="alt ",c=!1):(i="",c=!0),n.ReadOn!==null?i=i+"marked":v++,b.append('<tr index="'+f+'" class="'+i+'">\t<td class="checkbox"><input type="checkbox" name="chkSelect" value="'+n.MessageID+'" /><\/td>\t<td class="subject">'+n.Subject+'<\/td>\t<td class="date">'+n.ReceivedOn.format("DD MMM YYYY")+'<\/td>\t<td align="center"><a message-id="'+n.MessageID+'" href="/Home/_MessagesDelete" class="delete-icon sprite" title="'+$s.labels.Delete+'"><\/a><\/td><\/tr>');
    v>0?$("a.messages").html(v.toString()):$("a.messages").html("");
    u.append('<h4><a id="btnMDelete" href="/Home/_MessagesDelete" class="button-red" style="float:right">'+$s.labels.Delete+'<\/a>&nbsp;&nbsp;<a id="btnMMark" href="/Home/_MessagesMark" class="button-blue" style="float:right">'+$s.labels.Mark_as_read+"<\/a><\/h4>");
    $("#chkMHead").change(function(){
        $('input[name="chkSelect"]').prop("checked",$(this).prop("checked"))
        });
    $("#btnMDelete, #btnMMark").click(function(n){
        var t={
            id:""
        };
        
        return $('input[name="chkSelect"]').each(function(n,i){
            $(i).prop("checked")&&(t.id+=$(i).val()+"#")
            }),$.post($(this).attr("href"),t,function(n){
            n.success&&o()
            }),n.preventDefault(),!1
        });
    $("a.delete-icon").click(function(n){
        var t={
            id:$(this).attr("message-id")
            };
            
        return $.post($(this).attr("href"),t,function(n){
            n.success&&o()
            }),n.preventDefault(),!1
        });
    $("td.subject, td.date").click(function(n){
        return a(Number($(this).parent().attr("index"))),n.preventDefault(),!1
        });
    u.show()
    }
    function a(n){
    var t=r[n],e,i;
    t!=null&&(u.hide(),f.empty(),e=$("<h5><b>"+t.Subject+"<\/b><span>"+moment(t.ReceivedOn).format("Do MMM YYYY &#97;&#116; HH:mm")+'<\/span><br class="clear"/><\/h3>').appendTo(f),i=$('<div class="body"><\/div>').appendTo(f),$.post("/Home/_MessageBody",{
        id:t.MessageID
        },function(n){
        i.append(n[0].Body)
        }),f.append('<h4><a id="btnMBack" href="#" class="button-blue gradient">'+$s.labels.Back_to_messages+"<\/a><\/h4>"),$.post("/Home/_MessagesMark",{
        id:t.MessageID
        }),$("#btnMBack").click(function(n){
        return f.hide(),o(),n.preventDefault(),!1
        }),f.show())
    }
    var h=this,r,e=1,v=$('<div class="popup-overlay"><\/div>').appendTo($("body")),s,c,u,f;
this._messagePopup=$('<div class="popup"><\/div>').appendTo($("body"));
s=$('<h2 class="sprite messages-icon"><span>'+t+"<\/span><\/h2>").appendTo(this._messagePopup);
c=$('<a href="#">X<\/a>').appendTo(s);
this._messagePopup.draggable({
    handle:s
});
u=$("<div><\/div>").appendTo(this._messagePopup);
f=$('<div style="display:none;"><\/div>').appendTo(this._messagePopup);
f.append('<img class="loader" src="/Content/images/ajax-loader.gif"><\/img>');
this._messagePopup.position({
    my:"center",
    at:"center center-100px",
    of:window,
    collision:"fit"
});
$(c).click(function(n){
    return v.remove(),h._messagePopup.remove(),Helper.preventDefault(n)
    });
o()
},t
}();
t.Shared=i
})(n.Views||(n.Views={}));
var t=n.Views
}(InventoryDashboard||(InventoryDashboard={}));
$s=new InventoryDashboard.Views.Shared