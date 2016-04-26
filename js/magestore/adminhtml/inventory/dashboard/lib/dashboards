var InventoryDashboard;
var $_ = jQuery.noConflict();
(function(n){
    (function(t){
        var i=function(){
            function t(){
                this.animation=!0;
                this.views={};
                
                this.pageBreakCounter=0
                }
                return t.prototype.init=function(){
                var t=this;
                $_(function(){
                    try{
                        $s.animation=typeof hiqPdfConverter=="undefined";
                        $_("#ulTabs").sortable({
                            handle:"b",
                            forceHelperSize:!0,
                            revert:!0,
                            tolerance:"pointer",
                            update:function(){
                                t.saveTabOrder()
                                }
                            });
                    $_("#ulTabs > li.add").disableSelection();
                    t.isShare||($_("div.sortable").sortable({
                        connectWith:"div.sortable",
                        handle:"div.options",
                        placeholder:"placeholder",
                        opacity:.6,
                        cursorAt:{
                            left:150,
                            top:20
                        },
                        delay:200,
                        forceHelperSize:!0,
                        revert:!0,
                        tolerance:"pointer",
                        cursor:"move",
                        start:function(n,t){
                            t.helper.css("width","30%")
                            },
                        update:function(n,i){
                            var u=i.item.find("div.view, div.view-hidden"),r=u.attr("id");
                            t.views[r]&&t.views[r].reload(!1);
                            t.saveViewPositions()
                            }
                        }),$_("div.column > div").disableSelection());
                n.Helpers.Helper.dropDownMenu("li.dashboard-export","div.dashboard-dropmenu");
                    $_("a.add-dash").click(function(n){
                    var t=$_(this);
                    return t.hasClass("selected")?(t.removeClass("selected"),$_("div.form-dropdown").slideUp()):$.ajax({
                        url:t.attr("href"),
                        type:"GET",
                        cache:!1,
                        data:{
                            name:"X-Requested-With",
                            value:"XMLHttpRequest"
                        },
                        success:function(n){
                            $_("#dvAdd").html(n);
                            t.addClass("selected");
                            $_("#dvAdd").show().position({
                                my:"left top",
                                at:"left bottom",
                                collision:"none",
                                of:t
                            }).hide().slideDown();
                            $.validator.unobtrusive.parse("#dvAdd")
                            }
                        }),n.preventDefault(),!1
                    });
                $_("#dvAdd").on("click","a.cancel",function(n){
                    return $_("a.add-dash").removeClass("selected"),$_("div.form-dropdown").slideUp(),n.preventDefault(),!1
                    });
                $_("#ulTabs > li").length<=1&&$_("a.add-dash").click();
                t.backgroundColour&&($_("body").css("background-color",t.backgroundColour),t.backgroundColour==="#808080"&&$_("div.dash-content-area > h1").css("color","#FFFFFF"));
                ($_("#tblNoViews").length||$_("div.dash-create-message2").length)&&$_("#liAddView > a").trigger("click");
                t.loadNextDash()
                }catch(i){
                Helper.sendCatchError(i)
                }
            })
    },t.prototype.embedInit=function(){
    var n=this;
    $_(function(){
        try{
            $s.animation=!0;
            n.loadNextDash()
            }catch(t){
            Helper.sendCatchError(t)
            }
        })
},t.prototype.loadNextDash=function(){
    if($_("div.inventory-view-item[data-loaded=false]").length)try{        
        var t=$_("div.inventory-view-item[data-loaded=false]:first"),i="dvView"+t.attr("data-view-id"),r=t.attr("data-view-type");
        this.views[i]=new n.KPIViews[r](this.options,i,t,this);
        this.views[i].loadView(this)
        }catch(u){
        Helper.sendCatchError(u)
        }else typeof hiqPdfConverter!="undefined"&&window.setTimeout(hiqPdfConverter.startConversion,500)
        },t.prototype.saveViewPositions=function(){        
    var n={},t=[];    
    $_("div.column").each(function(){              
        var i=$_(this).attr("data-col"),n=1;
        $_(this).find("div.inventory-view-item").each(function(){
            t.push({
                ViewID:$_(this).attr("data-view-id"),
                Column:i,
                Row:n
            });
            n++
        })
        });    
    n.Positions=$_.toJSON(t);
    n.form_key = form_key_dashboard;    
    $_.ajax({
        cache:!1,
        traditional:!0,
        dataType:"json",
        type:"POST",
        url:saveViewPositions,
        context:document.body,
        data:n
    })
    },t.prototype.saveTabOrder=function(){
    var n={},t="";
    $_("#ulTabs > li").each(function(){
        var n=$_(this).attr("data-item-id");
        n&&(t+=n+",")
        });
    n.DashboardIDs=t;
    n.form_key = form_key_dashboard;
    $_.ajax({
        cache:!1,
        traditional:!0,
        dataType:"json",
        type:"POST",        
        url:saveTabPositions,
        context:document.body,
        data:n
    })
    },t.settings=function(){
    try{
        n.Views.Dashboards.controlLoad("Settings");
        n.Views.Dashboards.settingsInit()
        }catch(t){
        Helper.sendCatchError(t)
        }
    },t.settingsInit=function(){
    $_(function(){
        try{
            var n=$_("input[id=Layout]").val();
            $_("#ulLayout > li[data-value="+n+"]").addClass("selected");
            $_("#ulLayout > li").click(function(n){
                var t=$_(this).attr("data-value");
                return t&&($_("input[id=Layout]").val(t),$_("#ulLayout > li").removeClass("selected"),$_(this).addClass("selected")),n.preventDefault(),!1
                });
            $_("i[data-link]").click(function(n){
                var t=$_(this);
                return $_("i[data-link="+t.attr("data-link")+"]").removeClass("selected"),t.addClass("selected"),$_("input#"+t.attr("data-link")+"").val(t.attr("data-value")),n.preventDefault(),!1
                })
            }catch(t){
            Helper.sendCatchError(t)
            }
        })
},t.settingsSave=function(){
    try{
        n.Views.Dashboards.controlCancel();
        location.reload()
        }catch(t){
        Helper.sendCatchError(t)
        }
    },t.share=function(){
    try{
        var t=$_("#SharedToGroups").val(),i=$_("#SharedToUsers").val();
        n.Views.Dashboards.controlLoad("Share");
        $_("a#aGroups").multiselector({
            labelSingular:$s.labels.Group,
            labelPlural:$s.labels.Groups,
            labelAll:$s.labels.All_Groups,
            allWhenEmpty:!1,
            data:$s.groups,
            itemIds:t,
            isGroup:!0,
            onDone:function(n){
                $_("#SharedToGroups").val(n)
                }
            });
    $_("a#aUsers").multiselector({
        labelSingular:$s.labels.User,
        labelPlural:$s.labels.Users,
        labelAll:$s.labels.All_Users,
        allWhenEmpty:!1,
        data:$s.users,
        itemIds:i,
        onClear:function(){},
        onDone:function(n){
            $_("#SharedToUsers").val(n)
            }
        })
}catch(r){
    Helper.sendCatchError(r)
    }
},t.shareInit=function(){
    $_(function(){
        try{
            $_("#aPublicShareGenerate").click(function(n){
                var t=$_(this);
                return $.ajax({
                    cache:!1,
                    type:"POST",
                    url:t.attr("href"),
                    data:[{
                        name:"X-Requested-With",
                        value:"XMLHttpRequest"
                    }],
                    success:function(n){
                        $_("#PublicShareLink").val(n)
                        }
                    }),n.preventDefault(),!1
                })
        }catch(n){
        Helper.sendCatchError(n)
        }
    })
},t.shareSave=function(){
    try{
        n.Views.Dashboards.controlCancel();
        var t=$_("#SharedToGroups").val(),i=$_("#SharedToUsers").val();
        t=t.length<=1?"0":t.split(",").length.toString();
        i=i.length<=1?"0":i.split(",").length.toString();
        $_("div.dash-controls-holder > p").remove();
        (t>0||i>0)&&$_("div.dash-controls-holder").prepend("<p>"+$s.labels.This_dashboard_is_shared_with+"<\/p>")
        }catch(r){
        Helper.sendCatchError(r)
        }
    },t.addSave=function(n){
    try{
        parseInt(n,10)>0&&(window.location.href="/Dashboards/Index/"+n)
        }catch(t){
        Helper.sendCatchError(t)
        }
    },t.dashboardDelete=function(){
    try{
        $_("#dvSettings").slideUp();
        $_("#ulControls li").removeClass("selected");
        window.location.replace("/Dashboards")
        }catch(n){
        Helper.sendCatchError(n)
        }
    },t.dashboardViewDelete=function(n){
    try{
        $_("div[data-view-id="+n+"]").remove()
        }catch(t){
        Helper.sendCatchError(t)
        }
    },t.kpiViews=function(){
    try{
        n.Views.Dashboards.controlLoad("AddView")
        }catch(t){
        Helper.sendCatchError(t)
        }
    },t.controlLoad=function(t){
    var i=$_("#dvSettings").attr("data-selectedItem");
    i===t?n.Views.Dashboards.controlCancel():($_("div.dash-create-message2").length?$_("div.dash-create-message2").slideDown(400,function(){
        $_(this).delay(6e3).slideUp(400,function(){
            $_("#dvSettings:hidden").slideDown(400,function(){
                $_("div.dash-create-message").show().animate({
                    opacity:1,
                    top:"-=30"
                },800,function(){})
                })
            })
        }):$_("#dvSettings:hidden").slideDown(400,function(){
        $_("div.dash-create-message").animate({
            opacity:1,
            top:"-=30"
        },800,function(){})
        }),$_("#ulControls li").removeClass("selected"),$_("#li"+t).addClass("selected"),$_("#dvSettings").attr("data-selectedItem",t));
    $_(function(){
        $_("#dvSettings a.cancel").click(function(t){
            return n.Views.Dashboards.controlCancel(),Helper.preventDefault(t)
            })
        })
    },t.controlCancel=function(){
    $_("#dvSettings").attr("data-selectedItem","").slideUp();
    $_("#ulControls li").removeClass("selected")
    },t.embedSettingsInit=function(){
    $_(function(){
        try{
            $_("#aEmbedGenerate").click(function(n){
                var t=$_(this),i=t.attr("data-clear")==="true",r=[{
                    name:"X-Requested-With",
                    value:"XMLHttpRequest"
                },{
                    name:"clear",
                    value:i
                }];
                return $.ajax({
                    cache:!1,
                    type:"POST",
                    url:t.attr("href"),
                    data:r,
                    success:function(n){
                        $_("#EmbedLink").val(n);
                        t.attr("data-clear",(!i).toString());
                        i?t.text($s.labels.Generate_code):t.text($s.labels.Clear_code)
                        }
                    }),n.preventDefault(),!1
                })
        }catch(n){
        Helper.sendCatchError(n)
        }
    })
},t
}();
t.Dashboards=i
})(n.Views||(n.Views={}));
var t=n.Views
})(InventoryDashboard||(InventoryDashboard={}))