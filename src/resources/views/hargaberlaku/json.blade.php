<?php
$results['sEcho'] = $sEcho;
$results['iTotalRecords'] = $results['iTotalDisplayRecords'] = $iTotalRecords;
if(count($harga))
{
    $i=0;
    $j=$start;

    foreach($harga as $data)
    {

        $action = '<center><a href="'.route('hargaberlaku.detail',$data['kode']).'" class="btn btn-primary waves-effect" data-toggle="tooltip" data-original-title="Detil" data-placement="top" style="padding: 3px 8px;"><i class="zmdi zmdi-format-subject"></i></a></center>';

        $datass = array();
        foreach ($year as $value){
            $datass[$value->tahun] = $data[$value->tahun];
        }

        $datas = array(
            ($j+1),
            $data['kota']
        );

        $arract = array($action);

        $results['aaData'][$i] = array_merge($datas,$datass,$arract);

        ++$i;
        ++$j;
    }
} else {
    for($i=0;$i<5;++$i) {
        if($i == 2){
            $results['aaData'][0][$i] = '<center>Tidak Ada Data.</center>';
        }else{
            $results['aaData'][0][$i] = '';
        }
    }
}
print($callback.'('.json_encode($results).')');