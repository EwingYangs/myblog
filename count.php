<?php

//1.先制作一个空的二维数组，值都为0；
//2.根据方向决定x,y的自加1，条件是不能出去或者还有没有被占用，没有被占用可以用值等于0来表示
//3.输出数组变成图形
function jisuan($num){
	if($num < 3)
		die('must greater than 2 !');
	//先构造一个空数据
	$arr = array();
	for($i=0;$i<$num;$i++){
		for ($j=0; $j <$num ; $j++) { 
			$arr[$i][$j] = 0;
		}
	}
	//计算最大的值
	$max = $num*$num+$num-1;
	//定义x,y的坐标
	$x=$y=0;
	//定义方向  r(右),l(左),u(上),d(下)
	$direction = 'r';
	//循环$num~$max之间的数值
	for ($i=$num; $i <= $max ; $i++) { 
		if($arr[$x][$y] == 0){
			$arr[$x][$y] = $i;
		}else{
			//如果方向为右,判断
			if($direction == 'r'){
				//并且没有超出范围还有位置没有被占用,y++
				if(($y+1) < $num && $arr[$x][$y+1] == 0){
					$y++;
				}else{
					//如果占用了就改变方向
					$direction = 'd';
				}
			}
			//如果方向为下,判断
			if($direction == 'd'){
				//并且没有超出范围还有位置没有被占用,x++
				if(($x+1) < $num && $arr[$x+1][$y] == 0){
					$x++;
				}else{
					//如果占用了就改变方向
					$direction = 'l';
				}
			}
			//如果方向为左,判断
			if($direction == 'l'){
				//并且没有超出范围还有位置没有被占用,y--
				if(($y-1) >= 0 && $arr[$x][$y-1] == 0){
					$y--;
				}else{
					//如果占用了就改变方向
					$direction = 'u';
				}
			}
			//如果方向为上,判断
			if($direction == 'u'){
				//并且没有超出范围还有位置没有被占用,x--
				if(($x-1) >= 0 && $arr[$x-1][$y] == 0){
					$x--;
				}else{
					//如果占用了就改变方向
					$direction = 'r';
					if($direction == 'r'){
						//并且没有超出范围还有位置没有被占用,y++
						if(($y+1) < $num && $arr[$x][$y+1] == 0){
							$y++;
						}else{
							//如果占用了就改变方向
							$direction = 'd';
						}
					}
				}
			}
			$arr[$x][$y] = $i;
		}
		
	}
	$str = '<table rules="all" style="border:1px solid red">';
	foreach($arr as $k=>$v){
		$str .= '<tr>';
			foreach ($v as $k1 => $v1) {
				$str .= '<td style="border:1px solid gray">';
				$str .= $v1;
				$str .= '</td>';
			}
		$str .= '</tr>';
	}
	$str .= '</table>';
	echo $str;
}
jisuan(15);

