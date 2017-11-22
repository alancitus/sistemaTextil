
    

    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.22/themes/redmond/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="http://www.ok-soft-gmbh.com/jqGrid/jquery.jqGrid-4.4.0/css/ui.jqgrid.css" />
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.22/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://www.ok-soft-gmbh.com/jqGrid/jquery.jqGrid-4.4.0/js/i18n/grid.locale-en.js"></script>
    <script type="text/javascript">
        $.jgrid.no_legacy_api = true;
        $.jgrid.useJSON = true;
    </script>
    <script type="text/javascript" src="http://www.ok-soft-gmbh.com/jqGrid/jquery.jqGrid-4.4.0/js/jquery.jqGrid.src.js"></script>

    <script type="text/javascript">
    //<![CDATA[
    $(function () {
        'use strict';
        var mydata = [],
            $grid = $("#list"),
            initDateEdit = function (elem) {
                $(elem).datepicker({
                    dateFormat: 'dd-M-yy',
                    autoSize: true,
                    changeYear: true,
                    changeMonth: true,
                    showButtonPanel: true,
                    showWeek: true
                });
            },
            initDateSearch = function (elem) {
                setTimeout(function () {
                    $(elem).datepicker({
                        dateFormat: 'dd-M-yy',
                        autoSize: true,
                        changeYear: true,
                        changeMonth: true,
                        showWeek: true,
                        showButtonPanel: true
                    });
                }, 100);
            },
            numberTemplate = {formatter: 'number', align: 'right', sorttype: 'number',
                editrules: {number: true, required: true},
                searchoptions: { sopt: ['eq', 'ne', 'lt', 'le', 'gt', 'ge', 'nu', 'nn', 'in', 'ni'] }};
        $grid.jqGrid({
            data: mydata,
            datatype: "local",
                colNames:['1','2', '3', '4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27'],
        colModel:[
            {name:'id',index:'id', sorttype:"int", editable:true},
            {name:'c2',index:'c2', sorttype:"date", editable:true},
            {name:'c3',index:'c3', editable:true},
            {name:'c4',index:'c4', align:"right",sorttype:"float", editable:true},
            {name:'c5',index:'c5', align:"right",sorttype:"float", editable:true},      
            {name:'c6',index:'c6', align:"right",sorttype:"float", editable:true},      
            {name:'c7',index:'c7',  sortable:false, editable:true}      ,       
            {name:'c8',index:'c8',  sortable:false, editable:true}  ,       
            {name:'c9',index:'c9',   sortable:false, editable:true} ,       
            {name:'c10',index:'c10', sortable:false, editable:true} ,       
            {name:'c11',index:'c11', sortable:false, editable:true} ,       
            {name:'c12',index:'c12', sortable:false, editable:true} ,       
            {name:'c13',index:'c13', sortable:false, editable:true} ,       
            {name:'c14',index:'c14', sortable:false, editable:true} ,       
            {name:'c15',index:'c15', sortable:false, editable:true} ,       
            {name:'c16',index:'c16', sortable:false, editable:true} ,       
            {name:'c17',index:'c17', sortable:false, editable:true} ,       
            {name:'c18',index:'c18', sortable:false, editable:true} ,       
            {name:'c19',index:'c19', sortable:false, editable:true} ,       
            {name:'c20',index:'c20', sortable:false, editable:true} ,       
            {name:'c21',index:'c21', sortable:false, editable:true} ,       
            {name:'c22',index:'c22', sortable:false, editable:true} ,       
            {name:'c23',index:'c23', sortable:false, editable:true} ,       
            {name:'c24',index:'c24', sortable:false, editable:true} ,       
            {name:'c25',index:'c25', sortable:false, editable:true} ,       
            {name:'c26',index:'c26', sortable:false, editable:true} ,       
            {name:'c27',index:'c27', sortable:false, editable:true} 
        ],
            pager: '#pager',
            rowNum: 10,
            rowList: [5, 10, 20, 50],
            sortname: 'id',
            sortorder: 'asc',
            viewrecords: true,
            gridview: true,
            height: "100%",
            caption: "Demonstrate how to produce Warning message"
        });
        $grid.jqGrid('navGrid', '#pager', {add: false, edit: false, del: false});
        $grid.jqGrid('navButtonAdd',"#pager", {
            caption: "Click me!",
            onClickButton: function () {
                var alertIDs = {themodal:'alertmod',modalhead:'alerthd',modalcontent:'alertcnt'};
                if ($("#"+alertIDs.themodal).html() === null) {
                    $.jgrid.createModal(alertIDs,"<div>"+$.jgrid.nav.alerttext+"</div><span tabindex='0'><span tabindex='-1' id='jqg_alrt'></span></span>",
                        {gbox:"#gbox_"+$.jgrid.jqID(this.p.id),jqModal:true,drag:true,resize:true,
                        caption:$.jgrid.nav.alertcap,
                        top:100,left:100,width:200,height: 'auto',closeOnEscape:true,
                        zIndex: null},"","",true);
                }
                $.jgrid.viewModal("#"+alertIDs.themodal,{gbox:"#gbox_"+$.jgrid.jqID(this.p.id),jqm:true});
                $("#jqg_alrt").focus();
            }
        });
    });
    //]]>
    </script>
<div class="row">
<div class="col-md-12">
<table id="list" class="table-responsive"><tr><td/></tr></table>
<div id="pager"/>
</div>
</div>
</div>