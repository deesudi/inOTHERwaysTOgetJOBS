<script type="text/javascript">
            jQuery().ready(function (){
                jQuery("#tabel").jqGrid({
                    url:'<?php echo base_url().'jqgrid/tampil_datauser_unit' ?>',
                    mtype : "POST",
                    datatype: "json",
                    colNames:['id','username','password','nama','nama unit','group','active','Aksi'],
                    colModel:[
                         {name:'id',index:'id', width:30, autowidth: false,align:"left",editable:false,editrules:{required:true}},
                         {name:'username',index:'username', width:170,autowidth: false, align:"left",editable:true,editrules:{required:true}},
                        {name:'password',index:'password', width:150,autowidth: false, align:"left",editable:true,editrules:{required:true}},
                        {name:'user_nama',index:'user_nama', width:100, align:"left",editable:true,editrules:{required:true}},
                        {name:'nama_unit',index:'nama_unit', width:100, align:"left",editable:true,editrules:{required:true}, edittype:'select', editoptions:{value:{<?php echo "$varunit";?>}}},
                        {name:'nama_group',index:'nama_group', width:100, align:"left",editable:true,editrules:{required:true}, edittype:'select', editoptions:{value:{<?php echo "$vargroup";?>}}},
                        {name:'user_active',index:'user_active', width:50, align:"left",editable:true,editrules:{required:true}}, 
                        {name: 'myac', width:80, fixed:true, sortable:false, search:false, align:'center',  formatter:'actions',
                        formatoptions:{
                        keys:true,editbutton: true, delbutton: true, //Key True disini adalah untuk Shorcut Tombol Enter dan Esc, Enter untuk Save, dan Escape Untuk Batal, anda juga Membuatnya jadi False jika anda tidak ingin seperti itu
                        //Saya menghapus baris di bawah ini
                                                        /*onSuccess:function(jqXHR) {
                                                            alert(jqXHR.responseText);
                                                            return true;
                                                        }*/
                        }}
                        
                    ],
                    rowNum:20,
                    width: 900,
                    
                    height: 150,
                    rowList:[10,20,30,40,50,60,70],
                    pager: '#pager',
                    sortname: 'id_user',
                    viewrecords: true,
                    sortorder: "asc",
                    editurl: "<?php echo base_url().'jqgrid/crud_user_unit'?>",
                    multiselect: false,
                    caption:"Daftar User Per-Unit"
                }).navGrid('#pager');
            });    
            </script>  
        
            <table id="tabel"></table>
                
            <div id="pager"></div>