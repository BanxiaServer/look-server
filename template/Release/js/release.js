function iFrameHeight() { 
var ifm= document.getElementById("iframepage"); 
var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument; 
if(ifm != null && subWeb != null) { 
ifm.height = subWeb.body.scrollHeight; 
} 
} 
document.writeln("<iframe src='/html/release.html' id='iframepage' name='iframepage' frameBorder=0 scrolling=no width='100%' onLoad='iFrameHeight()' ></iframe>");