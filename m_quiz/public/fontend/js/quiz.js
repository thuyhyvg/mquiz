var sel_ = null; //Dòng được chọn

function avoid(r, zclass) {
	if (sel_ == r){//Nếu chọn cùng 1 dòng
		sel_.className = "element-animation1 btn btn-lg btn-primary btn-block";
		sel_ = null;
	}
	else {//Nếu chọn 1 dòng khác
		if (sel_ != null) {
			sel_.className = "element-animation1 btn btn-lg btn-primary btn-block";
		}
		sel_ = r;
		z_class = zclass;
		sel_.className = "element-animation1 btn btn-lg btn-danger btn-block";
	}
}