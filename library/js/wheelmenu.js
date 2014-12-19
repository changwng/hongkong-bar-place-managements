/*!
 * @author HESKEMO KAM
 */
(function($) {
	$.fn.wheelMenu = function(settings) {
		var options = {
			setup : function(callback) {

			},
			drawCanvasId : "circlemenu",
			outsideRadius : 200,
			textRadius : 130,
			insideRadius : 70,
			width : 400,
			height : 400,
			fontfamily : 'bold 28px sans-serif',
			drawtoparrow : false,
			spinWheelId : '',
			displayAttr:'',
			rotateText:false,
			centerImageSrc:null
		}
		function init_menu(){
			//hard code for the menu - slug
			//var list=['central','jordan','tst','mk','wanchai','causewaybay'];
			//var listc=['中環','佐敦','尖沙咀','旺角','灣仔','銅鑼灣'];
			//jQuery("#list_loactions_filter>li>a").each(function(i){
			//jQuery(this).parent().attr("area",list[i]);
			//jQuery(this).attr("href","javascript:at_district('"+list[i]+"')");
			// });
		}	
		$.extend(options, settings);
		var self = $(this);
		var ctx;
		var colors = ["#cdcdcd", "#bcbcbc"];
		var quienes = ["heskemo", "JP", "John Andrew", "hesk", "hesk"];
		if (self.children("li").size() > 0) {
			quienes = [];
			for (var i = 0; i < self.children("li").size(); i++) {
				if(options.displayAttr==''){
					quienes.push(self.children("li").eq(i).text());
				}else{
					var g = self.children("li").eq(i).attr(options.displayAttr);
					console.log(g);
					quienes.push(g);
				}				
			}
		} else {
			console.log("no listing, we use the default list");
		};
		console.log("get list");
		console.log(quienes);
		var quieneslength = quienes.length;
		var colorlength = colors.length;
		var startAngle = 0;
		var arc_pi = Math.PI *2 / quieneslength;
		var spinTimeout = null;
		var spinArcStart = 10;
		var spinTime = 0;
		var spinTimeTotal = 0;
		function drawRouletteWheel() {
			var canvas = document.getElementById(options.drawCanvasId);
			if (canvas.getContext) {
				var outsideRadius = options.outsideRadius;
				var textRadius = options.textRadius;
				var insideRadius = options.insideRadius;
				var center_x = options.width / 2;
				var center_y = options.height / 2;
				ctx = canvas.getContext("2d");
				ctx.clearRect(0, 0, options.width, options.height);
				ctx.strokeStyle = "gray";
				ctx.lineWidth = 1;
				ctx.font = options.fontfamily;
				for (var i = 0; i < quieneslength; i++) {
					var angle = startAngle + i * arc_pi;
					var colorcode = i%colorlength;
					console.log(colors[colorcode]);
					ctx.fillStyle = colors[colorcode];
					ctx.beginPath();
					ctx.arc(center_x, center_y, outsideRadius, angle, angle + arc_pi, false);
					ctx.arc(center_x, center_y, insideRadius, angle + arc_pi, angle, true);
					ctx.stroke();
					ctx.fill();
					ctx.save();
					ctx.shadowOffsetX = 1;
					ctx.shadowOffsetY = 1;
					ctx.shadowBlur = 1;
					ctx.shadowColor = "black";
					ctx.fillStyle = "#45454d";
					ctx.translate(center_x + Math.cos(angle + arc_pi / 2) * textRadius, center_y + Math.sin(angle + arc_pi / 2) * textRadius);
					if(options.rotateText){
						ctx.rotate(angle + arc_pi / 2 + Math.PI / 2);
					}
					var text = quienes[i];
					ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
					ctx.restore();
				}
				if(options.centerImageSrc!=null){
					var img = new Image();
					img.src = options.centerImageSrc;
					img.onload=function(){
						var h = img.height;
						console.log(h);
						ctx.drawImage(img, center_x-img.width/2, center_y-img.height/2)
					}
					
				}
				if (options.drawtoparrow) {
					//Arrow
					ctx.fillStyle = "#45454d";
					ctx.beginPath();
					ctx.moveTo(center_x - 6, center_y - (outsideRadius + 15));
					ctx.lineTo(center_x + 6, center_y - (outsideRadius + 15));
					ctx.lineTo(center_x + 6, center_y - (outsideRadius - 15));
					ctx.lineTo(center_x + 15, center_y - (outsideRadius - 15));
					ctx.lineTo(center_x + 0, center_y - (outsideRadius - 33));
					ctx.lineTo(center_x - 15, center_y - (outsideRadius - 15));
					ctx.lineTo(center_x - 6, center_y - (outsideRadius - 15));
					ctx.lineTo(center_x - 6, center_y - (outsideRadius + 15));
					ctx.fill();
				}
			}
		}

		function spin() {

			function rotateWheel() {
				spinTime += 30;
				if (spinTime >= spinTimeTotal) {
					stopRotateWheel();
					return;
				}
				var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
				startAngle += (spinAngle * Math.PI / 180);
				drawRouletteWheel();
				spinTimeout = setTimeout('rotateWheel()', 30);
			}

			function stopRotateWheel() {
				clearTimeout(spinTimeout);
				var degrees = startAngle * 180 / Math.PI + 90;
				var arcd = arc_pi * 180 / Math.PI;
				var index = Math.floor((360 - degrees % 360) / arcd);
				ctx.save();
				ctx.font = 'bold 32px sans-serif';
				ctx.shadowOffsetX = 2;
				ctx.shadowOffsetY = 2;
				ctx.shadowBlur = 2;
				ctx.shadowColor = "black";
				var text = quienes[index]
				ctx.fillText(text, 250 - ctx.measureText(text).width / 2, 250 + 10);
				ctx.restore();
			}

			function easeOut(t, b, c, d) {
				var ts = (t /= d) * t;
				var tc = ts * t;
				return b + c * (tc + -3 * ts + 3 * t);
			}

			spinAngleStart = Math.random() * 10 + 10;
			spinTime = 0;
			spinTimeTotal = Math.random() * 3 + 4 * 1000;
			rotateWheel();
		}

		if (options.spinWheelId != '') {
			$(options.spinWheelId).click(function() {
				spin();
			});
		}
		drawRouletteWheel();
		console.log("draw the wheel now");
	}
})(jQuery);

