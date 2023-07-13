<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum minima, odio repudiandae esse consequatur maxime repellendus, non perspiciatis odit praesentium unde obcaecati fugiat inventore? Earum autem iure officiis eius iste?</h1>





<script src="{{asset('/backend-assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/backend-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/backend-assets/js/adminlte.js')}}"></script>
<script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>
<script>



const puppeteer=require('puppeteer')

// console.log(puppeteer);

async function start() {
	const browser=await puppeteer.launch()
	const page=await browser.newPage()
	await page.goto("https://www.olx.uz/d/obyavlenie/1-komnatnaya-kvartira-v-almazar-siti-ID38lwp.html?reason=ip%7Ccf")
	// console.log(page);
	// await page.Screenshot({path:'full.png'})

	

	await page.waitForSelector('#root > div.css-50cyfj > div.css-1qw98an > div:nth-child(3) > div.css-6u8zs6 > div:nth-child(1) > div:nth-child(3) > div > button.css-1hrtz3t')

	// await page.waitForSelector('#root > div.css-50cyfj > div.css-1qw98an > div:nth-child(3) > div.css-n9feq4 > section > div > div > div.css-1epmoz1 > div.css-1saqqt7 > div > button')

	
	// button view number top
	
	// button view number bottom
	// click_top=await page.click('#root > div.css-50cyfj > div.css-1qw98an > div:nth-child(3) > div.css-n9feq4 > section > div > div > div.css-1epmoz1 > div.css-1saqqt7 > div > button')

	click_bottom=await page.click('#root > div.css-50cyfj > div.css-1qw98an > div:nth-child(3) > div.css-6u8zs6 > div:nth-child(1) > div:nth-child(3) > div > button.css-1hrtz3t')
	// await page.Screenshot({path:'full.png'})
	console.log(click_bottom);
	

	await page.waitForTimeout(4000)
	const  text_top= await page.$eval('#root > div.css-50cyfj > div.css-1qw98an > div:nth-child(3) > div.css-6u8zs6 > div:nth-child(1) > div:nth-child(3) > div > button.css-1hrtz3t > span > a',  (el)=>el.innerText)
	const  text_bottom= await page.$eval('#root > div.css-50cyfj > div.css-1qw98an > div:nth-child(3) > div.css-n9feq4 > section > div > div > div.css-1epmoz1 > div.css-1saqqt7 > div > div > a',  (el)=>el.innerText)


    console.log(text_top);
    // console.log(text_bottom);


	await browser.close()

	
}

start()






    // $('#reload').click(function () {
    //     $.ajax({
    //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //         type: 'GET',
    //         url: '/reload-captcha',
    //         dataType: "json",
    //         success: function (data) {
    //             // console.log(data);
    //             // $(".captcha span").html(data.captcha);
    //             $('.mathcaptcha-label').text(data);
    //         },
    //         error: function (error) {
    //             // console.log(error);
    //         }
    //     });
    // });
</script>

</body>
</html>