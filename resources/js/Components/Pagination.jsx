import React, {useEffect} from 'react';
import {Link} from "@inertiajs/react";

export default function Pagination({ links,setData,setIsLoading }) {
    let paginationLinks = []
    makePaginationLinks(links);
    function makePaginationLinks(){
        paginationLinks = links.slice(1,links.length)
        paginationLinks.pop()
    }

    function getClassName(active) {
        if(active) {
            return "mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded focus:border-primary focus:text-primary bg-blue-500 text-white";
        } else{
            return "mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary";
        }
    }

    async function paginate(event){
        setIsLoading(true)
        const url = event.target.getAttribute('data-url');
        await axios.get(url).then((response) => {
            setData(response.data);
            setIsLoading(false)
        });
    }
    return (
        links.length > 3 && (
            <div className="mb-4">
                <div className="flex flex-wrap mt-8 justify-center">
                    <span
                          className="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary cursor-pointer"
                          data-url={ links[0].url }
                          onClick={paginate}
                    >
                        قبلی
                    </span>
                    {paginationLinks.map((link, key) => (
                        <span key={key}
                            className={"cursor-pointer "+getClassName(link.active)}
                            onClick={paginate} data-url={link.url}
                        >
                            {link.label}
                        </span>
                    ))}
                    <span
                        className="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary cursor-pointer"
                        data-url={ links[links.length - 1].url }
                        onClick={paginate}
                    >
                        بعدی
                    </span>
                </div>
            </div>
        )
    );
}
