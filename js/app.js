var chapterData;
var selectedChapter;
$(document).bind('pageinit', function(){
	$('#content').hide();
	$(".get-quotes").click(function() {
		$('#content').show();
    	getContent('random', $(this).attr('id'));
    });
	$("#back").click(function() {
		var current = parseInt($('#position').attr('value'));
		current = current-1;
		checkButton(current);
	});
	$("#continue").click(function() {
		var current = parseInt($('#position').attr('value'));
		current = current+1;
		checkButton(current);
	});
});

function jsoncallback(data)
{
	var random = getRandom(0, data.valasz.versek.length-1);
	chapterData = data;
	selectedChapter = random;
	checkButton(random);
	$('#position').attr('value', random);
	$('#content .text').html(data.valasz.versek[random].szoveg);
	$('#content').listview('refresh');
}

function getContent(code, type)
{
	var typeStr = "";
	var now = new Date();
	if(type=='otest' || type=='newtest')
	{
		$.getJSON('http://www.dobrenteiistvan.hu/bible/api.php?task=' + code + '&link=' + type + '&jsoncallback=?', function(data) {});
		typeStr = (type=='otest' ? "Napi ószövetségi idézetem" : "Napi újszövetségi idézetem");
	}
	$('#content li[role="heading"]').html(now.format("yyyy mmmm dd. dddd") + ' ' + typeStr);
	$('#content').listview('refresh');
}

function getRandom (min, max) 
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function checkButton(position)
{
	if(position == 0)
	{
		$('#back').button('disable');
	}
	else if(position == chapterData.valasz.versek.length-1)
	{
		$('#continue').button('disable');
	}
	else
	{
		$('#back').button('enable');
		$('#continue').button('enable');
	}
	$('#position').attr('value', position);
	$('#content .text').html(chapterData.valasz.versek[position].szoveg);
	$('#content .chapter').html(chapterData.valasz.versek[position].hely.szep);
	if(position == selectedChapter)
	{
		$('#content .chapter').css('color','red');
	}
	else
	{
		$('#content .chapter').css('color','black');
	}
}