<?php
if (isset($user_id)) {
    $p = new cUser();
    $result = $p->getInfor($user_id);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $birth = $row['birth'];
            $gender = $row['gender'];
            $image = $row['image'];
            $major = $row['major_id'];
            $email = $row['email'];
            echo "<div class='card'>
                            <div class='card-body'>
                                <div class='row'>
                                    <div class='col-md-3'>
                                        <img src='../IMG/$image' alt='Avatar' class='avt'>
                                    </div>
                                    <div class='col-md-9'>
                                        </br></br>
                                        <p><strong>Name:</strong> $name</p>
                                        <p><strong>Date of Birth:</strong> $birth</p>
                                        <p><strong>Email:</strong> $email</p>
                                        <p><strong>Faculty:</strong> $major</p>
                                    </div>
                                </div>
                            </div>
                        </div>";
        }
    }
}
