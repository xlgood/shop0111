<extend name="Common:index"/>
<block name="list">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th><input type="checkbox" class="id"/>品牌ID</th>
                <?php foreach($fields as $field): ?>
                <th><?php echo $field['comment'] ?></th>
                <?php endforeach; ?>
                <th>操作</th>
            </tr>
            <volist name="rows" id="row">
                <tr>
                    <td><input type="checkbox" name="id[]" class="ids" value="{$row.id}" />{$row.id}</td>
                    <?php foreach($fields as $field){
                        if($field['field']=='name'){
                            echo "<td class=\"first-cell\"><span>{\$row.name}</span></td>";
                        }elseif($field['field']=='status'){
                            echo '<td align="center"><a class=\"ajax-get\" href="{:U(\'changeStatus\',array(\'id\'=>\$row[\'id\'],\'status\'=>1-\$row[\'status\']))}\"><img src="__IMG__/{\$row.status}.gif" /></a></td>';
                        }else{
                            echo "<td align=\"center\">{\$row.{$field['field']}}</td>";
                        }
                    }
                    ?>



                    <td align="center">
                        <a href="{:U('edit',array('id'=>$row['id']))}" title="编辑">编辑</a> |
                        <a class="ajax-get" href="{:U('changeStatus',array('id'=>$row['id']))}" title="移除">移除</a>
                    </td>
                </tr>
            </volist>
        </table>
        <div id="turn-page" class="page">
            {$pageHtml}
        </div>
    </div>
</block>