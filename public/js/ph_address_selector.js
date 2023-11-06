console.log("PH Address Selector is now running");
var my_handlers = {
    // fill province
    fill_provinces: function() {
        //selected region
        var region_code = $(this).val();

        // set selected text to input
        var region_text = $(this).find("option:selected").text();
        let region_input = $('#region-text');
        region_input.val(region_text);
        //clear province & city & barangay input
        $('#province-text').val('');
        $('#city-text').val('');
        $('#barangay-text').val('');

        //province
        let dropdown = $('#province');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
        dropdown.prop('selectedIndex', 0);

        //city
        let city = $('#city');
        city.empty();
        city.append('<option selected="true" disabled></option>');
        city.prop('selectedIndex', 0);

        //barangay
        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');
        barangay.prop('selectedIndex', 0);

        // filter & fill
        var url = 'https://raw.githubusercontent.com/wilfredpine/philippine-address-selector/main/ph-json/province.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.region_code == region_code;
            });

            result.sort(function(a, b) {
                return a.province_name.localeCompare(b.province_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
            })

        });
    },
    // fill city
    fill_cities: function() {
        //selected province
        var province_code = $(this).val();

        // set selected text to input
        var province_text = $(this).find("option:selected").text();
        let province_input = $('#province-text');
        province_input.val(province_text);
        //clear city & barangay input
        $('#city-text').val('');
        $('#barangay-text').val('');

        //city
        let dropdown = $('#city');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');
        dropdown.prop('selectedIndex', 0);

        //barangay
        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');
        barangay.prop('selectedIndex', 0);

        // filter & fill
        var url = 'https://raw.githubusercontent.com/wilfredpine/philippine-address-selector/main/ph-json/city.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.province_code == province_code;
            });

            result.sort(function(a, b) {
                return a.city_name.localeCompare(b.city_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
            })

        });
    },
    // fill barangay
    fill_barangays: function() {
        // selected barangay
        var city_code = $(this).val();

        // set selected text to input
        var city_text = $(this).find("option:selected").text();
        let city_input = $('#city-text');
        city_input.val(city_text);
        //clear barangay input
        $('#barangay-text').val('');

        // barangay
        let dropdown = $('#barangay');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose barangay</option>');
        dropdown.prop('selectedIndex', 0);

        // filter & Fill
        var url = 'https://raw.githubusercontent.com/wilfredpine/philippine-address-selector/main/ph-json/barangay.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.city_code == city_code;
            });

            result.sort(function(a, b) {
                return a.brgy_name.localeCompare(b.brgy_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
            })

        });
    },

    onchange_barangay: function() {
        // set selected text to input
        var barangay_text = $(this).find("option:selected").text();
        let barangay_input = $('#barangay-text');
        barangay_input.val(barangay_text);
    },

};


$(function() {
    // events
    $('#region').on('change', my_handlers.fill_provinces);
    $('#province').on('change', my_handlers.fill_cities);
    $('#city').on('change', my_handlers.fill_barangays);
    $('#barangay').on('change', my_handlers.onchange_barangay);

    // load region
    let dropdown = $('#region');
    dropdown.empty();
    dropdown.append('<option selected="true" disabled>Choose Region</option>');
    dropdown.prop('selectedIndex', 0);
    const url = 'https://raw.githubusercontent.com/wilfredpine/philippine-address-selector/main/ph-json/region.json';
    // Populate dropdown with list of regions
    $.getJSON(url, function(data) {
        $.each(data, function(key, entry) {
            dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
        })
    });

});











// let regionElement = document.getElementById("ph-region");
// let provinceElement = document.getElementById("ph-province");
// let cityElement = document.getElementById("ph-city");
// let barangayElement = document.getElementById("ph-barangay");

// const getRegions = async () => {
//     const res = await fetch(`https://psgc.gitlab.io/api/regions/`);

//     const data = await res.json();
//     return data;
// };

// const getProvinces = async (regionCode) => {
//     const res = await fetch(
//         `https://psgc.gitlab.io/api/regions/${regionCode}/provinces/`
//     );

//     const data = await res.json();
//     return data;
// };

// const getCities = async (provinceCode) => {
//     let res;
//     if (provinceCode === "130000000") {
//         res = await fetch(
//             `https://psgc.gitlab.io/api/regions/${provinceCode}/cities-municipalities/`
//         );
//     } else {
//         res = await fetch(
//             `https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`
//         );
//     }

