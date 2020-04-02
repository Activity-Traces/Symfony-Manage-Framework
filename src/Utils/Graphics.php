<?php

namespace App\Utils;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\AnnotationChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\AreaChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BubbleChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\CandlestickChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ComboChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\GaugeChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\GeoChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\SankeyDiagram;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ScatterChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\SteppedAreaChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\TableChart;

class Graphics {

    function Plot($mode, $titre, $vecteur, $vecteur2){

        if($mode=='PieChart') {
                $Plotform = new PieChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);

        }
        if($mode=='Histogram'){
                $Plotform = new Histogram();
                $Plotform->getData()->setArrayToDataTable($vecteur);

        }
        if($mode=='AreaChart'){
                $Plotform = new AreaChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);
        }

        if($mode=='BarChart'){
                $Plotform = new BarChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);

        }
        if($mode=='BubbleChart') {
                $Plotform = new BubbleChart();
                $Plotform->getData()->setArrayToDataTable($vecteur2);
        }

        if($mode=='CandlestickChart'){
                $Plotform = new CandlestickChart();
                $Plotform->getData()->setArrayToDataTable($vecteur2);
        }

        if($mode=='ColumnChart'){
                $Plotform = new ColumnChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);
        }
                
        if($mode=='ComboChart'){
                $Plotform = new ComboChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);
        }

        if($mode=='GaugeChart'){
                $Plotform = new GaugeChart();
                $Plotform->getData()->setArrayToDataTable($vecteur2);
        }

        if($mode=='GeoChart'){
                $Plotform = new GeoChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);
        }

        if($mode=='LineChart'){
                $Plotform = new LineChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);
        }

        if($mode=='SankeyDiagram'){
                $Plotform = new SankeyDiagram();
                $Plotform->getData()->setArrayToDataTable($vecteur);
        }

        if($mode=='ScatterChart'){
                $Plotform = new ScatterChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);
        }

        if($mode=='SteppedAreaChart'){
                $Plotform = new SteppedAreaChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);
        }

        if($mode=='TableChart') {
                $Plotform = new TableChart();
                $Plotform->getData()->setArrayToDataTable($vecteur);
        
        }
        
        if(($mode !='TableChart') && ($mode !='GeoChart') && ($mode != 'SankeyDiagram')) {

                $Plotform->getOptions()->setTitle($titre);
                $Plotform->getOptions()->setHeight(500);
                $Plotform->getOptions()->setWidth(900);
                $Plotform->getOptions()->getTitleTextStyle()->setBold(true);
                $Plotform->getOptions()->getTitleTextStyle()->setColor('#009900');
                $Plotform->getOptions()->getTitleTextStyle()->setItalic(true);
                $Plotform->getOptions()->getTitleTextStyle()->setFontName('Arial');
                $Plotform->getOptions()->getTitleTextStyle()->setFontSize(20);
        }
    
    return ($Plotform);    


    }

    
}