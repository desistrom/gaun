
<style type="text/css">
.detail_layanan{
    padding-top: 6em;
}
.content-tree{
    padding-left: 5em;
    padding-right: 5em;
}
.li-tree{
   
    color: white;
}
.tree{
    background-color:white;
    color:  #CF090A;
}
.tree li a{

}
  .tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative;

}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
  
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid;
}
.tree li {
    margin:0;
   
    
    padding:0 0 0 1em;
    line-height:2em;
    color: #747474;
    font-weight:700;
    position:relative;
    height: auto;
    overflow: hidden;
}
.tree li:hover{
    background-color: #CF090A;
    color: white;
}
.tree li:hover a{

    color: white;
}
.tree .dropdown:hover{
    background-color: white;
    color: #747474;
}
.tree .dropdown:hover a{

    color: #747474;
}
.tree .menu-parent,
.tree .branch
 {
    border-bottom: solid 1px  #E0E0E0;

}
.tree .dropdown  .sub-menu .menu-parent{
    border-bottom: none;
    padding-top: 0.5em;
    padding-bottom: 0.5em;
}
.tree .dropdown  .sub-menu .menu-parent:hover a{
    color: white;
}
.tree .dropdown .sub-menu{
    border-left: solid 1px  #E0E0E0;
}
.tree ul li:before {
   
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#fff;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color: #747474;
}
.tree .li-tree,
.tree .li-tree a
{

    color:white;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}
.inline-site{
    display: inline-table;
}
.menu{
    width: 15%;
    float: left;
     padding-top: 1em;
    padding-bottom: 1em;

    
}
.li-tree {
    background-color:#D2D2D2; 
}
.indicator {
    margin-top: 1em;
}
.sub-menu{
    width: 81%;
    
    float: right;
}
.menu:hover{

}
</style>
<section class="detail_layanan">
        <div class="container-fluid none-padding filter-title-page-news">
            <div class="col-md-12 col-sm-12 col-xs-12 none-padding title-page-news">
                <div class="line-news">
                    <div></div>
                </div>
                <div class="header-title">
                    <h1 style=""> Site Map </h1></div>
                    <div class="col col-md-12 col-sm-12 none-padding">
                        
                    </div>
                    <div class="content-tree">
                        <ul id="tree2">
                            <!-- <li class="li-tree"><a href="#">Menu</a>

                                <ul> -->
                                <?php echo $menu; ?>
                                    
                             <!--    </ul>
                            </li> -->
                        </ul>
                    </div>
                    
            </div>

        </div>

</section>
<script src="<?=base_url().'assets/js/jquery-3.2.1.min.js';?>"></script>
<!-- <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script> -->
<script type="text/javascript">
  $.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed();

$('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

$('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});

</script>