import {useState} from "react";
import {BsSortDown, BsSortUp} from "react-icons/bs";
export default function TableHead  (props) {
    const [sortField, setSortField] = useState("");
    const [order, setOrder] = useState("asc");
    const handleSortingChange = (field) => {
        setSortField(field);
        setOrder((prevOrder) => {
            const sortOrder = field === sortField && prevOrder === "desc" ? "asc" : "desc";
            props.handleSorting(field, sortOrder);
            return sortOrder;
        });
    };
    return (
        <thead className="border-b font-medium dark:border-neutral-500">
        <tr>
            <th className="px-6 py-4 cursor-pointer" onClick={() => handleSortingChange("id")}>#</th>
            {props.columns.map((column,key) => {
                return (
                    <th scope="col"
                        className="px-6 py-4 cursor-pointer"
                        key={key}
                        onClick={() => handleSortingChange(column.field)}>
                        {column.label}
                        {order === "desc" && column.field === sortField ? <BsSortDown size={20} className="ms-2"/> : <BsSortUp size={20} className="ms-2"/>}
                    </th>
                )
            })}
            {/*<th scope="col" className="px-6 py-4 cursor-pointer">
                عملیات
            </th>*/}
        </tr>
        </thead>
    );
};

