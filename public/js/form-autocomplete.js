(function () {
    "use strict";

    function autocomplete(e,t){var n;function i(e){if(!e)return!1;!function(e){for(var t=0;t<e.length;t++)e[t].classList.remove("autocomplete-active")}(e),n>=e.length&&(n=0),n<0&&(n=e.length-1),e[n].classList.add("autocomplete-active")}function a(t){for(var n=document.getElementsByClassName("autocomplete-items"),i=0;i<n.length;i++)t!=n[i]&&t!=e&&n[i].parentNode.removeChild(n[i])}e.addEventListener("input",function(i){var o,l,s,r=this.value;if(a(),!r)return!1;for(n=-1,(o=document.createElement("DIV")).setAttribute("id",this.id+"autocomplete-list"),o.setAttribute("class","autocomplete-items"),this.parentNode.appendChild(o),s=0;s<t.length;s++)t[s].substr(0,r.length).toUpperCase()==r.toUpperCase()&&((l=document.createElement("DIV")).innerHTML="<strong>"+t[s].substr(0,r.length)+"</strong>",l.innerHTML+=t[s].substr(r.length),l.innerHTML+="<input type='hidden' value='"+t[s]+"'>",l.addEventListener("click",function(t){e.value=this.getElementsByTagName("input")[0].value,a()}),o.appendChild(l))}),e.addEventListener("keydown",function(e){var t=document.getElementById(this.id+"autocomplete-list");t&&(t=t.getElementsByTagName("div")),40==e.keyCode?(n++,i(t)):38==e.keyCode?(n--,i(t)):13==e.keyCode&&(e.preventDefault(),n>-1&&t&&t[n].click())}),document.addEventListener("click",function(e){a(e.target)})}

    var countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antigua & Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia & Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central Arfrican Republic", "Chad", "Chile", "China", "Colombia", "Congo", "Cook Islands", "Costa Rica", "Cote D Ivoire", "Croatia", "Cuba", "Curacao", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Polynesia", "French West Indies", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauro", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre & Miquelon", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "St Kitts & Nevis", "St Lucia", "St Vincent", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor L'Este", "Togo", "Tonga", "Trinidad & Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks & Caicos", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen", "Zambia", "Zimbabwe"];

    autocomplete(document.getElementById("autoCompleteCountries"), countries);

    var places = ['Kabul', 'Tirana', 'Algiers', 'Luanda', 'Saint', 'John\'s', 'Buenos', 'Aires', 'Yerevan', 'Canberra', 'Vienna', 'Baku', 'Nassau', 'Manama', 'Dhaka', 'Bridgetown', 'Minsk', 'Brussels', 'Belmopan', 'Porto', 'Novo', 'Thimphu', 'Sarajevo', 'Gaborone', 'Brasilia', 'Sofia', 'Ouagadougou', 'Gitega', 'Praia', 'Phnom', 'Penh', 'Yaounde', 'Ottawa', 'Bangui', 'Djamena', 'Santiago', 'Beijing', 'Bogotá', 'Moroni', 'Kinshasa', 'Brazzaville', 'San', 'Jose', 'Yamoussoukro', 'Zagreb', 'Havana', 'Nicosia', 'Prague', 'Suva', 'Helsinki', 'Paris', 'Libreville', 'Banjul', 'Tbilisi', 'Berlin', 'Accra', 'Athens', 'Saint', 'George\'s', 'Guatemala', 'City', 'Conakry', 'Bissau', 'Georgetown', 'Reykjavik', 'New', 'Delhi', 'Jakarta', 'Tehran', 'Baghdad', 'Dublin', 'Jerusalem', 'Rome', 'Kingston', 'Tokyo', 'Amman', 'NurSultan', 'Nairobi', 'Tarawa', 'Pristina', 'Kuwait', 'City', 'Bishkek', 'Vientiane', 'Riga', 'Beirut', 'Maseru', 'Monrovia', 'Tripoli', 'Vaduz', 'Vilnius', 'Luxembourg'];
    
    autocomplete(document.getElementById("autoCompletePlace"), places);

})();