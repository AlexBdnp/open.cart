// qpSelector - make up name of selector for quick popup
// request - url request
// defaultLabel - label if there is no data from ajax to display
// selectFromAJAX - array of selectors of text we want to display from AJAX responce in popup
// button - button selector

class QuickPopup {
	
	constructor(qpSelector, url, defaultLabel, selectFromAJAX, button) {
		let _qpSelector = qpSelector.replace(/[\.\#]/g, ' ')
		
		//create quick popup, invisible for now
		$('body').append(`<div class="${_qpSelector}"><div class="content"></div></div>`)

		//style for one
		$('head').append(`<style>${qpSelector} { min-width: 200px; min-height: 40px; border: 1px solid #009900; border-radius: 8px; background-color: #00FF66; position: fixed; bottom: 5%; right: 10%;  padding: 10px; visibility: hidden; display: flex;  flex-flow: row wrap; justify-content: space-around; align-items: center; } ${qpSelector}.show { visibility: visible; animation: fadeIn 0.5s; } @keyframes fadeIn {from {opacity: 0;} to {opacity:1 ;}}</style>`)
		
		//close by click
		$(qpSelector).on('click', function() {
			$(qpSelector).removeClass('show')
		})		
		
		//global ajax binding
		$( document ).ajaxSuccess(function( event, xhr, settings ) {
			if ( settings.url === url ) {
				let html = xhr.responseText
				// $(html).find(selectFromAJAX).map( function() { console.log($(this).text()) } )
				
				//check for selectFromAJAX
				if(Object.keys(selectFromAJAX)) {
					for (let k in selectFromAJAX) {
						if($(html).find(k).length) {
							$(html).find(k).map( function() { 
								$(`${qpSelector} .content`).append($(this).text() + '<br>')
								$(qpSelector).css('background-color', selectFromAJAX[k])
							})
						}
					}
				}				
				if($(`${qpSelector} .content`).text() == '') {
					$(`${qpSelector} .content`).html(defaultLabel)
					$(qpSelector).css('background-color', 'lightgreen')
				}
			}
		})
		
		//global ajax binding
		$( document ).ajaxError(function( event, xhr, settings, thrownError ) {
		  if ( settings.url == url ) {
			$(`${qpSelector} .content`).append('Error: ' + thrownError)
			$(qpSelector).css('background-color', 'salmon')
		  }
		})
		
		//global ajax binding
		$( document ).ajaxComplete(function( event, xhr, settings ) {
		  if ( settings.url === url ) {
				$(button).html(t)
				$(button).removeAttr('disabled')

				// display and close popup window
				$(qpSelector).removeClass('show')
				setTimeout(() => $(qpSelector).addClass('show'), 1)
				setTimeout(() => $(qpSelector).removeClass('show').find('.content').html(''), 2000)
			}
		})
		
		//click on $(button)
		let t = ''
		$(button).on('click', function () {
			t = $(button).html()
			$(button).html('...')
			$(button).attr('disabled', 'disabled')
		})
	}
}

/*
let pab = new QuickPopup(
	'.qp-save',
	'#buttonload',
	'ajax/test.html',
	'Default Label',
	[
		{'.alert-danger', 'salmon'},
		{'.alert-success', 'lightgreen'}
	]
)
*/