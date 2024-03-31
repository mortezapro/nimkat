import {useState} from "react";
import TableHead from "@/Components/DataTable/TableHead.jsx";
import TableBody from "@/Components/DataTable/TableBody.jsx";

export default function DataTable(props){
    return (
        <table className="min-w-full text-sm text-center font-light">
            <TableHead columns={props.data.columns} handleSorting={props.handleSorting}/>
            <TableBody data={props.data} deleteEntity={props.deleteEntity} entity={props.entity} editable={props.editable} />
        </table>
    )
}
