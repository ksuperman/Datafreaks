function morrisBar(jsonArrayBar){
    Morris.Bar({
        element: 'morris-bar-chart',
        data: jsonArrayBar,
        xkey: 'category',
        ykeys: ['sales'],
        labels: ['Sales'],
        hideHover: 'auto',
        resize: true
    });
    
};

function morrisDonut(jsonArrayDonut){
    Morris.Donut({
        element: 'morris-donut-chart',
        data: jsonArrayDonut,
        resize: true,
		colors: ['#f4f142'],
    });
    
};

function morrisBar2(jsonArrayBar2){
    Morris.Bar({
        element: 'morris-bar-chart2',
        data: jsonArrayBar2,
        xkey: 'category',
        ykeys: ['loss'],
        labels: ['Loss'],
		barColors: ['crimson'],
        hideHover: 'auto',
        resize: false
    });
    
};

function morrisArea(jsonArrayArea){
Morris.Area({
        element: 'morris-area-chart',
        data: jsonArrayArea,
        xkey: 'year',
        ykeys: ['smartwatch', 'smartphone', 'headphones'],
        labels: ['smartwatch', 'smartphone', 'headphones'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
};	