var supplyneedsGridControl = Class.create();
supplyneedsGridControl.prototype = {

    //**********************************************************************************************************************************
    //initialize object
    initialize: function(grid, targetInputId, mainFieldPrefix, restoreValueCallback){

        this.grid = grid;
        this.grid.supplyneedsObject = this;
        this.targetInputId = targetInputId;
        this.mainFieldPrefix = mainFieldPrefix;
        this.changes = new Array();
        this.restoreValueCallBack = restoreValueCallback;
		
        grid.initCallback = this.initGrid;

        this.initGrid(this.grid);
    },
    //log change for control
    logChange: function(fieldId, initialValue){
        var elt = document.getElementById(fieldId);
        var value = "";
        switch(elt.type)
        {
            case 'checkbox':
                value = (elt.checked ? 1 : 0);            
                break;
            default:
               value = elt.value;
                break;
        }
        this.changes[this.changes.length] = new Array(fieldId, value);
    },
     //Init grid (when updated)
    initGrid: function(grid){
	
        var pgc = grid.supplyneedsObject;
	
        pgc.restoreChanges();
		
        //call callback for each item
        var ids = pgc.getIds();
        var id;
        for (var i=0; i < ids.length; i++)
        {
            id =  ids[i];
            if (pgc.restoreValueCallBack)
                pgc.restoreValueCallBack(id);
        }
		
    },
     restoreChanges: function(){
        for(i=0;i<this.changes.length ;i++)
        {
            if (document.getElementById(this.changes[i][0]))
            {
                var elt = document.getElementById(this.changes[i][0]);
                switch(elt.type)
                {
                    case 'checkbox':
                        elt.checked = (this.changes[i][1] == 1);
                        break;
                    default:
                        elt.value = this.changes[i][1];
                        break;
                }
                
                
            }
        }
    },
    //return displayed ids
    getIds: function(){
        var ids = new Array();
        var inputs = document.getElementsByTagName('input');
        for (i=0; i < inputs.length; i++)
        {
            if (inputs[i] && inputs[i].id != null)
            {
                if (inputs[i].id.indexOf(this.mainFieldPrefix) != -1)
                {
                    var id = inputs[i].id.replace(this.mainFieldPrefix, '');
                    ids[ids.length] = id;
                }
            }
        }
		
        return ids;
    },
    storeLogInTargetInput: function(){
	
        document.getElementById(this.targetInputId).value = '';

        for (var i=0; i < this.changes.length; i++)
        {
            var key = this.changes[i][0];
            var value = this.changes[i][1];
            document.getElementById(this.targetInputId).value += key + '=' + value + ';';
        }
		
    }
}