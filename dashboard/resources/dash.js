	function AddThumb(thisPic, pContent, pType) {
			$.ajax({
				url: '/core-files/format_thumb.php?picName='+thisPic+'&dataType='+pType,
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: pContent,                    
				type: 'post',
				success: function(data) { console.log(data); }
				})
		}
	
		function AddRooms(addCount) {
		var addString = "";
		for (v = 0; v < addCount; v++) {
		eachRoom.push(1);
		roomCount++;
		addString = addString + "<div style='position:relative; float:left; width:100%; height:34.3vh; border-bottom:1px solid #b3b3b3; background:#FFF;'><div style='position:absolute; padding-left:1%; width:50%; padding-top:1vh; padding-bottom:1.5vh; clear:both; z-index:11;'><label for='roomName"+roomCount+"' style='float:left; font-size:1.5vw; font-family:Questrial; margin-right:0.3vw;'>"+roomCount+". Room Name: </label><input type='text' name='roomName"+roomCount+"' id='roomName"+roomCount+"' class='vData1' style='float:left; width:13.5vw; height:3vh; margin-top:0.2vh;' placeholder='master bedroom, dining room, garage'/></div><div id='picContent"+roomCount+"' style='position:absolute; top:0; left:0; width:100%; height:34.3vh; overflow-x:scroll; clear:both; z-index:10;'><span style='position:absolute; top:1.5vh; right:14vw; font-size:1.5vw; font-family:Questrial;cursor:default;'>Add/Remove Pictures:</span><select class='picAmnt select"+roomCount+" contains1' style='position:absolute; top:1vh; right:10vw; height:4vh; width:3vw; margin-left:0.2vw;'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option></select><span class='deleteARoom remove"+roomCount+"' style='position:absolute; top:1.5vh; right:1vw; font-size:1.5vw; font-family:Questrial; color:red; cursor:pointer;'>Delete X</span><div class='picReel' style='float:left; width:100%; height:22vh; margin-top:6.4vh; padding-top:0.1vh; clear:both;'><img id='picPrevN"+roomCount+"-0' style='float:left; max-height:22vh; cursor:default;' src='' /></div><span style='float:left; font-size:1.3vw; font-family:Questrial; padding-left:2.73vw; padding-bottom:0.5vh; padding-right:0.5vw; padding-top:0.5vh;cursor:default;'>Add: </span><input id='room"+roomCount+"[0]' class='createNTour row0' type='file' style='float:left; width:14.52vw; padding-bottom:0.5vh; border-right:1px solid #b3b3b3; padding-top:0.5vh;'/></div></div>"; }
		$("#roomHolder").append(addString);
		$("#vColumn").val("");
		}
	
		function AddRoomsEdit(addCount2,IDCurrent) {
		var addString = "";
		for (v = 1; v <= addCount2; v++) {
		newRooms.push(1);
		roomCount2++;
		addString = addString + "<div style='position:relative; float:left; width:100%; height:34.3vh; border-bottom:1px solid #b3b3b3; background:#FFF;'><div class='textHolder' style='position:absolute; padding-left:1%; width:50%; padding-top:1vh; padding-bottom:1.5vh; clear:both; z-index:11;'><label for='editAdd"+roomCount2+"' style='float:left; font-size:1.5vw; font-family:Questrial; margin-right:0.3vw; margin-top:0.2vh;'><span class='rNumber'>"+roomCount2+"</span>. Room Name: </label><input type='text' id='editAdd"+roomCount2+"' class='vDataP"+IDCurrent+"' style='float:left; width:13.5vw; height:3vh; margin-top:0.2vh;' placeholder='master bedroom, dining room, garage'/></div><div id='pHold"+IDCurrent+"-"+roomCount2+"' class='picHolder pBox"+IDCurrent+"' style='position:absolute; top:0; left:0; width:100%; height:34.3vh; overflow-x:scroll; clear:both; z-index:10;'><span style='position:absolute; top:1.5vh; right:14vw; font-size:1.5vw; font-family:Questrial;cursor:default;'>Add/Remove Pictures:</span><select class='picAmntF select"+IDCurrent+" contains1' style='position:absolute; top:1vh; right:10vw; height:4vh; width:3vw; margin-left:0.2vw;'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option></select><span class='deleteTRoom remove"+IDCurrent+"-"+roomCount2+"' style='position:absolute; top:1.5vh; right:1vw; font-size:1.5vw; font-family:Questrial; color:red; cursor:pointer;'>Delete X</span><div class='picReel' style='float:left; width:100%; height:22vh; margin-top:6.4vh; padding-top:0.1vh; clear:both;'><img id='picPrev"+roomCount2+"-0' style='float:left; max-height:22vh; cursor:default;' src='' /></div><span style='float:left; font-size:1.3vw; font-family:Questrial; padding-left:2.73vw; padding-bottom:0.5vh; padding-right:0.5vw; padding-top:0.5vh;cursor:default;'>Add: </span><input id='room"+IDCurrent+"editAdd"+roomCount2+"[0]' class='newFile row0' type='file' style='float:left; width:14.52vw; padding-bottom:0.5vh; border-right:1px solid #b3b3b3; padding-top:0.5vh;'/></div></div>"; }
		$("#tour"+IDCurrent).find(".checkContent2").find(".editHolder").append(addString);
		$("#eColumn"+IDCurrent).val("");
		}
		
		function AddTour(pType,pNum,pID,pDest,pPer) {
		var countItems = 0;
		var cArray = new Array();
		var gArray = new FormData();
		for (k = 1; k < pPer.length; k++) {
			var pRow = pNum+k;
			var tourData = $(pRow).val();
			countItems++;
			if (tourData != "") {
			var checkPlus = pPer[k];
			if (checkPlus != 0) {
			cArray.push(countItems);
			rArray.push(tourData);
			hasGallery++;
			for (v = 0; v < checkPlus; v++) {
			console.log(pID+k+"\\["+v+"\\]");
			var vPic = $(pID+k+"\\["+v+"\\]").prop("files")[0];
			var checkPic = vPic.name;
			console.log(vPic.name);
			if (checkPic != "") { gArray.append("files["+k+"][]", vPic); }
			else { checkPlus = checkPlus - 1; pPer[k] = checkPlus; }
					}
				}
			} else { pPer[k] = 0; }
		}
		if (hasGallery != 0) {
			var newPropID = "";
			if (pDest == "update") { newPropID = pNum.replace("#editAdd"); newPropID = "&propID="+newPropID; }
			$.ajax({
				url: '/core-files/format_gallery.php?dataType='+pDest+'&roomCount='+cArray+'&roomArray='+pPer+'&roomName='+rArray+'&propType='+pType+newPropID,
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: gArray,                    
				type: 'post',
				success: function(data) { console.log(data); hasGallery = 0; }
				})
			}
		}
		
		function EditTour(bType, cCount, propNum, pikKey, pikArray) {
		var rEArray = new Array();
		var cEArray = new Array();
		var eArray = new FormData();
		var eCount = cCount;
		var oPicPerArr = pikArray.replace(/ /g,'');
		var picPerArr = oPicPerArr.split(",");
		var actualAdd = 0;
		$(".addedTPic").each(function(){
			cCount++;
			var picPer = picPerArr[eCount];
			var textData = $(this).find(".textHolder").find(".editText").val();
			if (textData != "") {
			var checkPlus = picPer;
			if (picPer != 0) {
			cEArray.push(cCount);
			rEArray.push(textData);
			for (u = 0; u < checkPlus; u++) {
			var cPic = $("#roomE"+cCount+"\\["+u+"\\]").prop("files")[0];
			var checkPicE = cPic.name;
			if (checkPicE != "") { eArray.append("files["+u+"][]", cPic); 
			var unpackClass = $("#roomE"+cCount+"\\["+u+"\\]").attr("class");
			unpackClass = unpackClass.split(" ");
			var newClass = unpackClass[0]+" editTour "+unpackClass[2];
			$("#roomE"+cCount+"\\["+u+"\\]").attr("class", newClass); 
			actualAdd++;
			}
			else { picPer = picPer - 1; $("#roomE"+cCount+"\\["+u+"\\]").remove(); }
						}
			if (picPer == 0) { picPerArr[eCount] = 0; }
			else { picPerArr[eCount] = picPer; 
				if (checkPlus != picPer) { var editSelect = $("#pHold"+propNum+"-"+cCount).find(".picEAmnt"); editSelect.val(picPer); 
				var esClass = editSelect.attr("class");
				esClass = esClass.split(" ");
				var newESClass = esClass[0]+" "+esClass[1]+" contains"+picPer;
				editSelect.attr("class", newESClass);
							}
						}
					}
				} else { picPerArr[eCount] = 0; }
			eCount++;
			});
			var fixGPics = "";
			for (s = 0; s < picPerArr.length; s++) { if (picPerArr[s] != 0) { fixGPics = fixGPics+picPerArr[s]+","; } }
			fixGPics = fixGPics.slice(0,-1);
			GPicArray1[pikKey] = fixGPics;
			
			if (actualAdd > 0) {
			$.ajax({
				url: '/core-files/format_gallery.php?dataType=edit&propertyNumber='+propNum+'&roomCount='+cEArray+'&roomArray='+picPerArr+'&roomName='+rEArray+'&propType='+bType,
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: eArray,                    
				type: 'post',
				success: function(data) { $("#editVConfirmed").stop().fadeIn(500); setTimeout(function() { $("#editVConfirmed").stop().fadeOut(500); },3000); }
					})
				}
			}
		
		function DeleteRooms(crntDBVar, propTarget, propArrK) {
		var deleteString = deleteRoom[propArrK];
		var removeArray = deleteString.split(",");
		var printKeys = "";
		for (t = 0; t < removeArray.length; t++) {
		var delValue = removeArray[t];
		if (delValue == 0) { printKeys = printKeys+t+","; }
			}
		printKeys = printKeys.slice(0,-1);
			$.ajax({
				type: "POST",
				url: "operations/editListing.php", 
				data: { editType: "delete", propType: crntDBVar, propID: propTarget, deleteKeys: printKeys },
				success: function(data) { console.log(data); }
			})
		}
		
		function AddTourPic(dType, propNum2, pic2ID, nPArray, oPArray) {
		var ePArray = new FormData();
		oPArray = oPArray.replace(/ /g,'');
		var origPA = oPArray.split(",");
		nPArray = nPArray.replace(/ /g,'');
		var newPA = nPArray.split(",");
		var changePA = new Array();
		var trackArray = new Array();
		for (m = 0; m < origPA.length; m++) {
		if (newPA[m] != origPA[m]) { getRoomIDN = m+1; var chainData = getRoomIDN+"-"+origPA[m]+"-"+newPA[m]; changePA.push(chainData); } 
			}
		for (n = 0; n < changePA.length; n++) {
		var getSerialP = changePA[n];
		getSerialP = getSerialP.split("-");
		var spID = getSerialP[0];
		var spOA = parseInt(getSerialP[1]);
		var spNA = parseInt(getSerialP[2]);
		var goToStop = spNA;
		var checkT = $("#roomNameE"+spID).val();
			for (l = spOA; l < goToStop; l++) {
			var cPic = $("#roomE"+spID+"\\["+l+"\\]").prop("files")[0];
			var checkPicE = cPic.name;
			if (checkPicE != "") { ePArray.append("files["+spID+"]["+l+"]", cPic); trackArray.push(l); } 
			else { spNA = spNA - 1; $("#roomE"+spID+"\\["+l+"\\]").remove(); }
				}
			if (spNA <= spOA) { changePA[n] = 0; }
			else { var chain2 = spID+"-"+spOA+"-"+spNA; 
			origPA[n] = spNA;
			newPA[n] = spNA;
			changePA[n] = chain2; 
			if (goToStop != spNA) {
			var addTPic = $("#pHold"+propNum2+"-"+n).find(".picAmntF"); 
			addTPic.val(picPer); 
				var asClass = addTPic.attr("class");
				asClass = asClass.split(" ");
				var newASClass = asClass[0]+" "+asClass[1]+" contains"+picPer;
				addTPic.attr("class", newASClass);
					}
				}
			}
		var replaceNString = "";
		for (f = 0; f < origPA.length; f++) { replaceNString = replaceNString+origPA[f]+","; }
		replaceNString = replaceNString.substr(0, replaceNString.length-1); 
		GPicArray1[pic2ID] = replaceNString;
		console.log("Show GPic:"+GPicArray1);
			$.ajax({
				url: '/core-files/format_gallery.php?dataType=addpics&propertyNumber='+propNum2+'&addPicArray='+changePA+'&propType='+dType,
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: ePArray,                    
				type: 'post',
				success: function(data) { var dataString = data; dataString = dataString.split("+"); 
				for (g = 0; g < dataString.length; g++) { var dataSplice = dataString[g]; dataSplice = dataSplice.split("|");
				var newRID = dataSplice[0]; var picAddress = dataSplice[1];
				picAddress = picAddress.split(",");
				var addPicToScroll = "";
					for (z = 0; z < picAddress.length; z++) { var picAddNum = trackArray[z]; 
					var picFullAddress = picAddress[z];
					addPicToScroll = addPicToScroll+"<img class='pic"+picAddNum+"' style='float:left; width:20.42vw; border-top:1px solid #b3b3b3; border-right:1px solid #b3b3b3; max-height:22vh;' src='"+picFullAddress+"'/>"; 
					var cloneDestroy = $("#roomE"+newRID+"\\["+picAddNum+"\\]");
					cloneDestroy.replaceWith( cloneDestroy = cloneDestroy.clone( true ) );
					$("#rSpan"+newRID+"-"+picAddNum).css({"paddingLeft":"0.3vw"}).text("Replace");
						}
				$("#pHold"+propNum2+"-"+newRID).find(".picReel").append(addPicToScroll); }
					}
				})
			}
			
			function ReorderRooms(propNum3, pKeyID) {
			var rOrderT = roomOrder[pKeyID];
			rOrderSplit = rOrderT.split(",");
			var originalST = roomOrder2[pKeyID];
			originalST = originalST.replace("'","");
			originalST = originalST.replace("'","");
			originalSplit = originalST.split(",");
			var newOrder = "No";
			var checkNRoom = new Array();
			var hasNRoom = 0;
			var adjustArray = 0;
			var addGPic = GPicArray1[pKeyID];
			addGPic = addGPic.split(",");
			var rDelete = deleteRoom[pKeyID];
			var rDeleteFix = rDelete.split(",");
			rDelete = rDelete.split(",");
			var addZero = 0;
			var trackZero = new Array();
			for (p = 0; p < rDelete.length; p++) {
			if (rDelete[p] == 0) { adjustArray++; rDeleteFix.splice(p, 1); addZero++; trackZero.push("REMOVE"); }
			else { trackZero.push(addZero); }
			}
			for (r = 0; r < rOrderSplit.length; r++) { if (rOrderSplit[r] != originalSplit[r]) { newOrder = "Yes"; 
			if ( jQuery.inArray(rOrderSplit[r], originalSplit) == -1 ) { checkNRoom.push(rOrderSplit[r]); hasNRoom++; } 
				} 
			}
			if (newOrder == "Yes") {
			if (hasNRoom != 0) {
			for (h = 0; h < hasNRoom; h++) {
			var goodAdd = 0;
			var checkTRoom = checkNRoom[h];
			var hasText = $("#roomNameE"+checkTRoom).val();
			var removeKey = jQuery.inArray(checkTRoom,rOrderSplit);
			removeKey = parseInt(removeKey);
			var picKey = checkTRoom - 1;
			picKey = picKey - adjustArray;
			if (hasText == "") {
			rOrderSplit.splice(removeKey, 1);
			var crntRoomsN = gPicsC[pKeyID];
			crntRoomsN = parseInt(crntRoomsN);
			crntRoomsN = crntRoomsN - 1;
			gPicsC[pKeyID] = crntRoomsN;
			$("#tour"+propNum3).children("div").eq(removeKey).remove();
			goodAdd++; }
			hasPic = addGPic[picKey];
			if (hasPic == "") {	rOrderSplit.splice(removeKey, 1); $("#tour"+propNum3).children("div").eq(removeKey).remove(); goodAdd++; }
				}
			}
			var finalOrder = "";
			var replaceOrder = "";
			var fixTZero = new Array();
			for (z = 0; z < rOrderSplit.length; z++) {
			var rOz = rOrderSplit[z];
			var downOne = rOz - 1;
			finalOrder = finalOrder+rOz+",";
			var rOrderTrack = trackZero[downOne];
			fixTZero.push(rOrderTrack);
			var plusUp = z+1; replaceOrder = replaceOrder+plusUp+","; }
			finalOrder = finalOrder.slice(0,-1);
			replaceOrder = replaceOrder.slice(0,-1);
			var replaceOArr = replaceOrder.split(",");
			$.ajax({
				type: "POST",
				url: "operations/editListing.php", 
				data: { editType: "reOrder", propID: propNum3, changeOrder: finalOrder, arrayMove: adjustArray },
				success: function(data) { var getConfirm = data; console.log(getConfirm);
				if (getConfirm == "SUCCESS") {
				for(w = 0; w < rOrderSplit.length; w++) { var retrieveR = rOrderSplit[w]; 
				var upInfo = replaceOArr[w];
				openPicArr = retrieveR - 1;
				openPicArr = openPicArr - fixTZero[w];
				var dataPoint1 = addGPic[w];
				var dataPoint2 = addGPic[openPicArr];
				var picLevelA = dataPoint2;
				addGPic[w] = dataPoint2;
				addGPic[openPicArr] = dataPoint1;
				var pHolderElem = $("#pHold"+propNum3+"-"+retrieveR);
				var pCrntEDiv = pHolderElem.parent();
				for (d = 0; d < picLevelA; d++) { var newIDrPic = "roomE"+upInfo+"["+d+"]"; $("#roomE"+retrieveR+"\\["+d+"\\]").attr("id", newIDrPic);  }
				var upID = propNum3+"-"+upInfo;
				var tInputEdit = "roomNameE"+upInfo;
				pCrntEDiv.find(".textHolder").find("input").attr("id",tInputEdit);
				pCrntEDiv.find(".textHolder").find("label").find(".rNumber").text(upInfo);
				var crntTDelete = pHolderElem.find(".deleteRoom");
				var nTDClass = "deleteRoom remove"+upID;
				var fixTDClass = crntTDelete.attr("class",nTDClass);
				pCrntEDiv.appendTo("#tour"+propNum3); 
				var nEPEdit = "pHold"+upID;
				pHolderElem.attr("id",nEPEdit);
								}
				var finalGPics = "";
				for (j = 0; j < addGPic.length; j++) { finalGPics = finalGPics+addGPic[j]+","; }
			    finalGPics = finalGPics.slice(0,-1);
				GPicArray1[pKeyID] = finalGPics;
				GPicArray2[pKeyID] = finalGPics;
				if (delCount[pKeyID] != 0) {
				var updateDeleteMatrix = "";
				for (f = 0; f < rDeleteFix.length; f++) { updateDeleteMatrix = updateDeleteMatrix+rDeleteFix[f]+","; }
				updateDeleteMatrix = updateDeleteMatrix.slice(0,-1);
				deleteRoom[pKeyID] = updateDeleteMatrix;
				delCount[pKeyID] = 0;
				}
				roomOrder[pKeyID] = replaceOrder;
				roomOrder2[pKeyID] = replaceOrder;
				gPicsC2[pKeyID] = gPicsC[pKeyID];
							}
						}
					});
				}
			}
						
			function checkPicSize(pSize, pSizeID, warn) {
			if (pSize > 1000) { 
			pSize = pSize * 0.001; 
			if (pSize > 1000) { pSize = pSize * 0.001; 
				if (pSize > 3) { $(warn).stop().fadeIn(400); 
				var newMPic = $(pSizeID); 
				newMPic.replaceWith( newMPic = newMPic.clone( true ) );
				setTimeout(function() { $(warn).stop().fadeOut(400); },2000); 
						} else { return "Good"; }
					} else { return "Good"; }
				} else { return "Good"; }
			}

