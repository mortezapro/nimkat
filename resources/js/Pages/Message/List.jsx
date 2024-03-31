import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import {Head, Link, router} from "@inertiajs/react";
import Pagination from "@/Components/Pagination.jsx";
import DataTable from "@/Components/DataTable/DataTable.jsx";
import {useState, useRef, useCallback, useEffect} from "react";
import {ImSpinner2} from "react-icons/im";
import {debounce} from "lodash/function.js";
import {toast, ToastContainer} from "react-toastify";
import 'react-toastify/dist/ReactToastify.css';
import axios from "axios";

export default function List({ auth,messages }) {
    const entity = "messages"
    const [data,setData] = useState(messages);
    const [filterParams,setFilterParams] = useState({search:"",sortField:"",orderBy:"",perPage:10});
    const [isLoading,setIsLoading] = useState(false);
    console.log(data)
    data.columns = [
        // { label: "#", accessor: "id", field:"id"},
        { label: "کاربر", accessor: "fullName", field:"user_id"},
        { label: "گروه", accessor: "chatName", field:"chat_id"},
        { label: "متن", accessor: "text", field:"text" },
        { label: "تاریخ", accessor: "created_at", field:"created_at" },
    ];

    const searchValueRef = useRef(null);
    const perPageRef = useRef(null);

    const handleSorting = (sortField, sortOrder) => {
        setIsLoading(true);
        const updatedFilterParams = {
            ...filterParams,
            column: sortField,
            orderBy: sortOrder,
        };
        if (searchValueRef.current.value) {
            updatedFilterParams.search = searchValueRef.current.value;
        }
        setFilterParams(updatedFilterParams);
        fetchAndSetData(updatedFilterParams).then(r =>  { setIsLoading(false) } )
    };

    const handleFilter = useCallback(
        debounce(async () => {
            setIsLoading(true);
            const updatedFilterParams = {
                ...filterParams,
                search: searchValueRef.current.value,
            };
            setFilterParams(updatedFilterParams);
            await fetchAndSetData(updatedFilterParams);
            setIsLoading(false)
        }, 500, { trailing: true, leading: false }),
        [filterParams]
    );

    const handlePerPage = () => {
        const updatedFilterParams = {
            ...filterParams,
            perPage: perPageRef.current.value,
        };
        setFilterParams(updatedFilterParams);
        setIsLoading(true);
        fetchAndSetData(updatedFilterParams).then(() => setIsLoading(false));
    };

    const fetchAndSetData = async (filterParams) => {
        await axios.get(route(entity+".index"),{params: filterParams,}).then((response) => {
            setData(response.data);
        });
    }
    const deleteEntity = async (e) => {
        if (confirm("آیا واقعا می‌خواهید سوال را حذف کنید؟")) {
            await axios.delete(route(entity+".destroy",e.target.getAttribute("data-id")));
            await fetchAndSetData(filterParams);
            notify("عملیات با موفقیت انجام شد")
        }
    }

    const notify = (message) => {
        toast.success(message)
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="inline-block font-semibold text-xl text-gray-800 leading-tight me-3">لیست سوالات</h2>}
            button={<Link href={route(entity+".create")} className="inline-block me-2 bg-transparent hover:bg-blue-500 text-blue-500 text-sm hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">ایجاد سوال جدید</Link>}
        >
            <Head title="Dashboard" />

            <div className="py-5">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="flex justify-between">
                        <div>
                            <input defaultValue={searchValueRef.current ? searchValueRef.current.value:""} ref={searchValueRef} onChange={handleFilter} type="text" className="p-2 my-2 ms-2 border-0 rounded-lg text-sm w-80" placeholder="تایپ کنید"/>
                            {isLoading?<ImSpinner2 className="spin inline-block ms-3" size="20" />:''}
                            <span className="text-sm     ms-3">({data.total} رکورد)</span>
                        </div>
                        <div>
                            <select ref={perPageRef} onChange={handlePerPage} defaultValue="10" className="border border-gray-300 focus:border-blue-500 focus:ring-0 p-2 my-2 ms-2 border-0 rounded-lg text-sm w-20 ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>

                    <div className="relative bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                        <DataTable data={data} handleSorting={handleSorting} deleteEntity={deleteEntity} entity={entity} />
                        <Pagination class="mt-6" links={data.links} setData={setData} setIsLoading={setIsLoading}/>
                    </div>
                </div>
            </div>
            <ToastContainer position="bottom-right" rtl={true} pauseOnFocusLoss/>
        </AuthenticatedLayout>
    );
}
