import {Link} from "@inertiajs/react";
export default function TableBody (props) {
    const data = props.data.data
    const columns = props.data.columns
    return (
        <tbody className="border-b font-medium dark:border-neutral-500">
        {data.map((data,key) => {
            return (
                <tr className="border-b dark:border-neutral-500" key={data.id}>
                    <td className="whitespace-nowrap px-6 py-3">{key+1}</td>
                    {columns.map(({ accessor }) => {
                        let tData = data[accessor] ? data[accessor] : "——";
                        return (
                            <td className="whitespace-nowrap px-6 py-3 font-medium" key={accessor}>
                                {tData}
                            </td>
                        )
                    })}
                    {/*<td className="whitespace-nowrap px-6 py-3">*/}
                    {/*    { props.editable !== false ? <Link href={route(props.entity+".edit",data.id)} className="inline-block me-2 bg-blue-500 hover:bg-blue-500 text-white text-sm hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">*/}
                    {/*        ویرایش*/}
                    {/*    </Link> : "-"}*/}
                    {/*    {props.deleteEntity !== undefined ? (*/}
                    {/*        <button*/}
                    {/*            onClick={props.deleteEntity}*/}
                    {/*            data-id={data.id}*/}
                    {/*            className="inline-block bg-transparent hover:bg-red-500 text-red-500 hover:text-white border border-red-500 text-sm hover:border-transparent py-2 px-4 rounded"*/}
                    {/*        >*/}
                    {/*            حذف*/}
                    {/*        </button>*/}
                    {/*    ) : null}*/}
                    {/*</td>*/}
                </tr>
            );
        })}
        </tbody>
    );
};