function page1() {
		$("#auto").autocomplete({source: cities});
		$.ui.autocomplete.filter = function (array, term) {
        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
        return $.grep(array, function (value) {
            return matcher.test(value.label || value.value || value);
			});
		};
		$("#p-available").datepicker();
		
		$("#vtour").change(function() {
		$("#checkHolder").stop().fadeOut(500);
		$("#fBox3").stop().animate({"minHeight":"38vh"},1000);
		setTimeout(function() {
		$("#checkContent").stop().fadeIn(500);
		}, 500);
		});	
		$("#p-mainPic").change(function() {
		if (document.getElementById("p-mainPic").files.length == 0){ has_pic = 0; }
		else { has_pic = 1; checkPicSize(this.files[0].size,"#p-mainPic","#mPicexceeds"); }
		});
		
		$(document).on("click", "#addRooms", function() {
		if (roomCount == 0) { $("#howMany").text("Add More Rooms: "); }
		var getRCount = $("#vColumn").val();
		var numberCheck = $.isNumeric(getRCount);
		if (numberCheck == true) {
		var checkMax = parseInt(roomCount) + parseInt(getRCount);
		if (checkMax <= 10) {
		AddRooms(getRCount, roomCount); 
		$(".picAmnt").change(function() {
		var getSelect = $(this).attr("class");
		getSelect = getSelect.split(" ");
		var dPicCount = getSelect[2];
		getSelect = getSelect[1];
		var addPicA = $(this).val();
		addPicA = parseInt(addPicA);
		getSelect = getSelect.replace("select","");
		dPicCount = dPicCount.replace("contains","");
		getSelect = parseInt(getSelect);
		dPicCount = parseInt(dPicCount);
		var updateContains = addPicA;
		if (dPicCount < addPicA) {
		var addFileUpload = "";
		var addFilePreview = "";
		for (j = dPicCount; j < addPicA; j++) {
		addFileUpload = addFileUpload + "<span id='rSpan"+getSelect+"-"+j+"' style='float:left; font-size:1.3vw; font-family:Questrial; padding-left:2.73vw; padding-bottom:0.5vh; padding-right:0.5vw; padding-top:0.5vh;cursor:default;'>Add: </span><input id='room"+getSelect+"["+j+"]' class='createNTour row"+j+"' type='file' style='float:left; width:14.52vw; padding-bottom:0.5vh; border-right:1px solid #b3b3b3; padding-top:0.5vh;'/>";
		addFilePreview = addFilePreview + "<img id='picPrevN"+getSelect+"-"+j+"' style='float:left; width:20.42vw; max-height:22vh; cursor:default;' src='' />";
				}
		$("#picContent"+getSelect).append(addFileUpload);
		$("#picContent"+getSelect).find(".picReel").append(addFilePreview);
			} else if (dPicCount > addPicA) {
			for (d = addPicA; d <= dPicCount; d++) { $("#room"+getSelect+"\\["+d+"\\]").remove(); $("#rSpan"+getSelect+"-"+d).remove();  $("#picPrevN"+getSelect+"-"+d).remove(); }
			}
		eachRoom[getSelect] = addPicA;
		$(this).removeClass("contains"+dPicCount);
		$(this).addClass("contains"+addPicA);
		});
			} else { $("#boxExceed").stop().fadeIn(400); setTimeout(function() { $("#boxExceed").stop().fadeOut(400); },2000); }
		}
		else { $("#numberWarning").stop().fadeIn(400); setTimeout(function() { $("#numberWarning").stop().fadeOut(400); },2000); }
		});
				
		$(document).on("click", ".createNTour", function() {
		$(".createNTour").change(function () {
		var getRow = $(this).attr("class");
		getRow = getRow.split(" ");
		getRow = getRow[1];
		getRow = getRow.replace("row","");
		var gCPID = $(this).parent().parent().find(".vData1").attr("id");
		gCPID = gCPID.replace("roomName","");
		var gPSize = this.files[0].size;
		var sendID = "#room"+gCPID+"\\["+getRow+"\\]";
		checkPicSize(gPSize,sendID,"#vTourExceed");
		var checkEFP = checkPicSize(gPSize,sendID,"#vTourExceed");
		if (checkEFP == "Good") {
		var reader = new FileReader();
		reader.readAsDataURL(this.files[0]);
		var findNPrevPic = "picPrevN"+gCPID+"-"+getRow;
		reader.onload = function (e) {  $("#"+findNPrevPic).attr('src', e.target.result).css({"width":"20.42vw","borderTop":"1px solid #b3b3b3","borderRight":"1px solid #b3b3b3"}); }
				}
			});
		});
				
		var dataArr = new Array();
		$(document).on("click", "#addProp", function() {
		var dataType = "";
		var dbType = "";
		if (!$("input[name='sellorrent']:checked").val()) {	$("#SelectWarning").stop().fadeIn(400);	setTimeout(function() { $("#SelectWarning").stop().fadeOut(400); },2000); }
		else {
		var hasNull = '';
		$(".required").each(function(){	var reqData = $(this).val(); if (reqData == "") { hasNull = "NULL"; } });
		if (hasNull == "NULL") { $("#reqWarning").stop().fadeIn(400); setTimeout(function() { $("#reqWarning").stop().fadeOut(400); },2000); }
		else {
		if (document.getElementById('selling').checked) { dataType = "AddProperty"; dbType = "buy-home"; }
		if (document.getElementById('renting').checked) { dataType = "AddRental"; dbType = "rent"; }
		$(".selectData").each(function(){
			var grabData = $(this).val();
			if (grabData == "") { grabData = "N/A"; }
			dataArr.push(grabData);
		});
			var getDate = dataArr[7];
			var fixDate = getDate.split("/");
			var assembleDate = fixDate[2]+"-"+fixDate[0]+"-"+fixDate[1];
			dataArr[7] = assembleDate;
			var propCost = dataArr[4];
			if ( propCost.indexOf('$') !== -1 ) { propCost.replace("$", ""); dataArr[4] = propCost; }
		var picContent = '';
		var picName = '';
		if (has_pic == 1) {
		var form = $('#p-mainPic').prop("files")[0];
		picName = form.name;
		picContent = new FormData();
		picContent.append("file", form);
		AddThumb(picName, picContent, dataType);
		} else { picName = "NULL"; }
		var haveGall = 'No';
		var getGTitles = "NULL";
		AddTour(dbType,"#roomName","#room","add",eachRoom); 
		if (hasGallery != 0) { haveGall = 'Yes'; getGTitles = rArray; }
		$.ajax({
			type: "POST",
			url: "/core-files/propertyManager.php", 
			data: { dataRequest: dataType, userID: currentUser, addStreet: dataArr[0], addCity: dataArr[1], addBedrooms: dataArr[2], addBathrooms: dataArr[3], addCost: dataArr[4], addBuilt: dataArr[5], addType: dataArr[6], addAvail: dataArr[7], addSize: dataArr[8], addCooling: dataArr[9], addHeating: dataArr[10], addFireplace: dataArr[11], addParking: dataArr[12], addLot: dataArr[13], addDesc: dataArr[14], thumbName: picName, hasGallery: haveGall, rArray:getGTitles, rPer:eachRoom },
			success: function (data) { $(".selectData").val(''); 
			$("#tabScroll").append(data);
			$("#listingAdded").stop().fadeIn(500);
			setTimeout(function() { $("#listingAdded").stop().fadeOut(500); },3000);
			var mPic = $("#p-mainPic"); mPic.replaceWith( mPic = mPic.clone( true ) );
			$("#roomHolder").empty();
			$("#howMany").text("Add Virtual Tour: ");
			$("#vtour").attr('checked', false);
			$("#selling").attr('checked', false);
			$("#renting").attr('checked', false);
			$("#checkHolder").fadeIn(500);
			$("#checkContent").hide();
			$("#fBox3").stop().animate({"minHeight":"7vh"},1500);
			if (document.getElementById("noListings") !== null) { $("#noListings").hide(); }
						}
					})
				}
			}
		});						
	}
	
	function page2() {
	var editComplete = 0;
	var changePic = new Array();
	var addPicEdit = new Array();
	var addNewPicEdit = new Array();
	var changeText = new Array();
	
	 $(".tourField ").sortable({
	 stop: function( event, ui ) {
	 var crntOrder = $(this).sortable("widget");
	 var getIDArray = "";
	 var getDiv = $(crntOrder).attr("id");
	 $("#"+getDiv).children().each(function(){
	 var loopName = $(this).find(".picHolder").attr("id");
	 loopName = loopName.split("-");
	 loopName = loopName[1];
	 loopName = parseInt(loopName);
	 getIDArray = getIDArray+loopName+",";
	 });
	 getIDArray = getIDArray.slice(0,-1);
	 var crntIDPos = getIDArray.split(",");
	 getIDArray = getIDArray;
	 var getSortEl = ui.item.find(".picHolder");
	 var sortName = getSortEl.attr("id");
	 sortName = sortName.split("-");
	 var tElem = sortName[0].replace("pHold","");
	 var sortRoomC = sortName[1];
	 tElem = parseInt(tElem);
	 var sortKey = jQuery.inArray(tElem,gRooms);
	 rOrderEdit[sortKey] = 1;
	 roomOrder[sortKey] = getIDArray;
	 var newNumID = jQuery.inArray(sortRoomC,crntIDPos);
	 newNumID = parseInt(newNumID);
	 newNumID = newNumID+1;
	 getSortEl.parent().find(".textHolder").find("label").find(".rNumber").text(newNumID);
	 for (o = newNumID; o <= sortRoomC; o++) { var plusOne = o; plusOne++; $("#tour"+tElem).children("div").eq(o).find(".textHolder").find("label").find(".rNumber").text(plusOne); }
		}
	 });
	 
	 $(document).on("click", ".deleteRoom", function() {
	 var whichRoom = $(this).attr("class");
	 whichRoom = whichRoom.split(" ");
	 whichRoom = whichRoom[1];
	 whichRoom = whichRoom.split("-");
	 var whichProp = whichRoom[0];
	 whichProp = whichProp.replace("remove", "");
	 whichProp = parseInt(whichProp);
	 var whichARoom = whichRoom[1];
	 var whichARoom1 = parseInt(whichARoom);
	 var whichSerial = whichProp+"-"+whichARoom;
	 var sortKey = jQuery.inArray(whichProp,gRooms);
	 var roomG = GPicArray1[sortKey];
	 roomG = roomG.split(",");
	 var thisOrder = roomOrder[sortKey];
	 thisOrder = thisOrder.split(",");
	 var roomKey = jQuery.inArray(whichARoom,thisOrder);
	 var roomLength = thisOrder.length;
	 var getDelete = deleteRoom[sortKey];
	 getDelete = getDelete.split(",");
	 var whichType = $(this).parent().find(".editFile").hasClass("nTour");
	 if (whichType == true) { 
	 getDelete.splice(roomKey, 1); 
	 var gPRooms = gPicsC[sortKey];
	 gPRooms = gPRooms - 1;
	 gPicsC[sortKey] = gPRooms;
	 }
	 else {
		getDelete[roomKey] = 0; 
		var removePicN = roomG[roomKey];
		for (x = 0; x < removePicN.length; x++) {
		var whichPic = whichSerial+"-"+x;
	 	if ( jQuery.inArray(whichPic, changePic) != -1 ) {
			changePic.splice(changePic.indexOf(whichSerial), 1);
			var reduceChange = parseInt(picChange[sortKey]);
			reduceChange = reduceChange - 1;
			picChange[sortKey] = reduceChange;
			}
		}
		if ( jQuery.inArray(whichSerial, changeText) != -1 ) {
			changeText.splice(changeText.indexOf(whichSerial), 1);
			var reduceChange2 = parseInt(textChange[sortKey]);
			reduceChange2 = reduceChange2 - 1;
			textChange[sortKey] = reduceChange2;
			}
		delCount[sortKey] = 1;
	 }
	 var orderKey = jQuery.inArray(whichARoom,thisOrder); 
	 thisOrder.splice(orderKey, 1); 
	 var fixOString = "";
	 for (a = 0; a < thisOrder.length; a++) { fixOString = fixOString+thisOrder[a]+","; }
	 fixOString = fixOString.slice(0,-1);
	 roomOrder[sortKey] = fixOString;
	 var fixDelete = "";
	 for (k = 0; k < getDelete.length; k++) { fixDelete = fixDelete+getDelete[k]+","; }
	 fixDelete = fixDelete.slice(0,-1);
	 deleteRoom[sortKey] = fixDelete;
	 var fixGPics = "";
	 roomG.splice(roomKey, 1);
	 for (b = 0; b < roomG.length; b++) { fixGPics = fixGPics+roomG[b]+","; }
	 fixGPics = fixGPics.slice(0,-1);
	 GPicArray1[sortKey] = fixGPics;
	 rOrderEdit[sortKey] = 1;
	 $(this).parent().parent().remove();
	 if (roomKey != roomLength) {
	 for (y = whichARoom1; y < roomLength; y++) { var plusOne = y; plusOne = plusOne - 1; $("#tour"+whichProp).children("div").eq(plusOne).find(".textHolder").find("label").find(".rNumber").text(y); }
	 }
	 });
	 
		$(document).on("click", ".editListing", function() {
		$("#tabScroll").css({"overflowY":"hidden"});
		var getOpenID = $(this).attr("id");
		getOpenID = getOpenID.replace("openEntry","");
		$(this).parent().parent().find(".submitEdit").show();
		$(".homelisting").each(function() {
		var hideID = $(this).attr("id");
		var hideID = hideID.replace("list","");
		if (hideID != getOpenID) { $("#list"+hideID).hide(); }
		});
		$("#entry"+getOpenID).slideDown("4000");
		var getButton = $(this).attr("id");
		$("#"+getButton).stop().fadeOut("350");
		setTimeout(function() { $("#switch"+getOpenID).show(); $("#extraOptions"+getOpenID).show(); }, 450);
			});
		
		$(document).on("click", ".switchItem", function() {
		if (editComplete == 0) {
		var whichClass = $(this).hasClass('switchClicked');
		if (whichClass == false) {
		var getSwitchID = $(this).parent().attr("id");
		getSwitchID = getSwitchID.replace("switch","");
		var whichItem = $(this).hasClass("dEdit");
		if (whichItem == true) {
		wTab = 0;
		$(this).parent().find(".vEdit").removeClass("switchClicked");
		$(this).addClass("switchClicked");
		if (document.getElementById("vTopHolder"+getSwitchID) !== null) { $("#vTopHolder"+getSwitchID).stop().fadeOut(500); }
		$("#tour"+getSwitchID).stop().fadeOut(500); 
		setTimeout(function() {
		$("#entry"+getSwitchID).stop().fadeIn(500);
			},500);
		}
		else {
		wTab = 1;
		$(this).parent().find(".dEdit").removeClass("switchClicked");
		$(this).addClass("switchClicked");
		$("#entry"+getSwitchID).stop().fadeOut(500); 
		setTimeout(function() {
		$("#tour"+getSwitchID).stop().fadeIn(500);
		if (document.getElementById("vTopHolder"+getSwitchID) !== null) { $("#vTopHolder"+getSwitchID).stop().fadeIn(500); }
						},500);
					}
				}
			} else { $("#timeVError").stop().fadeIn(400); setTimeout(function() { $("#timeVError").stop().fadeOut(400); },2000); }
		});
		
		$(document).on("click", ".closeEntry", function() {
		if (editComplete == 0) {
		$("#tabScroll").css({"overflowY":"auto"});
		$(this).parent().parent().parent().find(".subtab").slideUp("3000");
		$(this).parent().fadeOut(500);
		$(this).parent().parent().find(".enterSwitch").fadeOut(500);
		$(this).parent().parent().parent().find(".submitEdit").fadeOut(500);
		var getID = $(this).parent().parent().find(".editListing").attr("id");
		setTimeout(function() { $("#"+getID).fadeIn(500); }, 500);
		var gButton = getID.replace("openEntry","");
		$(".switchClicked").removeClass("switchClicked");
		$("#switch"+gButton).find(".dEdit").addClass("switchClicked");
		setTimeout(function() {
		$(".homelisting").each(function() {
		var hideID = $(this).attr("id");
		var hideID = hideID.replace("list","");
		if (hideID != gButton) { $("#list"+hideID).show(); }
		});},500);
		if (document.getElementById("vTopHolder"+gButton) !== null) { $("#vTopHolder"+gButton).stop().fadeOut(500); }
			} else { $("#timeVError").stop().fadeIn(400); setTimeout(function() { $("#timeVError").stop().fadeOut(400); },2000); }
		});
		
		$(document).on("click", ".eRoomsPlus", function() {
		var findVID = $(this).attr("id");
		findVID = findVID.replace("editAddRooms","");
		var getECount = $("#eColumn"+findVID).val();
		var numberCheck2 = $.isNumeric(getECount);
		if (numberCheck2 == true) {
		var checkMax2 = parseInt(roomCount2) + parseInt(getECount);
		if (checkMax2 <= 10) { AddRoomsEdit(getECount,findVID); 
		$(".picAmntF").change(function() {
		var roomNID = $(this).parent().attr("id");
		roomNID = roomNID.split("-");
		roomNID = roomNID[1];
		var getSelect = $(this).attr("class");
		getSelect = getSelect.split(" ");
		var dPicCount = getSelect[2];
		getSelect = getSelect[1];
		var addPicA = $(this).val();
		addPicA = parseInt(addPicA);
		getSelect = getSelect.replace("select","");
		dPicCount = dPicCount.replace("contains","");
		getSelect = parseInt(getSelect);
		dPicCount = parseInt(dPicCount);
		var updateContains = addPicA;
		if (dPicCount < addPicA) {
		var addFileUpload = "";
		var addFilePreview = "";
		for (j = dPicCount; j < addPicA; j++) {
		addFileUpload = addFileUpload + "<span id='rSpan"+roomNID+"-"+j+"' style='float:left; font-size:1.3vw; font-family:Questrial; padding-left:2.73vw; padding-bottom:0.5vh; padding-right:0.5vw; padding-top:0.5vh;cursor:default;'>Add: </span><input id='room"+getSelect+"editAdd"+roomNID+"["+j+"]' class='newFile row"+j+"' type='file' style='float:left; width:14.52vw; padding-bottom:0.5vh; border-right:1px solid #b3b3b3; padding-top:0.5vh;'/>";
		addFilePreview = addFilePreview + "<img id='picPrev"+roomNID+"-"+j+"' style='float:left; width:20.42vw; max-height:22vh; cursor:default;' src='' />";
				}
		var aPHold = $("#pHold"+findVID+"-"+roomNID);
		aPHold.append(addFileUpload);
		aPHold.find(".picReel").append(addFilePreview); 
		
			} else if (dPicCount > addPicA) {
			for (d = addPicA; d <= dPicCount; d++) { $("#room"+getSelect+"editAdd"+roomNID+"\\["+d+"\\]").remove(); $("#rSpan"+roomNID+"-"+d).remove(); $("#picPrev"+roomNID+"-"+d).remove(); }
			}
		newRooms[roomNID] = addPicA;
		console.log(newRooms);
		$(".pBox"+findVID).removeClass("contains"+dPicCount);
		$(".pBox"+findVID).addClass("contains"+addPicA);
			});
		}
		else { $("#bExceed"+findVID).stop().fadeIn(400); setTimeout(function() { $("#bExceed"+findVID).stop().fadeOut(400); },2000); } 
		}
		else { $("#numberWarning"+findVID).stop().fadeIn(400); setTimeout(function() { $("#numberWarning"+findVID).stop().fadeOut(400); },2000); }
		});
		
		$(document).on("click", ".deleteTRoom", function() {
		if (roomCount2 != 1) {
		var fIDTemp = $(this).attr("class");
		fIDTemp = fIDTemp.split(" ");
		fIDTemp = fIDTemp[1];
		fIDTemp = fIDTemp.split("-");
		var pIDTemp = fIDTemp[0];
		pIDTemp = pIDTemp.replace("remove","");
		fIDTemp = fIDTemp[1];
		fIDTemp = fIDTemp - 1;
		console.log(fIDTemp);
		var editHolderObj = $(this).parent().parent().parent();
		editHolderObj.children("div").eq(fIDTemp).remove();
		var nCountR = parseInt(roomCount2);
		nCountR = nCountR - 1;
		for ( c = fIDTemp; c < nCountR; c++ ) {
		roomCount2 = roomCount2 - 1;
		var oneUp = c + 1;
		var crntLoopDiv = editHolderObj.children("div").eq(c);
		crntLoopDiv.find(".textHolder").find("label").find(".rNumber").text(oneUp);
		var tInputTemp = "editAdd"+oneUp;
		crntLoopDiv.find(".textHolder").find("input").attr("id",tInputTemp);
		var crntPHolder = crntLoopDiv.find(".picHolder");
		var crntSelectPics = crntPHolder.find(".picAmntF");
		var crntHPics = crntSelectPics.val();
		var crntTDelete = crntPHolder.find(".deleteTRoom");
		var nTDClass = "deleteTRoom remove"+pIDTemp+"-"+oneUp;
		var fixTDClass = crntTDelete.attr("class",nTDClass);
		for (l = 0; l < crntHPics; l++) { var nTempTitle = "room"+pIDTemp+"editAdd"+oneUp+"["+l+"]"; crntPHolder.find("newFile").attr("id",nTempTitle); }
		var nHoldTempT = "pHold"+pIDTemp+"-"+oneUp;
		crntPHolder.attr("id",nHoldTempT);
				}
			}
		});
		
		$(".eTourC").change(function() {
		var findTourID = $(this).attr("id");
		findTourID = findTourID.replace("etour","");
		$("#tour"+findTourID).find(".checkHolder2").stop().fadeOut(500);
		setTimeout(function() {
		$("#tour"+findTourID).find(".checkContent2").fadeIn(500);
		}, 500);
		});
		
		$(document).on("click", ".addRooms", function() {
		if (editComplete == 0) {
		var getButtonID = $(this).attr("id");  
		var addID = getButtonID.replace("addR","");
		addID = parseInt(addID);
		var getKey = jQuery.inArray(addID,gRooms);
		var roomAmount = gPicsC[getKey];
		var grabPArray = GPicArray1[getKey];
		grabPArray = grabPArray+",1";
		GPicArray1[getKey] = grabPArray;
		var plusRoom = parseInt(roomAmount) + 1;
		if (plusRoom <= 10) {
		$("#tour"+addID).append("<div id='list"+plusRoom+"' class='addedTPic' style='position:relative; float:left; width:100%; height:34.3vh; border-bottom:1px solid #b3b3b3; background:#FFF; cursor:pointer;'><div class='textHolder' style='position:absolute; padding-left:1%; width:50%; padding-top:1vh; padding-bottom:1.5vh; clear:both; z-index:11;'><label for='roomNameE"+plusRoom+"' style='float:left; font-size:1.5vw; font-family:Questrial; margin-right:0.3vw; margin-top:0.2vh;'><span class='rNumber'>"+plusRoom+"</span>. Room Name: </label><input type='text' id='roomNameE"+plusRoom+"' class='editText nTour' style='float:left; width:13.5vw; height:3vh; margin-top:0.2vh;' placeholder='master bedroom, dining room, garage'/></div><div id='pHold"+addID+"-"+plusRoom+"' class='picHolder pBox"+addID+"' style='position:absolute; top:0; left:0; width:100%; height:34.3vh; overflow-x:scroll; clear:both; z-index:10;'><span style='position:absolute; top:1.5vh; right:14vw; font-size:1.5vw; font-family:Questrial;cursor:default;'>Add/Remove Pictures:</span><select class='picEAmnt select"+plusRoom+" contains1' style='position:absolute; top:1vh; right:10vw; height:4vh; width:3vw; margin-left:0.2vw;'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option></select><span  class='deleteRoom remove"+addID+"-"+plusRoom+"' style='position:absolute; top:1.5vh; right:1vw; font-size:1.5vw; font-family:Questrial; color:red; cursor:pointer;'>Delete X</span><div class='picReel' style='float:left; width:100%; height:22vh; margin-top:6.4vh; padding-top:0.1vh; clear:both;'></div><span style='float:left; font-size:1.3vw; font-family:Questrial; padding-left:2.73vw; padding-bottom:0.5vh; padding-right:0.5vw; padding-top:0.5vh;cursor:default;'>Add: </span><input id='roomE"+plusRoom+"[0]' class='editFile nTour row0' type='file' style='float:left; width:14.52vw; padding-bottom:0.5vh; border-right:1px solid #b3b3b3; padding-top:0.5vh;'/></div></div>");
		gPicsC[getKey] = plusRoom;
		var addRoomTA = roomOrder[getKey];
		addRoomTA = addRoomTA+","+plusRoom;
		roomOrder[getKey] = addRoomTA;
		var addDelete = deleteRoom[getKey];
		addDelete = addDelete+",1";
		deleteRoom[getKey] = addDelete;
		$("#tour"+getButtonID).sortable("refresh");
		addEditRooms[getKey] = 1;
		addOrEdit[getKey] = 2; } else { $("#bExceed"+addID).stop().fadeIn(400); setTimeout(function() { $("#bExceed"+addID).stop().fadeOut(400); },2000); }
			} else { $("#timeVError").stop().fadeIn(400); setTimeout(function() { $("#timeVError").stop().fadeOut(400); },2000); }
		});
		
		$(document).on("click", ".picEAmnt", function() {
		$(".picEAmnt").change(function() {
		var getSelect = $(this).attr("class");
		getSelect = getSelect.split(" ");
		var dPicCount = getSelect[2];
		getSelect = getSelect[1];
		var addPicA = $(this).val();
		addPicA = parseInt(addPicA);
		getSelect = getSelect.replace("select","");
		dPicCount = dPicCount.replace("contains","");
		getSelect = parseInt(getSelect);
		dPicCount = parseInt(dPicCount);
		var picEAType = $(this).parent().find(".row0").hasClass("editTour");
		var printType = "";
		if (picEAType == true) { printType = "editTourAdd"; }
		else { printType = "nTourAdd"; }
		var gVPropID = $(this).parent().attr("id");
		gVPropID = gVPropID.split("-");
		var cRoomID = gVPropID[1];
		gVPropID = gVPropID[0];
		gVPropID = parseInt(gVPropID.replace("pHold",""));
		var updateArrA = jQuery.inArray(gVPropID,gRooms);
		var updateArr = GPicArray1[updateArrA];
		updateArr = updateArr.split(",");
		if (dPicCount < addPicA) {
		var addFileUpload = "";
		for (j = dPicCount; j < addPicA; j++) {
		addFileUpload = addFileUpload + "<span id='rSpan"+cRoomID+"-"+j+"' style='float:left; font-size:1.3vw; font-family:Questrial; padding-left:2.73vw; padding-bottom:0.5vh; padding-right:0.5vw; padding-top:0.5vh;cursor:default;'>Add: </span><input id='roomE"+cRoomID+"["+j+"]' class='editFile "+printType+" row"+j+"' type='file' style='float:left; padding-bottom:0.5vh; padding-top:0.5vh;'/>";
				}
		$(this).parent().append(addFileUpload);
			} else if (dPicCount > addPicA) {
			for (d = addPicA; d <= dPicCount; d++) { var crntElement = $("#roomE"+cRoomID+"\\["+d+"\\]"); 
			var eClass = crntElement.hasClass("editTour"); 
			var childC = d+1;
			if (eClass == true) {
			var sItem = gVPropID+"-"+cRoomID+"-"+d;
			if ( jQuery.inArray(sItem, changePic) != -1 ) {
					changePic.splice(changePic.indexOf(sItem), 1);
					var reduceChange = parseInt(picChange[updateArrA]);
					reduceChange = reduceChange - 1;
					picChange[updateArrA] = reduceChange;
					}
				crntElement.parent().find(".picReel").find(".pic"+d).remove();
				}
			crntElement.parent().children("span").eq(childC).remove();
			crntElement.remove(); 
				}
			}
		if (GPicArray2[updateArrA] == addPicA) { if (editChange[updateArrA] == 0) { addOrEdit[updateArrA] = 0; } }
		else { updateArr[updateArrA] = addPicA; addOrEdit[updateArrA] = 2; }
		var updateArr2 = "";
		for (s = 0; s < updateArr.length; s++) { updateArr2 = updateArr2+updateArr[s]+", "; }
		updateArr2 = updateArr2.substr(0, updateArr2.length-2);
		GPicArray1[updateArrA] = updateArr2;
		$(this).removeClass("contains"+dPicCount);
		$(this).addClass("contains"+addPicA);
			});
		});
		
		$(document).on("click", ".editFile", function() {
		$(".editFile").change(function() { 
		var aCPID = $(this).parent().attr("id");
		var classPID = $(this).attr("class");
		classPID = classPID.split(" ");
		classPID = classPID[2];
		classPID = classPID.replace("row","");
		aCPID = aCPID.split("-");
		aCPID = aCPID[0];
		aCPID = aCPID.replace("pHold","");
		var eCPID = $(this).parent().parent().find(".textHolder").find(".editText").attr("id");
		eCPID = eCPID.replace("roomNameE","");
		var ePSize = this.files[0].size;
		var sendID = ".pBox"+aCPID+" #roomE"+eCPID+"\\["+classPID+"\\]";
		var warnID = "#pExceed"+aCPID;
		var checkEFP = checkPicSize(ePSize,sendID,warnID);
		if (checkEFP == "Good") {
		var checkNewF = $(this).hasClass("editTourAdd");
		var checkNewAddF = $(this).hasClass("nTourAdd");
		if (checkNewF == true) { var aString1 = aCPID+"-"+eCPID+"-"+classPID;
		if ( jQuery.inArray(aString1, addPicEdit) == -1) {
		addPicEdit.push(aString1); 
		var picKey = jQuery.inArray(aCPID, gRooms);
		hasPicAdded[picKey] = 1; 
			}
		} else if (checkNewAddF == true) { var aString2 = aCPID+"-"+eCPID+"-"+classPID;
		if ( jQuery.inArray(aString2, addNewPicEdit) == -1) { addNewPicEdit.push(aString2); }
					}
				}
			});
		});
		
		$(document).on("click", ".newFile", function() { 
		$(".newFile").change(function() {
		var aCPID = $(this).parent().attr("id");
		var classPID = $(this).attr("class");
		classPID = classPID.split(" ");
		classPID = classPID[1];
		classPID = classPID.replace("row","");
		aCPID = aCPID.split("-");
		aCPID = aCPID[0];
		aCPID = aCPID.replace("pHold","");
		var eCPID = $(this).parent().parent().find(".textHolder").find(".vDataP"+aCPID).attr("id");
		eCPID = eCPID.replace("editAdd","");
		var ePSize = this.files[0].size;
		var sendID = "#room"+aCPID+"editAdd"+eCPID+"\\["+classPID+"\\]";
		var warnID = "#pExceed"+aCPID;
		console.log(ePSize+"|"+sendID+"|"+warnID);
		var checkEFP = checkPicSize(ePSize,sendID,warnID);
		if (checkEFP == "Good") {
		var reader = new FileReader();
		reader.readAsDataURL(this.files[0]);
		var findNPrevPic = "picPrev"+eCPID+"-"+classPID;
		reader.onload = function (e) {  $("#"+findNPrevPic).attr('src', e.target.result).css({"width":"20.42vw","borderTop":"1px solid #b3b3b3","borderRight":"1px solid #b3b3b3"}); }
				}
			});
		});
		
		$(document).on("click", ".editTour", function() { 
		$(".editTour").change(function() {
		if (editComplete == 0) {
		var idEditParent = $(this).parent().parent().parent().attr("id");
		idEditParent = idEditParent.replace("tour","");
		idEditParent = parseInt(idEditParent);
		var editKey = jQuery.inArray(idEditParent,gRooms);
		var idEdit1 = $(this).hasClass("editText");
		var idEdit2 = $(this).hasClass("editFile");
		if (idEdit1 == true) {
		var getChangeID = $(this).attr("id");  
		getChangeID = getChangeID.replace("roomNameE","");
		var wordID = idEditParent+"-"+getChangeID;
		if ( jQuery.inArray(wordID, changeText) == -1 ) { changeText.push(wordID); textChange[editKey] = textChange[editKey]+1; }
		editChange[editKey] = 1;
		addOrEdit[editKey] = 2;
		}
		if (idEdit2 == true) { var getChangeID = $(this).parent().parent().find(".textHolder").find(".editText").attr("id"); 
		getChangeID = getChangeID.replace("roomNameE","");
		var imageID = parseInt(getChangeID);
		var gPRow = $(this).attr("class");
		gPRow = gPRow.split(" ");
		gPRow = gPRow[2];
		gPRow = parseInt(gPRow.replace("row",""));
		gPRow = idEditParent+"-"+getChangeID+"-"+gPRow;
		if ( jQuery.inArray(gPRow, changePic) == -1 ) {	changePic.push(gPRow); picChange[editKey] = picChange[editKey]+1; }
		editChange[editKey] = 1;
		addOrEdit[editKey] = 2;
				}
			} else { $("#timeVError").stop().fadeIn(400); setTimeout(function() { $("#timeVError").stop().fadeOut(400); },2000); }
			});
		});
		
		var propType;
		$(document).on("click", ".submitEdit", function() {
		if (editComplete == 0) {
		editComplete = 1;
		var getButtonID = $(this).attr("id");
		var typeOfProp = $(this).hasClass("buy");
		if (typeOfProp == true) { propType = "buy"; }
		else { propType = "rent"; }
		getButtonID = getButtonID.replace("editEntry","");
		var editVar = $("#switch"+getButtonID).find(".dEdit").hasClass("switchClicked");
		var editType = "";
		var editArr = new Array();
		if ( editVar == true ) {
		editType = "details";
		var classID = ".box"+getButtonID;
		$(classID).each(function(){
			var takeData = $(this).val();
			if (takeData == "") { takeData = "N/A"; }
			editArr.push(takeData);
		});
		$.ajax({
			type: "POST",
			url: "operations/editListing.php", 
			data: { editType: editType, listID: getButtonID, propType:propType, addStreet: editArr[0], addCity: editArr[1], addBedrooms: editArr[2], addBathrooms: editArr[3], addCost: editArr[4], addSize: editArr[5], addType: editArr[6], addBuilt: editArr[7], addLot: editArr[8], addCooling: editArr[9], addHeating: editArr[10], addFireplace: editArr[11], addParking: editArr[12], addDesc: editArr[13] },
			success: function (data) { $("#editConfirmed"+getButtonID).stop().fadeIn(500); setTimeout(function() { $("#editConfirmed"+getButtonID).stop().fadeOut(500); },3000); editComplete = 0;
				}
			})
		}
		else { editType = "tour";
		var intProp = parseInt(getButtonID);
		var getCCount = jQuery.inArray(intProp,gRooms);
		if (propType == "buy") { var thisPath = "buy-home"; }
		else { var thisPath = "rent"; }
		if (delCount[getCCount] != 0) { DeleteRooms(thisPath, getButtonID, getCCount); }
		if ( jQuery.inArray(getButtonID, gRooms) == -1 ) { var getEditBracket = "#room"+getButtonID+"editAdd"; var getEditTTag = "#editAdd"+getButtonID; 
		AddTour(thisPath,getEditTTag,getEditBracket,"update",newRooms); }
		if ( addOrEdit[getCCount] == 2) {
		var fRCount = gPicsC2[getCCount];
		if ( hasPicAdded[getCCount] != 0) {
		var g1 = GPicArray1[getCCount];
		var g2 = GPicArray2[getCCount];
		AddTourPic(thisPath, getButtonID, getCCount, g1, g2);
        hasPicAdded[getCCount] = 0; }
		if ( addEditRooms[getCCount] != 0) {
		var cPicPer = GPicArray1[getCCount];
		EditTour(thisPath, fRCount, getButtonID, getCCount, cPicPer); 
		addEditRooms[getCCount] = 0; }
		if (editChange[getCCount] != 0) {
		var textString = "";
		var picString = "";
		if (textChange[getCCount] != 0) {
		var fixText = new Array();
		var fixCount1 = 0;
		var propText = new Array();
		for (w = 0; w < changeText.length; w++) { 
			var findTexID = changeText[w]; findTexID = findTexID.split("-"); var checkTID = findTexID[0];
			if (checkTID == getButtonID) { propText.push(findTexID[1]); }
			}
		for (c = 0; c < textChange[getCCount]; c++) { var getValue = propText[c];
		if ( jQuery.inArray(getValue, fixText ) == -1) { fixText.push(getValue); fixCount1++;}
		}
		fixText = fixText.sort(function(a, b){return a-b});
		textChange[getCCount] = fixCount1;
		var textCounter = 0;
		for (a = 0; a < textChange[getCCount]; a++) { var textID = fixText[a]; var getEditText = $("#roomNameE"+textID).val(); textString = textString+","+textID+"-"+getEditText; textCounter++;}
		if (textCounter > 0) {
		textString = textString.substring(1);
		$.ajax({
			type: "POST",
			url: "operations/editListing.php", 
			data: { editType: editType, listID: getButtonID, propType: propType, textString: textString },
			success: function (data) { if (picChange == 0) { $("#editVConfirmed").stop().fadeIn(500); setTimeout(function() { $("#editVConfirmed").stop().fadeOut(500); },3000); editComplete = 0; } 
			textChange[getCCount] = 0; console.log(data); }
				})
			}
		}
		
		var picTitle = "";
		if (picChange[getCCount] != 0) {
		var newPics = new FormData();
		var newPixArr = new Array();
		var fixCount2 = 0;
		var propPic = new Array();
		for (r = 0; r < changePic.length; r++) { 
		var rawDataPic = changePic[r]; 
		rawDataPic = rawDataPic.split("-"); 
		var picCompatible = rawDataPic[0]; 
		var picDataF = rawDataPic[1]+"-"+rawDataPic[2];
		if (picCompatible == getButtonID) { propPic.push(picDataF); }
		}
		for (d = 0; d < picChange[getCCount]; d++) { var getNewPic = propPic[d];
		if ( jQuery.inArray(getNewPic, newPixArr) == -1) { newPixArr.push(getNewPic); fixCount2++;}
		}
		newPixArr = newPixArr.sort(function(a, b){return a-b});
		picChange[getCCount] = fixCount2;
		var countPic = 0;
		var rmfArray = new Array();
		picString = "";
		picRooms = "";
		for (b = 0; b < picChange[getCCount]; b++) { var splitNew = newPixArr[b]; splitNew = splitNew.split("-"); 
		var picID = parseInt(splitNew[0]);
		var picRow = splitNew[1];
		if (textChange[getCCount] != 0) {
			var textLoc = jQuery.inArray(picID,fixText);
			if (textLoc != -1) { var cutString = $("#roomNameE"+picID).val(); picTitle = picTitle+","+picID+"-"+cutString; }
		}
		var bPic = $("#roomE"+picID+"\\["+picRow+"\\]").prop("files")[0];
		var checkPic2 = bPic.name;
		if (checkPic2 != "") { newPics.append("files["+picID+"][]", bPic); 
		picString = picString+","+picID+"-"+picRow; 
		picRooms = picRooms+","+picID; 
		rmfArray.push(picID+"-"+picRow);
		countPic++; }
		}
		if (picTitle != "") { picTitle = picTitle.substring(1); }
		else { picTitle = "none"; }
		if (countPic > 0) {
		picString = picString.substring(1);
		picRooms = picRooms.substring(1);
		$.ajax({
				url: "operations/replacePics.php?picChange="+picChange[getCCount]+"&picTitle="+picTitle+"&buildingID="+getButtonID+"&picString="+picString+"&picRooms="+picRooms+"&propType="+propType, 
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: newPics,
				type: 'post',
				success: function(data) { $("#editVConfirmed").stop().fadeIn(500); setTimeout(function() { $("#editVConfirmed").stop().fadeOut(500); },3000); editComplete = 0; 
				picChange[getCCount] = 0; 
				for (j = 0; j < rmfArray.length; j++) { var getRMFVar = rmfArray[j]; getRMFVar = getRMFVar.split("-"); 
				var xID1 = getRMFVar[0]; var xID2 = getRMFVar[1]; 
				var cloneTarget = $("#roomE"+xID1+"\\["+xID2+"\\]");
				cloneTarget.replaceWith( cloneTarget = cloneTarget.clone( true ) );
					}
				}
			})
							} else { $("#editVError").stop().fadeIn(400); setTimeout(function() { $("#editVError").stop().fadeOut(400); },2000); editComplete = 0; console.log("countPic"); }
						}
					editChange[getCCount] = 0;
					} else { $("#editVConfirmed").stop().fadeIn(500); setTimeout(function() { $("#editVConfirmed").stop().fadeOut(500); },3000); editComplete = 0; }
					addOrEdit[getCCount] = 0; }
					if (rOrderEdit[getCCount] != 0) { ReorderRooms(getButtonID, getCCount); editComplete = 0; }
				}
			} else { $("#timeVError").stop().fadeIn(400); setTimeout(function() { $("#timeVError").stop().fadeOut(400); },2000); }
		});
	}
	
	function page3() {
		$(document).on("click", "#updateProfile", function() {
		uData = new Array();
			$(".formData2").each(function(){
				var getSearch3 = $(this).val();
				if (getSearch3 == "") { getSearch3 = "N/A"; }
				uData.push(getSearch3);
			});
			$.ajax({
			type: "POST",
			url: "operations/updateProfile.php",
			data: { id: currentUser, email: uData[0], company: uData[1], primary: uData[2], secondary: uData[3], fax: uData[4], website: uData[5], type: uData[6] },
			success: function (data) { $("#ErrorBox").html(data); }
			})
		});
		}