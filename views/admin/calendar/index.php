<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
 <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/calendar/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/calendar/fullcalendar.print.min.css" media="print">
  
  <?php vendor_html_helper::contentheader('Calendar <small>Control panel</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="row box-header with-border  " id="reports-header">
              <div class="col-sm-6">
                <h3 class="box-title text-info"> 
                   Calendar  <?php if ( isset($this->OTTime) && $this->OTTime = 'OT_time')  echo "OT"  ?> of  <?=$this->user['firstname'].' '.$this->user['lastname'];?>
                </h3>
              </div>
              <div class="col-sm-6">
                <h3 class="box-title  pull-right text-right">
                    This <?=$this->timetype ?> ,
                    <a  href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$this->user_id])) ?>"  > <?=$this->user['firstname'].' '.$this->user['lastname'];?></a> have 
                    <a href="<?=(vendor_app_util::url(["ctl"=>"requests", "act"=>"user/".$this->user_id."/time=".$this->time])) ?>" ><?=$this->monthRequests?> requests</a> and 
                    <a  href="<?=(vendor_app_util::url(["ctl"=>"reports", "act"=>"user/".$this->user_id."/time=".$this->time])) ?>"  ><?=$this->monthReports ?> reports 
                       <?php if ( isset($this->OTTime) && $this->OTTime = 'OT_time')  echo "OT"  ?>
                    </a> 
                </h3>
              </div>
            </div>
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->

              <div class="col-sm-9 col-xs-9">
                <?php if( isset($this->OTTime) && $this->OTTime = 'OT_time') { ?>
                  <form id="form-report" action="<?php echo vendor_app_util::url(["ctl"=>"calendar/user_id=".$this->user_id."/OT_time"]) ; ?>" method="post" enctype="multipart/form-data" class="form-inline">
                <?php } else { ?>
                  <form id="form-report" action="<?php echo vendor_app_util::url(["ctl"=>"calendar/user_id=".$this->user_id ]); ?>" method="post" enctype="multipart/form-data" class="form-inline">
                <?php } ?>
                  <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-addon mobileHide">Select month: </div>
                      <input type="month" name="month" class="form-control selectInput" id="month" placeholder="Month..." value="<?=$this->time;?>">
                    </div>
                  <button type="submit" class="btn btn-info">Submit</button>
                  </div>
                </form>
              </div>

              <div id="calendar">

              </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->

<!-- fullCalendar -->
<script src="<?php echo RootREL; ?>media/libs/js/calendar/jquery-ui.min.js"></script>
<script src="<?php echo RootREL; ?>media/libs/js/calendar/jquery.slimscroll.min.js"></script>
<script src="<?php echo RootREL; ?>media/libs/js/calendar/fastclick.js"></script>
<script src="<?php echo RootREL; ?>media/libs/js/calendar/moment.js"></script>
<script src="<?php echo RootREL; ?>media/libs/js/calendar/fullcalendar.min.js"></script>
<!-- Page specific script -->
<!-- obj = JSON.parse(JSON.stringify(events)); -->
<script type="text/javascript">


   
$(function () {
  var data = <?php echo json_encode($this->records); ?>;
  var dataP = <?php echo json_encode($this->recordsP); ?>;
  var daystart = <?php echo json_encode($this->time); ?>;
  var user_id = <?php echo json_encode($this->user_id); ?>;
  var OT_time = <?php echo (isset($this->OTTime))? json_encode($this->OTTime): "0"; ?>;
  var events = [];

console.log(OT_time);


  /*  format date return about Y-m-d
  -----------------------------------------------------------------*/
  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
  }

  /*  get data reports
  -----------------------------------------------------------------*/
  dataP.data.map((value,index) => {
    starttime = new Date(value.time_start);
    date = formatDate(value.time_start)
    endtime   =  new Date(value.time_end);
    time  = Number( value.work_time);
    cur = 0;
    events.map((value,index)=>{
        if (starttime.getDate() == value.start.getDate()) {
          events[index].title += time;
          cur++;
          return;
        } 
    }) 
    if(cur==0){
      events.push({
          title          : time,
          start          : starttime,
          end            : endtime,
          url            : '<?php echo RootREL; ?>admin/reports/userreports/'+user_id+'/date='+date + ( OT_time && OT_time == "OT_time" ? "/OT_time" : "" ),
          backgroundColor: '#00c0ef', 
          borderColor    : '#00c0ef' 
      })
    }
  });

  /*  get data requests
  -----------------------------------------------------------------*/
  data.data.map((value,index) => {
   events.push({
      title          : value.reason,
      start          : new Date(value.datetime_start),
      end            : new Date(value.datetime_end),
      url            : '<?php echo RootREL; ?>admin/requests/view/'+ value.id,
      backgroundColor: '#f56954', 
      borderColor    : '#f56954' 
    })
  });

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date(daystart);
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear();

    $('#calendar').fullCalendar({
      header    : {
        left  : '',
        center: '',
        right : ''
      },
    
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events : events,
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      defaultDate: date,
      displayEventTime : false
    })
  })
</script>

<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
