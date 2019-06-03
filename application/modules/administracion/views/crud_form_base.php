<div class="col-lg-12 control-section">
        <h4 class="form-title">Photo Contest</h4>
    <div class="control_wrapper" id="control_wrapper">
 <form id="form1" method="post">
                <div class="form-group" style="padding-top: 11px;">
                        <div class="e-float-input">
                            <input type="text" id="name" name="name" data-required-message="* Enter your name" required="" data-msg-containerid="nameError">
                            <span class="e-float-line"></span>
                            <label class="e-float-text e-label-top" for="name">Name</label>
                        </div>   
                        <div id="nameError"></div>                     
                    </div>
                    <div class="form-group" style="padding-top: 11px;">
                            <div class="e-float-input">
                                <input type="email" id="email" name="email" data-validation="email" data-required-message="* Enter your email" required="" data-msg-containerid="mailError">
                                <span class="e-float-line"></span>
                                <label class="e-float-text e-label-top" for="email">Email</label>
                            </div>
                            <div id="mailError"></div>
                    </div>

                    <div class="form-group" style="padding-top: 11px;">
                            <div class="e-float-input">
                                <input type="text" id="Mobileno" name="MobileNo" data-required-message="* Enter your mobile number" required="" data-msg-containerid="noError">
                                <span class="e-float-line"></span>
                                <label class="e-float-text e-label-top" for="name">Mobile No</label>
                            </div>   
                            <div id="noError"></div>                     
                    </div>
                    <div id="dropArea">
                        <div class="form-group" style="padding-top: 11px;">
                                <div class="e-float-input upload-area">
                                    <input type="text" id="upload" readonly="" name="upload" data-required-message="* Select any file" required="" data-msg-containerid="uploadError">
                                    <button id="browse" class="e-control e-btn e-info">Browse...</button>                        
                                    <span class="e-float-line"></span>
                                    <label class="e-float-text e-label-top" for="upload">Choose a file</label>
                                </div>   
                                <div id="uploadError"></div>                     
                                <input type="file" name="UploadFiles" id="fileupload">                                        
                        </div>
                        </div>
                        <div class="form-group" style="padding-top: 11px;">
                                <div class="e-float-input">
                                    <textarea class="address-field" rows="2" id="Address" name="Address"></textarea>
                                    <span class="e-float-line"></span>
                                    <label class="e-float-text e-label-top" for="address">Address</label>
                                </div>
                        </div>   
                <div class="submitBtn">
                    <button class="submit-btn e-btn" id="submit-btn">Submit</button>
                    <div class="desc"><span>*This button is not a submit type and the form submit handled from externally.</span></div>                     
                </div> 						
                </form>                                                                          
            <div id="confirmationDialog"></div>
    </div>
</div>

<style>
      .control_wrapper {
        max-width: 400px;
        margin: auto;
    }
    .e-upload {
        width: 100%;
        position: relative;
        margin-top: 15px;
    }
    .control_wrapper .e-upload .e-upload-drag-hover {
        margin: 0;
    }
    .address-field {
        resize: none;
    }
    
     #control_wrapper {
		max-width: 500px;
		margin: auto;
		border: 0.5px solid #BEBEBE;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.36);
		padding: 1% 4% 7%;
		background: #f9f9f9;
	}

        .highcontrast #control_wrapper {
            background: #000000;
        }
        .upload-area, .e-bigger .upload-area {
            width: 73%;
        }
        .e-error {
            padding-top:3px;
        }
        .e-upload {
            width: 100%;
            position: relative;
            margin-top: 15px;
        }
        .control_wrapper .e-upload .e-upload-drag-hover {
            margin: 0;
        }
    
        .submit-btn {
            margin-top: 15px;          
        }
        .submitBtn .desc {
			margin: 2% 23% 0% 18%;
        }
        @media only screen and (max-width: 500px) {
            .submitBtn .desc {
                margin: 12px;
            }
            .upload-area, .e-bigger .upload-area {
                width: 60%;
            }
        }
        .submitBtn {
            position: relative;
            text-align: center;
        }
        .form-support {
            width: 100%;            
        }
        .success .form-support {
            display: none;
        }
        .success .successmsg {
            border: 0.5px solid green;
            padding: 10%;
            color: green;
        }
        form#form1 {
            position: relative;
            top: 14%;
        }
        .form-support td {
            width: 100%;
            padding-top:4%;
        }
        .e-upload {
            display: none;
        }
        input.choose-file{
            width: 60%;
        }
        button#browse {
			float: right;
			margin-right: -113px;
			margin-top: -27px;
        }      
		@media only screen and (max-width: 600px) {
			.submitBtn {
			   margin-top: -22px;
			}
		 }

        .e-bigger.material button#browse {
			margin-top: -36px;      
        }
        .e-bigger.bootstrap #dropArea button#browse {
            margin-top: -40px;
        }
        .fabric #dropArea button#browse {
            margin-top: -33px;
        }
        .fabric.e-bigger #dropArea button#browse {
            margin-right: -118px;
            margin-top: -40px;
        }
		.highcontrast #dropArea button#browse {
			margin-top: -32px;
		}
		.bootstrap #dropArea button#browse {
			margin-right: -118px;
			margin-top: -34px;
		}
        .form-title {
            text-align: center;
        }
        .bootstrap label.e-float-text.e-label-top {
            font-weight: bold;
        }
		.e-bigger.highcontrast #dropArea button#browse {
			margin-top: -40px;
			margin-right: -118px;
}
</style>
