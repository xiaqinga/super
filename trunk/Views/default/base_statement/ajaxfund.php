<?php if(!empty($list)){?>
    <table class="sui-table table-bordered-simple">
        <thead>
        <tr class="thbg">
            <th colspan="4"></th>
        </tr>
        <tr class="thbk">
            <th class="center">学校名称</th>
            <th class="center">基金金额</th>
            <th class="center">来源</th>
            <th class="center">接收时间</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $rs){?>
            <tr>
                <td class="center"><?php echo $rs['name'];?></td>
                <td class="center"><?php echo $rs['income'];?></td>
                <td class="center"><?php echo $rs['accout'].'('.$rs['ordersNo'].')';?></td>
                <td class="center"><?php echo $rs['createDate'];?></td>

            </tr>
        <?php }?>
        </tbody>
    </table>
<?php }else{?>
    <table class="sui-table table-bordered-simple">
        <tbody>
        <tr>
            <td class="center">亲，还没有记录</td>
        </tr>
        </tbody>
    </table>
<?php }?>

<?php echo assets::$sayimo; ?>
