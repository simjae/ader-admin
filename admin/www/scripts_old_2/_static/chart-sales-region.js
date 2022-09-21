/*
  Although amMap has methods like getAreaCenterLatitude and getAreaCenterLongitude,
  they are not suitable in quite a lot of cases as the center of some countries
  is even outside the country itself (like US, because of Alaska and Hawaii)
  That's why wehave the coordinates stored here
*/

var latlong = {};
latlong["AD"] = {"latitude":42.5, "longitude":1.5};
latlong["AE"] = {"latitude":24, "longitude":54};
latlong["AF"] = {"latitude":33, "longitude":65};
latlong["AG"] = {"latitude":17.05, "longitude":-61.8};
latlong["AI"] = {"latitude":18.25, "longitude":-63.1667};
latlong["AL"] = {"latitude":41, "longitude":20};
latlong["AM"] = {"latitude":40, "longitude":45};
latlong["AN"] = {"latitude":12.25, "longitude":-68.75};
latlong["AO"] = {"latitude":-12.5, "longitude":18.5};
latlong["AP"] = {"latitude":35, "longitude":105};
latlong["AQ"] = {"latitude":-90, "longitude":0};
latlong["AR"] = {"latitude":-34, "longitude":-64};
latlong["AS"] = {"latitude":-14.3333, "longitude":-170};
latlong["AT"] = {"latitude":47.3333, "longitude":13.3333};
latlong["AU"] = {"latitude":-27, "longitude":133};
latlong["AW"] = {"latitude":12.5, "longitude":-69.9667};
latlong["AZ"] = {"latitude":40.5, "longitude":47.5};
latlong["BA"] = {"latitude":44, "longitude":18};
latlong["BB"] = {"latitude":13.1667, "longitude":-59.5333};
latlong["BD"] = {"latitude":24, "longitude":90};
latlong["BE"] = {"latitude":50.8333, "longitude":4};
latlong["BF"] = {"latitude":13, "longitude":-2};
latlong["BG"] = {"latitude":43, "longitude":25};
latlong["BH"] = {"latitude":26, "longitude":50.55};
latlong["BI"] = {"latitude":-3.5, "longitude":30};
latlong["BJ"] = {"latitude":9.5, "longitude":2.25};
latlong["BM"] = {"latitude":32.3333, "longitude":-64.75};
latlong["BN"] = {"latitude":4.5, "longitude":114.6667};
latlong["BO"] = {"latitude":-17, "longitude":-65};
latlong["BR"] = {"latitude":-10, "longitude":-55};
latlong["BS"] = {"latitude":24.25, "longitude":-76};
latlong["BT"] = {"latitude":27.5, "longitude":90.5};
latlong["BV"] = {"latitude":-54.4333, "longitude":3.4};
latlong["BW"] = {"latitude":-22, "longitude":24};
latlong["BY"] = {"latitude":53, "longitude":28};
latlong["BZ"] = {"latitude":17.25, "longitude":-88.75};
latlong["CA"] = {"latitude":54, "longitude":-100};
latlong["CC"] = {"latitude":-12.5, "longitude":96.8333};
latlong["CD"] = {"latitude":0, "longitude":25};
latlong["CF"] = {"latitude":7, "longitude":21};
latlong["CG"] = {"latitude":-1, "longitude":15};
latlong["CH"] = {"latitude":47, "longitude":8};
latlong["CI"] = {"latitude":8, "longitude":-5};
latlong["CK"] = {"latitude":-21.2333, "longitude":-159.7667};
latlong["CL"] = {"latitude":-30, "longitude":-71};
latlong["CM"] = {"latitude":6, "longitude":12};
latlong["CN"] = {"latitude":35, "longitude":105};
latlong["CO"] = {"latitude":4, "longitude":-72};
latlong["CR"] = {"latitude":10, "longitude":-84};
latlong["CU"] = {"latitude":21.5, "longitude":-80};
latlong["CV"] = {"latitude":16, "longitude":-24};
latlong["CX"] = {"latitude":-10.5, "longitude":105.6667};
latlong["CY"] = {"latitude":35, "longitude":33};
latlong["CZ"] = {"latitude":49.75, "longitude":15.5};
latlong["DE"] = {"latitude":51, "longitude":9};
latlong["DJ"] = {"latitude":11.5, "longitude":43};
latlong["DK"] = {"latitude":56, "longitude":10};
latlong["DM"] = {"latitude":15.4167, "longitude":-61.3333};
latlong["DO"] = {"latitude":19, "longitude":-70.6667};
latlong["DZ"] = {"latitude":28, "longitude":3};
latlong["EC"] = {"latitude":-2, "longitude":-77.5};
latlong["EE"] = {"latitude":59, "longitude":26};
latlong["EG"] = {"latitude":27, "longitude":30};
latlong["EH"] = {"latitude":24.5, "longitude":-13};
latlong["ER"] = {"latitude":15, "longitude":39};
latlong["ES"] = {"latitude":40, "longitude":-4};
latlong["ET"] = {"latitude":8, "longitude":38};
latlong["EU"] = {"latitude":47, "longitude":8};
latlong["FI"] = {"latitude":62, "longitude":26};
latlong["FJ"] = {"latitude":-18, "longitude":175};
latlong["FK"] = {"latitude":-51.75, "longitude":-59};
latlong["FM"] = {"latitude":6.9167, "longitude":158.25};
latlong["FO"] = {"latitude":62, "longitude":-7};
latlong["FR"] = {"latitude":46, "longitude":2};
latlong["GA"] = {"latitude":-1, "longitude":11.75};
latlong["GB"] = {"latitude":54, "longitude":-2};
latlong["GD"] = {"latitude":12.1167, "longitude":-61.6667};
latlong["GE"] = {"latitude":42, "longitude":43.5};
latlong["GF"] = {"latitude":4, "longitude":-53};
latlong["GH"] = {"latitude":8, "longitude":-2};
latlong["GI"] = {"latitude":36.1833, "longitude":-5.3667};
latlong["GL"] = {"latitude":72, "longitude":-40};
latlong["GM"] = {"latitude":13.4667, "longitude":-16.5667};
latlong["GN"] = {"latitude":11, "longitude":-10};
latlong["GP"] = {"latitude":16.25, "longitude":-61.5833};
latlong["GQ"] = {"latitude":2, "longitude":10};
latlong["GR"] = {"latitude":39, "longitude":22};
latlong["GS"] = {"latitude":-54.5, "longitude":-37};
latlong["GT"] = {"latitude":15.5, "longitude":-90.25};
latlong["GU"] = {"latitude":13.4667, "longitude":144.7833};
latlong["GW"] = {"latitude":12, "longitude":-15};
latlong["GY"] = {"latitude":5, "longitude":-59};
latlong["HK"] = {"latitude":22.25, "longitude":114.1667};
latlong["HM"] = {"latitude":-53.1, "longitude":72.5167};
latlong["HN"] = {"latitude":15, "longitude":-86.5};
latlong["HR"] = {"latitude":45.1667, "longitude":15.5};
latlong["HT"] = {"latitude":19, "longitude":-72.4167};
latlong["HU"] = {"latitude":47, "longitude":20};
latlong["ID"] = {"latitude":-5, "longitude":120};
latlong["IE"] = {"latitude":53, "longitude":-8};
latlong["IL"] = {"latitude":31.5, "longitude":34.75};
latlong["IN"] = {"latitude":20, "longitude":77};
latlong["IO"] = {"latitude":-6, "longitude":71.5};
latlong["IQ"] = {"latitude":33, "longitude":44};
latlong["IR"] = {"latitude":32, "longitude":53};
latlong["IS"] = {"latitude":65, "longitude":-18};
latlong["IT"] = {"latitude":42.8333, "longitude":12.8333};
latlong["JM"] = {"latitude":18.25, "longitude":-77.5};
latlong["JO"] = {"latitude":31, "longitude":36};
latlong["JP"] = {"latitude":36, "longitude":138};
latlong["KE"] = {"latitude":1, "longitude":38};
latlong["KG"] = {"latitude":41, "longitude":75};
latlong["KH"] = {"latitude":13, "longitude":105};
latlong["KI"] = {"latitude":1.4167, "longitude":173};
latlong["KM"] = {"latitude":-12.1667, "longitude":44.25};
latlong["KN"] = {"latitude":17.3333, "longitude":-62.75};
latlong["KP"] = {"latitude":40, "longitude":127};
latlong["KR"] = {"latitude":37, "longitude":127.5};
latlong["KW"] = {"latitude":29.3375, "longitude":47.6581};
latlong["KY"] = {"latitude":19.5, "longitude":-80.5};
latlong["KZ"] = {"latitude":48, "longitude":68};
latlong["LA"] = {"latitude":18, "longitude":105};
latlong["LB"] = {"latitude":33.8333, "longitude":35.8333};
latlong["LC"] = {"latitude":13.8833, "longitude":-61.1333};
latlong["LI"] = {"latitude":47.1667, "longitude":9.5333};
latlong["LK"] = {"latitude":7, "longitude":81};
latlong["LR"] = {"latitude":6.5, "longitude":-9.5};
latlong["LS"] = {"latitude":-29.5, "longitude":28.5};
latlong["LT"] = {"latitude":55, "longitude":24};
latlong["LU"] = {"latitude":49.75, "longitude":6};
latlong["LV"] = {"latitude":57, "longitude":25};
latlong["LY"] = {"latitude":25, "longitude":17};
latlong["MA"] = {"latitude":32, "longitude":-5};
latlong["MC"] = {"latitude":43.7333, "longitude":7.4};
latlong["MD"] = {"latitude":47, "longitude":29};
latlong["ME"] = {"latitude":42.5, "longitude":19.4};
latlong["MG"] = {"latitude":-20, "longitude":47};
latlong["MH"] = {"latitude":9, "longitude":168};
latlong["MK"] = {"latitude":41.8333, "longitude":22};
latlong["ML"] = {"latitude":17, "longitude":-4};
latlong["MM"] = {"latitude":22, "longitude":98};
latlong["MN"] = {"latitude":46, "longitude":105};
latlong["MO"] = {"latitude":22.1667, "longitude":113.55};
latlong["MP"] = {"latitude":15.2, "longitude":145.75};
latlong["MQ"] = {"latitude":14.6667, "longitude":-61};
latlong["MR"] = {"latitude":20, "longitude":-12};
latlong["MS"] = {"latitude":16.75, "longitude":-62.2};
latlong["MT"] = {"latitude":35.8333, "longitude":14.5833};
latlong["MU"] = {"latitude":-20.2833, "longitude":57.55};
latlong["MV"] = {"latitude":3.25, "longitude":73};
latlong["MW"] = {"latitude":-13.5, "longitude":34};
latlong["MX"] = {"latitude":23, "longitude":-102};
latlong["MY"] = {"latitude":2.5, "longitude":112.5};
latlong["MZ"] = {"latitude":-18.25, "longitude":35};
latlong["NA"] = {"latitude":-22, "longitude":17};
latlong["NC"] = {"latitude":-21.5, "longitude":165.5};
latlong["NE"] = {"latitude":16, "longitude":8};
latlong["NF"] = {"latitude":-29.0333, "longitude":167.95};
latlong["NG"] = {"latitude":10, "longitude":8};
latlong["NI"] = {"latitude":13, "longitude":-85};
latlong["NL"] = {"latitude":52.5, "longitude":5.75};
latlong["NO"] = {"latitude":62, "longitude":10};
latlong["NP"] = {"latitude":28, "longitude":84};
latlong["NR"] = {"latitude":-0.5333, "longitude":166.9167};
latlong["NU"] = {"latitude":-19.0333, "longitude":-169.8667};
latlong["NZ"] = {"latitude":-41, "longitude":174};
latlong["OM"] = {"latitude":21, "longitude":57};
latlong["PA"] = {"latitude":9, "longitude":-80};
latlong["PE"] = {"latitude":-10, "longitude":-76};
latlong["PF"] = {"latitude":-15, "longitude":-140};
latlong["PG"] = {"latitude":-6, "longitude":147};
latlong["PH"] = {"latitude":13, "longitude":122};
latlong["PK"] = {"latitude":30, "longitude":70};
latlong["PL"] = {"latitude":52, "longitude":20};
latlong["PM"] = {"latitude":46.8333, "longitude":-56.3333};
latlong["PR"] = {"latitude":18.25, "longitude":-66.5};
latlong["PS"] = {"latitude":32, "longitude":35.25};
latlong["PT"] = {"latitude":39.5, "longitude":-8};
latlong["PW"] = {"latitude":7.5, "longitude":134.5};
latlong["PY"] = {"latitude":-23, "longitude":-58};
latlong["QA"] = {"latitude":25.5, "longitude":51.25};
latlong["RE"] = {"latitude":-21.1, "longitude":55.6};
latlong["RO"] = {"latitude":46, "longitude":25};
latlong["RS"] = {"latitude":44, "longitude":21};
latlong["RU"] = {"latitude":60, "longitude":100};
latlong["RW"] = {"latitude":-2, "longitude":30};
latlong["SA"] = {"latitude":25, "longitude":45};
latlong["SB"] = {"latitude":-8, "longitude":159};
latlong["SC"] = {"latitude":-4.5833, "longitude":55.6667};
latlong["SD"] = {"latitude":15, "longitude":30};
latlong["SE"] = {"latitude":62, "longitude":15};
latlong["SG"] = {"latitude":1.3667, "longitude":103.8};
latlong["SH"] = {"latitude":-15.9333, "longitude":-5.7};
latlong["SI"] = {"latitude":46, "longitude":15};
latlong["SJ"] = {"latitude":78, "longitude":20};
latlong["SK"] = {"latitude":48.6667, "longitude":19.5};
latlong["SL"] = {"latitude":8.5, "longitude":-11.5};
latlong["SM"] = {"latitude":43.7667, "longitude":12.4167};
latlong["SN"] = {"latitude":14, "longitude":-14};
latlong["SO"] = {"latitude":10, "longitude":49};
latlong["SR"] = {"latitude":4, "longitude":-56};
latlong["ST"] = {"latitude":1, "longitude":7};
latlong["SV"] = {"latitude":13.8333, "longitude":-88.9167};
latlong["SY"] = {"latitude":35, "longitude":38};
latlong["SZ"] = {"latitude":-26.5, "longitude":31.5};
latlong["TC"] = {"latitude":21.75, "longitude":-71.5833};
latlong["TD"] = {"latitude":15, "longitude":19};
latlong["TF"] = {"latitude":-43, "longitude":67};
latlong["TG"] = {"latitude":8, "longitude":1.1667};
latlong["TH"] = {"latitude":15, "longitude":100};
latlong["TJ"] = {"latitude":39, "longitude":71};
latlong["TK"] = {"latitude":-9, "longitude":-172};
latlong["TM"] = {"latitude":40, "longitude":60};
latlong["TN"] = {"latitude":34, "longitude":9};
latlong["TO"] = {"latitude":-20, "longitude":-175};
latlong["TR"] = {"latitude":39, "longitude":35};
latlong["TT"] = {"latitude":11, "longitude":-61};
latlong["TV"] = {"latitude":-8, "longitude":178};
latlong["TW"] = {"latitude":23.5, "longitude":121};
latlong["TZ"] = {"latitude":-6, "longitude":35};
latlong["UA"] = {"latitude":49, "longitude":32};
latlong["UG"] = {"latitude":1, "longitude":32};
latlong["UM"] = {"latitude":19.2833, "longitude":166.6};
latlong["US"] = {"latitude":38, "longitude":-97};
latlong["UY"] = {"latitude":-33, "longitude":-56};
latlong["UZ"] = {"latitude":41, "longitude":64};
latlong["VA"] = {"latitude":41.9, "longitude":12.45};
latlong["VC"] = {"latitude":13.25, "longitude":-61.2};
latlong["VE"] = {"latitude":8, "longitude":-66};
latlong["VG"] = {"latitude":18.5, "longitude":-64.5};
latlong["VI"] = {"latitude":18.3333, "longitude":-64.8333};
latlong["VN"] = {"latitude":16, "longitude":106};
latlong["VU"] = {"latitude":-16, "longitude":167};
latlong["WF"] = {"latitude":-13.3, "longitude":-176.2};
latlong["WS"] = {"latitude":-13.5833, "longitude":-172.3333};
latlong["YE"] = {"latitude":15, "longitude":48};
latlong["YT"] = {"latitude":-12.8333, "longitude":45.1667};
latlong["ZA"] = {"latitude":-29, "longitude":24};
latlong["ZM"] = {"latitude":-15, "longitude":30};
latlong["ZW"] = {"latitude":-20, "longitude":30};

