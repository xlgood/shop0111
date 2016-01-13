

namespace Admin\Model;


use Think\Model;
use Think\Page;

class <?php echo $name ?>Model extends BaseModel{
    //进行自动验证
    protected $_validate = array(
    <?php foreach($fields as $field){
        //id和可以为空的字段不生成验证规则
        if($field['null']=='YES'){
            continue;
        }
        echo "array('{$field['field']}','require','{$field['comment']}不能为空！'), \r\n";
    } ?>
    );


}