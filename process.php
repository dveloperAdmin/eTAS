<!-- <div class="card-body">
          <div class="d-flex align-items-center">
            <h5 class="mb-0">Employee Details</h5>
            <form action="Employee List-Ui" method="" enctype="multipart/form-data" class="ms-auto position-relative">
              <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <i class="bi bi-search"></i>
              </div>
              <input class="form-control ps-5" type="text" placeholder="search" id="searchInput" />
            </form>
          </div>
          <div class="table-responsive mt-3 " style="height:30rem">
            <table class="table align-middle comTable" id="dataTable">
              <thead class="table-secondary table-header">
                <tr>
                  <th>Count</th>
                  <th>Emp.Code</th>
                  <th>Emp. Name</th>
                  <th>Comapny</th>
                  <th>Department</th>
                  <th>Category</th>
                  <th>Emp. Type</th>
                  <th>Location</th>
                  <th>Emp. Satus</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; while($tableDataFetch = sqlsrv_fetch_array($empTabledata , SQLSRV_FETCH_ASSOC)){ ?>
                <tr>
                  <td><?php echo ++$i;?></td>
                  <td><?php echo $tableDataFetch['empCode'];?></td>
                  <td><?php echo $tableDataFetch['empName'];?></td>
                  <td><?php echo com_find($tableDataFetch['companyCode'],$conn);?></td>
                  <td><?php echo dept_find($tableDataFetch['departmentCode'],$conn);?></td>
                  <td><?php echo empCat_find($tableDataFetch['empCategoryCode'],$conn);?></td>
                  <td><?php echo empType_find($tableDataFetch['empTypeCode'],$conn);?></td>
                  <td><?php echo empLoc_find($tableDataFetch['locationCode'],$conn);?></td>
                  <td><?php echo $tableDataFetch['status'];?></td>

                  <td>
                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                      <a href="javascript:;" class="text-primary viewBtn" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                      <a href="javascript:;" class="text-warning editBtn" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Edit "><i class="bi bi-pencil-fill"></i></a>
                      <a href="javascript:;" class="text-danger deltBtn" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div> -->



// 'comName' => com_find($row['companyCode'],$conn),
// 'deptName' => dept_find($row['departmentCode'],$conn),
// 'empCat' => empCat_find($row['empCategoryCode'],$conn),
// 'empType' => empType_find($row['empTypeCode'],$conn),
// 'location' => empLoc_find($row['locationCode'],$conn),
// 'status' => $row['status'],
// 'action' => '<div class="table-actions d-flex align-items-center gap-3 fs-6">
  <a href="javascript:;" class="text-primary empviewBtn" data-bs-toggle="tooltip" data-bs-placement="bottom"
    title="Views"><i class="bi bi-eye-fill"></i></a>
  <a href="javascript:;" class="text-warning empeditBtn" data-bs-toggle="tooltip" data-bs-placement="bottom"
    title="Edit "><i class="bi bi-pencil-fill"></i></a>
  <a href="javascript:;" class="text-danger empdeltBtn" data-bs-toggle="tooltip" data-bs-placement="bottom"
    title="Delete"><i class="bi bi-trash-fill"></i></a>
</div>'






$htmlForm ='
<form action="admin/process/employeeProcess.php" method="post">
  <div class="row">
    <div class="col-xl-6 mx-auto">
      <div class="card" style="margin-bottom:0px">
        <div class="card-body">
          <div class="border p-3 rounded">
            <h6 class="mb-0 text-uppercase">Edit Employee</h6>
            <hr />
            <div class="row g-3">
              <div class="row row-2">
                <div class="col-12 col-17">
                  <label class="form-label">Employee Code <span style="color:red; font-size:1.2rem;">*</span></label>

                  <label class="form-control">'.$empTabledata['empCode'].'</label>
                  <input type="hidden" name="empCode" value="'.$empTabledata['empCode'].'">
                </div>
                <div class="col-12 col-18">
                  <label class="form-label">Employee Name <span style="color:red; font-size:1.2rem;">*</span></label>

                  <input type="text" class="form-control" placeholder="Enter the Employee name" name="empName"
                    value="'.$empTabledata['empName'].'" required />
                </div>
              </div>
              <div class="col-12 col-14">
                <label class="form-label">Company Name <span style="color:red; font-size:1.2rem;">*</span></label>
                <select class="form-control" name="comName" required />
                <option value="'.$empTabledata['companyCode'].'" hidden selected disbale>
                  '.com_find($empTabledata['companyCode'],$conn).'</option>';
                while ($row = sqlsrv_fetch_array($comTabledata, SQLSRV_FETCH_ASSOC)){
                $htmlForm .= '<option value="'. $row['companyCode'].'">'.$row['comFName'].'</option>';
                }
                $htmlForm .= '</select>
              </div>

              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Department <span style="color:red; font-size:1.2rem;">*</span></label>
                  <select class="form-control" name="dept" required />
                  <option value="'.$empTabledata['departmentCode'].'" hidden selected disbale>
                    '.dept_find($empTabledata['departmentCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($deptTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .= '<option value="'.$row['deptCode'].'">'. $row['department'].'</option>';
                  }
                  $htmlForm .= ' </select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Sub - Department <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="subDept" />
                  <option value="'.$empTabledata['subDepartmantCode'].'" hidden selected disbale>
                    '.sub_dept_find($empTabledata['subDepartmantCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($sdeptTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .= '<option value="'.$row['subDeptCode'].'">'. $row['subDepartment'].'</option>';
                  }
                  $htmlForm .=' </select>
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Designation <span style="color:red; font-size:1.2rem;"></span></label>
                  <select class="form-control" name="desig" />
                  <option value="'.$empTabledata['designationCode'].'" hidden selected disbale>
                    '.desig_insert($empTabledata['designationCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($desigTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .=' <option value="'.$row['desigCode'].'">'. $row['designation'].'</option>';
                  }
                  $htmlForm .=' </select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Sub-Designation <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="subdesig" />
                  <option value="'.$empTabledata['subDesignationCode'].'" hidden selected disbale>
                    '.subdesig_find($empTabledata['subDesignationCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($sdesigTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['subDesigCode'].'">'.$row['subDesignation'].'</option>';
                  }
                  $htmlForm .=' </select>
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Division <span style="color:red; font-size:1.2rem;"></span></label>
                  <select class="form-control" name="division" />
                  <option value="'.$empTabledata['divisionCode'].'" hidden selected disbale>
                    '.division_find($empTabledata['divisionCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($divTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['divisionCode'].'">'. $row['division'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Sub-Division <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="subdivision" />
                  <option value="'.$empTabledata['subDivisionCode'].'" hidden selected disbale>
                    '.subdivision_find($empTabledata['subDivisionCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($sdivTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['subDiviCode'].'">'. $row['subDivision'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Emp. Category <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="empcat" />
                  <option value="'.$empTabledata['empCategoryCode'].'" hidden selected disbale>
                    '.empCat_find($empTabledata['empCategoryCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($empcatTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['empCatCode'].'">'.$row['empCategory'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Emp. Sub-Category <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="empsubcat" />
                  <option value="'.$empTabledata['empSubCategoryCode'].'" hidden selected disbale>'.
                    empSCat_insert($empTabledata['empSubCategoryCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($empScatTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['empSubCatCode'].'">'.$row['empSubCategory'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 mx-auto">
      <div class="card" style="margin-bottom:0px">
        <div class="card-body">
          <div class="border p-3 rounded">
            <div class="row g-3">
              <div class="row row-2" style="padding-top: 0.5rem;">
                <div class="col-15 col-14">
                  <label class="form-label">Employee Type <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="EmpType" />
                  <option value="'.$empTabledata['empTypeCode'].'" hidden selected disbale>
                    '.empType_find($empTabledata['empTypeCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($empTypeTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['empTypeCode'].'">'. $row['empType'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Grade <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="grade" />
                  <option value="'.$empTabledata['grade'].'" hidden selected disbale>
                    '.empGrade_find($empTabledata['grade'], $conn).'</option>';
                  while ($row = sqlsrv_fetch_array($gradeTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['gradeCode'].'">'. $row['grade'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Branch <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="branch" />
                  <option value="'.$empTabledata['branchCode'].'" hidden selected disbale>
                    '.branch_find($empTabledata['branchCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($branchTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['branchCode'].'">'. $row['branch'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Location <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="location" />
                  <option value="'.$empTabledata['locationCode'].'" hidden selected disbale>
                    '.empLoc_find($empTabledata['locationCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($locTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['locationCode'].'">'. $row['location'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
              </div>
              <div class=" row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Team<span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="team" />
                  <option value="'.$empTabledata['teamCode'].'" hidden selected disbale>
                    '.empTeam_find($empTabledata['teamCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($teamTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['teamCode'].'">'. $row['teamName'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Employee Status<span style="color:red; font-size:1.2rem;">*</span></label>

                  <select class="form-control" name="empsts" required />
                  <option value="'.$empTabledata['status'].'" hidden selected disbale>'.$empTabledata['status'].'
                  </option>
                  <option value="Working">Working</option>
                  <option value="Resigned">Resigned</option>
                  <option value="Retired">Retired</option>
                  </select>
                </div>
              </div>

              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">MObile NO <span style="color:red; font-size:1.2rem;"></span></label>

                  <input type="number" class="form-control" name="mobileNo" id="login_mob" autocomplete="off"
                    placeholder="Enter Mobile Number"
                    oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    pattern="\d{10}" maxlength="10" value="'.$empTabledata['contactNO'].'">

                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Email Id <span style="color:red; font-size:1.2rem;"></span></label>

                  <input type="email" class="form-control" id="email" name="email"
                    value="'.$empTabledata['emailId'].'" />
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Govt.Id Number<span style="color:red; font-size:1.2rem;"></span></label>
                  <input type="text" value="'.$empTabledata['govtId'].'" class="form-control"
                    placeholder="Enter Email ID" name="govtID" />

                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Address<span style="color:red; font-size:1.2rem;"></span></label>
                  <input type="text" value="'.$empTabledata['address'].'" class="form-control"
                    placeholder="Enter Email ID" name="address" />

                </div>
              </div>

              <div class="col-12">
                <div class="d-flex" style="justify-content: flex-end;">
                  <button type="submit" class="btn btn-primary" name="empEdit" style="margin-right:.5rem">
                    <i class="bi bi-pencil-square"></i>
                    Edit Employee
                  </button>
                  <a href="list-Employee-Ui" <button type="click" class="btn btn-secondary">
                    <i class="bi bi-arrow-clockwise"></i>
                    Back
                    </button></a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>';