var mapData = [
{"code":"AF" , "name":"아프가니스탄", "value":32358260, "color":"#eea638"},
{"code":"AL" , "name":"알바니아", "value":3215988, "color":"#d8854f"},
{"code":"DZ" , "name":"알제리아", "value":35980193, "color":"#de4c4f"},
{"code":"AO" , "name":"앙골라", "value":19618432, "color":"#de4c4f"},
{"code":"AR" , "name":"아르헨티나", "value":40764561, "color":"#86a965"},
{"code":"AM" , "name":"아르메니아", "value":3100236, "color":"#d8854f"},
{"code":"AU" , "name":"호주", "value":22605732, "color":"#8aabb0"},
{"code":"AT" , "name":"오스트리아", "value":8413429, "color":"#d8854f"},
{"code":"AZ" , "name":"아제르바이잔", "value":9306023, "color":"#d8854f"},
{"code":"BH" , "name":"Bahrain", "value":1323535, "color":"#eea638"},
{"code":"BD" , "name":"Bangladesh", "value":150493658, "color":"#eea638"},
{"code":"BY" , "name":"Belarus", "value":9559441, "color":"#d8854f"},
{"code":"BE" , "name":"Belgium", "value":10754056, "color":"#d8854f"},
{"code":"BJ" , "name":"Benin", "value":9099922, "color":"#de4c4f"},
{"code":"BT" , "name":"Bhutan", "value":738267, "color":"#eea638"},
{"code":"BO" , "name":"Bolivia", "value":10088108, "color":"#86a965"},
{"code":"BA" , "name":"Bosnia and Herzegovina", "value":3752228, "color":"#d8854f"},
{"code":"BW" , "name":"Botswana", "value":2030738, "color":"#de4c4f"},
{"code":"BR" , "name":"브라질", "value":196655014, "color":"#86a965"},
{"code":"BN" , "name":"Brunei", "value":405938, "color":"#eea638"},
{"code":"BG" , "name":"불가리아", "value":7446135, "color":"#d8854f"},
{"code":"BF" , "name":"Burkina Faso", "value":16967845, "color":"#de4c4f"},
{"code":"BI" , "name":"Burundi", "value":8575172, "color":"#de4c4f"},
{"code":"KH" , "name":"캄보디아", "value":14305183, "color":"#eea638"},
{"code":"CM" , "name":"카메룬", "value":20030362, "color":"#de4c4f"},
{"code":"CA" , "name":"캐나다", "value":34349561, "color":"#a7a737"},
{"code":"CV" , "name":"Cape Verde", "value":500585, "color":"#de4c4f"},
{"code":"CF" , "name":"Central African Rep.", "value":4486837, "color":"#de4c4f"},
{"code":"TD" , "name":"Chad", "value":11525496, "color":"#de4c4f"},
{"code":"CL" , "name":"Chile", "value":17269525, "color":"#86a965"},
{"code":"CN" , "name":"중국", "value":1347565324, "color":"#eea638"},
{"code":"CO" , "name":"콜롬비아", "value":46927125, "color":"#86a965"},
{"code":"KM" , "name":"Comoros", "value":753943, "color":"#de4c4f"},
{"code":"CD" , "name":"Congo, Dem. Rep.", "value":67757577, "color":"#de4c4f"},
{"code":"CG" , "name":"Congo, Rep.", "value":4139748, "color":"#de4c4f"},
{"code":"CR" , "name":"Costa Rica", "value":4726575, "color":"#a7a737"},
{"code":"CI" , "name":"Cote d'Ivoire", "value":20152894, "color":"#de4c4f"},
{"code":"HR" , "name":"Croatia", "value":4395560, "color":"#d8854f"},
{"code":"CU" , "name":"쿠바", "value":11253665, "color":"#a7a737"},
{"code":"CY" , "name":"Cyprus", "value":1116564, "color":"#d8854f"},
{"code":"CZ" , "name":"Czech Rep.", "value":10534293, "color":"#d8854f"},
{"code":"DK" , "name":"덴마크", "value":5572594, "color":"#d8854f"},
{"code":"DJ" , "name":"Djibouti", "value":905564, "color":"#de4c4f"},
{"code":"DO" , "name":"도미니카 공화국", "value":10056181, "color":"#a7a737"},
{"code":"EC" , "name":"Ecuador", "value":14666055, "color":"#86a965"},
{"code":"EG" , "name":"이집트", "value":82536770, "color":"#de4c4f"},
{"code":"SV" , "name":"El Salvador", "value":6227491, "color":"#a7a737"},
{"code":"GQ" , "name":"Equatorial Guinea", "value":720213, "color":"#de4c4f"},
{"code":"ER" , "name":"Eritrea", "value":5415280, "color":"#de4c4f"},
{"code":"EE" , "name":"에스토니아", "value":1340537, "color":"#d8854f"},
{"code":"ET" , "name":"Ethiopia", "value":84734262, "color":"#de4c4f"},
{"code":"FJ" , "name":"Fiji", "value":868406, "color":"#8aabb0"},
{"code":"FI" , "name":"Finland", "value":5384770, "color":"#d8854f"},
{"code":"FR" , "name":"프랑스", "value":63125894, "color":"#d8854f"},
{"code":"GA" , "name":"가봉", "value":1534262, "color":"#de4c4f"},
{"code":"GM" , "name":"Gambia", "value":1776103, "color":"#de4c4f"},
{"code":"GE" , "name":"조지아(그루지야)", "value":4329026, "color":"#d8854f"},
{"code":"DE" , "name":"독일", "value":82162512, "color":"#d8854f"},
{"code":"GH" , "name":"가나", "value":24965816, "color":"#de4c4f"},
{"code":"GR" , "name":"그리스", "value":11390031, "color":"#d8854f"},
{"code":"GT" , "name":"Guatemala", "value":14757316, "color":"#a7a737"},
{"code":"GN" , "name":"Guinea", "value":10221808, "color":"#de4c4f"},
{"code":"GW" , "name":"Guinea-Bissau", "value":1547061, "color":"#de4c4f"},
{"code":"GY" , "name":"Guyana", "value":756040, "color":"#86a965"},
{"code":"HT" , "name":"아이티", "value":10123787, "color":"#a7a737"},
{"code":"HN" , "name":"Honduras", "value":7754687, "color":"#a7a737"},
{"code":"HK" , "name":"홍콩", "value":7122187, "color":"#eea638"},
{"code":"HU" , "name":"헝가리", "value":9966116, "color":"#d8854f"},
{"code":"IS" , "name":"아이슬란드", "value":324366, "color":"#d8854f"},
{"code":"IN" , "name":"인도", "value":1241491960, "color":"#eea638"},
{"code":"ID" , "name":"인도네시아", "value":242325638, "color":"#eea638"},
{"code":"IR" , "name":"이란", "value":74798599, "color":"#eea638"},
{"code":"IQ" , "name":"이라크", "value":32664942, "color":"#eea638"},
{"code":"IE" , "name":"아일랜드", "value":4525802, "color":"#d8854f"},
{"code":"IL" , "name":"이스라엘", "value":7562194, "color":"#eea638"},
{"code":"IT" , "name":"이태리", "value":60788694, "color":"#d8854f"},
{"code":"JM" , "name":"자메이카", "value":2751273, "color":"#a7a737"},
{"code":"JP" , "name":"일본", "value":126497241, "color":"#eea638"},
{"code":"JO" , "name":"요르단", "value":6330169, "color":"#eea638"},
{"code":"KZ" , "name":"카자흐스탄", "value":16206750, "color":"#eea638"},
{"code":"KE" , "name":"케냐", "value":41609728, "color":"#de4c4f"},
{"code":"KP" , "name":"북한", "value":24451285, "color":"#eea638"},
{"code":"KR" , "name":"대한민국", "value":48391343, "color":"#eea638"},
{"code":"KW" , "name":"쿠웨이트", "value":2818042, "color":"#eea638"},
{"code":"KG" , "name":"키르기스스탄", "value":5392580, "color":"#eea638"},
{"code":"LA" , "name":"라오스", "value":6288037, "color":"#eea638"},
{"code":"LV" , "name":"라트비아", "value":2243142, "color":"#d8854f"},
{"code":"LB" , "name":"레바논", "value":4259405, "color":"#eea638"},
{"code":"LS" , "name":"레소토", "value":2193843, "color":"#de4c4f"},
{"code":"LR" , "name":"라이베리아", "value":4128572, "color":"#de4c4f"},
{"code":"LY" , "name":"리비아", "value":6422772, "color":"#de4c4f"},
{"code":"LT" , "name":"Lithuania", "value":3307481, "color":"#d8854f"},
{"code":"LU" , "name":"Luxembourg", "value":515941, "color":"#d8854f"},
{"code":"MK" , "name":"Macedonia, FYR", "value":2063893, "color":"#d8854f"},
{"code":"MG" , "name":"마다가스카", "value":21315135, "color":"#de4c4f"},
{"code":"MW" , "name":"말라위", "value":15380888, "color":"#de4c4f"},
{"code":"MY" , "name":"말레이시아", "value":28859154, "color":"#eea638"},
{"code":"ML" , "name":"말리", "value":15839538, "color":"#de4c4f"},
{"code":"MR" , "name":"Mauritania", "value":3541540, "color":"#de4c4f"},
{"code":"MU" , "name":"Mauritius", "value":1306593, "color":"#de4c4f"},
{"code":"MX" , "name":"멕시코", "value":114793341, "color":"#a7a737"},
{"code":"MD" , "name":"몰도바", "value":3544864, "color":"#d8854f"},
{"code":"MN" , "name":"몽골", "value":2800114, "color":"#eea638"},
{"code":"ME" , "name":"Montenegro", "value":632261, "color":"#d8854f"},
{"code":"MA" , "name":"모로코", "value":32272974, "color":"#de4c4f"},
{"code":"MZ" , "name":"Mozambique", "value":23929708, "color":"#de4c4f"},
{"code":"MM" , "name":"Myanmar", "value":48336763, "color":"#eea638"},
{"code":"NA" , "name":"Namibia", "value":2324004, "color":"#de4c4f"},
{"code":"NP" , "name":"네팔", "value":30485798, "color":"#eea638"},
{"code":"NL" , "name":"Netherlands", "value":16664746, "color":"#d8854f"},
{"code":"NZ" , "name":"뉴질랜드", "value":4414509, "color":"#8aabb0"},
{"code":"NI" , "name":"니카라과", "value":5869859, "color":"#a7a737"},
{"code":"NE" , "name":"니제르", "value":16068994, "color":"#de4c4f"},
{"code":"NG" , "name":"나이지리아", "value":162470737, "color":"#de4c4f"},
{"code":"NO" , "name":"노르웨이", "value":4924848, "color":"#d8854f"},
{"code":"OM" , "name":"오만", "value":2846145, "color":"#eea638"},
{"code":"PK" , "name":"파키스탄", "value":176745364, "color":"#eea638"},
{"code":"PA" , "name":"파나마", "value":3571185, "color":"#a7a737"},
{"code":"PG" , "name":"파푸아뉴기니", "value":7013829, "color":"#8aabb0"},
{"code":"PY" , "name":"파라과이", "value":6568290, "color":"#86a965"},
{"code":"PE" , "name":"페루", "value":29399817, "color":"#86a965"},
{"code":"PH" , "name":"필리핀", "value":94852030, "color":"#eea638"},
{"code":"PL" , "name":"폴란드", "value":38298949, "color":"#d8854f"},
{"code":"PT" , "name":"포르투칼", "value":10689663, "color":"#d8854f"},
{"code":"PR" , "name":"푸에르토리코", "value":3745526, "color":"#a7a737"},
{"code":"QA" , "name":"카타르", "value":1870041, "color":"#eea638"},
{"code":"RO" , "name":"로마니아", "value":21436495, "color":"#d8854f"},
{"code":"RU" , "name":"러시아", "value":142835555, "color":"#d8854f"},
{"code":"RW" , "name":"르완다", "value":10942950, "color":"#de4c4f"},
{"code":"SA" , "name":"사우디 아라비아", "value":28082541, "color":"#eea638"},
{"code":"SN" , "name":"세네갈", "value":12767556, "color":"#de4c4f"},
{"code":"RS" , "name":"세르비아", "value":9853969, "color":"#d8854f"},
{"code":"SL" , "name":"시에라리온", "value":5997486, "color":"#de4c4f"},
{"code":"SG" , "name":"싱가포르", "value":5187933, "color":"#eea638"},
{"code":"SK" , "name":"슬로바키아", "value":5471502, "color":"#d8854f"},
{"code":"SI" , "name":"슬로베니아", "value":2035012, "color":"#d8854f"},
{"code":"SB" , "name":"솔로몬제도", "value":552267, "color":"#8aabb0"},
{"code":"SO" , "name":"소말리아", "value":9556873, "color":"#de4c4f"},
{"code":"ZA" , "name":"남아프리카", "value":50459978, "color":"#de4c4f"},
{"code":"ES" , "name":"스페인", "value":46454895, "color":"#d8854f"},
{"code":"LK" , "name":"스리랑카", "value":21045394, "color":"#eea638"},
{"code":"SD" , "name":"수단", "value":34735288, "color":"#de4c4f"},
{"code":"SR" , "name":"수리남", "value":529419, "color":"#86a965"},
{"code":"SZ" , "name":"스와질란드", "value":1203330, "color":"#de4c4f"},
{"code":"SE" , "name":"스웨덴", "value":9440747, "color":"#d8854f"},
{"code":"CH" , "name":"스위스", "value":7701690, "color":"#d8854f"},
{"code":"SY" , "name":"시리아", "value":20766037, "color":"#eea638"},
{"code":"TW" , "name":"타이완", "value":23072000, "color":"#eea638"},
{"code":"TJ" , "name":"타지키스탄", "value":6976958, "color":"#eea638"},
{"code":"TZ" , "name":"탄자니아", "value":46218486, "color":"#de4c4f"},
{"code":"TH" , "name":"타이", "value":69518555, "color":"#eea638"},
{"code":"TG" , "name":"토고", "value":6154813, "color":"#de4c4f"},
{"code":"TT" , "name":"트리니다드토바고", "value":1346350, "color":"#a7a737"},
{"code":"TN" , "name":"튀니지", "value":10594057, "color":"#de4c4f"},
{"code":"TR" , "name":"터키", "value":73639596, "color":"#d8854f"},
{"code":"TM" , "name":"투르크메니스탄", "value":5105301, "color":"#eea638"},
{"code":"UG" , "name":"우간다", "value":34509205, "color":"#de4c4f"},
{"code":"UA" , "name":"우크라이나", "value":45190180, "color":"#d8854f"},
{"code":"AE" , "name":"아랍 에미리트", "value":7890924, "color":"#eea638"},
{"code":"GB" , "name":"영국", "value":62417431, "color":"#d8854f"},
{"code":"US" , "name":"미국", "value":313085380, "color":"#a7a737"},
{"code":"UY" , "name":"우르과이", "value":3380008, "color":"#86a965"},
{"code":"UZ" , "name":"우즈베키스탄", "value":27760267, "color":"#eea638"},
{"code":"VE" , "name":"베네수엘라", "value":29436891, "color":"#86a965"},
{"code":"PS" , "name":"가자지구", "value":4152369, "color":"#eea638"},
{"code":"VN" , "name":"베트남", "value":88791996, "color":"#eea638"},
{"code":"YE" , "name":"예멘", "value":24799880, "color":"#eea638"},
{"code":"ZM" , "name":"잠비아", "value":13474959, "color":"#de4c4f"},
{"code":"ZW" , "name":"지마브웨", "value":12754378, "color":"#de4c4f"}];


