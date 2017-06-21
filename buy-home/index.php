<html>
    <head>
        <title>Smart Locations - Buy Home</title>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.14/themes/black-tie/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<style>
		html { height: 100%; margin: 0px; padding: 0px; }
		body { position:absolute; top:0; left:0; height: 100%; width:100%; margin: 0px; padding: 0px; background:url(/resources/mainSmallX.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;}
		#centerBox {  position: relative; height:100%; width:80vw; float:none; margin-left:auto; margin-right:auto; background:rgba(255,255,255,0.7); }
		#navMenu { float: left; margin-left: 10.5vw; width: 57vw; padding-left:1vw; height: 4.5vh; padding-top:2vh; margin-top: 0.5vh; background: rgba(255,255,255,0.3); clear:left; z-index:10;}
		.navItems { margin-right:1.5vw; font-family: 'Questrial', sans-serif; color:#000; font-size:1vw; margin-left:1vw; text-decoration:none; }
		.formHolder { float:left; clear:both; margin-bottom:1vh; }
		.formTitle { float:left; font-size:1.5vw; margin-right:1vw; font-family: 'Questrial', sans-serif; color:#000; }
		#nextArrow { display:none; float: right; margin-top: 0.5vw; margin-right: 0.7vw; height: 83vh; width: 10vw; background: rgba(255,255,255,0.3); opacity:0.7; cursor:pointer;}
		#nextArrow:hover { opacity:1; }
		#nextTri { position: relative; top: 45%; transform: translateY(-50%); margin-left: 4vw; width: 3vw; pointer-events:none; }
		#nextText { float:left; margin-top:2vh; font-size:2.5vw; margin-left:2.5vw; font-family: 'Questrial', sans-serif; color:#000; pointer-events:none;}
		
		#page1 {float:left; width: 58vw; margin-left: 10.5vw;}
		#searchBox { float:left; width: 58vw; margin-top:1vh; height:22vh; background: rgba(255,255,255,0.3); }
		#subSHeader1 { float:left; width:100%; height:25%; padding-top:2%; clear:both; text-align:center; font-family: 'Questrial', sans-serif; color:#000; font-size:2vw; }
		#subSearch1 { float: left; width: 95%; padding-left: 2%; margin-left:1vw; height: 49%; padding-top: 3%; }
		.ui-helper-hidden-accessible {display:none; }
		#ui-id-1 { max-height: 50vh; overflow-y: auto; z-index:99;}
		#distanceSpan {float:left; margin-left:1vw; font-size:1.5vw; font-family: 'Questrial', sans-serif; color:#000; margin-top:0.7vh;}
		#distanceFrom {float:left; margin-left:1vw; height:5vh; }
		#distanceSearch { float:right; width:10vw; height:5vh; margin-right:3.4vw; display:none; }
		
		.allMap { cursor:pointer; }
		#region-Box { float:left; width: 58vw; margin-top:1vh; height:60vh; background: rgba(255,255,255,0.3); }
		#region-Map { position: relative; width: 56.063vw; float: left; margin-left: 1vw; margin-top: 2vh; }
		#Map1 { position: relative; float:left; height: 30.6vh; width: 36.2vw; }
		#Map2 { position: relative; float:left; width: 19.7vw; height: 26vh; }
		#Map3 { position: relative; float:left; width: 6.4vw;  height: 11.2vh; margin-left: -6.6%; margin-top: -5.9%; }
		#Map4 { position: relative; float:left; width: 16.6vw; height: 20.6vh; margin-left: 34.9%; clear:left; }
		#Map5 { position: relative; float:left; width: 19.6vw; height: 28.5vh; margin-top: -4.1%; }
		.mapImage { position:absolute; left:0px; top:0px; width: 100%; height: 100%; z-index:5; pointer-events:none; }
		#r1 { left: 22vw; top: 9.5vh; font-size:2.5vw; }
		#r2 { left: 4vw;  top: 10.5vh; font-size:2.5vw;}
		#r3 { left:0px; top:0px; font-size:1.5vw;}
		#r4 { left: 4vw; top: 3.5vh; font-size:2.5vw;}
		#r5 { left: 4vw; top: 9.5vh; font-size:2.5vw;}
		.rollText { position:absolute; display:none; font-family: 'Questrial', sans-serif; color:#000; z-index:10; pointer-events:none; }
		
		#page2 { position:absolute; left:0; top:0; width:100%; height:100%; display:none; }
		#page2Results { position:relative; float:left; width: 52vw; margin-top:7vh; margin-left: 0.5vw; height:93%; display:none; }
		#page2Search { position:relative; float:right; width:27vw; padding-left:0.5vw; height:100%; background: rgba(255,255,255,0.3); }
		#page2Box { float:left; width: 58vw; margin-top:1vh; height:33vh; }
		#page2Header { float:left; width:100%; height:10%; padding-top:3%; clear:both; text-align:center; font-family: 'Questrial', sans-serif; color:#000; font-size:2vw; }
		.selectSearch { float:left; height:3vh; width: 9vw;}
		.spanDollar { float:left; font-family: 'Questrial', sans-serif; color:#000; font-size:1.2vw; }
		.formColumn { float:left; width:90%; padding:1vh;}
		.formHolder2 { float:right; margin-bottom:0.5vh; clear:both; }
		.formTitle2 { float:left; font-size:1.2vw; margin-right:0.5vw; font-family: 'Questrial', sans-serif; color:#000; }
		#searchButton { float:left; margin-top:1vh; width:98%; height:6vh; }
		
		#sortBox { position: relative; float: left; height: 3vh; margin-top: 0.5vh; padding-top: 1.5vh; padding-bottom: 1.5vh; margin-bottom: 0.5vh; padding-left: 1.8vw; width: 50.2vw; }
		#resultBox { float:left; width:52vw; height:85vh; background: rgba(255,255,255,0.3); overflow-y:scroll; display: none; }
		#sBy { float:left; font-size:1.4vw; font-family: 'Questrial', sans-serif; color:#000; margin-right:2vw; }
		.sortItem { float:left; margin-left:1vw; margin-top: -1vh; padding-left:1vw; padding-right:1vw; padding-top:1vh; padding-bottom:1vh; font-family: 'Questrial', sans-serif; color:#000; font-size:1.2vw; border:1px solid #b3b3b3; background: rgba(255,255,255,0.3); cursor:pointer; }
		.sortItem:hover { background: rgba(255,255,255,0.8); }
		</style>
    </head>
    <body>
	<div id="centerBox">
	<?php $headerSection = 'buy'; require $_SERVER['DOCUMENT_ROOT'].'/resources/header.php'; ?>
	<div id="page1">
	<div id="searchBox">
	<div id="subSHeader1">Step 1 - Enter a location or choose a region.</div>
		<div id="subSearch1">
			<div class="formHolder"><label for="auto" class="formTitle">Search Nearby Towns/Cities: </label><input type="text" id="auto" class="textInput selectData" style="float:left; height: 4vh; width:20vw;"/></div>
			<button id="distanceSearch">Search</button>
		</div>
	</div>
	<div id="region-Box">
		<div id="region-Map">
		<div id="Map1" class="tileH allMap"><span id="r1" class="rollText">Northwest</span><img id="mPiece1" class="mapImage" src="resources/Map1.png"/></div>
		<div id="Map2" class="tileH allMap"><span id="r2" class="rollText">Northeast</span><img id="mPiece2" class="mapImage" src="resources/Map2.png"/></div>
		<div id="Map3" class="tileH allMap"><span id="r3" class="rollText"></span><img id="mPiece3" class="mapImage" src="resources/Map3.png"/></div>
		<div id="Map4" class="tileH allMap"><span id="r4" class="rollText">Southwest</span><img id="mPiece4" class="mapImage" src="resources/Map4.png"/></div>
		<div id="Map5" class="tileH allMap"><span id="r5" class="rollText">Southeast</span><img id="mPiece5" class="mapImage" src="resources/Map5.png"/></div>
		</div>
	</div>
	<script>
	var first_search = 0;
	var cities = ['Ada','Adair','Afton','Alex','Allen','Altus','Alva','Anadarko','Antlers','Apache','Arapaho','Ardmore','Arkoma','Arnett','Atoka','Barnsdall','Bartlesville','Beaver','Beggs','Bernice','Bethany','Bethel Acres','Billings','Binger','Blackwell','Blair','Blanchard','Boise','Bokchito','Bokoshe','Boley','Boswell','Bray','Bristow','Broken Arrow','Broken Bow','Buffalo','Burns Flat','Byng','Cache','Caddo','Calera','Calumet','Canton','Canute','Carnegie','Carney','Catoosa','Cement','Central High','Chandler','Checotah','Chelsea','Cherokee','Cheyenne','Chickasha','Choctaw','Chouteau','Claremore','Clayton','Cleveland','Coalgate','Colbert','Colcord','Cole','Collinsville','Comanche','Commerce','Copan','Corn','Covington','Coweta','Crescent','Cushing','Cyril','Davenport','Davis','Del','Dewar','Dewey','Dibble','Dickson','Dill','Duncan','Durant','Earlsboro','Edmond','Elgin','Elk','Elmore','El Reno','Empire','Enid','Erick','Eufaula','Fairfax','Fairland','Fairview','Fletcher','Forest Park','Forgan','Fort Cobb','Fort Gibson','Fort Towson','Frederick','Garber','Geronimo','Glencoe','Glenpool','Goldsby','Goodwell','Gore','Grandfield','Granite','Grove','Guthrie','Guymon','Haileyville','Hammon','Harrah','Hartshorne','Haskell','Healdton','Heavener','Helena','Hennessey','Henryetta','Hinton','Hobart','Holdenville','Hollis','Hominy','Hooker','Howe','Hugo','Hulbert','Hydro','Idabel','Inola','Jay','Jenks','Jones','Kansas','Kellyville','Keota','Kiefer','Kingfisher','Kingston','Kiowa','Konawa','Krebs','Lahoma','Langley','Langston','Laverne','Lawton','Lexington','Lindsay','Locust Grove','Lone Grove','Luther','McAlester','McCurtain','McLoud','Madill','Mangum','Mannsville','Marietta','Marlow','Medford','Meeker','Miami','Midwest','Minco','Moore','Mooreland','Morris','Morrison','Mounds','Mountain View','Muldrow','Muskogee','Mustang','Newcastle','New Cordell','Newkirk','Nichols Hills','Nicoma Park','Ninnekah','Noble','Norman','North Enid','Nowata','Oakland','Oilton','Okarche','Okay','Okeene','Okemah','Oklahoma City','Okmulgee','Olustee','Oologah','Owasso','Panama','Paoli','Pauls Valley','Pawhuska','Pawnee','Perkins','Perry','Pink','Pocola','Ponca City','Pond Creek','Porter','Porum','Poteau','Prague','Pryor Creek','Purcell','Quapaw','Quinton','Ramona','Ravia','Red Oak','Ringling','Rock Island','Roff','Roland','Rush Springs','Ryan','Salina','Sallisaw','Sand Springs','Savanna','Sayre','Schulter','Seiling','Seminole','Sentinel','Shady Point','Shattuck','Shawnee','Skiatook','Slaughterville','Snyder','South Coffeyville','Spencer','Sperry','Spiro','Springer','Sterling','Stigler','Stillwater','Stilwell','Stratford','Stroud','Sulphur','Tahlequah','Talihina','Tecumseh','Temple','Texhoma','The Village','Thomas','Tipton','Tishomingo','Tonkawa','Tuttle','Tyrone','Union','Valley Brook','Valliant','Velma','Verden','Verdigris','Vian','Vici','Vinita','Wagoner','Walters','Warner','Warr Acres','Washington','Watonga','Waukomis','Waurika','Wayne','Waynoka','Weatherford','Webbers Falls','Welch','Weleetka','Wellston','West Siloam Springs','Westville','Wetumka','Wewoka','Wilburton','Wilson','Winchester','Wister','Woodward','Wright','Wynnewood','Yale','Yukon'];
		var searchType = '';
		var isNext = 0;
		var searchContent = '';
	
	function changePage() {
	$("#page1").stop().fadeOut(350);
		$("#navMenu").css({"position":"absolute","left":"10.5vw","top":"0.5vh","marginLeft":"auto","marginTop":"auto"});
		$("#page1").css({"position":"absolute","left":"10.5vw","top":"7vh","marginLeft":"auto"});
		$("#navMenu").stop().animate({"left":"0.5vw","width":"51vw"},700);
		setTimeout(function() { $("#page2").stop().fadeIn(350);
		page2();
		}, 350);
	}
	
	$(document).ready(function() {		
		$("#auto").autocomplete({
		source: cities,
		select: function() {
		var hasContent = $(this).val();
		if (hasContent != '') {
		searchType = 'byCity';
		searchContent = hasContent;
		$("#distanceSearch").stop().fadeIn(400);
		if(document.getElementsByClassName("clicked") !== null) {
		$(".clicked").find("img").css({"opacity":"1"}); 
		$(".clicked").find("span").hide(); 
		$(".clicked").removeClass("clicked"); }
				}
			}
		});
			$.ui.autocomplete.filter = function (array, term) {
			var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
			return $.grep(array, function (value) {
				return matcher.test(value.label || value.value || value);
				});
			};
		$("#distanceSearch").on("click", function() {
		if (searchContent != "") { searchContent = $("#auto").val(); var getRadius = $("#distanceFrom").val(); $("#searchCity").val(searchContent); $("#searchRadius").val(getRadius);
		$("#blank").hide();
		changePage(); }
		});
			
		var bgIMG, rollText, isClicked, hClass;
		isClicked = 0;
		var mapRegionGuide = ['Nothing','Northwest','Northeast','Oklahoma City','Southwest','Southeast'];
		$(".allMap").on({
		mouseenter: function() { if ($(this).hasClass("tileH") == true) {
		bgIMG = $(this).find("img"); hClass1 = bgIMG.parent().hasClass("clicked"); if (hClass1 == false) { bgIMG.stop().animate({"opacity":"0.3"},500);
		rollText = $(this).find("span"); rollText.stop().fadeIn(500); }
			}
		},
		mouseleave: function() { if ($(this).hasClass("tileH") == true) {
		hClass2 = bgIMG.parent().hasClass("clicked"); if (hClass2 == false) { bgIMG.stop().animate({"opacity":"1"},500); rollText.stop().fadeOut(500);  }
			}
		},
		click: function(ev) { ev.stopPropagation(); if(document.getElementsByClassName("clicked") !== null) { 
		$(".clicked").find("img").css({"opacity":"1"}); 
		$(".clicked").find("span").hide(); 
		$(".clicked").removeClass("clicked"); }
		var findRegion = $(this).attr("id");
		findRegion = findRegion.replace("Map","");
		findRegion = parseInt(findRegion);
		searchType = 'byRegion';
		searchContent = mapRegionGuide[findRegion];
		bgIMG.parent().addClass("clicked");
		$("#auto").val("");
		$("#searchRegion").val(searchContent);
		changePage();
			}
		});
	});
	</script>
	</div>
	<div id="page2">
		<div id="page2Results">
		<div id="sortBox"><span id="sBy">Sort By: </span><span class="sortItem dayArrayAsc">Newest <span class='arrowSymbol'>&#x25BC;</span></span><span class="sortItem priceArrayAsc">Price <span class='arrowSymbol'>&#x25BC;</span></span><span class="sortItem squareFootaArrayAsc">Size <span class='arrowSymbol'>&#x25BC;</span></span><span class="sortItem availableArrayAsc">Availability <span class='arrowSymbol'>&#x25BC;</span></span><span class="sortItem addressArrayAsc">Address <span class='arrowSymbol'>&#x25BC;</span></span></div>
		<div id="resultBox"></div>
		</div>
		<div id="page2Search">
		<div id="page2Header">Step 2: Select your search criteria.</div>
		<div class="formColumn" style="margin-right:0.9%; margin-bottom:2vh; margin-top:2vh; border-bottom:1px solid #b3b3b3; border-top:1px solid #b3b3b3;">
			<div class="formHolder2"><label for="searchRegion" class="formTitle2" style="font-size:1.5vw;">Selected Region: </label><select id="searchRegion" class="selectSearch"><option value="">Any</option><option value="Northwest">Northwest</option><option value="Northeast">Northeast</option><option value="Oklahoma City">Oklahoma City</option><option value="Southwest">Southwest</option><option value="Southeast">Southeast</option></select></div>
			<div style="float:left; margin-top:1.5vh; margin-bottom:1.5vh; width:100%; clear:both; font-size:1.5vw; font-family:'Questrial',sans-serif; text-align:center;">or</div>
			<div class="formHolder2"><label for="searchCity" class="formTitle2" style="font-size:1.5vw;">Nearest City: </label><input type="text" id="searchCity" style="height:3vh; width:9vw;"/></div>
		</div>
		<div class="formColumn" style="margin-right:0.9%;">
			<div class="formHolder2"><label for="searchRooms" class="formTitle2">Bedrooms: </label><select id="searchRooms" class="selectSearch fData1"><option value="">Any</option><option value="1">1 Bedroom</option><option value="2">2 Bedrooms</option><option value="3">3 Bedrooms</option><option value="4">4 Bedrooms</option><option value="5">5 Bedrooms</option></select></div>
			<div class="formHolder2"><label for="searchBath" class="formTitle2">Bathrooms: </label><select id="searchBath" class="selectSearch fData1"><option value="">Any</option><option value="1">1 Bathroom</option><option value="2">2 Bathrooms</option><option value="3">3 Bathrooms</option><option value="4">4 Bathrooms</option><option value="5">5 Bathrooms</option></select></div>
			<div class="formHolder2"><label for="priceLow" class="formTitle2">Minimum Price: </label><span class="spanDollar">$</span><input type="text" id="priceLow" class="fData1" style="height:3vh; width:9vw;"/></div>
			<div class="formHolder2"><label for="priceHigh" class="formTitle2">Maximum Price: </label><span class="spanDollar">$</span><input type="text" id="priceHigh" class="fData1" style="height:3vh; width:9vw;"/></div>
		</div>
		<div class="formColumn" style="margin-right:0.9%;">
			<div class="formHolder2"><label for="searchCool" class="formTitle2">Cooling: </label><select class="selectSearch fData2" id="searchCool"><option value="">Any</option><option value="1">Central</option><option value="2">Window Unit</option><option value="3">Full A/C</option><option value="4">Ceiling Fan</option></select></div>
			<div class="formHolder2"><label for="searchHeat" class="formTitle2">Heating: </label><select class="selectSearch fData2" id="searchHeat"><option value="">Any</option><option value="1">Central</option><option value="2">Home Furnace</option><option value="3">Gas Heated</option><option value="4">Wood Stove</option></select></div>
			<div class="formHolder2"><label for="searchFire" class="formTitle2">Fireplace: </label><select class="selectSearch fData2" id="searchFire"><option value="">Any</option><option value="1">Firewood</option><option value="2">Gas-Fed</option><option value="3">Electrical</option></select></div>
			<div class="formHolder2"><label for="searchParking" class="formTitle2">Parking: </label><select class="selectSearch fData2" id="searchParking"><option value="">Any</option><option value="1">Garage</option><option value="2">Carport</option><option value="3">Driveway</option><option value="4">Street</option></select></div>
		</div>
		<div class="formColumn">
			<div class="formHolder2"><label for="dateAvailable" class="formTitle2">Date Available: </label><input type="text" id="dateAvailable" class="fData1" style="height:3vh; width:7.3vw;"/></div>
			<div class="formHolder2"><label for="yearBuilt" class="formTitle2">Year Built: </label><select id="yearBuilt" class="fData2" style="height:3vh; width:7.3vw;">
			<option value="">Any</option>
			<option value="2014">2014</option>
			<option value="2013">2013</option>
			<option value="2012">2012</option>
			<option value="2011">2011</option>
			<option value="2010">2010</option>
			<option value="2009">2009</option>
			<option value="2008">2008</option>
			<option value="2007">2007</option>
			<option value="2006">2006</option>
			<option value="2005">2005</option>
			<option value="2004">2004</option>
			<option value="2003">2003</option>
			<option value="2002">2002</option>
			<option value="2001">2001</option>
			<option value="2000">2000</option>
			<option value="1999">1999</option>
			<option value="1998">1998</option>
			<option value="1997">1997</option>
			<option value="1996">1996</option>
			<option value="1995">1995</option>
			<option value="1994">1994</option>
			<option value="1993">1993</option>
			<option value="1992">1992</option>
			<option value="1991">1991</option>
			<option value="1990">1990</option>
			<option value="1989">1989</option>
			<option value="1988">1988</option>
			<option value="1987">1987</option>
			<option value="1986">1986</option>
			<option value="1985">1985</option>
			<option value="1984">1984</option>
			<option value="1983">1983</option>
			<option value="1982">1982</option>
			<option value="1981">1981</option>
			<option value="1980">1980</option>
			<option value="1979">1979</option>
			<option value="1978">1978</option>
			<option value="1977">1977</option>
			<option value="1976">1976</option>
			<option value="1975">1975</option>
			<option value="1974">1974</option>
			<option value="1973">1973</option>
			<option value="1972">1972</option>
			<option value="1971">1971</option>
			<option value="1970">1970</option>
			<option value="1969">1969</option>
			<option value="1968">1968</option>
			<option value="1967">1967</option>
			<option value="1966">1966</option>
			<option value="1965">1965</option>
			<option value="1964">1964</option>
			<option value="1963">1963</option>
			<option value="1962">1962</option>
			<option value="1961">1961</option>
			<option value="1960">1960</option>
			<option value="1959">1959</option>
			<option value="1958">1958</option>
			<option value="1957">1957</option>
			<option value="1956">1956</option>
			<option value="1955">1955</option>
			<option value="1954">1954</option>
			<option value="1953">1953</option>
			<option value="1952">1952</option>
			<option value="1951">1951</option>
			<option value="1950">1950</option>
			<option value="1949">1949</option>
			<option value="1948">1948</option>
			<option value="1947">1947</option>
			<option value="1946">1946</option>
			<option value="1945">1945</option>
			<option value="1944">1944</option>
			<option value="1943">1943</option>
			<option value="1942">1942</option>
			<option value="1941">1941</option>
			<option value="1940">1940</option>
			<option value="1939">1939</option>
			<option value="1938">1938</option>
			<option value="1937">1937</option>
			<option value="1936">1936</option>
			<option value="1935">1935</option>
			<option value="1934">1934</option>
			<option value="1933">1933</option>
			<option value="1932">1932</option>
			<option value="1931">1931</option>
			<option value="1930">1930</option>
			<option value="1929">1929</option>
			<option value="1928">1928</option>
			<option value="1927">1927</option>
			<option value="1926">1926</option>
			<option value="1925">1925</option>
			<option value="1924">1924</option>
			<option value="1923">1923</option>
			<option value="1922">1922</option>
			<option value="1921">1921</option>
			<option value="1920">1920</option>
			<option value="1919">1919</option>
			<option value="1918">1918</option>
			<option value="1917">1917</option>
			<option value="1916">1916</option>
			<option value="1915">1915</option>
			<option value="1914">1914</option>
			<option value="1913">1913</option>
			<option value="1912">1912</option>
			<option value="1911">1911</option>
			<option value="1910">1910</option>
			<option value="1909">1909</option>
			<option value="1908">1908</option>
			<option value="1907">1907</option>
			<option value="1906">1906</option>
			<option value="1905">1905</option>
			<option value="1904">1904</option>
			<option value="1903">1903</option>
			<option value="1902">1902</option>
			<option value="1901">1901</option>
			<option value="1900">1900</option>
			</select></div>
		</div>
		<button id="searchButton">Search Homes</button>
		</div>
	<script>
	function page2() {
			$("#dateAvailable").datepicker();
			$("#searchCity").autocomplete({
			source: cities,
			select: function() { $("#searchRegion").val("Any"); $("#blank").hide(); }
				});
			$("#searchRegion").change(function() { $("#searchCity").val(""); $("#blank").show(); });
			
			$("#searchButton").on("click",function() {
			var nData = new Array();
			var oData = new Array();
			var hasData1 = "NULL";
			var hasData2 = "NULL";
			$(".fData1").each(function(){
				var getSearch1 = $(this).val();
				if (getSearch1 == "") { getSearch1 = "NULL"; }
				else { hasData1 = "Yes" }
				nData.push(getSearch1);
			});
			$(".fData2").each(function(){
				var getSearch2 = $(this).val();
				if (getSearch2 == "") { getSearch2 = "NULL"; }
				else { hasData2 = "Yes" }
				oData.push(getSearch2);
			});
			var searchType = ""; var searchCrit = "";
			var getRegion = $("#searchRegion").val();
			var getCity = $("#searchCity").val();
			if (getRegion != "") { searchType = "region"; searchCrit = getRegion; hasData1 = "Yes"; }
			else if (getCity != "") { searchType = "city"; searchCrit = getCity; hasData1 = "Yes"; }
			$.ajax({
			type: "POST",
			url: "/core-files/searchProperty.php", 
			data: { dataRequest: "SearchHome", hasPrimary: hasData1, searchBy: searchType, searchWith: searchCrit, bedrooms: nData[0], bathrooms: nData[1], minimumP: nData[2], maximumP: nData[3], dateReady: nData[4], hasOptional: hasData2, cooling: oData[1], heating: oData[2], fireplace: oData[3], parking: oData[3], yearBuilt: oData[4] },
			success: function (data) { $("#resultBox").html(data); }
				})
			if (first_search == 0) {
			$("#page2Results").stop().fadeIn(500);
			setTimeout(function() { $("#resultBox").slideDown("15000"); }, 250); first_search = 1;}
			else { $("#resultBox").empty(); }
			});
				
			$(document).on("click", ".sortItem", function() {
			var getClass = $(this).attr("class").split(' ');
			getClass = getClass[1];
			var replaceClass = "";
			var currentClass = "";
			var symbol = "";
			if (getClass.indexOf("Asc") >= 0) { currentClass = "Asc"; replaceClass = "Desc"; symbol = "&#x25B2;"; }
			else { currentClass = "Desc"; replaceClass = "Asc";  symbol = "&#x25BC;"; }
			var baseClass = getClass.replace(currentClass,"");
			currentClass = baseClass+currentClass;
			replaceClass = baseClass+replaceClass;
			if (getClass == "priceArrayAsc") { var getArray = priceArrayAsc; }
			else if (getClass == "priceArrayDesc") { var getArray = priceArrayDesc; }
			else if (getClass == "dayArrayAsc") { var getArray = dayArrayAsc; }
			else if (getClass == "dayArrayDesc") { var getArray = dayArrayDesc; }
			else if (getClass == "squareFootaArrayAsc") { var getArray = squareFootaArrayAsc; }
			else if (getClass == "squareFootaArrayDesc") { var getArray = squareFootaArrayDesc; }
			else if (getClass == "availableArrayDesc") { var getArray = availableArrayDesc; }
			else if (getClass == "availableArrayAsc") { var getArray = availableArrayAsc; }
			else if (getClass == "addressArrayAsc") { var getArray = addressArrayAsc; }
			else if (getClass == "addressArrayDesc") { var getArray = addressArrayDesc; }
			for (a=0; a < amountReturned; a++) { var getDivID = getArray[a]; $("#sResult"+getDivID).appendTo("#resultBox"); }
			$(this).addClass(replaceClass).removeClass(currentClass);
			$(this).find(".arrowSymbol").empty();
			$(this).find(".arrowSymbol").append(symbol);
			});
		}
		</script>
	</div>
</div>
</body>
</html>