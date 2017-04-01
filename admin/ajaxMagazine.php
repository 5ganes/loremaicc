<style>
	.ffew{ margin:2px 0 0 0; padding:0;}
</style>

	<tr>
    	<td width="90"><strong>Description : </strong></td>
    	<td>
    		<textarea name="contents" style="width:400px; height:60px;padding:5px;"><?=$groupRow['contents'];?></textarea>
    	</td>
	</tr>
    <tr><td></td></tr>
    <tr>
    	<td width="90"><strong>Upload File : </strong></td>
    	<td>
        	<? if(isset($groupRow['file']))
			{?>
        		<div><?=$groupRow['file'];?></div>
    		<? }?>
            <input type="file" name="file" />
    	</td>
	</tr>
    <tr>
    	<td width="90"><strong>Publish : </strong></td>
    	<td>
    		<label>
                <input name="publish" type="radio" id="featured_0" value="No" checked="checked" />
                No
            </label>
            <label>
                <input type="radio" name="publish" value="Yes" id="featured_1" <? if($groupRow['publish'] == 'Yes') echo 'checked="checked"';?> />
                Yes
            </label>
    	</td>
	</tr>