// get min and max values
var minBulletSize = 3;
var maxBulletSize = 70;
var min = Infinity;
var max = -Infinity;
for ( var i = 0; i < mapData.length; i++ ) {
  var value = mapData[ i ].value;
  if ( value < min ) {
    min = value;
  }
  if ( value > max ) {
    max = value;
  }
}

// it's better to use circle square to show difference between values, not a radius
var maxSquare = maxBulletSize * maxBulletSize * 2 * Math.PI;
var minSquare = minBulletSize * minBulletSize * 2 * Math.PI;

// create circle for each country
var images = [];
for ( var i = 0; i < mapData.length; i++ ) {
  var dataItem = mapData[ i ];
  var value = dataItem.value;
  // calculate size of a bubble
  var square = ( value - min ) / ( max - min ) * ( maxSquare - minSquare ) + minSquare;
  if ( square < minSquare ) {
    square = minSquare;
  }
  var size = Math.sqrt( square / ( Math.PI * 2 ) );
  var id = dataItem.code;

  images.push( {
    "type": "circle",
	"theme": "light",

    "width": size,
    "height": size,
    "color": dataItem.color,
    "longitude": latlong[ id ].longitude,
    "latitude": latlong[ id ].latitude,
    "title": dataItem.name,
    "value": value
  } );
}

// build map
var map = AmCharts.makeChart( "chart-sales-region", {
  "type": "map",
  "projection": "mercator",
  "titles": null,
  "areasSettings": {
    //"unlistedAreasColor": "#000000",
    //"unlistedAreasAlpha": 0.1
  },
  "dataProvider": {
    "map": "worldLow",
    "images": images
  },
  "export": {
    "enabled": true
  }
} );
