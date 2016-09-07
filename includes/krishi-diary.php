<style type="text/css">
	@font-face {
		font-family: "Preeti";
		src: url(font/Preeti.ttf) format("truetype");
	}
	.preetie { 
		font-family: "Preeti", Verdana, Tahoma;
	}
</style>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="span6">
                <i class="icon-flag page-title-icon"></i>
                <?php
		$d=mysql_fetch_array(mysql_query("select name from groups where urlname='krishi-diary'"));
		?>
                <h2><?=$d['name'];?></h2>
            </div>
            <div class="span6" style="float:right">
                <form action="index.php?action=krishi-diary" method="post" style="margin:0">
                    <input type="text" name="keyword" placeholder="search diary" style="margin:0 9px 0 0; width:60%;" />
                    <input type="submit" name="search" value="&#2326;&#2379;&#2332;&#2381;&#2344;&#2369;&#2361;&#2379;&#2360;" 
                    style="font-weight:bold; width:20%" />
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Services Full Width Text -->
<div class="services-full-width container" style="margin-top:0">
    <div class="row">
        <div class="services-full-width-text span12">
            <p>
            	<div class="magazine">
                
                	<div class="magazinesidebar">
                      	<ul>
                        	<h4><?=$d['name'];?></h4>
                        	<?
                            $cat=$categories->getByParentId(0);
							while($catGet=$conn->fetchArray($cat))
							{?>
                        		<li>
                                	<a href="krishi-diary/<?=$catGet['id'];?>">
										<?=$catGet['title'];?>
                                  	</a>
                              	</li>
                        	<? }?>
                        </ul>
                   	</div>
                  	<div class="magazinefile">
                  		<?
						if(isset($_POST['search']))
						{
							include("includes/search.php");	
						}
						else
						{?>
							<?
                            if(!isset($_GET['id']))
                            {
                                //echo "hi";
                                $diary=$groups->getById(1076);$diaryGet=$conn->fetchArray($diary); echo $diaryGet['contents'];
                            }
                            else if(isset($_GET['id']) and !isset($_GET['url']))
                            {?>
                                <ul>
                                    <p><span style="font-weight:bold; font-size:20px; text-decoration:underline">
                                        <?
                                            $catId=$_GET['id'];
                                            $cat=$categories->getById($catId);
                                            echo $cat['title'];
                                        ?>
                                    </span></p>
                                    <?
                                    $list=$categories->getByParentId($catId);
                                    $listCount=mysql_num_rows($list);
                                    if($cat['parentId']==0 and $listCount<1)
                                    {?>
                                        <div class="preetie">
                                                            <?
                                        $cont=$diary->getByCategoryId($catId);
                                        $contGet=$conn->fetchArray($cont);
                                        echo $contGet['contents'];?>
                                        </div>
                                    <? }
                                    else
                                    {
                                        //$list=$categories->getByParentId($catId);
                                        while($listRow=$conn->fetchArray($list))
                                        {?>
                                            <li><a href="krishi-diary/<?=$catId?>/<?=$listRow['id'];?>" style="text-decoration:underline"><?=$listRow['title'];?></a></li>
                                        <? }
                                    }?>
                                </ul>	
                            <? }
                            else
                            {?>
                                <ul>
                                    <p><span style="font-weight:bold; font-size:20px; text-decoration:underline">
                                        <?
                                            $catId=$_GET['url'];
                                            $cat=$categories->getById($catId);
                                            echo $cat['title'];
                                        ?>
                                    </span></p>
                                    <?
                                    $list=$diary->getByCategoryId($catId);
                                    $listCount=mysql_num_rows($list);
                                    if($cat['parentId']!=0 and $listCount==1)
                                    {
                                        //echo $catId;
                                        //$cont=$diary->getByCategoryId($catId);
                                        $contGet=$conn->fetchArray($list);
                                        echo $contGet['contents']; //echo "hi";
                                    }
                                    else
                                    {?>
                                        <table width="100%"  border="0" cellpadding="4" cellspacing="0">
                                            <tr bgcolor="#F1F1F1" class="tahomabold11">
                                                <td width="1">&nbsp;</td>
                                                <td><strong>S.N.</strong></td>
                                                <td><b>Organization</b></td>
                                                <td><b>Phone</b></td>
                                                <td><b>Fax</b></td>
                                                <td><b>Email</b></td>
                                                <td><b>Website</b></td>
                                            </tr>
                                            <?
                                            $cat=$_GET['url']; $counter=0;
                                            $diary=$diary->getByCategoryId($cat);
                                            while($row=$conn->fetchArray($diary))
                                            {?>
                                                <tr <?php if($i%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                                                    <td valign="top">&nbsp;</td>
                                                    <td valign="top"><?=++$i;?></td>
                                                    <td valign="top"><?= $row['name'] ?></td>
                                                    <td valign="top"><?=$row['phone'];?></td>
                                                    <td valign="top"><?=$row['fax'];?></td>
                                                    <td valign="top"><?=$row['email'];?></td>
                                                    <td valign="top"><?=$row['website'];?></td>
                                                </tr>
                                            <? }?>
                                        </table>
                                    <? }?>
                                </ul>
                            <? }?>
                        <? }?>
                  	</div>
                 	<div style="clear:both"></div>
                            
                </div>
            </p>
        </div>
    </div>
</div>