//     const data = await res.json();
//     return data;
// };

// const getBarangays = async (cityCode) => {
//     const res = await fetch(
//         `https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`
//     );

//     const data = await res.json();
//     return data;
// };

// const selectRegion = async (event) => {
//     var regionCode =
//         event.target.options[event.target.selectedIndex].dataset.code;
//     regionElement.dataset.code = regionCode;

//     // ncr
//     if (regionCode === "130000000") {
//         document.getElementById("ph-province").value = "";
//         document.getElementById(
//             "ph-province"
//         ).innerHTML = `<option  value='Metro Manila'>Metro Manila</option>`;
//         document.getElementById("ph-city").innerHTML = "";
//         document.getElementById("ph-barangay").innerHTML = "";

//         if (regionCode) {
//             document.getElementById("ph-province").disabled = false;
//         }

//         provinceElement.onchange();
//     } else {
//         const provinces = await getProvinces(regionCode);

//         document.getElementById("ph-province").innerHTML = "";
//         document.getElementById("ph-city").innerHTML = "";
//         document.getElementById("ph-barangay").innerHTML = "";

//         if (regionCode) {
//             document.getElementById("ph-province").disabled = false;
//         }

//         document.getElementById("ph-province").innerHTML +=
//             "<option value=''>-- Select province --</option>";
//         provinces.map((province, index) => {
//             if (index === 0) {
//                 provinceElement.value = province.name;
//                 provinceElement.dataset.code = province.code;
//             }
//             document.getElementById(
//                 "ph-province"
//             ).innerHTML += `<option value='${province.name}' data-code='${province.code}'>${province.name}</option>`;
//         });
//     }
// };

// const selectProvince = async (event) => {
//     var provinceCode;

//     let regionCode = regionElement.dataset.code;

//     if (regionCode === "130000000") {
//         provinceCode = "130000000";
//     } else {
//         provinceCode =
//             event.target.options[event.target.selectedIndex].dataset.code;

//         provinceElement.dataset.code = provinceCode;
//         regionCode = regionElement.dataset.code;
//     }

//     const cities = await getCities(provinceCode);

//     document.getElementById("ph-city").innerHTML = "";
//     document.getElementById("ph-barangay").innerHTML = "";

//     if (provinceCode) {
//         document.getElementById("ph-city").disabled = false;
//     }

//     document.getElementById("ph-city").innerHTML +=
//         "<option value=''>-- Select city --</option>";
//     cities.map(
//         (city) =>
//             (document.getElementById(
//                 "ph-city"
//             ).innerHTML += `<option value='${city.name}' data-code="${city.code}">${city.name}</option>`)
//     );
// };

// const selectCity = async (event) => {
//     let cityCode =
//         event.target.options[event.target.selectedIndex].dataset.code;

//     cityElement.dataset.code = cityCode;

//     const barangays = await getBarangays(cityCode);

//     if (cityCode) {
//         document.getElementById("ph-barangay").disabled = false;
//     }

//     document.getElementById("ph-barangay").innerHTML = "";

//     document.getElementById("ph-barangay").innerHTML +=
//         "<option value=''>-- Select barangay --</option>";

//     barangays.map(
//         (barangay) =>
//             (document.getElementById(
//                 "ph-barangay"
//             ).innerHTML += `<option value='${barangay.name}' data-code="${barangay.code}">${barangay.name}</option>`)
//     );
// };

// const selectBarangay = () => {
//     let barangayCode = document.getElementById("ph-barangay").value;
// };

// const runSelector = async () => {
//     const regions = await getRegions();

//     regions.map(
//         (region) =>
//             (document.getElementById(
//                 "ph-region"
//             ).innerHTML += `<option value='${region.name}' data-code='${region.code}'>${region.name}</option>`)
//     );
// };

// const selector_region = document.getElementById("ph-region");
// selector_region.onchange = selectRegion;
// const selector_province = document.getElementById("ph-province");
// selector_province.onchange = selectProvince;
// const selector_city = document.getElementById("ph-city");
// selector_city.onchange = selectCity;
// const selector_barangay = document.getElementById("ph-barangay");
// selector_barangay.onchange = selectBarangay;

// runSelector();