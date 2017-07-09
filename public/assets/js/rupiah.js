function rupiahkan(angka, simbol = false, desimal = false){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }

    return ((simbol) ? 'Rp. ' : '') + rev2.split('').reverse().join('') + ((desimal) ? ',00' : '');
}

function kembalikan(rupiah)
{
	return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}