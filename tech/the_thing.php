#Developer :白雲天狗(戚雲飛) yuhs(鍾宇翔)
#開發者 :白雲天狗(戚雲飛) yuhs(鍾宇翔) 
<!DOCTYPE html PUBLIC >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NMSL</title>
</head>
<body>
<form action="" method="POST">
    in:<textarea name="data" cols="" rows="" style="width: 300px; height: 200px"></textarea>
            <input type="submit" value="傳送"/>
</form>

<?php

function combination($arr,$m){	//字串排列組合
	$result = array();
        if($m == 1){
            return $arr;
        }
        if($m == count($arr)){
            $result[] = implode(',',$arr);
            return $result;
        }
        $temp_firstelement = $arr[0];
        unset($arr[0]);
        $arr = array_values($arr);
        $temp_first1 = combination($arr,$m - 1);
        foreach($temp_first1 as $s){
            $s = $temp_firstelement.','.$s;
            $result[] = $s;
        }
        unset($temp_first1);
        $temp_first2 = combination($arr,$m);
        foreach($temp_first2 as $s){
            $result[] = $s;
        }
        unset($temp_first2);
        return $result;
}


$data=nl2br($_POST["data"]);
// echo $data."<br>------------------<br>";
$type;
$material;

$typeQuantity=substr($data,0,strpos($data,"<"));
$data=substr($data,strpos($data,">")+1);

for($i=0;$i<$typeQuantity;$i++){
	$type[$i]=substr($data,0,strpos($data,"<"));
	$data=substr($data,strpos($data,">")+1);
}

$materialQuantity=substr($data,0,strpos($data,"<"));
$data=substr($data,strpos($data,">")+1);

for($i=0;$i<$materialQuantity;$i++){
	$material[$i][0]=substr($data,0,strpos($data," "));
	$data=substr($data,strpos($data," ")+1);
	$material[$i][1]=substr($data,0,strpos($data," "));
	$data=substr($data,strpos($data," ")+1);
	if($i+1==$materialQuantity){
		$material[$i][2]=$data;
	}
	else{
		$material[$i][2]=substr($data,0,strpos($data,"<"));
		$data=substr($data,strpos($data,">")+1);
	}
}

// for($i=0;$i<$typeQuantity;$i++){
// 	echo $type[$i]."<br>";
// }
// echo "<br>---<br>";
// for($i=0;$i<$materialQuantity;$i++){
// 	echo $material[$i][0].",".$material[$i][1].",".$material[$i][2]."<br>";
// }

$arr = range(0, $materialQuantity-1);
$comb = combination($arr,$typeQuantity);

// echo "<pre>";
// print_r($comb);
// echo "</pre>";

//$resultArr;
$resultArr1;
$resultArr2;
$resultArrCount=0;
$temp="";
$tempComb="";
$strTypeCheck="";
$combCount=count($comb);

for($i=0;$i<$combCount;$i++){
	// echo "<br>正在處理".$i."<br>";

	// $resultArr[$resultArrCount][0]=0;
	// $resultArr[$resultArrCount][1]="";
	$resultArr1[$resultArrCount]=0;
	$resultArr2[$resultArrCount]="";

	$temp="";
	$tempComb=$comb[$i];
	$strTypeCheck="";
	while(strlen($tempComb)>0){

		if(!empty(strpos($tempComb,","))){	//不是最後一組數字
			$temp=substr($tempComb,0,strpos($tempComb,","));	//擷取目前最前面的數字
			// echo "|".$temp."|";
			$tempComb=substr($tempComb,strpos($tempComb,",")+1);	//將$comb[$i]最前面的數字包含逗號移除
			// echo "~".$tempComb."~";
		}
		else{	//是最後一組數字
			$temp=$tempComb;	//擷取目前最前面的數字
			// echo "*".$temp."*";
			$tempComb=null;
		}
		// $resultArr[$resultArrCount][0]+=$material[$temp][2];
		$resultArr1[$resultArrCount]+=$material[$temp][2];
		//echo $resultArr[$resultArrCount][0]."|";

		// echo ":".$strTypeCheck.":".$material[$temp][0].":";
		// echo ((strpos($strTypeCheck,"|".$material[$temp][0]."|"))===false)?"未重複":"已重複";
		if((strpos($strTypeCheck,"|".$material[$temp][0]."|"))===false){	//在strTypeCheck中沒找到這個type
				$strTypeCheck.="|".$material[$temp][0]."|";	//將這個type加入至strTypeCheck字串中
				// echo "<br>";
			// $resultArr[$resultArrCount][1].=" ".$material[$temp][1];
			$resultArr2[$resultArrCount].=" ".$material[$temp][1];
			//echo $resultArr[$resultArrCount][1]."<br>";
		}
		else{
			unset($comb[$i]);
			// unset($resultArr[$resultArrCount]);
			unset($resultArr1[$resultArrCount]);
			unset($resultArr2[$resultArrCount]);
			// echo "break<br>";
			$resultArrCount--;
			break;
		}
	}
	$resultArrCount++;
}

$resultArr;
for($i=0;$i<count($resultArr1);$i++){
	$resultArr[$resultArr2[$i]]=$resultArr1[$i];
}
asort($resultArr);
foreach($resultArr as $x=>$x_value)
    {
    echo $x_value."".$x;
    echo "<br>";
    }
?> 

</body>
</html>