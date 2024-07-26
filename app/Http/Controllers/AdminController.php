<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentApproved;
use App\Mail\ForgetPassword;
use App\Mail\ResetPassword;
use App\Models\Admin;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Employees;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Sub_Admin;
use App\Models\Appointment;
use App\Models\Attendance;
use App\Models\Token;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->role_id == 1) {

            $admin =  Admin::where('email', $request->email)->where('password', $request->password)->first();

            if ($admin) {
                $tokenResult = $admin->createToken('AdminToken');
                $token = $tokenResult->token;
                $token->save();

                $success['status'] = 200;
                $success['message'] = 'Login successfully';
                $success['data'] = $admin;
                $success['token'] = $tokenResult->accessToken;

                return response()->json(['success' => $success]);
            } else {
                $error['status'] = 401;
                $error['message'] = 'Invalid email or password';

                return response()->json(['error' => $error]);
            }
        } else if ($request->role_id == 2) {


            $subadmin = Sub_Admin::where('email', $request->email)->where('password', $request->password)->first();

            if ($subadmin) {

                $success['status'] = 200;
                $success['message'] = 'Login successfully';
                $success['data'] =  $subadmin;

                return response()->json(['success' => $success]);
            } else {

                $error['status'] = 401;
                $error['message'] = 'Invalid email or password';

                return response()->json(['error' => $error]);
            }
        } else if ($request->role_id == 3) {

            $employee = Employees::where('email', $request->email)->where('password', $request->password)->first();

            if ($employee) {

                $success['status'] = 200;
                $success['message'] = 'Login successfully';
                $success['data'] =  $employee;

                return response()->json(['success' => $success]);
            } else {

                $error['status'] = 401;
                $error['message'] = 'Invalid email or password';

                return response()->json(['error' => $error]);
            }
        }
    }



    public function forget_password(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);


        if ($request->role_id == 1) {
            $admin =  Admin::where('email', $request->email)->first();

            if ($admin) {
                $admin_token =  rand(100, 99999);
                $success['status'] = 200;

                $success['message'] =  'Reset Password OTP has been sent to your Email';
                $success['data'] = $admin;
                $success['token'] = $admin_token;
                Mail::to($request->email)->send(new ForgetPassword($admin, $admin_token, null, null, null, null));
                return response()->json(['success' => $success]);
            } else {

                $error['status'] = 401;
                $error['message'] = 'Invalid email';
                return response()->json(['error' => $error]);
            }
        } else if ($request->role_id == 2) {

            $sub_admin = Sub_Admin::where('email', $request->email)->first();

            if ($sub_admin) {
                $subadmin_token = rand(100, 99999);
                $success['status'] = 200;
                $success['message'] = 'Reset Password OTP has been sent to your Email';
                $success['data'] = $sub_admin;
                $success['token'] = $subadmin_token;
                Mail::to($request->email)->send(new ForgetPassword(null, null, $sub_admin, $subadmin_token, null, null));
                return response()->json(['success' => $success]);
            } else {
                $error['status'] = 401;
                $error['message'] = 'Invalid email';
                return response()->json(['error' => $error]);
            }
        } else if ($request->role_id == 3) {

            $employee = Employees::where('email', $request->email)->first();

            if ($employee) {

                $employee_token  = rand(100, 99999);
                $success['status'] = 200;
                $success['message'] = 'Reset Password OTP has been sent to your Email';
                $success['data'] = $employee;
                $success['token'] = $employee_token;
                Mail::to($request->email)->send(new ForgetPassword(null, null, null, null, $employee, $employee_token));
                return response()->json(['success' => $success]);
            } else {

                $error['status'] = 401;
                $error['message'] = 'Invalid email';
                return response()->json(['error' => $error]);
            }
        }
    }

    public function reset_password(Request $request, $id)
    {

        $request->validate([
            'password' => 'required|confirmed',
        ]);


        if ($request->role_id  == 1) {
            $admin = Admin::find($id);

            if ($admin) {

                $admin->password = $request->password;
                $admin->save();
                Mail::to($admin->email)->send(new ResetPassword($admin, null, null));
                $success['status'] = 200;
                $success['message'] =  'Password reset successfully';
                $success['data'] = $admin;

                return response()->json(['success' => $success]);
            } else {

                $error['status'] = 401;
                $error['message'] = 'Admin not found';

                return response()->json(['error' => $error]);
            }
        } else if ($request->role_id  == 2) {

            $sub_admin = Sub_Admin::find($id);

            if ($sub_admin) {
                $sub_admin->password = $request->password;
                $sub_admin->save();
                Mail::to($sub_admin->email)->send(new ResetPassword(null, $sub_admin, null));
                $success['status'] = 200;
                $success['message'] = 'Password reset successfully';
                $success['data'] = $sub_admin;

                return response()->json(['success' => $success]);
            } else {

                $error['status'] = 401;
                $error['message'] = 'Admin not found';

                return response()->json(['error' => $error]);
            }
        } else if ($request->role_id == 3) {

            $employee = Employees::find($id);

            if ($employee) {

                $employee->password = $request->password;
                $employee->save();
                Mail::to($employee->email)->send(new ResetPassword(null, null, $employee));
                $success['status'] = 200;
                $success['message'] = 'Password reset successfully';
                $success['data'] = $employee;

                return response()->json(['success' => $success]);
            } else {

                $success['status'] = 401;
                $success['message'] = 'employee not found';
                $success['data'] = $employee;

                return response()->json(['success' => $success]);
            }
        }
    }

    public function edit_admin(Request $request, $id)
    {
        $admin  = Admin::find($id);
        if ($admin) {
            if ($request->name) {
                $admin->name =  $request->name;
            }
            if ($request->email) {
                $admin->email = $request->email;
            }

            if ($request->has('profile_image')) {
                $image  = rand(1000, 10000) . '.' . $request->file('profile_image')->extension();
                $path = $request->profile_image->StoreAs('profile_image', $image, 'public');
                $admin->profile_image  = 'storage/' . $path;
            }
            $admin->save();

            $success['status'] = 200;
            $success['message'] = 'Admin updated successfully';
            $success['data'] =  $admin;

            return response()->json(['success' =>  $success]);
        } else {

            $error['status'] = 401;
            $error['message'] = 'Admin not found';
            return response()->json(['error' => $error]);
        }
    }

    /* Roles and permissions management */
    public function create_role(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'privileges' => 'required'
        ]);


        $input = $request->all();

        $role = Role::create($input);

        $success['status'] = 200;
        $success['message'] = 'Role created successfully';
        $success['data'] = $role;

        return response()->json(['success' => $success]);
    }



    public function edit_role(Request $request, $id)
    {

        $role = Role::find($id);

        if ($role) {


            if ($request->name) {
                $role->name = $request->name;
            }

            if ($request->privilages) {
                $role->privilages = $request->privilages;
            }

            $role->save();

            $success['status'] = 200;
            $success['message'] = 'Role updated successfully';
            $success['data'] = $role;

            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 400;
            $error['message'] = 'role not found';

            return response()->json(['error' => $error]);
        }
    }



    public function delete_role($id)
    {
        $role =  Role::find($id);
        $role->delete();

        $success['status'] = 200;
        $success['message'] = 'role deleted successfully';
        $success['data'] =  $role;

        return response()->json(['success' => $success]);
    }


    public function get_roles()
    {

        $roles = Role::all();
        foreach ($roles as $role) {
            $role->privilages = json_decode($role->privilages);
        }

        $success['status'] = 200;
        $success['message'] = 'Roles fetched successfully';
        $success['data'] = $roles;

        return response()->json(['success' => $success]);
    }



    /* sub admin management */

    public function create_sub_admin(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        $input  = $request->all();
        $sub_admin = Sub_Admin::create($input);

        $success['status'] = 200;
        $success['message'] = 'Sub admin created successfully';
        $success['data'] = $sub_admin;

        return response()->json(['success' => $success]);
    }


    public function edit_sub_admin(Request $request, $id)
    {
        $sub_admin = Sub_Admin::find($id);

        if ($sub_admin) {

            if ($request->name) {
                $sub_admin->name = $request->name;
            }

            if ($request->email) {
                $sub_admin->email =  $request->email;
            }

            if ($request->password) {
                $sub_admin->password = $request->password;
            }
            if ($request->role) {

                $sub_admin->role = $request->role;
            }

            $sub_admin->save();
            $success['status'] = 200;
            $success['message'] = 'Sub admin updated successfully';
            $success['data'] =  $sub_admin;

            return response()->json(['success' =>  $success]);
        } else {

            $error['status'] = 401;
            $error['message'] = 'Sub admin not found';

            return response()->json(['error' => $error]);
        }
    }


    public function delete_sub_admin($id)
    {

        $sub_admin = Sub_Admin::find($id);
        $sub_admin->delete();

        $success['status'] = 200;
        $success['message'] = 'Sub admin deleted successfully';
        $success['data'] =  $sub_admin;

        return response()->json(['success' => $success]);
    }


    public function get_sub_admins()
    {

        $sub_admins =  Sub_Admin::all();

        $success['status'] = 200;
        $success['message'] =  'Sub admins fetched successfully';
        $success['data'] = $sub_admins;

        return response()->json(['success' => $success]);
    }


    /* employee management */

    public function create_employee(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees,email',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'hourly_rate' => 'required',
        ]);

        $input = $request->all();

        $employee = Employees::create($input);

        $success['status'] = 200;
        $success['message'] = 'Employee created successfully';
        $success['data'] = $employee;

        return response()->json(['success' => $success]);
    }



    public function edit_employee(Request $request, $id)
    {

        $employee =  Employees::find($id);

        if ($employee) {

            if ($request->name) {
                $employee->name = $request->name;
            }

            if ($request->email) {
                $employee->email = $request->email;
            }

            if ($request->password) {
                $employee->password =  $request->password;
            }

            if ($request->address) {
                $employee->address = $request->address;
            }

            if ($request->phone) {
                $employee->phone = $request->phone;
            }

            if ($request->hourly_rate) {
                $employee->hourly_rate = $request->hourly_rate;
            }
            if ($request->status) {
                $employee->status = $request->status;
            }
            if ($request->profile_image) {
                if ($request->hasFile('profile_image')) {
                    $image  = rand(1000, 10000) .  '.' . $request->profile_image->extension();
                    $path = $request->profile_image->storeAs('images', $image, 'public');
                    $employee->profile_image = 'storage/' . $path;
                }
            }
            $employee->save();

            $success['status'] = 200;
            $success['message'] = 'Employee updated successfully';
            $success['data'] = $employee;
            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 401;
            $error['message'] = 'Employee not found';

            return response()->json(['error' => $error]);
        }
    }

    public function delete_employee($id)
    {

        $employee =  Employees::find($id);
        $employee->delete();

        $success['status'] = 200;
        $success['message'] = 'Employee deleted successfully';
        $success['data'] = $employee;
        return response()->json(['success' => $success]);
    }

    public function get_employees()
    {

        $employees = Employees::all();

        if ($employees->count() > 0) {
            $success['status'] = 200;
            $success['message'] = 'Employees fetched successfully';
            $success['data'] = $employees;
            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 400;
            $error['message'] = 'No employees found';
            return response()->json(['error' => $error]);
        }
    }



    /* cars management */

    public function create_car(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'made_year' => 'required',
            'horse_power' => 'required',
            'number_plate' => 'required',
            'chassis_number' => 'required',
            'engine_number' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'car_report_doc' => 'nullable|mimes:pdf,doc,docx',
            'condition_description' => 'required',
            'images' => 'required|array|min:5|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'features' => 'nullable|array',
            'features.*.name' => 'required|string',
            'features.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'features.*.status' => 'required',
        ]);

        $input = $request->all();


        if ($request->hasFile('car_report_doc')) {
            $document = $request->file('car_report_doc');
            $documentName = rand(0000, 9999) . '.' . $document->getClientOriginalExtension();
            $documentPath = $document->storeAs('documents', $documentName, 'public');
            $input['car_report_doc'] = 'storage/' . $documentPath;
        }


        if ($request->hasFile('images')) {

            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = rand(0000, 9999) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $imageName, 'public');
                $imageUrl = 'storage/' . $path;
                $images[] = $imageUrl;
            }


            $input['images'] = json_encode($images);
        } else {
            $error['status'] = 401;
            $error['message'] = 'Please upload at least 5 images';
            return response()->json(['error' => $error]);
        }


        if ($request->has('features')) {
            $features = $request->input('features');

            foreach ($features as $index => $feature) {
                $features[$index]['id'] = $index + 1; // Assuming base ID starts at 1
                if ($request->hasFile("features.$index.icon")) {
                    $icon = $request->file("features.$index.icon");
                    $iconName = rand(0000, 9999) . '.' . $icon->getClientOriginalExtension();
                    $iconPath = $icon->storeAs('features/icons', $iconName, 'public');
                    $features[$index]['icon'] = 'storage/' . $iconPath;
                }
            }
            $input['features'] = json_encode($features);
        }

        $car = Car::create($input);

        $success['status'] = 200;
        $success['message'] = 'Car listed successfully';
        $success['data'] = $car;

        return response()->json(['success' => $success]);
    }

    public function edit_car(Request $request, $id)
    {
        $car = Car::find($id);

        if ($car) {

            if ($request->title) {
                $car->title = $request->title;
            }
            if ($request->brand) {
                $car->brand = $request->brand;
            }

            if ($request->model) {
                $car->model = $request->model;
            }

            if ($request->made_year) {
                $car->made_year = $request->made_year;
            }

            if ($request->horse_power) {
                $car->horse_power = $request->horse_power;
            }

            if ($request->number_plate) {
                $car->number_plate = $request->number_plate;
            }
            if ($request->chassis_number) {
                $car->chassis_number = $request->chassis_number;
            }

            if ($request->engine_number) {
                $car->engine_number = $request->engine_number;
            }

            if ($request->cost) {
                $car->cost = $request->cost;
            }

            if ($request->price) {
                $car->price = $request->price;
            }

            if ($request->condition_description) {
                $car->condition_description = $request->condition_description;
            }

            if ($request->car_report_doc) {
                $document = $request->file('car_report_doc');
                $documentName = rand(0000, 9999) . '.' . $document->getClientOriginalExtension();
                $documentPath = $document->storeAs('documents', $documentName, 'public');
                $car->car_report_doc = 'storage/' . $documentPath;
            }


            if ($request->hasFile('images')) {
                $indexToUpdate = $request->input('image_index', -1);
                $currentImages = json_decode($car->images, true) ?: [];
                $image = $request->file('images');
                $imageName = rand(0000, 9999) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $imageName, 'public');
                $imageUrl = 'storage/' . $path;

                if (isset($currentImages[$indexToUpdate])) {
                    $currentImages[$indexToUpdate] = $imageUrl;
                } else {
                    $currentImages[] = $imageUrl;
                }
                $car->images = json_encode($currentImages);
            }


            if ($request->has('features')) {
                $features = $request->input('features');
                $currentFeatures = json_decode($car->features, true) ?: [];


                foreach ($features as $index => $feature) {
                    if (isset($feature['icon']) && $request->hasFile("features.$index.icon")) {
                        $icon = $request->file("features.$index.icon");
                        $iconName = rand(0000, 9999) . '.' . $icon->getClientOriginalExtension();
                        $iconPath = $icon->storeAs('features/icons', $iconName, 'public');
                        $features[$index]['icon'] = 'storage/' . $iconPath;
                    } elseif (isset($currentFeatures[$index]['icon'])) {
                        $features[$index]['icon'] = $currentFeatures[$index]['icon'];
                    }
                }
                $car->features = json_encode($features);
            }

            if ($request->status) {
                $car->status = $request->status;
            }

            $car->save();

            $success['status'] = 200;
            $success['message'] = 'Car updated successfully';
            $success['data'] = $car;

            return response()->json(['success' => $success]);
        } else {
            $error['status'] = 401;
            $error['message'] = 'Car not found';

            return response()->json(['success' => $error]);
        }
    }

    public function delete_car($id)
    {
        $car =  Car::find($id);
        $car->delete();

        $success['status'] = 200;
        $success['message'] = 'Car deleted successfully';
        $success['data'] = $car;

        return response()->json(['success' => $success]);
    }

    public function delete_feature($car_id, $id)
    {
        $car = Car::find($car_id);
        $decoded_features = json_decode($car->features);

        foreach ($decoded_features as $key => $value) {

            if ($value->id == $id) {
                $value->status = 'deleted';
            }
        }

        $car->features = json_encode($decoded_features);
        $car->save();

        $success['status'] = 200;
        $success['message'] = 'Feature Deleted successfully';
        $success['data'] = $decoded_features;

        return response()->json(['success' => $success]);
    }




    public function edit_feature(Request $request, $car_id, $id)
    {
        // Find the car
        $car = Car::find($car_id);

        // Decode the features
        $decoded_features = json_decode($car->features);

        // Loop through the features and update the one with the given id
        foreach ($decoded_features as $key => $value) {
            if ($value->id == $id) {
                $value->name = $request->name;
                $value->icon = $request->icon;
            }
        }

        // Save the car
        $car->features = json_encode($decoded_features);
        $car->save();

        $success['status'] = 200;
        $success['message'] = 'Feature updated successfully';
        $success['data'] = $decoded_features;


        return response()->json(['success' => $success]);
    }




    public function get_cars()
    {
        $car = Car::all();

        if ($car->count() > 0) {

            foreach ($car as $key => $value) {
                $car[$key]->images = json_decode($value->images);
                $car[$key]->features = json_decode($value->features);
            }

            $success['status'] = 200;
            $success['message'] = 'Cars fetched successfully';
            $success['data'] = $car;
            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 400;
            $error['message'] = 'No cars found';
            return response()->json(['error' => $error]);
        }
    }


    public function get_single_car($id)
    {
        $car  = Car::find($id);
        if ($car) {

            $car->images = json_decode($car->images);
            $car->features = json_decode($car->features);

            $success['status'] = 200;
            $success['message'] = 'Car fetched successfully';
            $success['data'] = $car;

            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 400;
            $error['message'] = 'Car not found';

            return response()->json(['error' => $error]);
        }
    }

    public function show_car_code($id)
    {
        $url = 'https://mateen-ahmed.web.app/car/' . $id;

        $qrcode = QrCode::size(300)->format('svg')->generate($url);

        $filename = 'qr_code_' . $id . '.svg';
        $imagePath = 'public/qrcodes/' . $filename;

        Storage::put($imagePath, $qrcode);

        $publicPath = Storage::url($imagePath);

        return response()->json([
            'qr_code_path' => $publicPath,
        ]);
    }



    public function mark_car(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'id_card_number' => 'required',
            'billing_address' => 'required',
            'date_handed_over' => 'required',
            'status' => 'required'
        ]);

        $car  =  Car::find($id);

        if ($car) {
            if ($request->status) {
                $car->status = $request->status;

                $customer  =   Customer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'id_card_number' => $request->id_card_number,
                    'billing_address' => $request->billing_address,
                    'date_handed_over' => $request->date_handed_over
                ]);

                if ($customer) {
                    $invoice  = Invoice::create([
                        'car_id' => $car->id,
                        'customer_id' => $customer->id,
                        'selling_price' => $car->price,
                        'date_handed_over' => $request->date_handed_over,
                    ]);

                    $success['status'] = 200;
                    $success['message'] = 'Invoice created successfully';
                    $success['data'] = $invoice;

                    return response()->json(['success' => $success]);
                }
            }
        } else {

            $error['status'] = 400;
            $error['message'] = 'Car not found';

            return response()->json(['error' => $error]);
        }
    }

    /* Expense management */


    public function create_expense(Request $request)
    {

        $request->validate([
            'date' => 'required',
            'reason' => 'required',
            'amount' => 'required',
            'attachments' => 'nullable|mimes:pdf,doc,docx',
        ]);

        $input  =  $request->all();

        if ($request->hasFile('attachments')) {

            $document = $request->file('attachments');
            $documentName = rand(0000, 9999) . '.' . $document->getClientOriginalExtension();
            $documentPath = $document->storeAs('documents', $documentName, 'public');
            $input['attachments'] = $documentPath;
        }

        $expense = Expense::create($input);

        $success['status'] = 200;
        $success['message'] = 'Expense created successfully';
        $success['data'] = $expense;

        return response()->json(['success' => $success]);
    }


    public function edit_expense(Request $request, $id)
    {

        $expense  = Expense::find($id);

        if ($expense) {

            if ($request->date) {
                $expense->date  = $request->date;
            }
            if ($request->reason) {



                $expense->reason  = $request->reason;
            }

            if ($request->amount) {
                $expense->amount = $request->amount;
            }

            if ($request->hasFile('attachments')) {
                $document = $request->file('attachments');
                $documentName = rand(0000, 9999) . '.' . $document->getClientOriginalExtension();
                $documentPath = $document->storeAs('documents', $documentName, 'public');
                $expense->attachments = $documentPath;
            }

            $expense->save();

            $success['status'] = 200;
            $success['message'] = 'Expense updated successfully';
            $success['data'] = $expense;

            return response()->json(['success' => $success]);
        } else {
            $error['status'] = 400;
            $error['message'] = 'Expense not found';

            return response()->json(['error' => $error]);
        }
    }


    public function delete_expense($id)
    {

        $expense =  Expense::find($id);
        $expense->delete();

        $success['status'] = 200;
        $success['message'] = 'Expense deleted successfully';
        $success['data'] = $expense;

        return response()->json(['success' => $success]);
    }

    public function get_expenses()
    {
        $expense  = Expense::all();

        if ($expense->count() > 0) {

            $success['status'] = 200;
            $success['message'] = 'Expenses fetched successfully';
            $success['data'] = $expense;
            return response()->json(['success' => $success]);
        } else {
            $error['status'] = 400;
            $error['message'] = 'No expenses found';
            return response()->json(['error' => $error]);
        }
    }

    /* Appointments management */


    public function create_appointment(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
        ]);

        $input  = $request->all();


        $appointment = Appointment::create($input);

        $succcess['status'] = 200;
        $success['message'] = 'Appointment created successfully';
        $success['data'] = $appointment;

        return response()->json(['success' => $success]);
    }

    public function edit_appointment(Request $request, $id)
    {

        $appointment =  Appointment::find($id);

        if ($appointment) {

            if ($request->name) {
                $appointment->name = $request->name;
            }

            if ($request->email) {
                $appointment->email = $request->email;
            }

            if ($request->phone) {
                $appointment->phone = $request->phone;
            }

            if ($request->appointment_date) {
                $appointment->appointment_date = $request->appointment_date;
            }

            if ($request->appointment_time) {
                $appointment->appointment_time = $request->appointment_time;
            }

            $appointment->save();

            $success['status'] = 200;
            $success['message'] = 'Appointment updated successfully';
            $success['data'] = $appointment;

            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 400;
            $error['message'] = 'Appointment not found';

            return response()->json(['error' => $error]);
        }
    }

    public function delete_appointment($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        $success['status'] = 200;
        $success['message'] = 'Appointment deleted successfully';
        $success['data'] = $appointment;

        return response()->json(['success' => $success]);
    }

    public function get_appointments()
    {

        $appointment = Appointment::all();

        if ($appointment->count() > 0) {

            $success['status'] = 200;
            $success['message'] = 'Appointments found successfully';
            $success['data'] = $appointment;

            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 400;
            $error['message'] = 'No appointments founds';

            return response()->json(['error' => $error]);
        }
    }

    public function approved_appointment(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if ($appointment) {

            if ($appointment->status == 'pending') {
                $appointment->status = $request->status;
            }

            $appointment->save();

            Mail::to($appointment->email)->send(new AppointmentApproved($appointment));
            $success['status'] = 200;
            $success['message'] = 'Appointment ' . $appointment->status . ' successfully';
            $success['data'] = $appointment;

            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 400;
            $error['message'] = 'Appointment not found';

            return response()->json(['error' => $error]);
        }
    }


    public function get_analytics()
    {
        $data = [];

        $currentMonth = Carbon::now()->month;
        $allCars = Car::where('created_at', 'like', '%' . $currentMonth . '%')->count();


        $soldCarsByMonth = Car::where('status', 'sold')->count();
        $totalEmployees = Employees::all()->count();


        $totalExpenseInMonth = Expense::whereMonth('created_at', $currentMonth)->sum('amount');

        $salesInMonth = Car::whereMonth('created_at', $currentMonth)->sum('price');
        $profitOrLoss = $salesInMonth - $totalExpenseInMonth;


        $data['allCars'] = $allCars;
        $data['soldCarsByMonth'] = $soldCarsByMonth;
        $data['totalEmployees'] = $totalEmployees;
        $data['totalExpenseInMonth'] = $totalExpenseInMonth;
        $data['profitOrLoss'] = $profitOrLoss;

        $success['status'] = 200;
        $success['message'] = 'Analytics found successfully';
        $success['data'] = $data;

        return response()->json(['success' => $success]);
    }

    public function generateQrCode()
    {
        $qrCodeData = rand(100000, 999999);

        $existingToken = Token::find(5);

        if ($existingToken) {
            $existingToken->token = $qrCodeData;
            $existingToken->expires_at = Carbon::now()->addMinute();
            $existingToken->save();
        }

        // Generate QR code in SVG format
        $qrcode = QrCode::size(300)->format('svg')->generate($qrCodeData);

        $filename = 'qr_code_' . $qrCodeData . '.svg';
        $imagePath = 'public/qrcodes/' . $filename;

        Storage::put($imagePath, $qrcode);

        $publicPath = Storage::url($imagePath);

        return response()->json([
            'qr_code_path' => $publicPath,
            'expires_at' => $existingToken->expires_at->toDateTimeString(),
            'qr_code_data' => $qrCodeData
        ]);
    }


    public function markAttendance(Request $request)
    {

        $request->validate([
            'token' => 'required|string',
            'user_id' => 'required|integer',
            'action' => 'required|string|in:clock_in,clock_out,break_in,break_out'
        ]);

        $token = $request->input('token');
        $userId = $request->input('user_id');
        $action = $request->input('action');


        $cachedToken = Token::where('token', '=', $token)->first();

        if (!$cachedToken) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid token.',
            ]);
        }

        $today = date('Y-m-d');

        $attendance = Attendance::where('employee_id', $userId)->whereDate('date', $today)->first();

        if ($attendance) {
            switch ($action) {

                case 'clock_out':
                    if (!$attendance->clock_out) {
                        $attendance->clock_out = $request->input('clock_out', date('H:i:s'));
                        $attendance->working_hours = $this->calculateWorkingHours($attendance);
                        $attendance->save();

                        return response()->json([
                            'status' => 200,
                            'data' => $attendance,
                            'message' => 'Clock-out time recorded successfully.',
                        ]);
                    } else {
                        return response()->json([
                            'status' => 400,
                            'message' => 'Already clocked out for today.',
                        ]);
                    }

                    break;

                case 'break_in':
                    if ($attendance->clock_out || $attendance->break_in) {
                        return response()->json([
                            'status' => 400,
                            'message' => 'Cannot start break. Already clocked out or on break.',
                        ]);
                    } else {
                        $attendance->break_in = date('H:i:s');
                        $attendance->save();

                        return response()->json([
                            'status' => 200,
                            'data' => $attendance,
                            'message' => 'Break-in time recorded successfully.',
                        ]);
                    }
                    break;

                case 'break_out':
                    if (!$attendance->break_in || $attendance->break_out) {
                        return response()->json([
                            'status' => 400,
                            'message' => 'Cannot end break. No active break found.',
                        ]);
                    } else {
                        $attendance->break_out = date('H:i:s');
                        $attendance->save();

                        return response()->json([
                            'status' => 200,
                            'data' => $attendance,
                            'message' => 'Break-out time recorded successfully.',
                        ]);
                    }
                    break;

                default:
                    return response()->json([
                        'status' => 400,
                        'message' => 'Invalid action.',
                    ]);
            }
        } else {

            if ($action == 'clock_in') {

                $attendance = Attendance::create([
                    'employee_id' => $userId,
                    'date' => $today,
                    'clock_in' => date('H:i:s'),
                ]);

                return response()->json([
                    'status' => 200,
                    'data' => $attendance,
                    'message' => 'Clock-in time recorded successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid action. No existing clock-in found for today.',
                ]);
            }
        }
    }

    private function calculateWorkingHours($attendance)
    {
        $clockIn = new \DateTime($attendance->clock_in);
        $clockOut = new \DateTime($attendance->clock_out);
        $breakIn = $attendance->break_in ? new \DateTime($attendance->break_in) : null;
        $breakOut = $attendance->break_out ? new \DateTime($attendance->break_out) : null;

        $workingHours = $clockIn->diff($clockOut)->h;

        if ($breakIn && $breakOut) {
            $breakDuration = $breakIn->diff($breakOut);
            $workingHours -= $breakDuration->h;
        }

        $attendance->working_hours = $workingHours;
        $attendance->save();
    }

    public function getAttendances(Request $request)
    {
        $attendances = Attendance::where('date', '=', $request->date)->get();

        if ($attendances->count() > 0) {
            $success['status'] = 200;
            $success['message'] = 'Attendances found successfully';
            $success['data'] = $attendances;

            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 400;
            $error['message'] = 'No attendances found';

            return response()->json(['error' => $error]);
        }
    }



    public function editAttendances(Request $request, $id)
    {

        $attendances = Attendance::find($id);

        if ($attendances) {

            if ($request->clock_in) {
                $attendances->clock_in = $request->clock_in;
            }

            if ($request->clock_out) {
                $attendances->clock_out = $request->clock_out;
            }

            if ($request->break_in) {
                $attendances->break_in = $request->break_in;
            }

            if ($request->break_out) {
                $attendances->break_out  = $request->break_out;
            }

            if ($request->working_hours) {
                $attendances->working_hours = $request->working_hours;
            }

            $attendances->save();

            $success['status'] = 200;
            $success['message'] = 'Attendances updated successfully';
            $success['data'] = $attendances;

            return response()->json(['success' => $success]);
        } else {

            $error['status'] = 400;
            $error['message'] = 'No attendances found';

            return response()->json(['error' => $error]);
        }
    }
}
