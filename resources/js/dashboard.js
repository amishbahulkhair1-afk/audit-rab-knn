import Chart from 'chart.js/auto';


document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | Ambil Data Dari Blade
    |--------------------------------------------------------------------------
    */

    const data = window.dashboardData;



    if (!data) {
        console.error('Dashboard data tidak ditemukan');
        return;
    }



    /*
    |--------------------------------------------------------------------------
    | BAR CHART STATISTIK SISTEM
    |--------------------------------------------------------------------------
    */


    const statistikCanvas =
        document.getElementById('statistikChart');


    if(statistikCanvas){


        new Chart(statistikCanvas, {

            type: 'bar',


            data:{


                labels:[

                    'Bangunan',
                    'Audit',
                    'Dataset KNN',
                    'RAB'

                ],



                datasets:[{


                    label:'Jumlah Data',


                    data:data.statistik,



                    borderRadius:10,



                    backgroundColor:[

                        '#2563EB',
                        '#F59E0B',
                        '#9333EA',
                        '#10B981'

                    ]



                }]


            },



            options:{


                responsive:true,


                maintainAspectRatio:false,


                plugins:{


                    legend:{


                        display:false


                    }


                },



                scales:{


                    y:{


                        beginAtZero:true,


                        ticks:{


                            precision:0


                        }


                    }


                }


            }


        });


    }








    /*
    |--------------------------------------------------------------------------
    | LINE CHART RAB
    |--------------------------------------------------------------------------
    */


    const rabCanvas =
        document.getElementById('rabChart');



    if(rabCanvas){



        new Chart(rabCanvas,{


            type:'line',



            data:{


                labels:data.bulan,



                datasets:[{


                    label:'Total RAB',



                    data:data.grafikRab,



                    borderWidth:3,


                    tension:0.4,



                    fill:true,



                    backgroundColor:
                        'rgba(16,185,129,0.15)',



                    borderColor:
                        '#10B981',



                    pointRadius:5



                }]



            },



            options:{


                responsive:true,


                maintainAspectRatio:false,



                plugins:{


                    tooltip:{


                        callbacks:{


                            label:function(context){


                                return 'Rp ' +

                                new Intl.NumberFormat(
                                    'id-ID'
                                ).format(
                                    context.raw
                                );


                            }


                        }


                    }


                },



                scales:{


                    y:{


                        ticks:{


                            callback:function(value){


                                return 'Rp ' +

                                new Intl.NumberFormat(
                                    'id-ID'
                                ).format(value);



                            }


                        }


                    }


                }



            }



        });



    }










    /*
    |--------------------------------------------------------------------------
    | PIE CHART HASIL KNN
    |--------------------------------------------------------------------------
    */


    const knnCanvas =
        document.getElementById('knnChart');



    if(knnCanvas){



        new Chart(knnCanvas,{


            type:'doughnut',



            data:{


                labels:Object.keys(data.knn),



                datasets:[{


                    data:Object.values(data.knn),



                    backgroundColor:[


                        '#10B981',
                        '#F59E0B',
                        '#EF4444'


                    ],



                    borderWidth:0



                }]



            },



            options:{


                responsive:true,


                maintainAspectRatio:false,



                cutout:'70%',



                plugins:{


                    legend:{


                        position:'bottom'


                    }



                }



            }



        });



    }



});